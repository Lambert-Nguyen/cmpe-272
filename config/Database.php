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
        // These will be set in Render's environment
        // Use getenv() for better compatibility with different hosting environments
        $host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost');

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
                $this->connection = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        
        return $this->connection;
    }
    
    public function closeConnection() {
        $this->connection = null;
    }
}