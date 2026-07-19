<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$id = $_GET['id'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$conn->query("DELETE FROM compras WHERE id=$id");

header("Location: compras.php?mes=$mes&ano=$ano");