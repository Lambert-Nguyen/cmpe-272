<?php

class Database {
    private $host;
    private $database;
    private $username;
    private $password;
    private $port;
    private $connection;
    
    public function __construct() {
        // Use environment variables for database configuration
        // These will be set in the hosting environment
        // Use getenv() for better compatibility with different hosting environments
        $host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null);

        // Check if we're in a production-like environment without DB_HOST set
        if ($host === null) {
            // Check if this looks like a production environment
            $serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
            $isProduction = !in_array($serverName, ['localhost', '127.0.0.1', '']);

            if ($isProduction) {
                throw new Exception(
                    "Database configuration error: DB_HOST environment variable is not set. " .
                    "Please configure database environment variables (DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD) in your hosting environment."
                );
            }

            // Default to localhost for local development only
            $host = 'localhost';
        }

        // Convert 'localhost' to '127.0.0.1' to force TCP connection
        // This avoids "No such file or directory" socket errors
        $this->host = ($host === 'localhost') ? '127.0.0.1' : $host;

        $this->database = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'cmpe272_app');
        $this->username = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root');
        $this->password = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? '');
        $this->port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306);
    }
    
    public function getConnection() {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";

                // Add connection timeout to fail faster
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_TIMEOUT => 5  // 5 second timeout
                ];

                $this->connection = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                // Provide detailed error message for debugging
                $errorMsg = "Database connection failed: " . $e->getMessage() . "\n";
                $errorMsg .= "Connection details: host={$this->host}, port={$this->port}, database={$this->database}, user={$this->username}\n";
                $errorMsg .= "\nPlease verify:\n";
                $errorMsg .= "1. Database server is running and accessible\n";
                $errorMsg .= "2. Environment variables are properly configured: DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD\n";
                $errorMsg .= "3. Firewall/security groups allow connection from this server\n";
                $errorMsg .= "4. Database credentials are correct\n";

                throw new Exception($errorMsg);
            }
        }

        return $this->connection;
    }
    
    public function closeConnection() {
        $this->connection = null;
    }
}