<?php

// Inclui os arquivos necessários
include_once ('../controller/conexao/Conexao.php');
include_once('../app/model/classes/Produto.php');
include_once('../app/model/funcoes/produtoDao.php');

// Cria instâncias das classes
$produto = new Produto();
$produtodao = new ProdutoDAO();

// Inicia uma sessão
session_start();

// Extrai as variáveis da requisição
extract($_REQUEST, EXTR_SKIP);

// Filtra e armazena os dados de entrada do método POST
$d = filter_input_array(INPUT_POST);

// Verifica a operação
if(isset($_POST['cadastrar'])){

    // Preenche as propriedades com os dados 
    $produto->setID_PRODUTO($d['ID_PRODUTO']);
    $produto->setProduto($d['produto']);
    $produto->setPreco($d['preco']);
    $produto->setFoto($d['foto']);

    // Chama a função "create" do objeto $produtodao para criar um novo produto
    $produtodao->create($produto);

    // Redireciona para a página "produtos.php"
    header("Location: ../view/produtos.php");
} 


// Verifica se a operação é "deletar"
else if(isset($_GET['del'])){

    // Define o ID do produto a ser deletado com base na URL
    $produto->setID_PRODUTO($_GET['del']);

    // Chama a função "delete" do objeto $produtodao para excluir um produto
    $produtodao->delete($produto);

    header("Location: ../view/produtos.php");
}
// Se nenhuma das condições anteriores for atendida, redireciona para a página "produtos.php"
else{
    header("Location: ../view/produtos.php");
}
?>