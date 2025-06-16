<?php
require_once 'model/model.php';

// Pega o get id e deleta a task desse id
if (isset($_GET['id'])) {
    $taskId = intval($_GET['id']);
    
    // Deleta a tarefa
    $result = deleteTask($taskId);
    
    if ($result) {
        // Redireciona para home com mensagem de sucesso
        header("Location: home.php");
    } else {
        // Redireciona para home com mensagem de erro
        header("Location: home.php");
    }
} else {
    // Redireciona para home se não houver id
    header("Location: home.php");
}