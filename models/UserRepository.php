<?php

class UserRepository{
    public static function login($username, $password){
        $db = Connection::connect();
        $q = 'SELECT * FROM users WHERE username="'.$username.'" AND password="'.md5($password).'"';
        $result = $db->query($q);
        if($row = $result->fetch_assoc()){
            return new User($row['id'],$row['username'],$row['email'], $row['role'], $row['avatar']);
        }else{
            return false;
        }
    }

    public static function register($username, $password, $email, $avatar){
        $db = Connection::connect();
        //# Comprobar que el usuario no existe
        $q = 'SELECT * FROM users WHERE username="'.$username.'"';
        $result = $db->query($q);
        if($result->num_rows > 0){
            require_once('views/registerView.phtml');
            exit();
        }
        $q = 'INSERT INTO users (username, password, email, role, avatar) VALUES ("'.$username.'", "'.md5($password).'" ,"'.$email.'", 0, "' . $avatar . '")';
        $db->query($q);
        if($db->insert_id){
            $success = "Usuario registrado correctamente. Ya puedes iniciar sesión.";
            require_once('views/loginView.phtml');
        }else{
            $error = "Error al registrar el usuario";
            require_once('views/registerView.phtml');
        }
        exit();
    }
}