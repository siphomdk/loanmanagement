<?php
class Offer {
    private $id;
    private $user_id;
    private $title;
    private $description;
    private $interest_rate;
    private $term_length;
    private $amount_min;
    private $amount_max;
    private $created_at;
    private $updated_at;

    // Constructor
    public function __construct($id, $user_id, $title, $description, $interest_rate, $term_length, $amount_min, $amount_max, $created_at, $updated_at) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->interest_rate = $interest_rate;
        $this->term_length = $term_length;
        $this->amount_min = $amount_min;
        $this->amount_max = $amount_max;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getInterestRate() { return $this->interest_rate; }
    public function getTermLength() { return $this->term_length; }
    public function getAmountMin() { return $this->amount_min; }
    public function getAmountMax() { return $this->amount_max; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function setTitle($title) { $this->title = $title; }
    public function setDescription($description) { $this->description = $description; }
    public function setInterestRate($interest_rate) { $this->interest_rate = $interest_rate; }
    public function setTermLength($term_length) { $this->term_length = $term_length; }
    public function setAmountMin($amount_min) { $this->amount_min = $amount_min; }
    public function setAmountMax($amount_max) { $this->amount_max = $amount_max; }
    public function setCreatedAt($created_at) { $this->created_at = $created_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }

    // Example method to save the offer to the database
    public function save() {
        // Implement database saving logic here
    }
}
?>
