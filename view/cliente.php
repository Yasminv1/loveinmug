<?php
include_once "../controller/conexao/Conexao.php";
include_once "../app/model/funcoes/clienteDao.php";
include_once "../app/model/classes/Cliente.php";

//instancia as classes
$cliente = new Cliente();
$clientedao = new clienteDao();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">  
    <link rel="icon" href="/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	
    <title>Cliente</title>
    <style>
        select {
            width: 100%;
            float: left;
            margin-bottom: 10px;
            margin-top: 10px;
            outline: 0;
            background: #fff;
            color: #777;
            border: 2px solid #863D3D;
            padding: 3px 20px;
            border-radius: 5px;
            }
        h2{
            color: #863D3D;
        }
    </style>
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
                </br><p>Clientes</p>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Encontre os botões
            var botaoCancelar = document.querySelector('.botaoCan');
            var botaoSair = document.querySelector('.botaoSair');
            var modal = document.getElementById('myModal');
            
            // Adicione um EventListener para fechar o modal quando o botão "Cancelar" for clicado
            botaoCancelar.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        });
    
        // Função para confirmar a saída e redirecionar para a página de login
        function confirmExit() {
            // Aqui, você pode redirecionar o usuário para a página de login
            // Substitua 'pagina-de-login.html' pelo URL da sua página de login
            window.location.href = 'https://hostdeprojetosdoifsp.gru.br/loveinmug/login.html';
        }
    </script>
     
            <div id="conteudo">
                <div class="iniciotable">
                    <div class="titulo" style="margin-top: 3%; width: 70%;">

                          <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Cliente</button>
 
                          <div id="id01" class="modal">
                              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>

                             <form class="modal-content animate" action="../controller/controlCliente.php" method="POST" >
                                  <div class="container2">
                                      <p>Preencha os campos e clique em Cadastrar Cliente</p>

                                      <label>Nome:</label>
                                      <input type="text" placeholder="Nome do Cliente" name="nome" id="nome" required>
                       
                                      <label>Telefone:</label>
                                      <input type="text" placeholder="Telefone" name="telefone"  id="telefone"required>
                                  
                                      <label>CEP:</label>
                                      <input type="text" placeholder="CEP" name="cep" id="cep" required>
                      
                                      <label>Endereço:</label>
                                      <input type="text" placeholder="Endereço" name="endereco" id="endereco"required>
                      
                                      <label>Bairro:</label>
                                      <input type="text" placeholder="Bairro" name="bairro" id="bairro" required>
                      
                                      <label>Complemento:</label>
                                      <input type="text" placeholder="Complemento" name="complemento"  id="complemento"required>
                                      
                                      <label>Cidade:</label>
                                      <input type="text" placeholder="Cidade" name="cidade" id="cidade" required>  

                                      <label>Estado:</label>
                                      <input type="text" placeholder="Estado" name="uf" id="uf" required>

                                      <div class="clearfix">
                                          <input type="hidden" name="cadastrar" value="Incluir">
                                          <button type="submit" value="Incluir" class="signupbtn">Cadastrar Cliente</button>
                                          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar Cadastro</button>
                                      </div>
                                  </div>
                              </form>
                          </div>

                          
                        <div class="search-box">
                            <input type="text" placeholder="Pesquisa..." />
                            <a href="##" class="iicon">
                              <i class="fas fa-search"></i>
                            </a>
                          </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                              const searchInput = document.querySelector('.search-box input');
                              const tableRows = document.querySelectorAll('tbody tr');
                            
                              searchInput.addEventListener('input', function() {
                                  const searchTerm = searchInput.value.toLowerCase();
                            
                                  tableRows.forEach(function(row) {
                                      const rowData = row.textContent.toLowerCase();
                            
                                      if (rowData.includes(searchTerm)) {
                                          row.style.display = '';
                                      } else {
                                          row.style.display = 'none';
                                      }
                                  });
                              });
                            });
                        </script>  
                          
        
                    </div>
                        <table style="width: 70%;">
                            <thead>
                                <tr style="color: #863D3D; margin-left: 10px;">
                                    <th style="padding-left: 6%;">Todos</th>
                                </tr>
                                <tr style="background: #f8f8f8; text-align: center; color: #863D3D;" >
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>CEP</th>
                                    <th>Bairro</th>
                                    <th>Editar</th>
                                    <th>Perfil</th>
                                    
                                </tr>
                            </thead>
                        <tbody>
                    <?php foreach ($clientedao->read() as $cliente) : ?>
                                <tr>
                                    <td data-label="Nome"><?= $cliente->getNome() ?></td>
                                    <td data-label="Telefone"><?= $cliente->getTelefone() ?></td>
                                    <td data-label="CEP"><?= $cliente->getCep() ?></td>
                                    <td data-label="Bairro"><?= $cliente->getBairro() ?></td>

                                    <td class="text-center">
                                         <button class="  btn-warning btn-sm2" data-toggle="modal" data-target="#editar><?= $cliente->getID_CLIENTE() ?>">
                                            Editar
                                        </button>
                                        <a href="../controller/controlCliente.php?del=<?= $cliente->getID_CLIENTE() ?>">
                                        <button class="  btn-danger btn-sm2" type="button">Excluir</button>
                                        </a>
                                    </td>
                                   <!-- Botão para abrir o modal (com a mesma classe "openProfileModal") -->
                                    <td class="text-center">
                                        <button class="perfil-button"  class="openProfileModal" data-target="#profileModal<?= $cliente->getID_CLIENTE() ?>"><i class="bi bi-person"  data-toggle="modal"></i></button>
                                        
                                    </td>

                                    <!-- Modal de perfil (mantenha apenas um modal no HTML) -->
                                    
                                    <div id="profileModal<?= $cliente->getID_CLIENTE() ?>" class="modal">
                                        
                                        <div class="modal-content">
                                            <span id="closeModal" class="close">&times;</span>
                                            <h2>PERFIL DO CLIENTE</h2>
                                            <div class="linha"></div>
                                           
                                            <p><strong data-label="Nome">Nome:</strong> <?= $cliente->getNome() ?></p>
                                            <p><strong data-label="Telefone">Telefone:</strong> <?= $cliente->getTelefone() ?></p>
                                            <p><strong data-label="CEP">CEP:</strong> <?= $cliente->getCep() ?></p>
                                            <p><strong data-label="Bairro">Bairro:</strong> <?= $cliente->getBairro() ?></p>
                                            <p><strong data-label="Complemento">Complemento:</strong> <?= $cliente->getComplemento() ?></p>
                                            <p><strong data-label="Cidade">Cidade:</strong> <?= $cliente->getCidade() ?></p>
                                            <p><strong data-label="Uf">Estado:</strong> <?= $cliente->getUf() ?></p>
                                        </div>
                                    </div>

                                </tr>
                                
                        <div class="modal fade" id="editar><?= $cliente->getID_CLIENTE() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p>Altere os campos e clique em Alterar Cliente</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../controller/controlCliente.php" method="POST">
                                            <div class="row">
  
                                                <div class="col-md-7">
                                                    <label>Nome</label>
                                                    <input type="text" name="nome" value="<?= $cliente->getNome() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Telefone</label>
                                                    <input type="text" name="telefone" value="<?= $cliente->getTelefone() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>CEP</label></br>
                                                    <input type="text" name="cep" value="<?= $cliente->getCep() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>Endereço</label>
                                                    <input type="text" name="endereco" value="<?= $cliente->getEndereco() ?>" class="form-control" require />
                                                </div>

												<div class="col-md-3">
                                                    <label>Bairro</label>
                                                    <input type="text" name="bairro" value="<?= $cliente->getBairro() ?>" class="form-control" require />
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Complemento</label>
                                                    <input type="text" name="complemento" value="<?= $cliente->getComplemento() ?>" class="form-control" require />
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Cidade</label>
                                                    <input type="text" name="cidade" value="<?= $cliente->getCidade() ?>" class="form-control" require />
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Estado</label>
                                                    <input type="text" name="uf" value="<?= $cliente->getUf() ?>" class="form-control" require />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="ID_CLIENTE" value="<?= $cliente->getID_CLIENTE() ?>" />
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
                        </div>
                    <?php endforeach ?>

                               
                </tbody>
        </table>
            </div>
        </div>
    <div class="main_footer">
        
        <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
        <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>
    
    </div>

<script type="text/javascript">
    $(document).ready(function() {
        // Quando o documento estiver pronto (DOM pronto), execute a função anônima
        // Esta função será executada quando a página estiver completamente carregada

        // Define um evento de "blur" (quando o campo perde o foco) para o campo de CEP
        $("#cep").blur(function() {
            // Constrói a URL para buscar informações de endereço com base no CEP digitado
            var url = "https://viacep.com.br/ws/" + $("#cep").val() + "/json/";
           

            // Envia uma requisição GET para a URL definida e processa a resposta
            $.get(url, function(data) {
                // Preenche os campos de endereço com os dados obtidos da resposta JSON
                $("#endereco").val(data.logradouro);
                $("#bairro").val(data.bairro);
                $("#cidade").val(data.localidade);
                $("#uf").val(data.uf);
            }, "json");
        });
    });
</script>
<script>
    // Obtenha todos os botões de perfil
    const perfilButtons = document.querySelectorAll('.perfil-button');

    // Adicione um ouvinte de clique a cada botão de perfil
    perfilButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Obtenha o alvo do modal com base no atributo data-target
            const target = button.getAttribute('data-target');

            // Exiba o modal correspondente
            const modal = document.querySelector(target);
            modal.style.display = 'block';
        });
    });

    // Feche o modal quando o botão de fechar é clicado
    const closeModal = document.querySelectorAll('.close');
    closeModal.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            modal.style.display = 'none';
        });
    });
    
    const button = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu");

    if (button && menu) {
        button.addEventListener("click", () => {
            menu.classList.toggle("active");
        });
    }
</script>
    <script src="../js/js.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>