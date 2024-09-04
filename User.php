<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $status;
    private $address;
    private $town;
    private $province;
    private $country;
    private $zipcode;

    // Constructor
    public function __construct($id, $name, $email, $password, $role, $status, $address = null, $town = null, $province = null, $country = null, $zipcode = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->address = $address;
        $this->town = $town;
        $this->province = $province;
        $this->country = $country;
        $this->zipcode = $zipcode;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }
    public function getStatus() { return $this->status; }
    public function getAddress() { return $this->address; }
    public function getTown() { return $this->town; }
    public function getProvince() { return $this->province; }
    public function getCountry() { return $this->country; }
    public function getZipcode() { return $this->zipcode; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setRole($role) { $this->role = $role; }
    public function setStatus($status) { $this->status = $status; }
    public function setAddress($address) { $this->address = $address; }
    public function setTown($town) { $this->town = $town; }
    public function setProvince($province) { $this->province = $province; }
    public function setCountry($country) { $this->country = $country; }
    public function setZipcode($zipcode) { $this->zipcode = $zipcode; }

    // Example method to save the user to the database
    public function save() {
        // Implement database saving logic here
    }
}
?>
