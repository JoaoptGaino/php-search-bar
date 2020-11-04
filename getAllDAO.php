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

$sql = "SELECT * FROM informacoes";
$result = mysqli_query($con, $sql);


while ($row = mysqli_fetch_array($result)) {
    $tabela = "<tr>";
    $tabela .= "<td>" . $row['nome'] . "</td>";
    $tabela .= "<td>" . $row['telefone'] . "</td>";
    $tabela .= "</tr>";
    echo $tabela;
}
