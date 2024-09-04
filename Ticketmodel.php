<?php
require_once 'Ticket.php';
require_once 'crud.php'; // Assuming CRUD handles common database operations

class TicketModel extends Ticket {
    private $crud;


    public function __construct() {
        parent::__construct();
        $this->crud = new CRUD('Tickets', 'ticket_id');
    }

    // Create a new ticket
    public function createTicket($data) {
        $this->setCreditorId($data['creditor_id']);
        $this->setDebtorId($data['debtor_id']);
        $this->setAmount($data['amount']);
        $this->setDescription($data['description']);
        $this->setStatus('open'); // default status
        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $this->setUpdatedAt(date('Y-m-d H:i:s'));

        // Insert ticket into the database
        return $this->crud->create([
            'creditor_id' => $this->getCreditorId(),
            'debtor_id' => $this->getDebtorId(),
            'amount' => $this->getAmount(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ]);
    }

    // Fetch a ticket by ID
    public function getTicketById($ticket_id) {
        return $this->crud->fetchById($ticket_id);
    }

    // Update ticket status
    public function updateTicketStatus($ticket_id, $status) {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));

        return $this->crud->update($ticket_id, [
            'status' => $status,
            'updated_at' => $this->getUpdatedAt()
        ]);
    }

    // Delete a ticket
    public function deleteTicket($ticket_id) {
        return $this->crud->delete($ticket_id);
    }

    // Additional methods can be added as required
	
    // Fetch all tickets
    public function fetchAllTickets() {
        $sql = "SELECT * FROM tickets"; // Adjust table name and columns as needed
        $stmt = $this->crud->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
