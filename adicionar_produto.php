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
      <h1 class="page-title">Cadastrar Produto</h1>
      <p class="page-subtitle">Adicione um novo produto ao catálogo do AlimentaAngola</p>
    </div>

    <?= mostrarMensagens() ?>
    
    <div class="form-container">
      <form id="product-form" action="processar_adicionar_produto.php" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
          <div class="form-group">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" name="nome" class="form-input" required placeholder="Ex: Maçã, Pão">
          </div>

          <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" name="categoria" class="form-select" required>
              <option selected disabled>Selecione uma categoria</option>
              <?php
                foreach($categorias as $categoria) {
                  echo "<option value='{$categoria["id_categoria"]}'>{$categoria["nome"]}</option>";  
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="preco" class="form-label">Preço</label>
            <div class="price-group">
              <input type="number" id="preco" name="preco" class="form-input" required placeholder="0.00" step="0.01" min="0">
            </div>
          </div>

          <div class="form-group full-width">
            <label for="descricao" class="form-label">Descrição do Produto</label>
            <textarea id="descricao" name="descricao" class="form-textarea" placeholder="Descreva o produto, suas características, benefícios..."></textarea>
          </div>

          <div class="form-group full-width">
            <label class="form-label">Imagem do Produto</label>
            <div class="image-upload-area">
              <input type="file" id="foto" name="foto" accept="image/*" class="file-input">
            </div>
          </div>
        </div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </div>
      </form>
    </div>  
  </main>
</body>
</html>
