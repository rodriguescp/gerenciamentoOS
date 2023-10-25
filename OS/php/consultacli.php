<?php
include_once("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group select {
            width: 100%;
        }

        .login-btn {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .login-btn:not(:last-child) {
            margin-right: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Lista de Clientes</h2>
        <div class="login-form">
            <?php
            function listarClientes($filtroNome = '') {
                global $conexao;
                $sql = "SELECT nome_cli, idcliente, fone_cli, endereço_cli, email_cli FROM tbclientes";
                if (!empty($filtroNome)) {
                    $sql .= " WHERE nome_cli LIKE '%$filtroNome%'";
                }
                $result = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<form method='GET' action=''>
                            <input type='text' name='filtroNome' placeholder='Filtrar por Nome' value='$filtroNome'>
                            <input type='submit' value='Filtrar' class='login-btn'>
                        </form>";

                    echo "<table>";
                    echo "<tr><th>Nome</th><th>ID do Cliente</th><th>Telefone</th><th>Endereço</th><th>Email</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nome_cli'] . "</td>";
                        echo "<td>" . $row['idcliente'] . "</td>";
                        echo "<td>" . $row['fone_cli'] . "</td>";
                        echo "<td>" . $row['endereço_cli'] . "</td>";
                        echo "<td>" . $row['email_cli'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Nenhum cliente cadastrado.";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['filtroNome'])) {
                $filtroNome = $_GET['filtroNome'];
                listarClientes($filtroNome);
            } else {
                listarClientes();
            }
            ?>
        </div>
    </div>
</body>
</html>
