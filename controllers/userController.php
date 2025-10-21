<?php

//logout
if(isset($_GET['logout'])){
    $_SESSION['user']=false;
    header('location:index.php');
    exit();
}

//register view
if(isset($_GET['action']) && $_GET['action']=='register'){
    require_once('views/registerView.phtml');
    exit();
}

//login view
if(isset($_GET['action']) && $_GET['action']=='login'){
    require_once('views/loginView.phtml');
    exit();
}

//register user
if(isset($_GET['action']) && $_GET['action']=='saveRegister'){
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && !empty($_FILES['avatar'])){

        FileHelper::fileHandler($_FILES['avatar']['tmp_name'],'public/img/'.$_POST['username'].$_FILES['avatar']['name']);
        UserRepository::register($_POST['username'],$_POST['password'], $_POST['email'], $_FILES['avatar']['name']);
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        UserRepository::register($_POST['username'],$_POST['password'], $_POST['email'], 'default.png');
    }
    
    header('location:index.php');
    exit();
}

//login
if(isset($_POST['username']) && isset($_POST['password'])){
    if($_SESSION['user']=UserRepository::login($_POST['username'],$_POST['password'])){
        require_once('views/mainView.phtml');
        exit();
    }else{
        require_once('views/loginView.phtml');
        exit();
    }
}

//default view
require_once('views/mainView.phtml');