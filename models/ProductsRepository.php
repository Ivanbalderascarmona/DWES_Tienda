<?php

class ProductsRepository {

    public static function getAllProducts(){
        $db = Connection::connect();
        $q = "SELECT * FROM product";
        $result = $db->query($q);
        $products =[];
        while($row = $result->fetch_assoc()){
            $products[] = new Products($row['id'], $row['productname'], $row['description'], $row['stock'], $row['type'], $row['price'],$row['image']);
        }
        return $products;
    }

    public static function getProductById($id){
        $db=Connection::connect();
        $q="SELECT * FROM product WHERE id = $id";
        $result=$db->query($q);
        if($row=$result->fetch_assoc()){
            return new Products($row['id'], $row['productname'], $row['description'], $row['stock'], $row['type'], $row['price'],$row['image']);
        }
        return null;
    }

    // -- admin --
    // public static function addProduct($name,$description,$stock,$type,$price){
    //     $db=Connection::connect();
    //     $q='INSERT INTO product (productname, description, stock, type, price,, image) VALUES ("'.$name.'", "'.$description.'" ,"'.$stock.'", "' . $type . '","'.$price.'")';
    //     return $db->query($q);
    // }

    // public static function updateStock($idProduct, $newStock){
    //     $db=Connection::connect();
    //     $q= 'UPDATE product SET stock = "'.$newStock.'" WHERE idProduct = "'.$idProduct.'"';
    //     return $db->query($q);
    // }

    // public static function deleteProduct($idProduct){
    //     $db= Connection::connect();
    //     $q= 'DELETE FROM product WHERE idProduct = '.$idProduct;
    //     return $db->query($q);
    // }

    
}


?>