<?php

class Transaction {
    protected $userId;
    protected $accountId;
    protected $transactionType;
    protected $amount;
    protected $transactionDate;

    public function __construct($userId, $accountId, $transactionType, $amount, $transactionDate) {
        $this->userId = $userId;
        $this->accountId = $accountId;
        $this->transactionType = $transactionType;
        $this->amount = $amount;
        $this->transactionDate = $transactionDate;
    }

    // Getters
    public function getUserId() {
        return $this->userId;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function getTransactionType() {
        return $this->transactionType;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getTransactionDate() {
        return $this->transactionDate;
    }
}
