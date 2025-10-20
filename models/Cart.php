<?php
class Cart {
    private $id;
    private $idUser;
    private $totalPrice;
    private $datetime;
    private $pagado;
    
    public function __construct($id, $idUser, $totalPrice, $datetime, $pagado) {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->totalPrice = $totalPrice;
        $this->datetime = $datetime;
        $this->pagado = $pagado;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getDateTime() {
        return $this->datetime;
    }

    public function getPagado() {
        return $this->pagado;
    }
}
