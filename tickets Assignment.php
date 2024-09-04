<?php
class TicketAssignment {
    private $id;
    private $ticket_id;
    private $collector_id;
    private $assignment_date;
    private $status;

    // Constructor
    public function __construct($id, $ticket_id, $collector_id, $assignment_date, $status) {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->collector_id = $collector_id;
        $this->assignment_date = $assignment_date;
        $this->status = $status;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTicketId() { return $this->ticket_id; }
    public function getCollectorId() { return $this->collector_id; }
    public function getAssignmentDate() { return $this->assignment
