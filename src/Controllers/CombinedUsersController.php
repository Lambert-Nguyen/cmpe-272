<?php

require_once __DIR__ . '/Controller.php';

class CombinedUsersController extends Controller {
    
    /**
     * Display combined users from all companies (local + remote via CURL)
     */
    public function index() {
        // Partner company URLs (you'll need to get these from your teammates)
        // Replace these with actual URLs from your group members
        $partnerCompanies = [
            // Add your group members' URLs here
            // Example:
            // 'Company B' => 'https://company-b-url.com/api/users',
            // 'Company C' => 'https://company-c-url.com/api/users',
        ];
        
        // Get local users (Company A - your company)
        $localUsers = $this->getLocalUsers();
        
        // Get remote users via CURL
        $remoteUsers = $this->getRemoteUsers($partnerCompanies);
        
        // Combine all users
        $allCompanies = [
            [
                'name' => 'Lambert Nguyen Company',
                'url' => 'https://lambertnguyen.cloud',
                'users' => $localUsers,
                'source' => 'local',
                'status' => 'success'
            ]
        ];
        
        // Add remote company data
        $allCompanies = array_merge($allCompanies, $remoteUsers);
        
        // Calculate statistics
        $totalUsers = 0;
        $activeCompanies = 0;
        foreach ($allCompanies as $company) {
            if ($company['status'] === 'success') {
                $totalUsers += count($company['users']);
                $activeCompanies++;
            }
        }
        
        $data = [
            'title' => 'Combined User List - All Companies',
            'companies' => $allCompanies,
            'total_users' => $totalUsers,
            'total_companies' => count($allCompanies),
            'active_companies' => $activeCompanies,
            'partner_urls' => array_keys($partnerCompanies)
        ];
        
        $this->render('combined-users/index', $data);
    }
    
    /**
     * API endpoint to return users as JSON (for other companies to call via CURL)
     */
    public function api() {
        // Set JSON header
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests
        header('Access-Control-Allow-Methods: GET');
        
        // Get local users
        $users = $this->getLocalUsers();
        
        // Return JSON response
        echo json_encode([
            'success' => true,
            'company' => 'Lambert Nguyen Company',
            'url' => 'https://lambertnguyen.cloud',
            'count' => count($users),
            'users' => $users,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit;
    }
    
    /**
     * Get local users from database/text file
     */
    private function getLocalUsers() {
        $usersFile = __DIR__ . '/../../database/users.txt';
        $users = [];
        
        if (file_exists($usersFile)) {
            $lines = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                // Parse pipe-delimited format: Name|Email|Role|Status|JoinDate
                $parts = explode('|', $line);
                if (count($parts) >= 5) {
                    $users[] = [
                        'name' => trim($parts[0]),
                        'email' => trim($parts[1]),
                        'role' => trim($parts[2]),
                        'status' => trim($parts[3]),
                        'join_date' => trim($parts[4])
                    ];
                }
            }
        }
        
        return $users;
    }
    
    /**
     * Get remote users from partner companies via CURL
     */
    private function getRemoteUsers($partnerCompanies) {
        $remoteData = [];
        
        foreach ($partnerCompanies as $companyName => $apiUrl) {
            $remoteData[] = $this->fetchUsersViaCurl($companyName, $apiUrl);
        }
        
        return $remoteData;
    }
    
    /**
     * Fetch users from a remote company using CURL
     */
    private function fetchUsersViaCurl($companyName, $apiUrl) {
        // Initialize CURL
        $ch = curl_init();
        
        // Set CURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 10 second timeout
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For development (remove in production)
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'User-Agent: Lambert-Nguyen-Company-CURL/1.0'
        ]);
        
        // Execute CURL request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        
        // Close CURL connection
        curl_close($ch);
        
        // Check if request was successful
        if ($response && $httpCode === 200) {
            $data = json_decode($response, true);
            
            if ($data && isset($data['success']) && $data['success']) {
                return [
                    'name' => $data['company'] ?? $companyName,
                    'url' => $data['url'] ?? $apiUrl,
                    'users' => $data['users'] ?? [],
                    'source' => 'remote',
                    'status' => 'success',
                    'timestamp' => $data['timestamp'] ?? null,
                    'http_code' => $httpCode
                ];
            }
        }
        
        // If failed, return error information
        return [
            'name' => $companyName,
            'url' => $apiUrl,
            'users' => [],
            'source' => 'remote',
            'status' => 'error',
            'error_message' => $curlError ?: "HTTP $httpCode - Failed to fetch data",
            'http_code' => $httpCode
        ];
    }
    
    /**
     * Test CURL connection to a specific company
     */
    public function testConnection() {
        $testUrl = $_GET['url'] ?? '';
        
        if (empty($testUrl)) {
            echo json_encode(['error' => 'No URL provided']);
            exit;
        }
        
        header('Content-Type: application/json');
        
        $result = $this->fetchUsersViaCurl('Test Company', $testUrl);
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit;
    }
}
