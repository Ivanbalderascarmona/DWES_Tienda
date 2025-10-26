<?php

class CartRepository {

    public static function createCart($idUser) {
        $db=Connection::connect();
        $q='INSERT INTO cart (idUser, totalPrice, state) VALUES ("'.$idUser.'", 0.00, 0)';
        return $db->query($q);
    }

    public static function getCartByUser($idUser){
        $db=Connection::connect();
        $q='SELECT * FROM cart WHERE state = 0 AND idUser = "'.$idUser.'"';
        $result = $db->query($q);
        if($row = $result->fetch_assoc()){
            return new Cart($row['id'], $row['idUser'], $row['totalPrice'],$row['datetime'], $row['state']);
        }else{
            return false;
        }
    }

    public static function getAmountByProduct($idCart, $idProduct){
        $db=Connection::connect();
        $q='SELECT * FROM cartdetails WHERE idCart = "'.$idCart.'" AND idProduct = "'.$idProduct.'"';
        $result = $db->query($q);
        if($row = $result->fetch_assoc()){
            return $row['amount'];
        }else{
            return 0;
        }
    }

    public static function getItems($idCart){
        $db= Connection::connect();
        $q= "SELECT p.id, p.productname, p.description, p.price, p.image, cd.amount FROM cartdetails cd INNER JOIN Product p ON cd.idProduct = p.id WHERE cd.idCart = ".$idCart;
        $result= $db->query($q);
        $items=array();
        while( $row=$result->fetch_assoc() ){
            $items[] = new Products($row['id'], $row['productname'], $row['description'], null, null, $row['price'],$row['image']);
        }
        return $items; 
    }

    public static function addItem($idCart, $idProduct, $amount){
        $db=Connection::connect();
        // Comprobar que el producto existe en el carrito y sumarle 1 si ya esta o añadirlo sino

        $q='SELECT * FROM cartdetails WHERE idCart = "'.$idCart.'" AND idProduct = "'.$idProduct.'"';
        $result = $db->query($q);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $amount = $row['amount'] + $amount;
            $q='UPDATE cartdetails SET amount = "'.$amount.'" WHERE idCart = "'.$idCart.'" AND idProduct = "'.$idProduct.'"';
            $db->query($q);
            
        }else{
            $q='INSERT INTO cartdetails (idCart, idProduct, amount) VALUES ("'.$idCart.'", "'.$idProduct.'" ,"'.$amount.'")';
            $db->query($q);
        }
    }

    public static function payCart($idCart){
        $db=Connection::connect();
        $q='UPDATE Cart SET state = 1, datetime = NOW()  WHERE id = "'.$idCart.'"';
        $db->query($q);
    }

    // para el historial de pedidos
    public static function getOrdersByUser($idUser){
        $db= Connection::connect();
        $q = 'SELECT * FROM cart WHERE idUser = "'.$idUser.'" AND state = 1 ORDER BY datetime DESC';
        $result = $db->query($q);
        $orders=array();
        while( $row=$result->fetch_assoc() ){
            $orders[] =[ 'id'=>$row['id'],'totalPrice' => $row['totalPrice'],'datetime' => $row['datetime'] ];
        }
        return $orders;
    }

    public static function getOrderById($idCart){
        $db= Connection::connect();
        $q= "SELECT * FROM cart WHERE id = ".$idCart;
        $result= $db->query($q);
        if( $row=$result->fetch_assoc() ){
            return new Cart($row['id'], $row['idUser'], $row['totalPrice'], $row['datetime'], $row['state']);
        }else{
            return false;
        }
    }

    public static function getProductsByCart($idCart){
        $db= Connection::connect();
        $q= "SELECT p.id, p.productname, p.description, p.price, p.image, cd.amount FROM cartdetails cd INNER JOIN product p ON cd.idProduct = p.id WHERE cd.idCart = ".$idCart;
        $result= $db->query($q);
        $products=array();
        while( $row=$result->fetch_assoc() ){
            $products[] = ['id'=>$row['id'],'productname'=>$row['productname'],'description'=>$row['description'],'price'=>$row['price'],'image'=>$row['image'],'amount'=>$row['amount']];
        }
        return $products;
    }


}

?>