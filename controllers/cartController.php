<?php


// ver carrito

if(isset($_GET['action']) && $_GET['action'] == 'showCart'){
    

    $idUser = $_SESSION['user']->getId();
    $cart = CartRepository::getCartByUser($idUser);

    if($cart){
        $cartItems= CartRepository::getItems($cart->getId());
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