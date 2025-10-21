<?php

class Products {
    private $idProduct;
    private $name;
    private $description;
    private $stock;
    private $type;
    private $price;
    private $image;

    public function __construct($idProduct, $name,$description,$stock,$type,$price,$image) {
        $this->idProduct = $idProduct;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->type = $type;
        $this->price = $price;
        $this->image = $image;
    }
    public function getId() {
        return $this->idProduct;
    }

    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getStock() {
        return $this->stock;
    }
    public function getType() {
        return $this->type;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getImage() {
        return $this->image;
    }
}

?>