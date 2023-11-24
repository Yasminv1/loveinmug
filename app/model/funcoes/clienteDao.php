<?php

include_once('../app/model/classes/Cliente.php');

class clienteDao{
    private $c;
    
    public function create(Cliente $cliente) {
        try {
            // Preparando para inserção de um novo cliente no banco de dados
            $sql = "INSERT INTO cliente (
                ID_CLIENTE, nome, telefone, cep, endereco, bairro, complemento, cidade, uf)
                VALUES (
                    :ID_CLIENTE, :nome, :telefone, :cep, :endereco, :bairro, :complemento, :cidade, :uf)";
            
            // conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros os dados do objeto Cliente
            $p_sql->bindValue(":ID_CLIENTE", $cliente->getID_CLIENTE());
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
            $p_sql->bindValue(":cep", $cliente->getCep());
            $p_sql->bindValue(":endereco", $cliente->getEndereco());
            $p_sql->bindValue(":bairro", $cliente->getBairro());
            $p_sql->bindValue(":complemento", $cliente->getComplemento());
            $p_sql->bindValue(":cidade", $cliente->getCidade());
            $p_sql->bindValue(":uf", $cliente->getUf());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Inserir cliente <br>" . $e . '<br>';
        }
    }
    
    public function read() {
        try {
            // Preparando a instrução SQL para buscar todos os clientes e ordená-los pelo cliente
            $sql = "SELECT * FROM cliente order by nome asc";
    
            // Executando a instrução SQL e obtendo os resultados em um array associativo
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
    
            // Criando um array vazio para armazenar os objetos cliente
            $f_lista = array();
    
            // Iterando sobre os resultados e convertendo-os em objetos cliente
            foreach ($lista as $l) {
                $f_lista[] = $this->listaCliente($l);
            }
    
            // Retornando a lista de clientes
            return $f_lista;
        } catch (Exception $e) {
             
        echo "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    public function update(Cliente $cliente) {
        try {
            // Preparando atualizar um cliente com base no ID
            $sql = "UPDATE cliente set
                nome=:nome,
                telefone=:telefone,
                cep=:cep,
                endereco=:endereco,    
                bairro=:bairro,
                complemento=:complemento,
                cidade=:cidade,  
                uf=:uf      
                WHERE ID_CLIENTE= :ID_CLIENTE";
            
            // Preparando a conexão com o banco de dados
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando os valores dos parâmetros da instrução SQL com os dados do objeto CLIENTE

            $p_sql->bindValue(":ID_CLIENTE", $cliente->getID_CLIENTE());
            $p_sql->bindValue(":nome", $cliente->getNome());
            $p_sql->bindValue(":telefone", $cliente->getTelefone());
            $p_sql->bindValue(":cep", $cliente->getCep());
            $p_sql->bindValue(":endereco", $cliente->getEndereco());
            $p_sql->bindValue(":bairro", $cliente->getBairro());
            $p_sql->bindValue(":complemento", $cliente->getComplemento());
            $p_sql->bindValue(":cidade", $cliente->getCidade());
            $p_sql->bindValue(":uf", $cliente->getUf());
    
            return $p_sql->execute();
        } catch (Exception $e) {
            
            echo "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }
    
    public function delete(Cliente $cliente) {
        try {
            // Preparando para excluir um cliente com base no ID
            $sql = "DELETE FROM cliente WHERE ID_CLIENTE = :ID_CLIENTE";
            
            $p_sql = Conexao::getConexao()->prepare($sql);
    
            // Associando o valor do parâmetro com o ID do objeto cliente
            $p_sql->bindValue(":ID_CLIENTE", $cliente->getID_CLIENTE());
    
            return $p_sql->execute();
        } catch (Exception $e) {
            // Em caso de erro, imprime uma mensagem 
            echo "Erro ao Excluir cliente<br> $e <br>";
        }
    }

    
    private function listaCliente($row) {
        // Criando um objeto cliente e preenchendo-o com os dados do array associativo
        $cliente = new Cliente();
        $cliente->setID_CLIENTE($row['ID_CLIENTE']);
        $cliente->setNome($row['nome']);
        $cliente->setTelefone($row['telefone']);
        $cliente->setCep($row['cep']);
        $cliente->setEndereco($row['endereco']);
        $cliente->setBairro($row['bairro']);
        $cliente->setComplemento($row['complemento']);
        $cliente->setCidade($row['cidade']);
        $cliente->setUf($row['uf']);
    
        // Retornando o objeto cliente
        return $cliente;
    }

  
    }









?>