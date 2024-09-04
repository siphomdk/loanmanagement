<?php
class Loan {
    private $id;
    private $debtor_id;
    private $creditor_id;
    private $amount;
    private $interest_rate;
    private $status;
    private $application_date;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDebtorId() {
        return $this->debtor_id;
    }

    public function getCreditorId() {
        return $this->creditor_id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getInterestRate() {
        return $this->interest_rate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getApplicationDate() {
        return $this->application_date;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setDebtorId($debtor_id) {
        $this->debtor_id = $debtor_id;
    }

    public function setCreditorId($creditor_id) {
        $this->creditor_id = $creditor_id;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function setInterestRate($interest_rate) {
        $this->interest_rate = $interest_rate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setApplicationDate($application_date) {
        $this->application_date = $application_date;
    }
}
?>
