<?php

class ProductsRepository {

    public static function getAllProducts(){
        $db = Connection::connect();
        $q = "SELECT * FROM Products";
        $result = $db->query($q);
        $products =[];
        while($row = $result->fetch_assoc()){
            $products[] = new Products($row['idProduct'], $row['name'], $row['description'], $row['stock'], $row['type'], $row['price']);
        }
        return $products;
    }

    public static function getProductById($idProduct){
        $db=Connection::connect();
        $q="SELECT * FROM Products WHERE idProduct = $idProduct";
        $result=$db->query($q);
        if($row=$result->fetch_assoc()){
            return new Products($row['idProduct'], $row['name'], $row['description'], $row['stock'], $row['type'], $row['price']);
        }
        return null;
    }

    // -- admin --
    public static function addProduct($name,$description,$stock,$type,$price){
        $db=Connection::connect();
        $q='INSERT INTO Products (name, description, stock, type, price) VALUES ("'.$name.'", "'.$description.'" ,"'.$stock.'", "' . $type . '","'.$price.'")';
        return $db->query($q);
    }

    public static function updateStock($idProduct, $newStock){
        $db=Connection::connect();
        $q= 'UPDATE Products SET stock = "'.$newStock.'" WHERE idProduct = "'.$idProduct.'"';
        return $db->query($q);
    }

    public static function deleteProduct($idProduct){
        $db= Connection::connect();
        $q= 'DELETE FROM Products WHERE idProduct = '.$idProduct;
        return $db->query($q);
    }

    
}


?>