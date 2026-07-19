<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$mes = $_GET['mes'] ?? '';
$ano = $_GET['ano'] ?? '';


$sql = "SELECT * FROM compras
        WHERE 1=1";

if ($mes != '') {
    $sql .= " AND mes='$mes'";
}

if ($ano != '') {
    $sql .= " AND ano='$ano'";
}

$sql .= " ORDER BY status, item";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

<h1>🛒 Lista de Compras</h1>

<?php

if ($mes != '' && $ano != '') {
    echo "<h2>$mes / $ano</h2>";
} else {
    echo "<h2>Todas as listas</h2>";
}
?>

<form method="GET">

    <select name="mes">
        <option value="">Todos os meses</option>
        <option value="Janeiro">Janeiro</option>
        <option value="Fevereiro">Fevereiro</option>
        <option value="Março">Março</option>
        <option value="Abril">Abril</option>
        <option value="Maio">Maio</option>
        <option value="Junho">Junho</option>
        <option value="Julho">Julho</option>
        <option value="Agosto">Agosto</option>
        <option value="Setembro">Setembro</option>
        <option value="Outubro">Outubro</option>
        <option value="Novembro">Novembro</option>
        <option value="Dezembro">Dezembro</option>
    </select>

    <select name="ano">
        <option value="">Todos os anos</option>

        <?php
        for ($i = 2024; $i <= 2035; $i++) {
            $selected = ($ano == $i) ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
        }
        ?>
    </select>

    <button type="submit">🔍 Filtrar</button>

</form>
<table border="1">

    <tr>
        <!-- <th>Mês</th>
        <th>Ano</th> -->
        <th>Item</th>
        <th>Status</th>
        <th>Ação</th>
    </tr>

    <?php

    while ($row = $result->fetch_assoc()) {

    echo "<tr>";

    // echo "<td>{$row['mes']}</td>";
    // echo "<td>{$row['ano']}</td>";
    echo "<td>{$row['item']}</td>";

    if ($row['status'] == 'carrinho') {

        echo "<td>✅ No carrinho</td>";

        echo "<td>
            <button class=\"button-danger\" onclick=\"window.location.href='retirar_carrinho.php?id={$row['id']}&mes=$mes&ano=$ano'\">
                🗑️ Retirar do carrinho
            </button>
          </td>";

    } else {

        echo "<td>⏳ Pendente</td>";

        echo "<td>
            <button class=\"button-success\" onclick=\"window.location.href='adicionar_carrinho.php?id={$row['id']}&mes=$mes&ano=$ano'\">
                🛒 Adicionar ao carrinho
            </button>
          </td>";
    }

    echo "</tr>";
}
    ?>
</table>
    <button onclick="window.location.href='index.php'">
        🔙 Voltar
    </button>
    </div>
</body>
</html>