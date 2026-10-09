<?php 
    if($max_pag < 6 && $pagina >= 1 && $pagina <= $max_pag):?>
        <?php for($i = 1; $i <= $max_pag; $i++):

            $urlAux = $_GET;
            $urlAux['pagina'] = $i;
        ?>

            <a 
                class="item-center-paginacao <?php if($pagina == $i) echo ' pagina';?>" 
                href="?<?php echo http_build_query($urlAux);?>"
            >
                <?php echo $i;?>
            </a>
        <?php endfor;?>
    <?php endif;
?>
    
