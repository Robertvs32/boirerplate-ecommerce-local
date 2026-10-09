
<!-- ===================== FILTROS ===================== -->
<aside class="filtros" id="filtros">
    <form method="get">

        <h3>CATEGORIA</h3>

        <div class="grupo">
            <?php foreach ($categoriasDisponiveis as $valor => $rotulo): ?>
                <label>
                <input type="checkbox" name="categoria[]" value="<?= htmlspecialchars($valor) ?>"
                    <?= in_array($valor, $categoriasSelecionadas, true) ? 'checked' : '' ?>>
                <?= htmlspecialchars($rotulo) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <h3>GENERO</h3>

        <div class="grupo">
            <?php foreach ($generosDisponiveis as $valor => $rotulo): ?>
                <label>
                <input type="checkbox" name="genero[]" value="<?= htmlspecialchars($valor) ?>"
                    <?= in_array($valor, $generosSelecionados, true) ? 'checked' : '' ?>>
                <?= htmlspecialchars($rotulo) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn-aplicar">APLICAR FILTROS</button>
    </form>
</aside>