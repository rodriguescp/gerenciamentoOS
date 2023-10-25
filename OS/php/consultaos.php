<!DOCTYPE html>
<html>
<head>
    <title>Lista de Equipamentos</title>
    <style>
        table {
            font-family: Arial, sans-serif;
            background-color: #fff;
            max-width: 800px;
            margin: 50px auto;
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

        .cancel-button, .save-button {
            background-color: #ccc;
        }
        
        .pesquisa-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
                    }

        .pesquisa-input::placeholder {
                color: #999;
            }

        .pesquisa-button {
                padding: 5px 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease; 
            }

        .pesquisa-button:hover {
                background-color: #004288;
            }

    </style>
</head>
<body>
    <?php
    include_once("conexao.php");

    $tecnicoSearch = isset($_GET['tecnico-search']) ? $_GET['tecnico-search'] : '';

    function exibirBarraPesquisa($tecnicoSearch) {
        echo '<form method="GET" action="">';
        echo '<label for="tecnico-search">Pesquisar Técnico:</label>';
        echo '<input type="text" name="tecnico-search" id="tecnico-search" class="pesquisa-input" placeholder="Digite o nome do técnico" value="' . $tecnicoSearch . '">';
        echo '<input type="submit" value="Pesquisar" class="pesquisa-button">';
        echo '</form>';
    }
    
    exibirBarraPesquisa($tecnicoSearch);

    function listarEquipamentos($conexao, $tecnicoSearch) {
        $sql = "SELECT equipamento, valor, defeito, idcliente, tecnico, data_os, os FROM tbos";
        
        if (!empty($tecnicoSearch)) {
            $sql .= " WHERE tecnico LIKE '%$tecnicoSearch%'";
        }

        $result = mysqli_query($conexao, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Equipamento</th><th>Valor</th><th>Defeito</th><th>ID do Cliente</th><th>Técnico</th><th>Data OS</th><th>OS</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                if (isset($_POST['editar']) && $_POST['editar'] == $row['os']) {
                  
                } else {
                    echo $row['equipamento'];
                }
                echo "</td>";
                echo "<td>" . $row['valor'] . "</td>";
                echo "<td>" . $row['defeito'] . "</td>"; 
                echo "<td>" . $row['idcliente'] . "</td>";
                echo "<td>" . $row['tecnico'] . "</td>";
                echo "<td>" . $row['data_os'] . "</td>";
                echo "<td>" . $row['os'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum equipamento encontrado para o técnico: " . $tecnicoSearch;
        }
    }

    listarEquipamentos($conexao, $tecnicoSearch);
    ?>
</body>
</html>
