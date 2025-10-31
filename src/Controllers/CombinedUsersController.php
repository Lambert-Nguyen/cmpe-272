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
            'Partner Company (Render)' => 'https://php-mysql-hosting-project.onrender.com/api/local_users.php',
            // Note: 42web.io blocks server-to-server requests, so using manual data entry below
            // 'Anukrithima Yadala Company' => 'http://anukrithimyadala.42web.io/users_api.php',
        ];
        
        // Manual partner data (for services that block CURL/server requests)
        // You can copy the JSON response from your partner's API and paste it here
        $manualPartnerData = [
            [
                'name' => 'PureBite Beauty',
                'url' => 'https://anukrithimyadala.42web.io',
                'users' => [
                    [
                        'name' => 'Mary Smith',
                        'email' => 'mary.smith@purebitebeauty.com',
                        'role' => 'Marketing Lead',
                        'status' => 'Active',
                        'join_date' => '2024-01-10'
                    ],
                    [
                        'name' => 'John Wang',
                        'email' => 'john.wang@purebitebeauty.com',
                        'role' => 'Product Designer',
                        'status' => 'Active',
                        'join_date' => '2024-02-14'
                    ],
                    [
                        'name' => 'Alex Bington',
                        'email' => 'alex.bington@purebitebeauty.com',
                        'role' => 'Software Engineer',
                        'status' => 'Active',
                        'join_date' => '2024-03-20'
                    ],
                    [
                        'name' => 'Emily Stone',
                        'email' => 'emily.stone@purebitebeauty.com',
                        'role' => 'Sales Associate',
                        'status' => 'Inactive',
                        'join_date' => '2024-04-05'
                    ]
                ],
                'source' => 'manual',
                'status' => 'success'
            ]
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
        
        // Add manual partner data
        foreach ($manualPartnerData as $partnerData) {
            $allCompanies[] = $partnerData;
        }
        
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
        // First, try file_get_contents (sometimes works better with free hosting)
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "Accept: application/json\r\n" .
                           "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n",
                'timeout' => 15,
                'ignore_errors' => true
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);
        
        $response = @file_get_contents($apiUrl, false, $context);
        
        // If file_get_contents worked, try to parse it
        if ($response !== false) {
            $response = trim($response);
            $response = preg_replace('/^\xEF\xBB\xBF/', '', $response); // Remove UTF-8 BOM
            
            $data = @json_decode($response, true);
            
            if (json_last_error() === JSON_ERROR_NONE && $data !== null) {
                // Successfully got JSON data
                $users = [];
                
                if (is_array($data) && isset($data[0])) {
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'Member',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $data);
                } elseif (is_array($data) && isset($data['users'])) {
                    // Normalize users array
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'Member',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $data['users']);
                } elseif (is_array($data) && isset($data['data'])) {
                    // Normalize data array
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'Member',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $data['data']);
                }
                
                if (!empty($users)) {
                    return [
                        'name' => isset($data['name']) ? $data['name'] : (isset($data['company']) ? $data['company'] : $companyName),
                        'url' => $apiUrl,
                        'users' => $users,
                        'source' => 'remote',
                        'status' => 'success',
                        'timestamp' => date('c'),
                        'http_code' => 200
                    ];
                }
            }
        }
        
        // If file_get_contents failed or didn't return valid JSON, try CURL
        // Initialize CURL
        $ch = curl_init();
        
        // Set CURL options for maximum compatibility
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20); // 20 second timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); // 15 second connection timeout
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification
        curl_setopt($ch, CURLOPT_ENCODING, ''); // Accept any encoding
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); // Force new connection
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true); // Don't reuse connections
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // Use HTTP 1.1
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json, text/html, */*',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: close',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        ]);
        
        // Execute CURL request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        
        // Close CURL connection
        curl_close($ch);
        
        // Check if request was successful
        if ($response && $httpCode === 200) {
            // Clean up the response (remove BOM and whitespace)
            $response = trim($response);
            $response = preg_replace('/^\xEF\xBB\xBF/', '', $response); // Remove UTF-8 BOM
            
            $data = json_decode($response, true);
            
            // Check for JSON decode errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                return [
                    'name' => $companyName,
                    'url' => $apiUrl,
                    'users' => [],
                    'source' => 'remote',
                    'status' => 'error',
                    'error_message' => 'Invalid JSON response: ' . json_last_error_msg() . '. Response: ' . substr($response, 0, 200),
                    'http_code' => $httpCode
                ];
            }
            
            if ($data !== null) {
                // Handle different JSON response formats
                $users = [];
                
                // Format 1: Direct array of users [{"name": "...", "role": "..."}, ...]
                if (is_array($data) && isset($data[0])) {
                    $users = $data;
                    // Normalize the format - ensure each user has required fields
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'N/A',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $users);
                }
                // Format 2: Object with users array {"success": true, "users": [...]}
                elseif (is_array($data) && isset($data['users']) && is_array($data['users'])) {
                    $users = $data['users'];
                    // Normalize the users
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'Member',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $users);
                }
                // Format 3: Object with data array {"data": [...]}
                elseif (is_array($data) && isset($data['data']) && is_array($data['data'])) {
                    $users = $data['data'];
                    // Normalize the users
                    $users = array_map(function($user) {
                        return [
                            'name' => $user['name'] ?? 'Unknown',
                            'email' => $user['email'] ?? 'N/A',
                            'role' => $user['role'] ?? 'Member',
                            'status' => $user['status'] ?? 'Active',
                            'join_date' => $user['join_date'] ?? date('Y-m-d')
                        ];
                    }, $users);
                }
                
                // If we successfully parsed users, return success
                if (!empty($users)) {
                    return [
                        'name' => $data['name'] ?? $data['company'] ?? $companyName,
                        'url' => $data['url'] ?? $apiUrl,
                        'users' => $users,
                        'source' => 'remote',
                        'status' => 'success',
                        'timestamp' => $data['timestamp'] ?? null,
                        'http_code' => $httpCode
                    ];
                }
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
