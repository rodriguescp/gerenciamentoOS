<?php
    $iduser = $_POST['idUsuario'];
    $usuario = $_POST['usuario'];
    $fone = $_POST['telefone'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $tipoUsuario = $_POST['tipoUsuario'];
   

    include_once("conexao.php");

    $sql = "INSERT INTO tbusuarios VALUES ";
    $sql .= "('$iduser', '$usuario', '$fone', '$login', '$senha', '$tipoUsuario')";

    mysqli_query($conexao, $sql) or die ("ERRO AO TENTAR CADASTRAR O QUIZ");
    mysqli_close($conexao);

    echo '<h1><center>OS cadastrado com sucesso!</center></h1>';
    echo '<meta http-equiv="refresh" content="2;URL=/OS/cadeos.html">';

    header('Location: principal.html');

?>