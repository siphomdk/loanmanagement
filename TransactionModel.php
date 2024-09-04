<?php
require_once 'entities/Transaction.php'; // Assuming Transaction.php contains the base class
require_once 'crud.php'; // Assuming CRUD.php contains the CRUD class

class TransactionModel extends Transaction {
    private $crud;

    public function __construct($userId, $accountId, $transactionType, $amount, $transactionDate) {
        parent::__construct($userId, $accountId, $transactionType, $amount, $transactionDate);

        // Initialize CRUD for database operations
        $this->crud = new CRUD('transactions', 'transaction_id', ['user_id', 'account_id', 'transaction_type', 'amount', 'transaction_date']);
    }

    // Method to insert a new transaction record
    public function insertTransaction() {
        $data = [
            'user_id' => $this->getUserId(),
            'account_id' => $this->getAccountId(),
            'transaction_type' => $this->getTransactionType(),
            'amount' => $this->getAmount(),
            'transaction_date' => $this->getTransactionDate()
        ];
        return $this->crud->create($data);
    }

    // Additional methods to interact with the transactions can be added here
}
