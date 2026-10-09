<div class="containerPaginacao">
    <?php if($pagina < 1 || $pagina > $max_pag):?>
        <a href="?<?php echo http_build_query($params)?>">Voltar para o início</a>
    <?php else:?>
        <?php include('./componentes/paginacao/paginacao-max-5.php')?>
        <?php include('./componentes/paginacao/paginacao-maior-5.php')?>
    <?php endif?>
</div>