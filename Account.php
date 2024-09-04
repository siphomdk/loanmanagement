<?php
class Account {
    protected $accountId;
    protected $userId;
    protected $balance;
    protected $accountType;
    protected $createdAt;
    protected $updatedAt;

    // Constructor to initialize an Account object
    public function __construct($accountId, $userId, $balance, $accountType, $createdAt, $updatedAt) {
        $this->accountId = $accountId;
        $this->userId = $userId;
        $this->balance = $balance;
        $this->accountType = $accountType;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters and setters for the account properties
    public function getAccountId() {
        return $this->accountId;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

    public function getAccountType() {
        return $this->accountType;
    }

    public function setAccountType($accountType) {
        $this->accountType = $accountType;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}
?>
