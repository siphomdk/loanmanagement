<?php
require_once 'model/crud.php';

class TicketModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'Tickets',             // Table name
            'id',                  // Primary key
            ['creditor_id', 'debtor_id', 'duration', 'description', 'amount_owed', 'collectors_fee', 'status'], // Columns
            [] // No location columns for sorting
        );
    }

    public function create() {
        $ticketData = $this->crud->getSanitizedPostData();
        $this->crud->create($ticketData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $ticketData = $this->crud->getSanitizedPostData();
        $this->crud->update($id, $ticketData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }
      // New method to get all records with location-based sorting and limiting
    public function getAllRecordsWithLocation($limit = 100) {
        return $this->crud->getAllRecordsWithLocation($limit);
    }
}
?>
