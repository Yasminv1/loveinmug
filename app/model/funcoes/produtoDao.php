<?php

include_once('../app/model/classes/Produto.php');

class ProdutoDao{
    private $c;

    /*public function __construct(){
        $this ->c=mysqli_connect("localhost","hostdeprojetos","ifspgru@2022","hostdeprojetos_loveinmug");
        if(mysqli_connect_errno() == 0){
            echo "\n"."Conexão ok!";
        }else{
            $msg = mysqli_connect_error();
            echo "\n" . "erro na conexão SQL!";
            echo "\n" . "O MySQL retornou a seguinte mensagem: " . $msg;
        }
    }*/

    
    public function create(Produto $produto) {
        try {
            // Preparando para inserção de um novo produto no banco de dados
            $sql = "INSERT INTO produto (
                ID_PRODUTO, produto, preco, foto)
                VALUES (
                    :ID_PRODUTO, :produto, :preco, :foto)";
            
            // conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros os dados do objeto produto
            $p_sql->bindValue(":ID_PRODUTO", $produto->getID_PRODUTO());
            $p_sql->bindValue(":produto", $produto->getProduto());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":foto", $produto->getFoto());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Inserir produto <br>" . $e . '<br>';
        }
    }

   
    
   
    
    public function read() {
        try {
            // Preparando a instrução SQL para buscar todos os produtos e ordená-los pelo nome
            $sql = "SELECT * FROM produto order by produto asc";
    
            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
    
            // Criando um array vazio para armazenar os objetos produto
            $f_lista = array();
    
            // Iterando sobre os resultados e convertendo-os em objetos produto
            foreach ($lista as $l) {
                $f_lista[] = $this->listaProduto($l);
            }
    
            // Retornando a lista de produtos
            return $f_lista;
        } catch (Exception $e) {
             
        echo "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    public function update(Produto $produto) {
        try {
            // Preparando atualizar um produto com base no ID
            $sql = "UPDATE produto set
                produto=:produto,
                preco=:preco,
                foto=:foto         
                WHERE ID_PRODUTO = :ID_PRODUTO";
            
            // Preparando a conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros da instrução SQL com os dados do objeto produto
            $p_sql->bindValue(":ID_PRODUTO", $produto->getID_PRODUTO());
            $p_sql->bindValue(":produto", $produto->getProduto());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":foto", $produto->getFoto());
    
            return $p_sql->execute();
            
        } catch (Exception $e) {
            
            echo "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }
    
    public function delete(Produto $produto) {
        try {
            // Preparando para excluir um produto com base no ID
            $sql = "DELETE FROM produto WHERE ID_PRODUTO = :ID_PRODUTO";
            
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando o valor do parâmetro com o ID do objeto produto
            $p_sql->bindValue(":ID_PRODUTO", $produto->getID_PRODUTO());
    
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Excluir produto<br> $e <br>";
        }
    }

    
    
    private function listaProduto($row) {
        // Criando um objeto produto e preenchendo-o com os dados do array associativo
        $produto = new Produto();
        $produto->setID_PRODUTO($row['ID_PRODUTO']);
        $produto->setProduto($row['produto']);
        $produto->setPreco($row['preco']);
        $produto->setFoto($row['foto']);
    
        // Retornando o objeto produto
        return $produto;
    }

  
    }

?>