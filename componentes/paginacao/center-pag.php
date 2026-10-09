<?php 
    $paramsAux = $_GET;
?>

<!-- SITUACAO INICIAL - PAGINA < 1 -> 1 zero começa pintado na esquerda, depois o 2 pintado no meio, pra nao
ficar esquisito depois com a pagina atual sempre pintada na esquerda se fosse progressivo do começo ao fim da paginacao -->
<?php if($pagina >= 1 && $pagina < 3):?>

    <?php for($i = 1; $i <= 3; $i++):?>

        <?php 
            $paramsAux['pagina'] = $i; //começa do 1 e vai ate o 3
            $urlAux = http_build_query($paramsAux);
        ?>

        <a 
            class="item-center-paginacao <?php if($pagina == $i) echo ' pagina';?>" 
            style="<?php if($pagina == $i) echo 'pointer-events: none';?>"
            href="?<?php echo $urlAux;?>"
        >
            <?php echo $i;?>
        </a>
    <?php endfor;?>
    
<?php endif;?>


<!-- SITUACAO DO MEIO | PAGINA > 1 && PAGINA < MAX -->
<?php if($pagina > 2 && $pagina < $max_pag):?>
    
            <?php for($i = $pagina - 1; $i <= $pagina + 1; $i++):?>
                <?php 
                    $paramsAux['pagina'] = $i; //começa do menor e vai aumentando
                    $urlAux = http_build_query($paramsAux);
                ?>

                <?php if($pagina == $i):?>
                    <a 
                        class="item-center-paginacao <?php if($i == $pagina) echo ' pagina';?>" 
                        href="?<?php echo $urlAux;?>"
                        style="pointer-events: none"
                    >
                        <?php echo (int)$i;?>
                    </a>
                <?php 
                    continue;
                    endif;
                ?>

                <a 
                    class="item-center-paginacao <?php if($i == $pagina) echo ' pagina';?>" 
                    href="?<?php echo $urlAux;?>"
                >
                    <?php echo (int)$i;?>
                </a>
                
            <?php endfor;?>
    
<?php endif;?>

<!-- SITUACAO FINAL - PAGINA < MAXIMO_PAGINAS - PRA PINTAR O ULTIMO SOZINHO, SEM COLOCAR MAIS NENHUMA PAGINA A FRENTE -->
<?php if($pagina == $max_pag):?>

    <?php for($i = $max_pag - 2; $i <= $max_pag; $i++):?>

        <?php 
            $paramsAux['pagina'] = $i;
            $urlAux = http_build_query($paramsAux);
        ?>

        <a 
            class="item-center-paginacao <?php if($i == $max_pag) echo ' pagina';?>" 
            href="?<?php echo $urlAux;?>"
        >
            <?php echo $i;?>
        </a>
    <?php endfor;?>
    
<?php endif;?>