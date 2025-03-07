<?php   

require_once '../database/conn2.php';

// Instancia a classe Database
$db = new Database();

// Obtém a conexão PDO
$pdo = $db->getPdo();

$descricao = filter_input(INPUT_POST, 'descricao');
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$titulo = filter_input(INPUT_POST, 'titulo');

if ($descricao && $id && $titulo) {
    // Prepara a consulta SQL para atualizar a tarefa
    $sql = $pdo->prepare("UPDATE task SET descricao = :descricao, titulo = :titulo WHERE id = :id");
    $sql->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $sql->bindValue(':descricao', $descricao, PDO::PARAM_STR);
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Redireciona para a página principal após a atualização
    header('Location: ../index.php');
    exit();
} else {
    // Redireciona para a página principal se a descrição ou o ID estiver vazio ou inválido
    header('Location: ../index.php');
    exit();
}

 

