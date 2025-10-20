<?php

class Orders {

    private $idOrder;
    private $idCart;
    private $idProduct;
    private $dateOrder;
    private $totalPrice;

    public function __construct($idOrder, $idCart, $idProduct, $dateOrder, $totalPrice) {
        $this->idOrder = $idOrder;
        $this->idCart = $idCart;
        $this->idProduct = $idProduct;
        $this->dateOrder = $dateOrder;
        $this->totalPrice = $totalPrice;
    }

    public function getIdOrder() {
        return $this->idOrder;
    }
    public function getIdCart() {
        return $this->idCart;
    }
    public function getIdProduct() {
        return $this->idProduct;
    }
    public function getDateOrder() {
        return $this->dateOrder;
    }
    public function getTotalPrice() {
        return $this->totalPrice;
    }

}

?>