<?php

require_once 'visual/register.php';
require_once 'model/model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect();

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //$hash = md5($username . time());

    $result = setUser($email, $username, $password);

    if ($result) {
        //Redirect para login
        $mensagem = urlencode("Usuário registrado com sucesso");
        header("Location: index.php?alert=$mensagem");
    } else {
        echo "<h2>Erro ao registrar usuário.</h2>";
    }
} else {
    echo "Acesso inválido.";
}