<?php

$conn = new mysqli("localhost","root","","lista_compras");

$id = $_GET['id'];
$mes = $_GET['mes'] ?? '';
$ano = $_GET['ano'] ?? '';

$conn->query("
    UPDATE compras
    SET status='carrinho'
    WHERE id='$id'
");

header("Location: lista.php?mes=$mes&ano=$ano");
exit;