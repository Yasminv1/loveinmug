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

// Recupere os dados do formulário
$loginEmail = $_POST['loginEmail'];
$loginSenha = $_POST['loginSenha'];

// Verifique o login
$sql = "SELECT id, email, senha FROM cadastrar WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$loginEmail]);
$user = $stmt->fetch();

if ($user && password_verify($loginSenha, $user['senha'])) {
    // Login bem-sucedido. Retorne uma resposta JSON para o redirecionamento no lado do cliente.
    $response = array('success' => true, 'message' => 'Login bem-sucedido.');
    echo json_encode($response);
} else {
    // Login mal-sucedido. Retorne uma resposta JSON indicando o erro.
    $response = array('success' => false, 'message' => 'Email ou senha incorreto.');
    echo json_encode($response);
}

