<?php

include_once "../controller/conexao/Conexao.php";
include_once "../app/model/classes/Pedido.php";
include_once "../app/model/funcoes/pedidoDao.php";

$pedido = new Pedido();
$pedidodao = new pedidoDao();

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
    $pedido->setID_PEDIDO($d['ID_PEDIDO']);
    $pedido->setData($d['data']);
    $pedido->setCliente($d['cliente']);
    $pedido->setProduto($d['produto']);
    $pedido->setQuantidade($d['quantidade']);
    $pedido->setPreco($d['preco']);
    $pedido->setStatus($d['status']);

    // Chama a função "create" do objeto $pedidodao para criar um novo pedido
    $pedidodao->create($pedido);

    // Redireciona para a página "pedidos.php"
    header("Location: ../view/pedidos.php ");
} 

// Verifica se a operação é "editar"
else if(isset($_POST['editar'])){

    $pedido->setID_PEDIDO($d['ID_PEDIDO']);
    $pedido->setData($d['data']);
    $pedido->setCliente($d['cliente']);
    $pedido->setProduto($d['produto']);
    $pedido->setQuantidade($d['quantidade']);
    $pedido->setPreco($d['preco']);
    $pedido->setStatus($d['status']);

    // Chama a função "update" do objeto $pedidodao para editar um pedido existente
    $pedidodao->update($pedido);

    header("Location: ../view/pedidos.php");
}
// Verifica se a operação é "deletar"
else if(isset($_GET['del'])){

    // Define o ID do pedido a ser deletado com base na URL
    $pedido->setID_PEDIDO($_GET['del']);

    // Chama a função "delete" do objeto $pedidodao para excluir um pedido
    $pedidodao->delete($pedido);

    header("Location: ../view/pedidos.php");
}
// Se nenhuma das condições anteriores for atendida, redireciona para a página "pedidos.php"
else{
    header("Location: ../view/pedidos.php");
}
?>