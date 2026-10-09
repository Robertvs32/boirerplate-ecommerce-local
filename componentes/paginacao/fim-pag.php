<?php 
    $paramsFim = $_GET;
    $paramsFim['pagina'] = $max_pag;

    $urlFim = http_build_query($paramsFim);
?>

<?php if($pagina < $max_pag - 1):?>
    <a style="margin: 0 12px !important" class="item-center-paginacao" href="?<?php echo $urlFim;?>"><?php echo $max_pag;?></a>
<?php endif?>
