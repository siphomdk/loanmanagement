<?php
class Ticket {
    private $id;
    private $creditor_id;
    private $debtor_id;
    private $duration;
    private $description;
    private $amount_owed;
    private $collectors_fee;
    private $status;

    // Constructor
    public function __construct($id, $creditor_id, $debtor_id, $duration, $description, $amount_owed, $collectors_fee, $status) {
        $this->id = $id;
        $this->creditor_id = $creditor_id;
        $this->debtor_id = $debtor_id;
        $this->duration = $duration;
        $this->description = $description;
        $this->amount_owed = $amount_owed;
        $this->collectors_fee = $collectors_fee;
        $this->status = $status;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getCreditorId() { return $this->creditor_id; }
    public function getDebtorId() { return $this->debtor_id; }
    public function getDuration() { return $this->duration; }
    public function getDescription() { return $this->description; }
    public function getAmountOwed() { return $this->amount_owed; }
    public function getCollectorsFee() { return $this->collectors_fee; }
    public function getStatus() { return $this->status; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setCreditorId($creditor_id) { $this->creditor_id = $creditor_id; }
    public function setDebtorId($debtor_id) { $this->debtor_id = $debtor_id; }
    public function setDuration($duration) { $this->duration = $duration; }
    public function setDescription($description) { $this->description = $description; }
    public function setAmountOwed($amount_owed) { $this->amount_owed = $amount_owed; }
    public function setCollectorsFee($collectors_fee) { $this->collectors_fee = $collectors_fee; }
    public function setStatus($status) { $this->status = $status; }

    // Example method to save the ticket to the database
    public function save() {
        // Implement database saving logic here
    }
}
?>
