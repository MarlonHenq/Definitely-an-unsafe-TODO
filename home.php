<?php
require_once 'model/model.php';

// Verifica se está logado
session_start();
if (!isset($_SESSION['hash'])) {
    header("Location: index.php");
    exit;
}

// Obtém usuário pelo hash
$hash = $_SESSION['hash'];
$userResult = getUserByHash($hash);
if (!$userResult || $userResult->num_rows === 0) {
    header("Location: index.php");
    exit;
}
$user = $userResult->fetch_assoc();
$_SESSION['user_id'] = $user['id'];
$user_id = $_SESSION['user_id'];

$alert_message = '';
$alert_type = '';

// Se for POST (submit do form)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['taskName'];
    $priority = $_POST['taskPriority'];
    $description = $_POST['taskDescription'];
    $link = $_POST['taskLink'] ?? '';
    $shared = ($_POST['taskShare'] === 'true') ? 1 : 0;

    if (isset($_GET['id'])) {
        // Update tarefa existente
        $taskId = intval($_GET['id']);
        $result = updateTask($taskId, $name, $priority, $description, $link, $shared);
        if ($result) {
            $alert_message = "Tarefa atualizada com sucesso!";
            $alert_type = "success";
        } else {
            $alert_message = "Erro ao atualizar tarefa.";
            $alert_type = "danger";
        }

        header("Location: home.php");
    } else {
        // Cria nova tarefa
        $result = setTask($user_id, $name, $priority, $description, $link, $shared);
        if ($result) {
            $alert_message = "Tarefa adicionada com sucesso!";
            $alert_type = "success";
        } else {
            $alert_message = "Erro ao adicionar tarefa.";
            $alert_type = "danger";
        }
    }
}

// Se recebeu id no GET, busca tarefa para editar e preencher form
$taskToEdit = null;
if (isset($_GET['id'])) {
    $taskId = intval($_GET['id']);
    $taskResult = getTaskById($taskId);
    if ($taskResult && $taskResult->num_rows > 0) {
        $taskToEdit = $taskResult->fetch_assoc();
    } else {
        $alert_message = "Tarefa não encontrada.";
        $alert_type = "danger";
    }
}

// Busca tarefas para mostrar nas tabelas
$personalTasks = getTasksByUserId($user_id);
$teamTasks = getAllSharedTasks();

require_once 'visual/home.php';
