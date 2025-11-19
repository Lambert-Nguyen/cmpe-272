<?php
/**
 * Database Configuration Checker
 *
 * This script helps diagnose database connection issues by showing:
 * - Which environment variables are set
 * - What values are being used for database connection
 * - Whether the database server is reachable
 *
 * SECURITY WARNING: Delete this file after debugging or restrict access!
 */

// Check if access is restricted (optional - uncomment to require a secret key)
// $secretKey = getenv('DB_CHECK_SECRET');
// if (!$secretKey || ($_GET['key'] ?? '') !== $secretKey) {
//     die('Access denied. Set DB_CHECK_SECRET env var and pass ?key=YOUR_SECRET');
// }

header('Content-Type: text/plain');

echo "=== Database Configuration Checker ===\n\n";

// Check server information
echo "Server Information:\n";
echo "- Server Name: " . ($_SERVER['SERVER_NAME'] ?? 'Not set') . "\n";
echo "- Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Not set') . "\n";
echo "- PHP Version: " . phpversion() . "\n";
echo "- PDO MySQL Available: " . (extension_loaded('pdo_mysql') ? 'Yes' : 'No') . "\n\n";

// Check environment variables
echo "Environment Variables:\n";
$envVars = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'APP_ENV'];
foreach ($envVars as $var) {
    $value = getenv($var) ?: ($_ENV[$var] ?? null);
    if ($var === 'DB_PASSWORD') {
        // Don't display actual password
        echo "- $var: " . ($value ? '[SET - ' . strlen($value) . ' chars]' : '[NOT SET]') . "\n";
    } else {
        echo "- $var: " . ($value ?: '[NOT SET - will use default]') . "\n";
    }
}

// Show what values will be used
echo "\nConnection Parameters That Will Be Used:\n";
$host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost');
$actualHost = ($host === 'localhost') ? '127.0.0.1' : $host;
$port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306);
$database = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'cmpe272_app');
$username = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root');
$hasPassword = !empty(getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? ''));

echo "- Host: $actualHost (original: $host)\n";
echo "- Port: $port\n";
echo "- Database: $database\n";
echo "- Username: $username\n";
echo "- Password: " . ($hasPassword ? '[SET]' : '[EMPTY]') . "\n\n";

// Test connection
echo "Connection Test:\n";
try {
    $dsn = "mysql:host=$actualHost;port=$port;dbname=$database;charset=utf8mb4";
    echo "- DSN: $dsn\n";

    $password = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? '');

    echo "- Attempting connection...\n";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);

    echo "✓ SUCCESS: Database connection established!\n";

    // Get database version
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "- MySQL Version: $version\n";

    // Check if tables exist
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "- Tables in database: " . count($tables) . "\n";
    if (count($tables) > 0) {
        echo "  Tables: " . implode(', ', array_slice($tables, 0, 10));
        if (count($tables) > 10) echo " ... and " . (count($tables) - 10) . " more";
        echo "\n";
    }

} catch (PDOException $e) {
    echo "✗ FAILED: " . $e->getMessage() . "\n\n";
    echo "Common solutions:\n";
    echo "1. Verify DB_HOST is set to the correct database server hostname\n";
    echo "2. Check that DB_PORT matches your database server port (default: 3306)\n";
    echo "3. Ensure DB_NAME, DB_USER, and DB_PASSWORD are correctly set\n";
    echo "4. Verify the database server is running and accessible from this server\n";
    echo "5. Check firewall rules allow connections from this web server to the database\n";
}

echo "\n=== End of Diagnostics ===\n";
echo "\nSECURITY WARNING: Delete this file after debugging!\n";
