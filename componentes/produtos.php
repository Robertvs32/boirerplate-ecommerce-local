<!-- ===================== PRODUTOS ===================== -->
<main class="produtos">
    <?php if (empty($produtosPaginacao) || $pagina < 1 || $pagina > $max_pag): ?>
        <p class="sem-produtos">Nenhum produto encontrado para os filtros selecionados.</p>
    <?php else: ?>
        <?php foreach ($produtosPaginacao as $index => $p): ?>

        <div class="card-produto">
            <img src="<?= $p['imagem'] ?>" alt="<?= htmlspecialchars($p['titulo']) ?>">
            <div class="info">
            <span 
                class="tag-genero" 
                style="<?php if(!$p['genero']) echo "
                    background: none; 
                    border: none; 
                    color: transparent; 
                    height: 21px;
                ";?>"
            >
                <?= htmlspecialchars($generosDisponiveis[$p['genero']] ?? $p['genero']) ?>
            </span>
            <p class="titulo"><?= htmlspecialchars($p['titulo']) ?></p>
            <p class="descricao"><?= htmlspecialchars($p['descricao']) ?></p>
            <p class="preco"><?= formatarPreco($p['valor']) ?></p>
            <button class="btn-adicionar"
                data-id="<?= $p['id'] ?>"
                data-titulo="<?= htmlspecialchars($p['titulo']) ?>"
                data-valor="<?= $p['valor'] ?>"
                data-imagem="<?= $p['imagem'] ?>"
                onclick="abrirModalAdicionar(this)">
                ADICIONAR AO CARRINHO
            </button>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>