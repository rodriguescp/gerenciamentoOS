<?php
session_start();
include('conexao.php');

if (empty($_POST['login']) || empty($_POST['senha'])) {
    header('location:/OS/index.html');
    exit();
}

$login = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT login, iduser FROM tbusuarios WHERE login = '$login' AND senha = '$senha'";
$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['login'] = $login;
    header("location:/OS/principal.html");
    exit();
} else {
    header('location:/OS/index.html');
    exit();
}
?>