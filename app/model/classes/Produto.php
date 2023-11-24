<?php

include_once('../app/model/funcoes/PedidoDao.php');

class Produto{
    private $ID_PRODUTO;
    private $produto;
    private $preco;
    private $foto;


    function getID_PRODUTO() {
        return $this->ID_PRODUTO;
    }

    function getProduto() {
        return $this->produto;
    }

    function getPreco() {
        return $this->preco;
    }
    function getFoto() {
        return $this->foto;
    }

    function setID_PRODUTO($ID_PRODUTO) {
        $this->ID_PRODUTO = $ID_PRODUTO;
    }

    function setProduto($produto) {
        $this->produto = $produto;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }
    function setFoto($foto) {
        $this->foto = $foto;
    }

}

?>