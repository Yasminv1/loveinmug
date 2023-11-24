<?php
include_once "../conexao/Conexao.php";
include_once "../model/funcoes/produtoDao.php";
include_once "../model/classes/Produto.php";

//instancia as classes
$produto = new Produto();
$produtodao = new ProdutoDao();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="icon" href="/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Produtos</title>

</head>
<body>

<?php session_start(); ?>

<!-- Caixa para a mensagem de erro que pode ser sido armazenada na sessão -->
<center>
    <b>
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            $_SESSION['msg'] = "";
        }?>
    </b>
</center>

    <div class="container">
        <div class="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="cabecalho">
            </br>
            <p>Produtos</p>
        </div>
            <button class="botaoSair" onclick="openModal()"><i class="bi bi-box-arrow-right"></i></button>

    </div>    

    <div class="menu">
        <a href="../view/painel.php"><i class="bi bi-house-door d-none d-lg-block"></i> Painel</a>
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
<div class="addproduto" style="margin-top: 3%; width: 70%;">
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Produto</button>
</div>
 <div id="id01" class="modal">
     <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
     <form class="modal-content animate" action="../controller/controlProduto.php" method="POST">
         <div class="container2">
             <p>Preencha os campos e clique em Gravar Produto</p>
             <label>Nome:</label>
             <input type="text" placeholder="Nome do Produto" name="produto"required>

            <!-- Modelo Normal -->
             <div class="formWrapper">
             <label>Imagem:</label>
                 <div class="upload">
                        <input type="file" name="fileFoto" id="fileFoto">
                        <input type="hidden" name="foto" id="foto">
                    </div>
                </div>
           
           <?php if (!empty($imageFoto)) { ?>
                <div class="result">
                <img src="<?php echo $imageFoto; ?>" alt="image" />
                </div>
            <?php } ?>
         
             <label>Valor:</label>
             <input type="text" placeholder="Valor do Produto" name="preco" required>


             <div class="clearfix">
                 <input type="hidden" name="cadastrar" value="Incluir">
                 <button type="submit" value="Incluir" class="signupbtn">Gravar Pedido</button>
                 <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar Pedido</button>
             </div>

         </div>
     </form>
 </div>



    <div class="card-conteudo">

        <?php foreach ($produtodao->read() as $produto) : ?>
            <div class="card">
           
                <img data-label="Foto" src="<?= $produto->getFoto() ?>" alt="Imagem do Cartão 1">
                <h2 data-label="Produto"><?= $produto->getProduto() ?></h2>
                <p data-label="Preco"><?= $produto->getPreco() ?></p></br>

                <a href="../controller/controlProduto.php?del=<?= $produto->getID_PRODUTO() ?>">
                <button class="  btn-danger btn-sm" type="button">Excluir</button>
                </a>

            
            </div>

                    <div class="modal fade" id="editar><?= $produto->getID_PRODUTO() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p>Altere os campos e clique em Alterar Produto</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../controller/controlProduto.php" method="POST">
                                            <div class="row">
                                            <div class="col-md-5">
                                            <div class="col-md-7">
                                                    <label>Nome</label>
                                                    <input type="text" name="produto" value="<?= $produto->getProduto() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="col-md-3">
                                                       <div class="formWrapper">
                                                        <label>Imagem:</label>
                                                        <div class="upload">
                                                            <input type="file" name="fileFoto" id="fileFoto" onchange="previewImage()">
                                                            <input type="hidden" name="foto" id="foto">
                                                        </div>
                                                    </div>
                                                    </div>

                                                </div>    
                                                <?php if (!empty($imageFoto)) { ?>
                                                    <div class="result">
                                                        <img src="<?php echo $imageFoto; ?>" alt="image" />
                                                    </div>
                                                <?php } ?>
                                                
												<div class="col-md-3">
                                                    <label>Valor</label></br>
                                                    <input type="text" name="preco" value="<?= $produto->getPreco() ?>" class="form-control" require />
                                                </div>

												
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="ID_PRODUTO" value="<?= $produto->getID_PRODUTO() ?>" />
]                                                    <button type="button" class="cancelbtn" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">Cancelar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form> 
                                    </div>

                                </div>
                            </div>
                        </div>

        <?php endforeach ?>    
    </div>
            </div>
           
            <div class="main_footer">
                
                <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
                <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>
            
            </div>

    <script type="text/javascript">
    $("#fileFoto").change(function() {

        var formData = new FormData();
        formData.append('file', $('#fileFoto')[0].files[0]);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                data = JSON.parse(data);
                if (data.error === 0) {
                    // Se o upload for bem-sucedido, atualiza a imagem exibida e o campo de valor da foto
                    $("#imageFoto").attr("src", data.path);
                    $("#foto").val(data.path);
                } else {
                    // Se houver um erro, exibe um alerta com a mensagem de erro
                    alert("Erro ao fazer upload da foto: " + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                // Em caso de erro na requisição AJAX, exibe um alerta com informações de erro
                alert("Erro ao fazer upload da Foto: " + status + " - " + error);
            }
        });
    });

    $(document).ready(function() {
        $(".menu1").click(function() {
            $(".keep").toggleClass("width");
        });
    });
    </script>

<!--<script  src="../js/js.js"></script>-->
    <script src="/js/js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>