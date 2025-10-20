<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $rol;
    private $products;
    private $avatar;

    public function __construct($id, $username, $email, $rol, $avatar) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->rol = $rol;
        $this->avatar = $avatar;
        $this->products = array();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getAvatar() {
        return $this->avatar;
    }
}
    
    