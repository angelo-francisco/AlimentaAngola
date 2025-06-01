<?php

  require_once "db.php";

  if (isset($_GET["id_produto"]) && !empty($_GET["id_produto"])) {
    $id_produto = $_GET["id_produto"];
    $produto = pegarProdutoPeloId($conn, $id_produto);
    
    if (!$produto) {
      adicionarMensagem("O produto selecionado não foi encontrado", "error", "index.php");
    }
    
    $categoria = pegarCategoriaPeloId($conn, $produto["id_categoria"]);
    
  } else { 
    adicionarMensagem("Nenhum produto foi selecionado", "error", "index.php");
  }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/ver_produto.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>AlimentaAngola</title>
</head>
<body>
  <?php include("navbar.php"); ?>

 <div class="container2">
  <div class="produto2">
    <div class="produto2-imagem">
      <img src="<?= htmlspecialchars($produto["foto"]) ?>" alt="<?= htmlspecialchars($produto["nome"]) ?>" class="produto-image">
    </div>

    <div class="produto2-info">
      Produtos > Categorias > <?= $categoria["nome"] ?>
      <h2><?= htmlspecialchars($produto["nome"]) ?></h2>
      <p><?= nl2br(htmlspecialchars($produto["descricao"])) ?></p>

      <div class="informacoes">
        <div class="container-preco">
          <small>Preço</small><br>
          <span class="preco"><?= number_format($produto['preco'], 2, ',', '.') ?> Kz</span>
        </div>
        <div class="container-preco">
          <small>Categoria</small><br>
          <span class="preco"><?= $categoria["nome"] ?></span>
        </div>
        <div class="container-preco">
          <small>Adicionado em</small><br>
          <span class="preco"><?= date('d/m/Y', strtotime($produto["data_criacao"])) ?></span>
        </div>
      </div>
    </div>
  </div>
</div>



</body>
</html>


