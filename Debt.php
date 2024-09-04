<?php
class Debt {
    private $id;
    private $creditor_id;
    private $debtor_id;
    private $description;
    private $amount;
    private $status;

    // Constructor
    public function __construct($id, $creditor_id, $debtor_id, $description, $amount, $status) {
        $this->id = $id;
        $this->creditor_id = $creditor_id;
        $this->debtor_id = $debtor_id;
        $this->description = $description;
        $this->amount = $amount;
        $this->status = $status;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getCreditorId() { return $this->creditor_id; }
    public function getDebtorId() { return $this->debtor_id; }
    public function getDescription() { return $this->description; }
    public function getAmount() { return $this->amount; }
    public function getStatus() { return $this->status; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setCreditorId($creditor_id) { $this->creditor_id = $creditor_id; }
    public function setDebtorId($debtor_id) { $this->debtor_id = $debtor_id; }
    public function setDescription($description) { $this->description = $description; }
    public function setAmount($amount) { $this->amount = $amount; }
    public function setStatus($status) { $this->status = $status; }

    // Example method to save the debt to the database
    public function save() {
        // Implement database saving logic here
    }
}
?>
