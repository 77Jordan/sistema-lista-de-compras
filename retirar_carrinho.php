<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$id = $_GET['id'];
$mes = $_GET['mes'] ?? '';
$ano = $_GET['ano'] ?? '';

$conn->query("
    UPDATE compras
    SET status='pendente'
    WHERE id='$id'
");

header("Location: lista.php?mes=$mes&ano=$ano");
exit;