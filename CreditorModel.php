<?php
require_once 'model/crud.php';

class CreditorModel {
    private $crud;

    public function __construct() {
        $this->crud = new CRUD(
            'Creditors',           // Table name
            'id',                  // Primary key
            ['user_id', 'description', 'country', 'region', 'town', 'address', 'zipcode', 'status'], // Columns
            ['town', 'region', 'country'] // Location columns for sorting
        );
    }

    public function create() {
        $creditorData = $this->crud->getSanitizedPostData();
        $this->crud->create($creditorData);
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
        $creditorData = $this->crud->getSanitizedPostData();
        $this->crud->update($id, $creditorData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }

    public function getAllCreditorsWithLocation($limit = 100) {
        return $this->crud->getAllRecordsWithLocation($limit);
    }
}
?>
