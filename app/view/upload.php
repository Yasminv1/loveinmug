<?php
// Verifica se ocorreu algum erro durante o upload do arquivo
if ($_FILES["file"]["error"] > 0) {
    // Se houver um erro, retorna uma resposta JSON com informações de erro
    echo json_encode(array('error' => 1, 'message' => 'Erro ao fazer upload da foto: ' . $_FILES["file"]["error"], 'path' => ''));
} else {
    // Se não houver erro, continua o processo de upload

    // Define o tamanho máximo para o envio de arquivos (20MB neste caso)
    ini_set('post_max_size', '20M');

    // Obtém a extensão do arquivo enviado
    $extensao = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    // Gera um nome de arquivo único baseado na data e em um número aleatório
    $nomeArquivo = date("YmdHis") . rand(100, 999) . "." . $extensao;

    // Define o caminho onde o arquivo será armazenado
    $path = "upload/" . $nomeArquivo;

    // Verifica se o diretório "upload" existe, e se não, cria-o com permissões de escrita (0777)
    if (!is_dir('upload')) {
        mkdir('upload', 0777, true);
    }

    // Move o arquivo temporário para o caminho definido
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
        // Se o arquivo foi movido com sucesso, retorna uma resposta JSON indicando sucesso
        echo json_encode(array('error' => 0, 'message' => 'Upload de foto realizado com sucesso.', 'path' => $path));
    } else {
        // Se houver um erro ao mover o arquivo, retorna uma resposta JSON com informações de erro
        echo json_encode(array('error' => 1, 'message' => 'Erro ao mover o arquivo temporário.', 'path' => ''));
    }
}
?>