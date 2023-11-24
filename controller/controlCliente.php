<?php

include_once "../controller/conexao/Conexao.php";
include_once "../app/model/classes/Cliente.php";
include_once "../app/model/funcoes/clienteDao.php";

// Cria instâncias das classes
$cliente = new Cliente();
$clientedao = new clienteDao();

verificarAutenticacao();

// Inicia uma sessão
session_start();

// Extrai as variáveis da requisição
extract($_REQUEST, EXTR_SKIP);

// Filtra e armazena os dados de entrada do método POST
$d = filter_input_array(INPUT_POST);

// Verifica a operação
if(isset($_POST['cadastrar'])){

    // Preenche as propriedades com os dados 
    $cliente->setID_CLIENTE($d['ID_CLIENTE']);
    $cliente->setNome($d['nome']);
    $cliente->setTelefone($d['telefone']);
    $cliente->setCep($d['cep']);
    $cliente->setEndereco($d['endereco']);
    $cliente->setBairro($d['bairro']);
    $cliente->setComplemento($d['complemento']);
    $cliente->setCidade($d['cidade']);
    $cliente->setUf($d['uf']);

    // Chama a função "create" do objeto $clientedao para criar um novo cliente
    $clientedao->create($cliente);

    // Redireciona para a página "cliente.php"
    header("Location: ../view/cliente.php ");
} 

// Verifica se a operação é "editar"
else if(isset($_POST['editar'])){

    $cliente->setID_CLIENTE($d['ID_CLIENTE']);
    $cliente->setNome($d['nome']);
    $cliente->setTelefone($d['telefone']);
    $cliente->setCep($d['cep']);
    $cliente->setEndereco($d['endereco']);
    $cliente->setBairro($d['bairro']);
    $cliente->setComplemento($d['complemento']);
    $cliente->setCidade($d['cidade']);
    $cliente->setUf($d['uf']);

    // Chama a função "update" do objeto $clientedao para editar um cliente existente
    $clientedao->update($cliente);

    header("Location: ../view/cliente.php");
}
// Verifica se a operação é "deletar"
else if(isset($_GET['del'])){

    // Define o ID do cliente a ser deletado com base na URL
    $cliente->setID_CLIENTE($_GET['del']);

    // Chama a função "delete" do objeto $clientedao para excluir um cliente
    $clientedao->delete($cliente);

    header("Location: ../view/cliente.php");
}
// Se nenhuma das condições anteriores for atendida, redireciona para a página "cliente.php"
else{
    header("Location: ../view/cliente.php");
}
?>