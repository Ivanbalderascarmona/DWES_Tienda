<?php

class CartRepository {

    public static function createCart($idUser) {
        $db=Connection::connect();
        $q='INSERT INTO Cart (idUser, precio, pagado) VALUES ("'.$idUser.'", 0.00, FALSE)';
        return $db->query($q);
    }

    public static function getCartByUser($idUser){
        $db=Connection::connect();
        $q='SELECT * FROM Cat WHERE idUser = "'.$idUser.'"';
        $result = $db->query($q);
        return $result->fetch_assoc();
    }

    public static function getItems($idCart){
        $db= Connection::connect();
        $q= "SELECT p.idProduct, p.name, p.description, p.price, p.price, ci.amount FROM CartItems ci INNER JOIN Products p ON ci.idProduct = p.idProduct WHERE ci.idCart = ".$idCart;
        $result= $db->query($q);
        $items=array();
        while( $row=$result->fetch_assoc() ){
            $items[] =[
                'name'=>$row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'type' => $row['type'],
                'amount' => $row['amount']
            ];
        }
        return $items; 
    }

    public static function addItem($idCart, $idProduct, $amount){
        $db=Connection::connect();
        $q='INSERT INTO CartItems (idCart, idProduct, amount) VALUES ("'.$idCart.'", "'.$idProduct.'" ,"'.$amount.'")';
        return $db->query($q);
    }

    public static function payCart($idCart){
        $db=Connection::connect();
        $q='UPDATE Cart SET pagado = TRUE WHERE id = "'.$idCart.'"';
        return $db->query($q);
    }

    // para el historial de pedidos
    public static function getOrdersByUser($idUser){
        $db= Connection::connect();
        $q = 'SELECT * FROM Cart WHERE idUser = "'.$idUser.'" AND pagado = 1 ORDER BY fecha DESC';
        $result = $db->query($q);
        $orders=array();
        while( $row=$result->fetch_assoc() ){
            $orders[] =[
                'id'=>$row['id'],
                'precio' => $row['precio'],
                'fecha' => $row['fecha'],
            ];
        }
        return $orders;
    }
}

?>