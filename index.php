<?php

require_once 'visual/login.php';
require_once 'model/model.php';
session_start();

//Mostar alert do get

if ($_GET["alert"]){
    echo "<script>alert('" . $_GET["alert"] . "')</script>";
    echo "<script>window.location.href = 'index.php'</script>";
}

//IF tem hash redirect para home
if (isset($_SESSION['hash'])) {
    $hash = $_SESSION['hash'];
    $user = getUserByHash($hash);
    if ($user && $user->num_rows > 0) {
        $user = $user->fetch_assoc();
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        echo "<script>alert('AAAaaaAA')</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Executa login vulnerável
    $result = login($username, $password);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Login bem-sucedido
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['hash'] = md5($username . time());

        setUserHash($username, $_SESSION['hash']);
        header("Location: index.php");
        exit;
    } else {
        $mensagem = urlencode("Usuário ou senha inválidos.");
        header("Location: index.php?alert=$mensagem");
    }
} else {
    echo "Acesso inválido.";
}
