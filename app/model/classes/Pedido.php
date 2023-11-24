<?php

include_once('../app/model/funcoes/pedidoDao.php');

class Pedido{
    private $ID_PEDIDO;
    private $data;
    private $cliente;
    private $produto;
    private $quantidade;
    private $preco;
    private $status;


    function getID_PEDIDO() {
        return $this->ID_PEDIDO;
    }

    function getData() {
        return $this->data;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getProduto() {
        return $this->produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getPreco() {
        return $this->preco;
    }
    function getStatus() {
        return $this->status;
    }

    function setID_PEDIDO($ID_PEDIDO) {
        $this->ID_PEDIDO = $ID_PEDIDO;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setProduto($produto) {
        $this->produto = $produto;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }
    function setStatus($status) {
        $this->status = $status;
    }

}

?>