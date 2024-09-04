<?php
require_once 'DatabaseConnection.php';

class CRUD extends DatabaseConnection {
    private $tableName;
    private $primaryKey;
    private $columns;
    private $locationColumns;

    public function __construct($tableName, $primaryKey, $columns, $locationColumns = []) {
        parent::__construct(); // Call the parent constructor
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
        $this->columns = $columns;
        $this->locationColumns = $locationColumns;
    }

    // Create a new record
    public function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));

        $sql = "INSERT INTO " . $this->tableName . " ($columns) VALUES ($placeholders)";
        $this->executeQuery($sql, array_values($data));
        return $this->pdo->lastInsertId();

    }

    // Read a record by ID
    public function read($id) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->primaryKey . " = ?";
        $stmt = $this->executeQuery($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a record
    public function update($id,$data) {
        $setClause = implode(", ", array_map(function($col) {
            return "$col = ?";
        }, array_keys($data)));

        $sql = "UPDATE " . $this->tableName . " SET $setClause WHERE " . $this->primaryKey . " = ?";
        $params = array_merge(array_values($data),[$id]);
        return $this->executeQuery($sql, $params);
    }

    // Delete a record
    public function delete($id) {
        $sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->primaryKey . " = ?";
        return $this->executeQuery($sql, [$id]);
    }

    // Get and sanitize POST parameters
    public function getSanitizedPostData() {
        return $this->getSanitizedPostParams($this->columns);
    }

    // Get all records with location sorting and limiting
    public function getAllRecordsWithLocation($limit = 100) {
        if (empty($this->locationColumns)) {
            $sql = "SELECT * FROM " . $this->tableName . " LIMIT ?";
            $stmt = $this->executeQuery($sql, [$limit]);
        } else {
            $locationSort = implode(', ', $this->locationColumns);
            $sql = "SELECT * FROM " . $this->tableName . " ORDER BY $locationSort LIMIT ?";
            $stmt = $this->executeQuery($sql, [$limit]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch user by username
    public function getUserByUsername($username) {
        $sql = "SELECT id, username, password, role FROM Users WHERE username = ?";
        $stmt = $this->executeQuery($sql, [$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  // Fetch user by email
public function getUserByEmail($email) {
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $this->executeQuery($sql, [$email]);

    if ($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Handle the error or return null if query execution fails
        error_log('Failed to execute query: ' . $sql);
        return false;
    }
}

  // Fetch user by id
public function getUserById($id) {
    $sql = "SELECT * FROM Users WHERE id = ?";
    $stmt = $this->executeQuery($sql, [$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>
