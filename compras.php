<?php

$conn = new mysqli("localhost", "root", "", "lista_compras");

$mes = $_GET['mes'] ?? $_POST['mes'];
$ano = $_GET['ano'] ?? $_POST['ano'];

if (isset($_POST['item'])) {

    $item = $_POST['item'];

    $sql = "INSERT INTO compras(mes,ano,item)
        VALUES('$mes','$ano','$item')";

    $conn->query($sql);
}
?>
<h2>Compras de <?= $mes ?> / <?= $ano ?></h2>
<form method="POST">

    <input type="hidden" name="mes" value="<?= $mes ?>">
    <input type="hidden" name="ano" value="<?= $ano ?>">

    <input
        type="text"
        name="item"
        placeholder="Digite o item"
        required>

    <button>Cadastrar</button>
    <a href="lista.php">
    <button type="button">🛒 Ver Lista de Compras</button>
</a>

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
            <button onclick=\"window.location.href='excluir.php?id={$row['id']}&mes=$mes&ano=$ano'\">🗑️</button>
        </td>
    </tr>";
    }

    ?>

</table>