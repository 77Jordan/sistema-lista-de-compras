<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

$mes = $_GET['mes'] ?? $_POST['mes'] ?? '';
$ano = $_GET['ano'] ?? $_POST['ano'] ?? '';

if (isset($_GET['action'])) {
    $id = (int)($_GET['id'] ?? 0);

    if ($id > 0) {
        if ($_GET['action'] === 'add_cart') {
            $conn->query("UPDATE compras SET status='carrinho' WHERE id=$id");
        } elseif ($_GET['action'] === 'remove_cart') {
            $conn->query("UPDATE compras SET status='pendente' WHERE id=$id");
        } elseif ($_GET['action'] === 'delete') {
            $conn->query("DELETE FROM compras WHERE id=$id");
        }
    }

    header('Location: index.php?mes=' . urlencode($mes) . '&ano=' . urlencode($ano));
    exit;
}

if (isset($_POST['item']) && trim($_POST['item']) !== '') {
    $item = $conn->real_escape_string(trim($_POST['item']));
    $mesEsc = $conn->real_escape_string($mes);
    $anoEsc = $conn->real_escape_string($ano);

    $conn->query("INSERT INTO compras (mes, ano, item, status) VALUES ('$mesEsc', '$anoEsc', '$item', 'pendente')");

    header('Location: index.php?mes=' . urlencode($mes) . '&ano=' . urlencode($ano));
    exit;
}

$sql = "SELECT * FROM compras WHERE 1=1";

if ($mes !== '') {
    $sql .= " AND mes='" . $conn->real_escape_string($mes) . "'";
}

if ($ano !== '') {
    $sql .= " AND ano='" . $conn->real_escape_string($ano) . "'";
}

$sql .= " ORDER BY status, item";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="hero">
            <div>
                <h1>🛒 Lista de Compras</h1>
                <p>Cadastre, filtre, remova e organize itens no carrinho em uma única tela.</p>
            </div>
            <a class="button-link" href="historico.php">📋 Consultar Histórico</a>
        </div>

        <form method="GET" class="filters" id="filter-form">
            <div class="field-group">
                <label>Mês:</label>
                <select name="mes" id="filter-mes">
                    <option value="">Todos os meses</option>
                    <option value="Janeiro" <?= $mes === 'Janeiro' ? 'selected' : '' ?>>Janeiro</option>
                    <option value="Fevereiro" <?= $mes === 'Fevereiro' ? 'selected' : '' ?>>Fevereiro</option>
                    <option value="Março" <?= $mes === 'Março' ? 'selected' : '' ?>>Março</option>
                    <option value="Abril" <?= $mes === 'Abril' ? 'selected' : '' ?>>Abril</option>
                    <option value="Maio" <?= $mes === 'Maio' ? 'selected' : '' ?>>Maio</option>
                    <option value="Junho" <?= $mes === 'Junho' ? 'selected' : '' ?>>Junho</option>
                    <option value="Julho" <?= $mes === 'Julho' ? 'selected' : '' ?>>Julho</option>
                    <option value="Agosto" <?= $mes === 'Agosto' ? 'selected' : '' ?>>Agosto</option>
                    <option value="Setembro" <?= $mes === 'Setembro' ? 'selected' : '' ?>>Setembro</option>
                    <option value="Outubro" <?= $mes === 'Outubro' ? 'selected' : '' ?>>Outubro</option>
                    <option value="Novembro" <?= $mes === 'Novembro' ? 'selected' : '' ?>>Novembro</option>
                    <option value="Dezembro" <?= $mes === 'Dezembro' ? 'selected' : '' ?>>Dezembro</option>
                </select>
            </div>

            <div class="field-group">
                <label>Ano:</label>
                <select name="ano" id="filter-ano">
                    <option value="">Todos os anos</option>
                    <?php for ($i = 2024; $i <= 2035; $i++): ?>
                        <option value="<?= $i ?>" <?= $ano == $i ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </form>

        <form method="POST" class="add-item-form">
            <input type="hidden" name="mes" value="<?= htmlspecialchars($mes, ENT_QUOTES, 'UTF-8') ?>">
            <input type="hidden" name="ano" value="<?= htmlspecialchars($ano, ENT_QUOTES, 'UTF-8') ?>">

            <div class="field-group field-group-grow">
                <label>Item:</label>
                <input type="text" name="item" placeholder="Digite o item" required>
            </div>
            <button class="button-success" type="submit">Adicionar item</button>
        </form>

        <?php if ($mes !== '' && $ano !== ''): ?>
            <h2><?= htmlspecialchars($mes, ENT_QUOTES, 'UTF-8') ?> / <?= htmlspecialchars($ano, ENT_QUOTES, 'UTF-8') ?></h2>
        <?php else: ?>
            <h2>Todas as listas</h2>
        <?php endif; ?>

        <table id="lista-table">
            <tr>
                <th>Item</th>
                <th>Status</th>
                <th class="actions-column">Ação</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Item">
                        <div class="item-cell">
                            <strong><?= htmlspecialchars($row['item'], ENT_QUOTES, 'UTF-8') ?></strong>
                            <?php if ($mes === '' || $ano === ''): ?>
                                <span class="item-meta"><?= htmlspecialchars($row['mes'], ENT_QUOTES, 'UTF-8') ?> · <?= (int)$row['ano'] ?></span>
                            <?php endif; ?>
                        </div>
                    </td>

                    <?php if ($row['status'] === 'carrinho'): ?>
                        <td data-label="Status">✅ No carrinho</td>
                        <td>
                            <div class="action-buttons">
                                <button class="button-orange" type="button" onclick="window.location.href='index.php?action=remove_cart&id=<?= (int)$row['id'] ?>&mes=<?= urlencode($mes) ?>&ano=<?= urlencode($ano) ?>'">
                                    🗑️ Retirar do carrinho
                                </button>
                                <button class="button-danger btn-delete" type="button" onclick="window.location.href='index.php?action=delete&id=<?= (int)$row['id'] ?>&mes=<?= urlencode($mes) ?>&ano=<?= urlencode($ano) ?>'">
                                    <span class="btn-icon">✕</span>
                                    <span class="btn-label">Excluir item</span>
                                </button>
                            </div>
                        </td>
                    <?php else: ?>
                        <td data-label="Status">⏳ Pendente</td>
                        <td>
                            <div class="action-buttons">
                                <button class="button-success" type="button" onclick="window.location.href='index.php?action=add_cart&id=<?= (int)$row['id'] ?>&mes=<?= urlencode($mes) ?>&ano=<?= urlencode($ano) ?>'">
                                    🛒 Adicionar ao carrinho
                                </button>
                                <button class="button-danger btn-delete" type="button" onclick="window.location.href='index.php?action=delete&id=<?= (int)$row['id'] ?>&mes=<?= urlencode($mes) ?>&ano=<?= urlencode($ano) ?>'">
                                    <span class="btn-icon">✕</span>
                                    <span class="btn-label">Excluir item</span>
                                </button>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filter-form');
            if (!filterForm) return;

            filterForm.querySelectorAll('select').forEach(function (select) {
                select.addEventListener('change', function () {
                    filterForm.submit();
                });
            });
        });
    </script>
</body>
</html>