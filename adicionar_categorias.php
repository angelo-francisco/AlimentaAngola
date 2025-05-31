<?php
  require_once "db.php";

  apenasPessoasLogadas();
  apenasAdmins();
  
  $categorias = pegarCategorias($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/base.css">  
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/adicionar_produto.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>Novo Produto | AlimentaAngola</title>
</head>
<body>
  <?php include("navbar.php"); ?>

  <main class="main-container">
    <div class="page-header">
      <h1 class="page-title">Cadastrar categoria</h1>
      <p class="page-subtitle">Adicione uma nova categoria ao catálogo do AlimentaAngola</p>
    </div>

    <?= mostrarMensagens() ?>
    
    <div class="form-container">
      <form id="product-form" action="ver_categoria.php" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
          <div class="form-group">
            <label for="nome" class="form-label">Nome da categoria</label>
            <input type="text" id="nome" name="nome" class="form-input" required placeholder="Ex: Doces e sobremesas, congelados">
          </div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </div>
      </form>
    </div>  
  </main>
</body>
</html>
