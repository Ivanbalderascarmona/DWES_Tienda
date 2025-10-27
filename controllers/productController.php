<?php


//ver producto
if (isset($_GET['action']) && $_GET['action'] == 'viewProduct'){
    $idProduct= $_GET['id'];
    
    if($idProduct){
        $product= ProductsRepository::getProductById($idProduct);
        if($product){
            require_once('views/productView.phtml');
        }else{
            echo "Producto no encontrado";
        }
    }else{
        echo "ID de producto no proporcionado";
    }
}

// buscar producto por nombre
if(isset($_GET['action']) && $_GET['action'] == 'searchProduct'){
    if(isset($_POST['q'])){
        $nombreProducto = $_POST['q'].trim("");
        $products = ProductsRepository::searchProductByName($nombreProducto);
        header('location: index.php?c=product&action=viewProduct&id='.$products[0]->getId() );
        exit();
    }
    

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

// vista añadir producto
if(isset($_GET['action']) && $_GET['action'] == 'showAddProduct' && $_SESSION['user']->getRole() == 1){
    require_once('views/addProduct.phtml');
    exit();
}

// crear producto
if(isset($_GET['action']) && $_GET['action'] == 'addProduct'){
    if(!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['price']) || !isset($_POST['stock']) || !isset($_POST['type']) || !isset($_POST['visible']) || !isset($_FILES['image'])){
        require_once('views/addProduct.phtml');
        exit();
    }
    FileHelper::fileHandler($_FILES['image']['tmp_name'],'public/img/'.$_FILES['image']['name']);
    $id = ProductsRepository::addProduct($_POST['name'],$_POST['description'],$_POST['stock'],$_POST['type'],$_POST['price'],$_FILES['image']['name']);
    header('location: index.php?c=product&action=viewProduct&id='.$id);
    exit();
}

// actualizar producto
if(isset($_GET['action']) && $_GET['action'] == 'updateProduct'){
    if(!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['price']) || !isset($_POST['stock']) || !isset($_POST['type']) || !isset($_FILES['image'])){
        require_once('views/updateProduct.phtml');
        exit();
    }
    FileHelper::fileHandler($_FILES['image']['tmp_name'],'public/img/'.$_FILES['image']['name']);
    $id = $_GET['id'];
    ProductsRepository::updateProduct($id,$_POST['name'],$_POST['description'],$_POST['stock'],$_POST['type'],$_POST['price'],$_FILES['image']['name']);
    header('location: index.php?c=product&action=viewProduct&id='.$id);
    exit();
}


// quitar producto
if(isset($_GET['action']) && $_GET['action'] == 'deleteProduct'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        ProductsRepository::deleteProduct($id);
        header('location: index.php');
        exit();
    }
}

// actualizar stock de producto


// para añadir foto al producto -> FileHelper

?>