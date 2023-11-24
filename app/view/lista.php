<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style_todo.css">  
    <link rel="stylesheet" href="/css/style.css">  
    <link rel="icon" href="/img/logo.png" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Lista de Tarefas</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="/js/js_todo.js" defer></script>
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
                <img src="img/" alt="">
                <p>Lista de Tarefas</p>
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
    
     <div class="todo-container">
        <header>
            <h1>Tarefas</h1>
        </header>
        <form id="todo-form" method="post" action="../controller/controlTask.php">
            <p>Adicione sua tarefa</p>
            <div class="form-control">
                <input type="text" id="todo-input" name="task" placeholder="O que você vai fazer?" required />
                <button type="submit" name="action" value="add">
                    <i class="fa-thin fa-plus"></i>
                </button>
            </div>
        </form>
        <form id="edit-form" class="hide" method="post" action="../controller/controlTask.php">
            <p>Edite sua tarefa</p>
            <div class="form-control">
                <input type="text" id="edit-input" name="newTask" />
                <input type="hidden" id="task-index" name="taskIndex" />
                <button type="submit" name="action" value="edit">
                    <i class="fa-solid fa-check-double"></i>
                </button>
            </div>
            <button id="cancel-edit-btn">Cancelar</button>
        </form>
        <div id="toolbar">
            <div id="search">
                <h4>Pesquisar:</h4>
                <form>
                    <input type="text" id="search-input" placeholder="Buscar..." />
                    <button id="erase-button">
                        <i class="fa-solid fa-delete-left"></i>
                    </button>
                </form>
            </div>
            <div id="filter">
                <h4>Filtrar:</h4>
                <select id="filter-select">
                    <option value="all">Todos</option>
                    <option value="done">Feitos</option>
                    <option value="todo">A fazer</option>
                </select>
            </div>
        </div>
        <div id="todo-list">
            <!-- Aqui, você pode exibir as tarefas existentes da $_SESSION['tasks'] -->
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <div class="todo-item">
                    <p class="<?php echo $task['done'] ? 'done' : ''; ?>"><?php echo $task['task']; ?></p>
                    <button class="edit-button" onclick="editTask(<?php echo $index; ?>)">Editar</button>
                    <button class="delete-button" onclick="deleteTask(<?php echo $index; ?>)">Excluir</button>
                    <?php if (!$task['done']): ?>
                        <button class="mark-button" onclick="markTaskAsDone(<?php echo $index; ?>)">Concluir</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

        
    <div class="main_footer">
        
        <p class="m-b-footer"> Sistema de Gestão - 2023, &copy todos os direitos reservados.</p> 
        <p class="by"><i class="icon icon-heart-3"></i> Desenvolvido por: <a href="https://talentosdoifsp.gru.br/inovatech/" title="INOVATECH">INOVATECH</a></p>
    
    </div>

</footer>
    <script src="/js/js.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
