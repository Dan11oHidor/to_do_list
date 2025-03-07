<?php

require_once '../database/conn2.php';

// Instancia a classe Database
$db = new Database();

// Obtém a conexão PDO
$pdo = $db->getPdo();

// Filtra a entrada do usuário
$descricao = filter_input(INPUT_POST, 'descricao');
$titulo = filter_input(INPUT_POST, 'titulo');

if ($descricao && $titulo) {
    // Prepara a consulta SQL para inserir a nova tarefa
    $sql = $pdo->prepare("INSERT INTO task (titulo, descricao) VALUES (:titulo, :descricao)");
    $sql->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $sql->bindValue(':descricao', $descricao, PDO::PARAM_STR);
    $sql->execute();


    // Redireciona para a página principal após a inserção
    header('Location: ../index.php');
    exit();

} else {
    // Redireciona para a página principal se a descrição estiver vazia
    header('Location: ../index.php');
    exit();
}

