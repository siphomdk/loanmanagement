<?php
require_once 'CRUD.php';

class DebtorModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'Debtors',             // Table name
            'id',                  // Primary key
            ['user_id', 'description', 'country', 'region', 'town', 'address', 'zipcode', 'status'], // Columns
            ['town', 'region', 'country'] // Location columns for sorting
        );
    }

    public function create() {
        $debtorData = $this->crud->getSanitizedPostData();
        $this->crud->create($debtorData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $debtorData = $this->crud->getSanitizedPostData();
        $this->crud->update($id, $debtorData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }

    public function getAllDebtorsWithLocation($limit = 100) {
        return $this->crud->getAllRecordsWithLocation($limit);
    }
}
?>
