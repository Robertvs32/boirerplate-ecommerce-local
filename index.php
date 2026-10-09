<?php

include('./config/categorias.php');
include('./config/produtos.php');
include('./config/generos.php');
include('./config/whatsapp.php');  

$categoriasSelecionadas = $_GET['categoria'] ?? [];
$generosSelecionados    = $_GET['genero'] ?? [];
$pagina = (int)($_GET['pagina'] ?? 1);

//ARRAY DE PRODUTOS FILTRADOS POR CATEGORIA E GENERO
$produtosFiltrados = array_values(array_filter($produtos, function ($p) use ($categoriasSelecionadas, $generosSelecionados) {
    $passaCategoria = empty($categoriasSelecionadas) || in_array($p['categoria'], $categoriasSelecionadas, true);
    $passaGenero    = empty($generosSelecionados) || in_array($p['genero'], $generosSelecionados, true);
    return $passaCategoria && $passaGenero;
}));

$params = $_GET;
$params['pagina'] = 1;

//PARAMETROS DA PAGINA ATUAL PARA PASSAR COMO PARAMETRO PRA PROXIMA PAGINA
$paramsProx = $_GET;
$paramsProx['pagina'] = $pagina + 1;
$urlProx = http_build_query($paramsProx);

//PARAMETROS DA PAGINA ATUAL PARA PASSAR COMO PARAMETRO PRA PAGINA ANTERIOR
$paramsAnt = $_GET;
$paramsAnt['pagina'] = $pagina - 1;
$urlAnt = http_build_query($paramsAnt);

//QUANTIDADE DE PRODUTOS VISIVEIS POR PÁGINA
$qtd_produtos = 15;
//INDICE LIMITE DO ARRAY FILTRADO (CORTAR PARA PAGINAÇÃO)
$limite = $pagina * $qtd_produtos;

//PÁGINA MÁXIMA
$max_pag = ceil((count($produtosFiltrados) / $qtd_produtos)); //ta arredondando pra baixo pq começa em 0 a página

$produtosPaginacao = array_slice($produtosFiltrados, $limite - $qtd_produtos, $qtd_produtos);

function formatarPreco(float $valor): string {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.R Perfumaria</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./componentes/paginacao/paginacao.css">
    <link rel="icon" href="./assets/logo.svg" type="image/svg+xml">
</head>
<body>

  <?php include('./componentes/header.php')?>
  <div class="container">
    <?php include('./componentes/filtros.php')?>
    <?php include('./componentes/produtos.php')?>
  </div>
  
  <?php include('./componentes/containerPaginacao.php')?>
  <?php include('./componentes/carrinho.php')?>
  <?php include('./componentes/fundoCarrinho.php')?>
  <?php include('./componentes/modalAddCarrinho.php')?>

  <script src="./componentes/script.js" defer></script>

</body>
</html>