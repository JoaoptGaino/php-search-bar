<?php
$con = mysqli_connect('localhost', 'root', 'mgtrda', 'pagination');
$sql = "SET NAMES 'utf8'";
mysqli_query($con, $sql);
$sql = 'SET character_set_connection=utf8';
mysqli_query($con, $sql);
$sql = 'SET character_set_client=utf8';
mysqli_query($con, $sql);
$sql = 'SET character_set_results=utf8';
mysqli_query($con, $sql);

if (isset($_GET['q'])) {//Checa se tem alguma pesquisa.
    $search = $_GET['q'];
} else {
    $search = '';
}

if (!$con) {//Checa a conexão
    die("Couldn't connect: " . mysqli_error($con));
    echo "erro";
} else {
    if ($search === "") {//Se estiver sem pesquisa, ele chama a função que pega todas as informações do banco de dados
        getAll($con);
    } else {//Se não, ele filtra
        search($con, $search);
    }
}
function getAll($cone)//Função que pega todas as informações.
{
    $sql = "SELECT * FROM informacoes";
    $result = mysqli_query($cone, $sql);


    while ($row = mysqli_fetch_array($result)) {
        $tabela = "<tr>";
        $tabela .= "<td>" . $row['nome'] . "</td>";
        $tabela .= "<td>" . $row['telefone'] . "</td>";
        $tabela .= "</tr>";
        echo $tabela;
    }
}
function search($cone, $search)//Função para filtrar.
{
    $sql = "SELECT * FROM informacoes WHERE nome LIKE '$search%'";
    $result = mysqli_query($cone, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $tabela = "<tr>";
        $tabela .= "<td>" . $row['nome'] . "</td>";
        $tabela .= "<td>" . $row['telefone'] . "</td>";
        $tabela .= "</tr>";
        echo $tabela;
    }
}
