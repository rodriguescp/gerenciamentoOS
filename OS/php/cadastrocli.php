<?php
    $nome_cli = $_POST['nome_cli'];
    $fone_cli = $_POST['fone_cli'];
    $endereço_cli = $_POST['endereço_cli'];
    $email_cli = $_POST['email_cli'];
    $idcliente = $_POST['idcliente'];

    include_once("conexao.php");

    // Use a função mysqli_real_escape_string para escapar as aspas simples
    $nome_cli = mysqli_real_escape_string($conexao, $nome_cli);
    $endereço_cli = mysqli_real_escape_string($conexao, $endereço_cli);
    $email_cli = mysqli_real_escape_string($conexao, $email_cli);

    $sql = "INSERT INTO tbclientes VALUES ";
    $sql .= "('$nome_cli', '$idcliente', '$fone_cli', '$endereço_cli', '$email_cli')";

    mysqli_query($conexao, $sql) or die ("ERRO AO TENTAR CADASTRAR O CLIENTE");
    mysqli_close($conexao);

    echo '<h1><center>Cliente cadastrado com sucesso!</center></h1>';
    echo '<meta http-equiv="refresh" content="2;URL=/OS/cadecli.html">';
?>
