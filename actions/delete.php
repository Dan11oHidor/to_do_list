<?php

require_once '../database/conn2.php';

// Instancia a classe Database
$db = new database();

// Obtém a conexão PDO
$pdo = $db->getPdo();

// Filtra a entrada do usuário
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    // Prepara a consulta SQL para deletar a tarefa
    $sql = $pdo->prepare('DELETE FROM task WHERE id = :id');
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Redireciona para a página principal após a exclusão
    header('Location: ../index.php');
    exit();
} else {
    // Redireciona para a página principal se o ID estiver vazio ou inválido
    header('Location: ../index.php');
    exit();
}