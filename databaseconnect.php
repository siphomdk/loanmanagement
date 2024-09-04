<?php
// databaseconnection.php

require 'config.php'; // Include the configuration file

class DatabaseConnection {
    private $pdo;
    private static $instance = null;

    // Private constructor to prevent instantiation
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (DISPLAY_ERRORS) {
                echo "Database connection failed: " . $e->getMessage();
            }
            // Log error if logging is enabled
            if (LOG_ERRORS) {
                error_log("Database connection failed: " . $e->getMessage());
            }
            exit;
        }
    }

    // Get the singleton instance of the DatabaseConnection class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get the PDO instance
    public function getPDO() {
        return $this->pdo;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the instance
    private function __wakeup() {}
}

// Example usage:
$db = DatabaseConnection::getInstance()->getPDO();
?>
