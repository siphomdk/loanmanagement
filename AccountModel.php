<?php
require_once 'model/crud.php';
require_once 'entities/Account.php';

class AccountModel extends Account {
    private $crud;

    // Constructor to initialize AccountModel and CRUD
    public function __construct() {
        // Initialize CRUD with table and column details
        $this->crud = new CRUD(
            'Accounts',           // Table name
            'id',         // Primary key
            [
                'id',
                'user_id',
                'balance',
                'account_type',
                'created_at',
                'updated_at'
            ]
        );
    }

    // Method to create a new account record
    public function create($data) {
        return $this->crud->create($data);
    }

    // Method to read account by account ID
    public function read($accountId) {
        $accountData = $this->crud->read($accountId);
        if ($accountData) {
            // Populate the Account object with data from the database
            $this->setAccountId($accountData['id']);
            $this->setUserId($accountData['user_id']);
            $this->setBalance($accountData['balance']);
            $this->setAccountType($accountData['account_type']);
            $this->setCreatedAt($accountData['created_at']);
            $this->setUpdatedAt($accountData['updated_at']);
            return $this;
        }
        return null;
    }

    // Method to update an account
    public function updateAccount($accountId, $data) {
        return $this->crud->update($accountId, $data);
    }

    // Method to delete an account
    public function deleteAccount($accountId) {
        return $this->crud->delete($accountId);
    }

    // Additional method to get accounts by user ID
    public function getAccountByUserId($userId) {
        $sql = "SELECT * FROM Accounts WHERE user_id = ?";
        $stmt = $this->crud->executeQuery($sql, [$userId]);
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($accountData) {
            // Populate the Account object with data from the database
            $this->setAccountId($accountData['id']);
            $this->setUserId($accountData['user_id']);
            $this->setBalance($accountData['balance']);
            $this->setAccountType($accountData['account_type']);
            $this->setCreatedAt($accountData['created_at']);
            $this->setUpdatedAt($accountData['updated_at']);
            return $this;
        }
        return null;
    }

    // Example method to update the balance of an account
    public function updateBalance($accountId, $newBalance) {
        return $this->updateAccount($accountId, ['balance' => $newBalance]);
    }
}
?>
