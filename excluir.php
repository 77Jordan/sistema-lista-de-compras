<?php

$conn = new mysqli("localhost","root","","lista_compras");

$id = $_GET['id'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

$conn->query("DELETE FROM compras WHERE id=$id");

header("Location: compras.php?mes=$mes&ano=$ano");