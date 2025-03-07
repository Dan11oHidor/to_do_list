<?php

require_once '../database/conn2.php';

// Instancia a classe Database
$db = new Database();

// Obtém a conexão PDO
$pdo = $db->getPdo();

// Filtra a entrada do usuário
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$completed = filter_input(INPUT_POST, 'completed', FILTER_VALIDATE_INT);

if ($id !== false && $completed !== null) {
    // Prepara a consulta SQL para atualizar o status da tarefa
    $sql = $pdo->prepare("UPDATE task SET completed = :completed WHERE id = :id");
    $sql->bindValue(':completed', $completed, PDO::PARAM_INT);
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    
    if ($sql->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao executar a consulta SQL']);
    }
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'ID ou status inválido']);
    exit();
}