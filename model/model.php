<?php
// Configurações de conexão
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";


// Conectar ao banco de dados
function connect() {
    global $db_host, $db_user, $db_pass, $db_name;
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
    return $conn;
}


// Funções relacionadas ao usuário
function setUser($email, $username, $password) {
    $conn = connect();
    $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
    return $conn->query($query);
}

function getUserByEmail($email) {
    $conn = connect();
    $query = "SELECT * FROM users WHERE email = '$email'";
    return $conn->query($query);
}

function getUserByUsername($username){
    $conn = connect();
    $query = "SELECT * FROM users WHERE username = '$username'";
    return $conn->query($query);
}

function login($username, $password) {
    $conn = connect();
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '' OR '1'='1'";
    return $conn->query($query);
}


function getUserById($id) {
    $conn = connect();
    $query = "SELECT * FROM users WHERE id = $id";
    return $conn->query($query);
}

function setUserHash($username, $hash) {
    $conn = connect();
    $query = "UPDATE users SET hash = '$hash' WHERE username = '$username'";
    return $conn->query($query);
}

function getUserByHash($hash) {
    $conn = connect();
    $query = "SELECT * FROM users WHERE hash = '$hash'";
    return $conn->query($query);
}

// Funções relacionadas às tarefas
function setTask($user_id, $name, $priority, $description, $link, $shared) {
    $conn = connect();
    $query = "INSERT INTO tasks (user_id, name, priority, description, link, shared)
              VALUES ($user_id, '$name', '$priority', '$description', '$link', $shared)";
    return $conn->query($query);
}

function getTasksByUserId($user_id) {
    $conn = connect();
    $query = "SELECT * FROM tasks WHERE user_id = $user_id";
    return $conn->query($query);
}

function getTaskById($id) {
    $conn = connect();
    $query = "SELECT * FROM tasks WHERE id = $id";
    return $conn->query($query);
}

function getAllSharedTasks() {
    $conn = connect();
    $query = "SELECT * FROM tasks WHERE shared = 1";
    return $conn->query($query);
}

function deleteTask($id) {
    $conn = connect();  // cria a conexão localmente

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    if (!$stmt) {
        // Para debug, pode adicionar:
        die("Erro no prepare: " . $conn->error);
    }

    // 'i' = int
    $stmt->bind_param("i", $id);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}

function updateTask($id, $name, $priority, $description, $link, $shared) {
    $conn = connect();  // cria a conexão localmente

    $stmt = $conn->prepare("UPDATE tasks SET name = ?, priority = ?, description = ?, link = ?, shared = ? WHERE id = ?");
    if (!$stmt) {
        // Para debug, pode adicionar:
        die("Erro no prepare: " . $conn->error);
    }

    // 'sssiii' = string, string, string, string, int, int
    $stmt->bind_param("sssiii", $name, $priority, $description, $link, $shared, $id);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}
