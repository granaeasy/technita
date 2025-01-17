<?php
// Verificar se um CPF foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    // Caminho do arquivo onde os CPFs serão armazenados
    $arquivo_cpfs = 'cpfs.txt';

    // Verificar se o arquivo já existe, caso contrário, criar
    if (!file_exists($arquivo_cpfs)) {
        file_put_contents($arquivo_cpfs, '');
    }

    // Ler todos os CPFs já armazenados
    $cpfs_salvos = file($arquivo_cpfs, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Verificar se o CPF já está cadastrado
    if (in_array($cpf, $cpfs_salvos)) {
        // CPF já cadastrado: retornar a mensagem de cancelamento
        echo json_encode(['status' => 'exists', 'message' => 'Cancelamento já realizado com sucesso.']);
    } else {
        // Adicionar o novo CPF ao arquivo
        file_put_contents($arquivo_cpfs, $cpf . PHP_EOL, FILE_APPEND);

        // Retornar uma resposta de sucesso
        echo json_encode(['status' => 'new', 'message' => 'CPF registrado com sucesso.']);
    }
    exit;
}
