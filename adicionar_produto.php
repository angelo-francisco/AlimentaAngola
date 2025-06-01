<?php
  require_once "db.php";

  apenasPessoasLogadas();
  apenasAdmins();
  
  $categorias = pegarCategorias($conn);
  $produto = null;
  
  if (isset($_GET["id_produto"]) && is_numeric($_GET["id_produto"])) {
    $id_produto = $_GET["id_produto"];
    
    $produto = pegarProdutoPeloId($conn, $id_produto);
    $categoria_do_produto = pegarCategoriaPeloId($conn, $produto["id_categoria"]);
  }
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
      <form id="product-form" action="processar_adicionar_produto.php<?= $produto ? "?id_produto=" . $produto["id_produto"] : "" ?>" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
          <div class="form-group">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" name="nome" class="form-input" required placeholder="Ex: Maçã, Pão" value="<?= $produto["nome"] ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" name="categoria" class="form-select" required>
              <?php
              if (!$produto) {?>
              <option selected disabled>Selecione uma categoria</option>
              <?php } ?>
              
              <?php
                foreach($categorias as $categoria) {
                  if ($categoria_do_produto["nome"] === $categoria["nome"]) {
                    echo "<option value='{$categoria["id_categoria"]}' selected>{$categoria["nome"]}</option>";  
                  } else {
                    echo "<option value='{$categoria["id_categoria"]}'>{$categoria["nome"]}</option>";  
                  }
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="preco" class="form-label">Preço</label>
            <div class="price-group">
              <input type="number" id="preco" name="preco" class="form-input" required placeholder="0.00" step="0.01" min="0" value="<?= $produto["preco"] ?? '' ?>">
            </div>
          </div>

          <div class="form-group full-width">
            <label for="descricao" class="form-label">Descrição do Produto</label>
            <textarea id="descricao" name="descricao" class="form-textarea" placeholder="Descreva o produto, suas características, benefícios..."><?= $produto["descricao"] ?? '' ?></textarea>
          </div>

          <div class="form-group full-width">
            <label class="form-label">Imagem do Produto</label>
            <?php if ($produto) { ?>
            <small>Selecione a imagem novamente, ou o produto ficara sem.</small>
            <?php } ?>
            <div class="image-upload-area">
              <input type="file" id="foto" name="foto" accept="image/*" class="file-input" required>
            </div>
          </div>
        </div>

        <div class="btn-group">
          <?php if ($produto) { ?>
            <a type="submit" class="btn btn-secondary" href="ver_produtos.php" style="text-decoration: none;">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Produto</button>
          <?php } else {?>
          <button type="submit" class="btn btn-primary">Adicionar Produto</button>
          <?php } ?>
        </div>
      </form>
    </div>  
  </main>
</body>
</html>
