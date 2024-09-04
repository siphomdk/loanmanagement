<?php
require_once 'model/crud.php'; // Ensure this path is correct
require_once 'entities/User.php';

class UserModel extends User {
    private $crud;
    private $lastInsertedId;

    public function __construct() {
        $this->crud = new CRUD(
            'Users',               // Table name
            'id',                  // Primary key
            ['name', 'email', 'password', 'role', 'status', 'address', 'town', 'province', 'country', 'zipcode'], // Columns
            ['town', 'province', 'country'] // Location columns for sorting
        );
    }

    public function save() {
        $userData = $this->crud->getSanitizedPostData();
        $lastInsertId=$this->crud->create($userData);
        if ($lastInsertId) {
            $this->lastInsertedId = $lastInsertId;
            return true;
        }

        return false;
    }

    public function read($id) {
        return $this->crud->read($id);
    }

    public function update($id) {
    // Log or debug to ensure data is being correctly passed to the update method
    $userData = $this->crud->getSanitizedPostData();
    error_log('Updating User ID: ' . $id . ' with Data: ' . print_r($userData, true));
    
    $this->crud->update($id, $userData);
}

    public function delete($id) {
        $this->crud->delete($id);
    }

    public function getAllUsersWithLocation($limit = 100) {
        return $this->crud->getAllRecordsWithLocation($limit);
    }

    // New method to get user by email
    public function getUserByEmail($email) {
         return $this->crud->getUserByEmail($email); 
    }
     // New method to get user by id
    public function findById($id) {
         return $this->crud->getUserById($id); 
    }
       public function getLastInsertedId() {
        return $this->lastInsertedId;
    }
}
?>
