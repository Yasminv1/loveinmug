<?php
$host = "localhost";
$dbname = "loveinmug";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para validar a senha
    function validarSenha($senha) {
        // Senha deve ter no mínimo 6 caracteres, incluindo no mínimo 4 números, duas letras (uma sendo maiúscula)
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*\d.*\d.*\d).{6,}$/', $senha);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginEmail = $_POST['loginEmail'];
        $codAcesso = $_POST['codAcesso'];
        $novaSenha = $_POST['novaSenha'];

        // Verifique se o código de acesso está correto
        if ($codAcesso !== "0603-L") {
            echo '<div id="result" class="error-message">Código de acesso inválido. Fale com o responsável.</div>';
        } elseif (!validarSenha($novaSenha)) {
            echo '<div id="result" class="error-message">A senha não atende aos requisitos mínimos.</div>';
        } else {
            // Código de acesso correto, atualize a senha no banco de dados
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE cadastrar SET senha = ? WHERE email = ?");
            $stmt->execute([$senhaHash, $loginEmail]);

            if ($stmt->rowCount() > 0) {
                echo '<div id="result" class="success-message">Senha atualizada com sucesso.</div>';

                // Realize o login com a nova senha
                $stmtLogin = $conn->prepare("SELECT * FROM cadastrar WHERE email = ?");
                $stmtLogin->execute([$loginEmail]);
                $usuario = $stmtLogin->fetch(PDO::FETCH_ASSOC);

                if ($usuario && password_verify($novaSenha, $usuario['senha'])) {
                    // Login bem-sucedido, redirecione ou execute a lógica desejada
                    echo '<div id="result" class="success-message">Login bem-sucedido com a nova senha.</div>';
                    // Redirecione para outra página
                    echo '<script>window.location.href = "../view/painel.php";</script>';
                } else {
                    // Login falhou, manipule de acordo
                    echo '<div id="result" class="error-message">Falha no login com a nova senha.</div>';
                }
            } else {
                echo '<div id="result" class="error-message">Nenhuma linha afetada. Verifique se o e-mail '.$loginEmail.' existe.</div>';
            }
        }

        // Fecha a conexão
        $conn = null;
    }
} catch (Exception $e) {
    echo '<div id="result" class="error-message">Erro: '.$e->getMessage().'</div>';
}
?>
