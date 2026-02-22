<?php

/** 
 * This file is responsible for establishing a connection to the database using PDO (PHP Data Objects).
 * It retrieves the database connection parameters from environment variables defined in a .env file.
 * The connection is established within a try-catch block to handle any potential connection errors.
 */
$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') === false) {
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

/** 
 * We retrieve the database connection parameters from the environment variables for security reasons, 
 * so that they are not hardcoded in the code and can be easily changed without modifying the code.
 */
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $connection_error) {
    error_log("Database connection error: " . $connection_error->getMessage());
    die("Database connection failed. Please try again later.");
}

return $pdo;
