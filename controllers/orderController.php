<?php

// ver historial de pedidos
if(isset($_GET['action']) && $_GET['action'] == 'history'){
    

    $idUser = $_SESSION['user']->getId();
    $orders = CartRepository::getOrdersByUser($idUser);

    require_once('views/orderHistory.phtml');
    exit();
}

?>