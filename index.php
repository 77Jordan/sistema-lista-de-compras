<h1>Selecione o Mes e Ano para dar inicio ao cadastro de itens</h1>
<form action="compras.php" method="GET">

    <label>Mês:</label>

    <select name="mes" required>
        <option value="Janeiro">Janeiro</option>
        <option value="Fevereiro">Fevereiro</option>
        <option value="Março">Março</option>
        <option value="Abril">Abril</option>
        <option value="Maio">Maio</option>
        <option value="Junho">Junho</option>
        <option value="Julho">Julho</option>
        <option value="Agosto">Agosto</option>
        <option value="Setembro">Setembro</option>
        <option value="Outubro">Outubro</option>
        <option value="Novembro">Novembro</option>
        <option value="Dezembro">Dezembro</option>
    </select>

    <label>Ano:</label>

    <select name="ano" required>
        <?php
        for($ano = 2024; $ano <= 2035; $ano++){
            echo "<option value='$ano'>$ano</option>";
        }
        ?>
    </select>

    <button type="submit">Adicionar itens</button>



</form>
<button onclick="window.location.href='historico.php'" class="btn-historico">
    📋 Consultar Histórico
</button>