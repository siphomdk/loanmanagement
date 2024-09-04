<?php
class Ticket {
    protected $ticket_id;
    protected $creditor_id;
    protected $debtor_id;
    protected $amount;
    protected $description;
    protected $status;
    protected $created_at;
    protected $updated_at;

    public function __construct($ticket_id = null, $creditor_id = null, $debtor_id = null, $amount = null, $description = '', $status = 'open') {
        $this->ticket_id = $ticket_id;
        $this->creditor_id = $creditor_id;
        $this->debtor_id = $debtor_id;
        $this->amount = $amount;
        $this->description = $description;
        $this->status = $status;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    // Getter and Setter methods
    public function getTicketId() {
        return $this->ticket_id;
    }

    public function setTicketId($ticket_id) {
        $this->ticket_id = $ticket_id;
    }

    public function getCreditorId() {
        return $this->creditor_id;
    }

    public function setCreditorId($creditor_id) {
        $this->creditor_id = $creditor_id;
    }

    public function getDebtorId() {
        return $this->debtor_id;
    }

    public function setDebtorId($debtor_id) {
        $this->debtor_id = $debtor_id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
	
	
    // Fetch all tickets
    public function fetchAllTickets() {
        return $this->fetchAll(); // Use the fetchAll method from CRUDBase
    }
}
?>
