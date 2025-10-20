<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $role;
    private $avatar;

    public function __construct($id, $username, $email, $role, $avatar) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->avatar = $avatar;
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

    public function getRole() {
        return $this->role;
    }


    public function getAvatar() {
        return $this->avatar;
    }
}
    
    