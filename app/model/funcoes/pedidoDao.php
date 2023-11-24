<?php

include_once('../app/model/classes/Pedido.php');
include_once('../app/model/classes/Cliente.php');

class PedidoDao{
    private $c;

    /**public function __construct(){
        $this ->c=mysqli_connect("localhost","root","","loveinmug");
        if(mysqli_connect_errno() == 0){
            //echo "\n"."Conexão ok!";
        }else{
            $msg = mysqli_connect_error();
            echo "\n" . "erro na conexão SQL!";
            echo "\n" . "O MySQL retornou a seguinte mensagem: " . $msg;
        }
    }*/

    
    public function create(Pedido $pedido) {
        try {
            // Preparando para inserção de um novo pedido no banco de dados
            $sql = "INSERT INTO pedido (
                ID_PEDIDO, data, cliente, produto, quantidade, preco, status)
                VALUES (
                    :ID_PEDIDO, :data, :cliente, :produto, :quantidade, :preco, :status)";
            
            // conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros os dados do objeto Pedido
            $p_sql->bindValue(":ID_PEDIDO", $pedido->getID_PEDIDO());
            $p_sql->bindValue(":data", $pedido->getData());
            $p_sql->bindValue(":cliente", $pedido->getCliente());
            $p_sql->bindValue(":produto", $pedido->getProduto());
            $p_sql->bindValue(":quantidade", $pedido->getQuantidade());
            $p_sql->bindValue(":preco", $pedido->getPreco());
            $p_sql->bindValue(":status", $pedido->getStatus());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Inserir pedido <br>" . $e . '<br>';
        }
    }
    
    public function read() {
        try {
            // Preparando a instrução SQL para buscar todos os pedidos e ordená-los pelo cliente
            $sql = "SELECT * FROM pedido order by cliente asc";
    
            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
    
            // Criando um array vazio para armazenar os objetos Pedido
            $f_lista = array();
    
            // Iterando sobre os resultados e convertendo-os em objetos Pedido
            foreach ($lista as $l) {
                $f_lista[] = $this->listaPedido($l);
            }
    
            // Retornando a lista de pedidos
            return $f_lista;
        } catch (Exception $e) {
             
        echo "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    public function update(Pedido $pedido) {
        try {
            // Preparando atualizar um pedido com base no ID
            $sql = "UPDATE pedido set
                data=:data,
                cliente=:cliente,
                produto=:produto,
                quantidade=:quantidade,
                preco=:preco,    
                status=:status         
                WHERE ID_PEDIDO = :ID_PEDIDO";
            
            // Preparando a conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros da instrução SQL com os dados do objeto Pedido
            $p_sql->bindValue(":ID_PEDIDO", $pedido->getID_PEDIDO());
            $p_sql->bindValue(":data", $pedido->getData());
            $p_sql->bindValue(":cliente", $pedido->getCliente());
            $p_sql->bindValue(":produto", $pedido->getProduto());
            $p_sql->bindValue(":quantidade", $pedido->getQuantidade());
            $p_sql->bindValue(":preco", $pedido->getPreco());
            $p_sql->bindValue(":status", $pedido->getStatus());
    
            return $p_sql->execute();
        } catch (Exception $e) {
            
            echo "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }
    
    public function delete(Pedido $pedido) {
        try {
            // Preparando para excluir um pedido com base no ID
            $sql = "DELETE FROM pedido WHERE ID_PEDIDO = :ID_PEDIDO";
            
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando o valor do parâmetro com o ID do objeto Pedido
            $p_sql->bindValue(":ID_PEDIDO", $pedido->getID_PEDIDO());
    
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Excluir pedido<br> $e <br>";
        }
    }

    public function readIndex() {
        try {
            // Preparando a instrução SQL para buscar todos os pedidos e ordená-los pelo cliente
            $sql = "SELECT * FROM pedido order by data DESC LIMIT 5";
    
            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
    
            // Criando um array vazio para armazenar os objetos Pedido
            $f_lista = array();
    
            // Iterando sobre os resultados e convertendo-os em objetos Pedido
            foreach ($lista as $l) {
                $f_lista[] = $this->listaPedido($l);
            }
    
            // Retornando a lista de pedidos
            return $f_lista;
        } catch (Exception $e) {
             
        echo "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    
    private function listaPedido($row) {
        // Criando um objeto Pedido e preenchendo-o com os dados do array associativo
        $pedido = new Pedido();
        $pedido->setID_PEDIDO($row['ID_PEDIDO']);
        $pedido->setData($row['data']);
        $pedido->setCliente($row['cliente']);
        $pedido->setProduto($row['produto']);
        $pedido->setQuantidade($row['quantidade']);
        $pedido->setPreco($row['preco']);
        $pedido->setStatus($row['status']);
    
        // Retornando o objeto Pedido
        return $pedido;
    }

    public function getListaClientes() {
        try {
            // Preparando a instrução SQL para buscar todos os clientes
            $sql = "SELECT * FROM cliente";

            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);

            return $lista;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar buscar a lista de clientes: $e";
        }
    }

    public function getListaProdutos() {
        try {
            // Preparando a instrução SQL para buscar todos os clientes
            $sql = "SELECT * FROM produto";

            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);

            return $lista;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar buscar a lista de produtos: $e";
        }
    }
}  




?>