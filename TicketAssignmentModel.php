<?php
require_once 'CRUD.php';

class TicketAssignmentModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'TicketAssignments',   // Table name
            'id',                  // Primary key
            ['ticket_id', 'collector_id', 'assignment_date', 'status'], // Columns
            [] // No location columns for sorting
        );
    }

    public function create() {
        $assignmentData = $this->crud->getSanitizedPostData();
        $this->crud->create($assignmentData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $assignmentData = $this->crud->getSanitizedPostData();
        $this->crud->update($id, $assignmentData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }
}
?>
