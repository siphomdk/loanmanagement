<?php
require_once 'entities/loan.php';
require_once 'model/crud.php';

class LoanModel extends Loan {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'Loans',                // Table name
            'id',                   // Primary key
            ['debtor_id', 'creditor_id', 'amount', 'interest_rate', 'status', 'application_date'], // Columns
            []                      // No location columns for sorting
        );
    }

    public function create() {
        $loanData = [
            'debtor_id' => $this->getDebtorId(),
            'creditor_id' => $this->getCreditorId(),
            'amount' => $this->getAmount(),
            'interest_rate' => $this->getInterestRate(),
            'status' => $this->getStatus(),
            'application_date' => $this->getApplicationDate()
        ];
        return $this->crud->create($loanData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $loanData = [
            'debtor_id' => $this->getDebtorId(),
            'creditor_id' => $this->getCreditorId(),
            'amount' => $this->getAmount(),
            'interest_rate' => $this->getInterestRate(),
            'status' => $this->getStatus(),
            'application_date' => $this->getApplicationDate()
        ];
        return $this->crud->update($id, $loanData);
    }

    public function delete($id) {
        return $this->crud->delete($id);
    }

    public function getAllLoans($limit = 100) {
        return $this->crud->getAllRecordsWithLocation($limit);
    }
}
?>
