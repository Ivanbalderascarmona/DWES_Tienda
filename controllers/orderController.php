<?php

// ver historial de pedidos
if(isset($_GET['action']) && $_GET['action'] == 'history'){
    

    $idUser = $_SESSION['user']->getId();
    $orders = CartRepository::getOrdersByUser($idUser);

    require_once('views/orderHistory.phtml');
    exit();
}

// ver detalles de un pedido
if(isset($_GET['action']) && $_GET['action'] == 'details'){
    
    $idOrder = $_GET['id'];
    $products=CartRepository::getProductsByCart($idOrder);
    $order = CartRepository::getOrderById($idOrder);

    require_once('views/orderDetails.phtml');
    exit();
    
}

?>