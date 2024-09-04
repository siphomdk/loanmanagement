<?php



class DatabaseConnection {
    protected $pdo;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $host = 'localhost'; // Database host
            $dbname = 'DebtCollectionPlatform'; // Database name
            $username = 'root'; // Database username
            $password = ''; // Database password

            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function getSanitizedPostParams($columns) {
        $sanitizedData = [];
        foreach ($columns as $column) {
            if (isset($_POST[$column])) {
                $sanitizedData[$column] = htmlspecialchars($_POST[$column], ENT_QUOTES, 'UTF-8');
            }
        }
        return $sanitizedData;
    }
}
?>
