<?php
require_once 'model/crud.php'; // Ensure this path is correct
require_once 'entities/offer.php';

class OfferModel extends Offer {
    private $crud;
    private $lastInsertedId;

    public function __construct() {
        $this->crud = new CRUD(
            'offers',               // Table name
            'id',                   // Primary key
            ['user_id', 'title', 'description', 'interest_rate', 'term_length', 'amount_min', 'amount_max'], // Columns
            [] // No location columns needed for sorting in this context
        );
    }

    public function save() {
        $offerData = [
            'user_id' => $this->getUserId(), // Ensure user_id is set
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'interest_rate' => $this->getInterestRate(),
            'term_length' => $this->getTermLength(),
            'amount_min' => $this->getAmountMin(),
            'amount_max' => $this->getAmountMax(),
        ];

        $lastInsertId = $this->crud->create($offerData);
        if ($lastInsertId) {
            $this->lastInsertedId = $lastInsertId;
            return true;
        }

        return false;
    }

    public function update($id) {
        $offerData = [
            'user_id' => $this->getUserId(), // Ensure user_id is set
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'interest_rate' => $this->getInterestRate(),
            'term_length' => $this->getTermLength(),
            'amount_min' => $this->getAmountMin(),
            'amount_max' => $this->getAmountMax(),
        ];

        error_log('Updating Offer ID: ' . $id . ' with Data: ' . print_r($offerData, true));
        
        return $this->crud->update($id, $offerData);
    }

    public function delete($id) {
        $this->crud->delete($id);
    }

    public function getAllOffers($limit = 100) {
        return $this->crud->fetchAll($limit);
    }

    public function getOfferById($id) {
        return $this->crud->read($id);
    }

    public function getLastInsertedId() {
        return $this->lastInsertedId;
    }
}
?>