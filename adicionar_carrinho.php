<?php

// $conn = new mysqli("localhost","root","","lista_compras");  // PARA ACESSAR O SERVIDOR LOCAL
$conn = new mysqli(   // PARA ACESSAR O SERVIDOR ONLINE
    "sql308.infinityfree.com",
    "if0_42307329",
    "Jordinho159",
    "if0_42307329_lista_compras"
);

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