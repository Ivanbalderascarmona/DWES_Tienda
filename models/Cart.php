<?php
class Cart {
    private $id;
    private $idOrder;
    private $idUser;
    private $precio;
    private $pagado;
    
    public function __construct($id, $idOrder, $idUser, $precio, $pagado) {
        $this->id = $id;
        $this->idOrder = $idOrder;
        $this->idUser = $idUser;
        $this->precio = $precio;
        $this->pagado = $pagado;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdOrder() {
        return $this->idOrder;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPagado() {
        return $this->pagado;
    }
}