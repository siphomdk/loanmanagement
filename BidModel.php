<?php
require_once 'model/crud.php';

class BidModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'Bids',                // Table name
            'id',                  // Primary key
            ['ticket_assignment_id', 'bidder_id', 'amount'] // Columns
        );
    }

    public function create() {
        $bidData = $this->crud->getSanitizedPostData();
        $this->crud->create($bidData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $bidData = $this->crud->getSanitizedPostData();
        $this->crud->update($id, $bidData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }

    // Fetch all bids related to a specific ticket assignment
    public function getBidsByTicketAssignment($ticketAssignmentId, $limit = 100) {
        $sql = "SELECT * FROM Bids WHERE ticket_assignment_id = ? LIMIT ?";
        $stmt = DatabaseConnection::executeQuery($sql, [$ticketAssignmentId, $limit]);
        $bids = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $bids;
    }
}
?>
