<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container-de-cadastro {
            max-width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .container-de-cadastro h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .formulario-de-cadastro {
            display: flex;
            flex-direction: column;
        }

        .grupo-de-formulario {
            margin-bottom: 20px;
        }

        .grupo-de-formulario label {
            font-weight: bold;
            color: #555;
        }

        .grupo-de-formulario input,
        .grupo-de-formulario select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .grupo-de-formulario select {
            width: 100%;
        }

        .botao-de-cadastro {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .botao-de-cadastro:hover {
            background-color: #0056b3;
        }

        .botao-de-cadastro:not(:last-child) {
            margin-right: 10px;
        }

        table {
            font-family: Arial, sans-serif;
            background-color: #fff;
            max-width: 100%;
            margin: 20px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        td {
            background-color: #f0f0f0;
            color: #555;
        }

        .edit-form {
            display: inline-block;
        }

        .edit-button, .delete-button, .cancel-button, .save-button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-button {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #f44336;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #004288;
        }
    </style>
</head>
<body>
    <?php
    include_once("conexao.php");

    function listarUsuarios() {
        global $conexao;
        $sql = "SELECT usuario, fone FROM tbusuarios";
        $result = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Usuário</th><th>Telefone</th><th>Ações</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                if (isset($_POST['editar']) && $_POST['editar'] == $row['usuario']) {
                    echo "<form class='edit-form' method='POST' action=''>
                            <input type='text' name='novo-usuario' value='" . $row['usuario'] . "'>
                            <input type='text' name='novo-telefone' value='" . $row['fone'] . "'>
                            <button type='submit' name='salvar' class='save-button' value='" . $row['usuario'] . "'>Salvar</button>
                            <button type='submit' name='cancelar' class='cancel-button' value='" . $row['usuario'] . "'>Cancelar</button>
                          </form>";
                } else {
                    echo $row['usuario'];
                }
                echo "</td>";
                echo "<td>";
                if (isset($_POST['editar']) && $_POST['editar'] == $row['usuario']) {
                    echo "";
                } else {
                    echo $row['fone'];
                }
                echo "</td>";
                echo "<td>";
                if (!isset($_POST['editar']) || $_POST['editar'] != $row['usuario']) {
                    echo "<form method='POST' action=''>
                            <button type='submit' name='editar' class='edit-button' value='" . $row['usuario'] . "'>Editar</button>
                          </form>";
                }
                echo "<form method='POST' action=''>
                        <button type='submit' name='excluir' class='delete-button' value='" . $row['usuario'] . "'>Excluir</button>
                      </form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum usuário cadastrado.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["novo-usuario"]) && isset($_POST["salvar"])) {
            $usuario = $_POST["salvar"];
            $novoUsuario = $_POST["novo-usuario"];
            $novoTelefone = $_POST["novo-telefone"];

            global $conexao;
            $sql = "UPDATE tbusuarios SET usuario = '$novoUsuario', fone = '$novoTelefone' WHERE usuario = '$usuario'";
            $resultado = mysqli_query($conexao, $sql);

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } elseif (isset($_POST["excluir"])) {
            $usuario = $_POST["excluir"];
            $sql = "DELETE FROM tbusuarios WHERE usuario = '$usuario'";
            $resultado = mysqli_query($conexao, $sql);

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } elseif (isset($_POST["cancelar"])) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    listarUsuarios();
    ?>
</body>
</html>
