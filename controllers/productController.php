<?php


//ver producto
if (isset($_GET['action']) && $_GET['action'] == 'viewProduct'){
    $idProduct= $_GET['id'];
    $product= ProductsRepository::getProductById($idProduct);
    if($product){
        require_once('views/productView.phtml');
    }else{
        echo "Producto no encontrado";
    }
    exit();

}

//añadir al carrito
if(isset($_GET['action']) && $_GET['action'] == 'addToCart'){
    $idProduct=$_GET['id'];
    $idUser=$_SESSION['user']->getId();

    // si ya hay carrito lo obtiene sino lo crea
    $cart=CartRepository::getCartByUser($idUser);
    if(!$cart){
        CartRepository::createCart($idUser);
        $cart=CartRepository::getCartByUser($idUser);
    }
    
    CartRepository::addItem($cart->getId(),$idProduct,1);
    
    header('location: index.php');
    exit();
}

// - admin -


// crear producto


// quitar producto


// actualizar stock de producto


// para añadir foto al producto -> FileHelper

?>