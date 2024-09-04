<?php
class Account {
    private $id;
    private $user_id;
    private $account_number;
    private $balance;

    // Constructor
    public function __construct($id, $user_id, $account_number, $balance) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->account_number = $account_number;
        $this->balance = $balance;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getAccountNumber() { return $this->account_number; }
    public function getBalance() { return $this->balance; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function setAccountNumber($account_number) { $this->account_number = $account_number; }
    public function setBalance($balance) { $this->balance = $balance; }

    // Example method to save the account to the database
    public function save() {
        // Implement database saving logic here
    }
}
?>
