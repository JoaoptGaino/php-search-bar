<?php
$connec = mysqli_connect('191.37.38.114', 'root', 'mgtrda', 'smartino_sistema'); //Conecta com a base que tem os relatórios

$var = $_GET['var'];
$sqlRelatorios = "SELECT * FROM sql_retorno WHERE cod='$var'";

$result = mysqli_query($connec, $sqlRelatorios);
while ($row = mysqli_fetch_array($result)) {
    $nomeRelatorio = $row['nome'];
    $banco = $row['banco'];
    $conexao = $row['conexao'];
    $query = $row['vsql'];
}
if (empty($banco)) {
    die;
}

$total_reg = "5";
$pagina = $_GET['pagina'];
if (!$pagina) {
    $pc = "1";
} else {
    $pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;
$novaCon = mysqli_connect($conexao, 'root', 'mgtrda', $banco);

$limite = "SET NAMES 'utf8'";
mysqli_query($novaCon, $limite);
$limite = 'SET character_set_connection=utf8';
mysqli_query($novaCon, $limite);
$limite = 'SET character_set_client=utf8';
mysqli_query($novaCon, $limite);
$limite = 'SET character_set_results=utf8';
mysqli_query($novaCon, $limite);
$limite = mysqli_query($novaCon, "$query LIMIT $inicio,$total_reg");
$todos = mysqli_query($novaCon, "$query");

$tr = mysqli_num_rows($todos);
$tp = $tr / $total_reg;
?>

<!doctype html>
<html lang="en">

<head>
    <title>Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body onload="getAll()">
    <div class="container">
        <div class="form-group">
            <label for="texto">Nome</label>
            <input type="text" id="inp" onkeyup="handleChange()" class="form-control">
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <div class="overflow-auto">
                <tbody id="nome"></tbody>
            </div>
        </table>
    </div>
    <?php
    $anterior = $pc - 1;
    $proximo = $pc + 1;
    ?>
    <nav aria-label="Navegação de página exemplo">
        <ul class="pagination justify-content-center">
            <?php
            if ($pc <= 1) { ?>
                <li class="page-item disabled">
                    <a class="page-link" href="?pagina=<?= $anterior ?>&var=<?= $var ?>" aria-label="Anterior">
                        <span aria-hidden="true">Anterior</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $anterior ?>&var=<?= $var ?>" aria-label="Anterior">
                        <span aria-hidden="true">Anterior</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($pc < $tp) { ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $proximo ?>&var=<?= $var ?>" aria-label="Próximo">
                        <span aria-hidden="true">Próximo</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled">
                    <a class="page-link" href="?pagina=<?= $proximo ?>&var=<?= $var ?>" aria-label="Próximo">
                        <span aria-hidden="true">Próximo</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="search.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>