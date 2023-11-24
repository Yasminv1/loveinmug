<?php

include_once('../app/model/funcoes/clienteDao.php');

class Cliente{
    private $ID_CLIENTE;
    private $nome;
    private $telefone;
    private $cep;
    private $endereco;
    private $bairro;
    private $complemento;
    private $cidade;
    private $uf;

//GET
    function getID_CLIENTE() {
        return $this->ID_CLIENTE;
    }

    function getNome() {
        return $this->nome;
    }

    function getTelefone() {
        return $this->telefone;
    }
    function getCep() {
        return $this->cep;
    }
    function getEndereco() {
        return $this->endereco;
    }
    function getBairro() {
        return $this->bairro;
    }
    function getComplemento() {
        return $this->complemento;
    }
    function getCidade() {
        return $this->cidade;
    }
    function getUf() {
        return $this->uf;
    }



//SET
    function setID_CLIENTE($ID_CLIENTE) {
        $this->ID_CLIENTE = $ID_CLIENTE;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    function setCep($cep) {
        $this->cep = $cep;
    }
    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
    function setBairro($bairro) {
        $this->bairro = $bairro;
    }
    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    function setUf($uf) {
        $this->uf = $uf;
    }

}

?>