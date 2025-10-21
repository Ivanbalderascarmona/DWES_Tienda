<?php

require_once("models/User.php");
require_once("models/CartDetails.php");
require_once("models/Cart.php");
require_once("models/Products.php");
require_once("models/UserRepository.php");
require_once("helpers/FileHelper.php");

session_start();

$db = Connection::connect();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = false;
}

if(isset($_GET['c'])){
    require_once('controllers/'.$_GET['c'].'Controller.php');
}else {
    require_once('controllers/userController.php');
}