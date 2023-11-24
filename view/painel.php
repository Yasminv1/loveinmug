<?php
include_once "../controller/conexao/Conexao.php";
include_once "../app/model/funcoes/pedidoDao.php";
include_once "../app/model/classes/Pedido.php";

//instancia as classes
$pedido = new Pedido();
$pedidodao = new PedidoDAO();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">  
    <link rel="icon" href="/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Painel</title>
</head>
<body>
    
<?php session_start(); ?>

<!-- Caixa para a mensagem de erro que pode ser sido armazenada na sess찾o -->
<center>
    <b>
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            $_SESSION['msg'] = "";
        }?>
    </b>
</center>    

    <div class="container">
    <div id="my-button" class="menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="cabecalho">
        </br>
        <p>Painel de controle</p>
    </div>
    <button class="botaoSair" onclick="openModal()"><i class="bi bi-box-arrow-right"></i></button>
</div>

    <div class="menu">
        <a href="#"><i class="bi bi-house-door d-none d-lg-block"></i> Painel</a>
        <a href="../view/pedidos.php"><i class="bi bi-reception-3"></i> Pedidos</a>
        <a href="../view/produtos.php"><i class="bi bi-heart"></i> Produtos</a>
        <a href="../view/cliente.php"><i class="bi bi-person"></i> Cliente</a>
        <a href="../view/lista.php"><i class="bi bi-list-task"></i> Tarefas</a>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <p>Tem certeza de que deseja sair?</p>
        <button class="botaoCan" onclick="closeModal()">Cancelar</button>
        <button class="botaoSair" onclick="confirmExit()">Sair</button>
    </div>
</div>
    <div id="conteudo">
        <div class="atalho">
            <div class="icone">
                <img src="/img/imagem1.png" alt="icone de cliente" >
                <a href="../view/cliente.php"><p>Cliente</p></a>
            </div>
            <div class="icone">
                <img src="/img/imagem2.png" alt="icone de produto">
                <a href="../view/produtos.php"><p>Produto</p></a>
            </div>
            <div class="icone">
                <img src="/img/imagem3.png" alt="icone de pedido">
                <a href="../view/pedidos.php"><p>Pedido</p></a>
            </div>
            <div class="icone">
                <img src="/img/imagem5.png" alt="icone de lista">
                <a href="../view/lista.php"><p>Tarefas</p></a>
            </div>
        </div>
        <div id="conteudo">
        <div class="iniciotable">
            <div class="titulo" style="margin-top: 3%;">
                <a href="../view/pedidos.php"><p>Pedidos Pendentes</p></a>
            </div>
                <table>
                    <thead>
                        <tr style="color: #863D3D; margin-left: 10px;">
                            <th>Todos</th>
                        </tr>
                        <tr style="background: #f8f8f8; text-align: center; color: #863D3D;" >
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($pedidodao->readIndex() as $pedido) : ?>
                                <tr >
                                    <td data-label="Data"><?= $pedido->getData() ?></td>
                                    <td data-label="Cliente"><?= $pedido->getCliente() ?></td>
                                    <td data-label="Produto"><?= $pedido->getProduto() ?></td>
                                    <td data-label="Quantidade"><?= $pedido->getQuantidade()?></td>
                                    <td data-label="Valor"><?= $pedido->getPreco()?></td>
                                    <td data-label="Status"><?= $pedido->getStatus()?></td>
                                    <td class="text-center">
                                         <button class="  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $pedido->getID_PEDIDO() ?>">
                                            Editar
                                        </button>
                                        <a href="../controller/controlPedido.php?del=<?= $pedido->getID_PEDIDO() ?>">
                                        <button class="  btn-danger btn-sm" type="button">Excluir</button>
                                        </a>
                                    </td>
                                </tr>

                                
                        <div class="modal fade" id="editar><?= $pedido->getID_PEDIDO() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p>Altere os campos e clique em Alterar Pedido</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../controller/controlPedido.php" method="POST">
                                            <div class="row">
                                            <div class="col-md-5">
                                                    <label>Data</label>
                                                    <input type="text" name="data" value="<?= $pedido->getData() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Cliente</label>
                                                    <input type="text" name="cliente" value="<?= $pedido->getCliente() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Produto</label>
                                                    <input type="text" name="produto" value="<?= $pedido->getProduto() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>Quantidade</label></br>
                                                    <input type="text" name="quantidade" value="<?= $pedido->getQuantidade() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>Preco</label>
                                                    <input type="text" name="preco" value="<?= $pedido->getPreco() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>Status</label>
                                                    <input type="text" name="status" value="<?= $pedido->getStatus() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="ID_PEDIDO" value="<?= $pedido->getID_PEDIDO() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Alterar</button>
                                                    <button type="button" class="cancelbtn" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">Cancelar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        
                            <?php endforeach ?>
                    </tbody>
                </table>
    </div>
</div>
</div>
<div class="main_footer">
        
    <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
    <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>

</div>

    <script src="/js/js.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>