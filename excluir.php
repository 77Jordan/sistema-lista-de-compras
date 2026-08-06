<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$id = (int)($_GET['id'] ?? 0);
$mes = $_GET['mes'] ?? '';
$ano = $_GET['ano'] ?? '';

if ($id > 0) {
    $conn->query("DELETE FROM compras WHERE id=$id");
}

header('Location: index.php?mes=' . urlencode($mes) . '&ano=' . urlencode($ano));
exit;