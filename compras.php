<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$mes = $_GET['mes'] ?? $_POST['mes'];
$ano = $_GET['ano'] ?? $_POST['ano'];

if (isset($_POST['item'])) {

    $item = $_POST['item'];

    $sql = "INSERT INTO compras(mes,ano,item)
        VALUES('$mes','$ano','$item')";

    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Itens</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Compras <?= $mes ?> de <?= $ano ?></h2>
        <form method="POST">

            <input type="hidden" name="mes" value="<?= $mes ?>">
            <input type="hidden" name="ano" value="<?= $ano ?>">

    <input
        type="text"
        name="item"
        placeholder="Digite o item"
        required>

    <button class="button-success">Adicionar item</button>
    <button type="button" onclick="window.location.href='lista.php'">🛒 Ver Lista de Compras</button>
</form>
<table border="1">

    <?php

    $sql = "SELECT * FROM compras
        WHERE mes='$mes'
        AND ano='$ano'
        ORDER BY id DESC";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

        echo "
    <tr>
        <td>{$row['item']}</td>

        <td>
            <button class=\"button-danger\" onclick=\"window.location.href='excluir.php?id={$row['id']}&mes=$mes&ano=$ano'\">Remover item🗑️</button>
        </td>
    </tr>";
    }

    ?>

</table>
    </div>
</body>
</html>