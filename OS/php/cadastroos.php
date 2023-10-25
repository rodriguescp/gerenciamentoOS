<?php
    $os = $_POST['os'];
    $equipamento = $_POST['equipamento'];
    $serviço = $_POST['serviço'];
    $tecnico = $_POST['tecnico'];
    $valor = $_POST['valor'];
    $defeito = $_POST['defeito'];
    $data_os = $_POST['data_os'];
    $idcliente= $_POST['idcliente'];


    include_once("conexao.php");

    $sql = "INSERT INTO tbos VALUES ";
    $sql .= "('$os', '$data_os', '$equipamento', '$defeito', '$serviço', '$tecnico', '$valor','$idcliente')";

    mysqli_query($conexao, $sql) or die ("ERRO AO TENTAR CADASTRAR O QUIZ");
    mysqli_close($conexao);

    echo '<h1><center>OS cadastrado com sucesso!</center></h1>';
    echo '<meta http-equiv="refresh" content="2;URL=/OS/cadeos.html">';

?>