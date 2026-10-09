<?php 
    $paramsIni = $_GET;
    $paramsIni['pagina'] = 1;

    $urlIni = http_build_query($paramsIni);
?>

<?php if($pagina > 2):?>
    <a style="margin: 0 12px !important" class="item-center-paginacao" href="?<?php echo $urlIni;?>">1</a>
<?php endif;?>
