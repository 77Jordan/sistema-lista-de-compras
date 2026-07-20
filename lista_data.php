<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$mes = $_GET['mes'] ?? '';
$ano = $_GET['ano'] ?? '';

$sql = "SELECT * FROM compras WHERE 1=1";

if ($mes !== '') {
    $mesEsc = $conn->real_escape_string($mes);
    $sql .= " AND mes='$mesEsc'";
}

if ($ano !== '') {
    $anoEsc = $conn->real_escape_string($ano);
    $sql .= " AND ano='$anoEsc'";
}

$sql .= " ORDER BY status, item";

$result = $conn->query($sql);

$rowsHtml = '';

while ($row = $result->fetch_assoc()) {
    $id = (int) $row['id'];
    $item = htmlspecialchars($row['item'], ENT_QUOTES, 'UTF-8');
    $status = $row['status'] === 'carrinho' ? 'carrinho' : 'pendente';
    $mesParam = htmlspecialchars($mes, ENT_QUOTES, 'UTF-8');
    $anoParam = htmlspecialchars($ano, ENT_QUOTES, 'UTF-8');

    $rowsHtml .= "<tr>";
    $rowsHtml .= "<td>{$item}</td>";

    if ($status === 'carrinho') {
        $rowsHtml .= "<td>✅ No carrinho</td>";
        $rowsHtml .= "<td>";
        $rowsHtml .= "<button class=\"button-danger\" onclick=\"window.location.href='retirar_carrinho.php?id={$id}&mes={$mesParam}&ano={$anoParam}'\">🗑️ Retirar do carrinho</button>";
        $rowsHtml .= "</td>";
    } else {
        $rowsHtml .= "<td>⏳ Pendente</td>";
        $rowsHtml .= "<td>";
        $rowsHtml .= "<button class=\"button-success\" onclick=\"window.location.href='adicionar_carrinho.php?id={$id}&mes={$mesParam}&ano={$anoParam}'\">🛒 Adicionar ao carrinho</button>";
        $rowsHtml .= "</td>";
    }

    $rowsHtml .= "</tr>";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['html' => $rowsHtml]);
