<?php
class CarritoItems {
    private $id;
    private $idCart;
    private $idProduct;
    private $amount;

    public function __construct($id, $idCart, $idProduct, $amount) {
        $this->id = $id;
        $this->idCart = $idCart;
        $this->idProduct = $idProduct;
        $this->amount = $amount;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdCart() {
        return $this->idCart;
    }

    public function getIdProduct() {
        return $this->idProduct;
    }

    public function getAmount() {
        return $this->amount;
    }
}