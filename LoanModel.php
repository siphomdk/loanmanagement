<?php
require_once 'model/crud.php';

class LoanModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'LoanRequests',       // Table name
            'id',                // Primary key
            ['debtor_id', 'creditor_id', 'amount', 'request_date', 'status'] // Columns
        );
    }

    public function createRequest($debtorId, $creditorId, $amount) {
        $data = [
            'debtor_id' => $debtorId,
            'creditor_id' => $creditorId,
            'amount' => $amount,
            'status' => 'Pending'
        ];
        return $this->crud->create($data);
    }

    public function getRequestsByCreditor($creditorId) {
        return $this->crud->getAllRecordsWithLocation($creditorId);
    }

    public function updateRequestStatus($id, $status) {
        $data = ['status' => $status];
        return $this->crud->update($id, $data);
    }
}
?>
