<?php


// ver carrito

if(isset($_GET['action']) && $_GET['action'] == 'cart'){
    

    $idUser = $_SESSION['user']->getId();
    $cart = CartRepository::getCartByUser($idUser);

    if($cart){
        $idCart=$cart['id'];
        $cartItems= CartRepository::getItems($idCart);
    }else{
        $cartItems = [];
    }

    require_once('views/cartView.phtml');
    exit();
}



//pagar carrito

if (isset($_GET['action']) && $_GET['action'] == 'pagarCarrito'){

    $idUser = $_SESSION['user']->getId();
    $cart = CartRepository::getCartByUser($idUser);

    if($cart){
        $idCart=$cart['id'];
        CartRepository::payCart($idCart);
    }

    header('location:index.php');
    exit();
}

?>