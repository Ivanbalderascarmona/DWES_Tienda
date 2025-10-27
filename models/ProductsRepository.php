<?php

class ProductsRepository {

    public static function getAllProducts(){
        $db = Connection::connect();
        $q = "SELECT * FROM product WHERE visible = 1";
        $result = $db->query($q);
        $products =[];
        while($row = $result->fetch_assoc()){
            $products[] = new Products($row['id'], $row['productname'], $row['description'], $row['stock'], $row['type'], $row['price'],$row['image'],$row['visible']);
        }
        return $products;
    }

    public static function searchProductByName($name){
        $db=Connection::connect();
        $name = $db->real_escape_string($name);
        $q="SELECT * FROM product WHERE productname LIKE '%$name%'";
        $result=$db->query($q);
        $products =[];
        while($row = $result->fetch_assoc()){
            $products[] = new Products($row['id'], $row['productname'], $row['description'], $row['stock'], $row['type'], $row['price'],$row['image'],$row['visible']);
        }
        return $products;
    }

    public static function getProductById($idProduct){
        $db=Connection::connect();
        $idProduct = intval($idProduct);
        $q="SELECT * FROM product WHERE id = $idProduct";
        $result=$db->query($q);
        if($row=$result->fetch_assoc()){
            return new Products($row['id'], $row['productname'], $row['description'], $row['stock'], $row['type'], $row['price'],$row['image'],$row['visible']);
        }
        return null;
    }
    
    public static function addProduct($name,$description,$stock,$type,$price,$image){
        $db=Connection::Connect();
        $q='INSERT INTO product (productname, description, stock, type, price, image, visible) VALUES ("'.$name.'", "'.$description.'" ,"'.$stock.'", "' . $type . '","'.$price.'", "'.$image.'", 1)';
        $db->query($q);
        return $db->insert_id;
    }

    public static function updateProduct($idProduct, $name,$description,$stock,$type,$price,$image){
        $db=Connection::Connect();
        $q='UPDATE product SET productname = "'.$name.'", description = "'.$description.'", stock = "'.$stock.'", type = "'.$type.'", price = "'.$price.'", image = "'.$image.'", visible = 1 WHERE id = '.$idProduct;
        $db->query($q);
    }

    public static function deleteProduct($idProduct){
        $db= Connection::connect();
        $q= 'UPDATE product SET visible = 0 WHERE id = '.$idProduct;
        return $db->query($q);
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