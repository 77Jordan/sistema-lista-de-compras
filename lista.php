<?php
header('Location: index.php?mes=' . urlencode($_GET['mes'] ?? '') . '&ano=' . urlencode($_GET['ano'] ?? ''));
exit;
