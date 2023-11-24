<?php
$host = "localhost";
$dbname = "loveinmug";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Função para remover caracteres não numéricos e garantir que o CPF tenha 11 dígitos
function limparCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        return false; // O CPF não tem 11 dígitos após a limpeza
    }
    return $cpf;
}

// Função para validar a senha
function validarSenha($senha) {
    // Senha deve ter no mínimo 6 caracteres, incluindo no mínimo 4 números, duas letras (uma sendo maiúscula)
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*\d.*\d.*\d).{6,}$/', $senha);
}

// Função para validar o e-mail
function validarEmail($email) {
    // E-mail deve conter '@' e ter um domínio válido
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função para validar o telefone
function validarTelefone($telefone) {
    // Telefone deve ter a quantidade de dígitos de um número de telefone
    return preg_match('/^\d{10,}$/', $telefone);
}

$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cpf = limparCPF($_REQUEST['cpf']);
$telefone = $_REQUEST['telefone'];
$senha = $_REQUEST['senha'];
$codAcesso = $_REQUEST['codAcesso'];

try {
    // Verifique se o código de acesso é válido
    $stmtCodAcesso = $conn->prepare("SELECT codAcesso FROM verificacao WHERE codAcesso = ?");
    $stmtCodAcesso->execute([$codAcesso]);
    $resultCodAcesso = $stmtCodAcesso->fetch(PDO::FETCH_ASSOC);

    if (!$resultCodAcesso || $resultCodAcesso['codAcesso'] !== $codAcesso) {
        echo '<div id="result" class="error-message">Código de acesso inválido. Fale com o responsável.</div>';
    } else {
        // Validar senha, CPF, e-mail e telefone
        if (!validarSenha($senha)) {
            echo '<div id="result" class="error-message">A senha deve ter pelo menos 6 caracteres, incluindo 4 números, uma letra maiúscula e uma letra minúscula.</div>';
        } elseif (!$cpf) {
            echo '<div id="result" class="error-message">CPF inválido.</div>';
        } elseif (!validarEmail($email)) {
            echo '<div id="result" class="error-message">E-mail inválido.</div>';
        } elseif (!validarTelefone($telefone)) {
            echo '<div id="result" class="error-message">Telefone inválido.</div>';
        } else {
            // Verificar se o email e CPF são únicos
            $stmt = $conn->prepare("SELECT COUNT(*) FROM cadastrar WHERE email = ? OR cpf = ?");
            $stmt->execute([$email, $cpf]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo '<div id="result" class="error-message">Email ou CPF já cadastrado.</div>';
            } else {
                // Inserir dados no banco de dados
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "INSERT INTO cadastrar (nome, email, cpf, telefone, senha) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                // Verificar se a senha foi inserida corretamente
                if ($stmt->execute([$nome, $email, $cpf, $telefone, $senha_hash])) {
                    echo '<div id="result" class="success-message">Cadastro realizado com sucesso.</div>';
                } else {
                    echo '<div id="result" class="error-message">Erro ao cadastrar. Verifique os dados e tente novamente.</div>';
                }
            }
        }
    }
} catch (PDOException $e) {
    echo '<div id="result" class="error-message">Erro: ' . $e->getMessage() . '</div>';
}

// Fecha a conexão
$conn = null;
?>
