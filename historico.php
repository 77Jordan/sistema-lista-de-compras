<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$filtroMes = $_GET['mes'] ?? '';
$filtroAno = $_GET['ano'] ?? '';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Histórico de Compras</h1>
        <form method="GET">

    <select name="mes">
        <option value="">Todos os meses</option>

        <option value="Janeiro" <?= ($filtroMes == 'Janeiro') ? 'selected' : '' ?>>Janeiro</option>

        <option value="Fevereiro" <?= ($filtroMes == 'Fevereiro') ? 'selected' : '' ?>>Fevereiro</option>

        <option value="Março" <?= ($filtroMes == 'Março') ? 'selected' : '' ?>>Março</option>

        <option value="Abril" <?= ($filtroMes == 'Abril') ? 'selected' : '' ?>>Abril</option>

        <option value="Maio" <?= ($filtroMes == 'Maio') ? 'selected' : '' ?>>Maio</option>

        <option value="Junho" <?= ($filtroMes == 'Junho') ? 'selected' : '' ?>>Junho</option>

        <option value="Julho" <?= ($filtroMes == 'Julho') ? 'selected' : '' ?>>Julho</option>

        <option value="Agosto" <?= ($filtroMes == 'Agosto') ? 'selected' : '' ?>>Agosto</option>

        <option value="Setembro" <?= ($filtroMes == 'Setembro') ? 'selected' : '' ?>>Setembro</option>

        <option value="Outubro" <?= ($filtroMes == 'Outubro') ? 'selected' : '' ?>>Outubro</option>

        <option value="Novembro" <?= ($filtroMes == 'Novembro') ? 'selected' : '' ?>>Novembro</option>

        <option value="Dezembro" <?= ($filtroMes == 'Dezembro') ? 'selected' : '' ?>>Dezembro</option>
    </select>

    <select name="ano">
        <option value="">Todos os anos</option>

        <?php
        for ($i = 2024; $i <= 2035; $i++) {

            $selected = ($filtroAno == $i) ? 'selected' : '';

            echo "<option value='$i' $selected>$i</option>";
        }
        ?>
    </select>
    <button type="submit">Pesquisar</button>
</form>

<?php
$sql = "SELECT DISTINCT mes, ano
        FROM compras
        WHERE 1=1";

if ($filtroMes != '') {
    $sql .= " AND mes='$filtroMes'";
}

if ($filtroAno != '') {
    $sql .= " AND ano='$filtroAno'";
}

$sql .= " ORDER BY ano DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $mes = $row['mes'];
    $ano = $row['ano'];

    echo "<h2>$mes / $ano</h2>";

    $itens = $conn->query(
        "SELECT item
         FROM compras
         WHERE mes='$mes'
         AND ano='$ano'
         ORDER BY id DESC"
    );

    echo "<ul>";

    while ($item = $itens->fetch_assoc()) {
        echo "<li>{$item['item']}</li>";
    }

    echo "</ul>";
}
?>
        <button onclick="window.location.href='index.php'">
            🔙 Voltar
        </button>
    </div>
</body>
</html>