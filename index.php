<?php
    require_once "db.php";

    $produtos = pegarProdutos($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>AlimentaAngola</title>
</head>
<body>
  <?php include("navbar.php"); ?>
  
  <?php foreach ($produtos as $produto) { ?>
      <div class="produto loading">
          <img src="<?= htmlspecialchars($produto["foto"]) ?>" alt="<?= htmlspecialchars($produto["nome"]) ?>" class="produto-image">
          <div class="produto-content">
              <h3><?= htmlspecialchars($produto["nome"]) ?></h3>
              <p><?= htmlspecialchars($produto["descricao"]) ?></p>
              <p class="preco">AOA <?= number_format($produto['preco'], 2, ',', '.') ?></p>
          </div>
          <div class="produto-actions">
              <a href="produto.php?id=<?= $produto["id_produto"] ?>">Ver mais</a>
              <form action="adicionar_carrinho.php" method="POST">
                  <input type="hidden" name="produto_id" value="<?= $produto["id_produto"] ?>">
                  <button type="submit" class="btn">Adicionar ao Carrinho</button>
              </form>
          </div>
      </div>
  <?php } if (empty  ($produtos)) {
    echo <<<HTML
    <div class="no-products">
        <div class="no-products-icon">X</div>
        <h3>Sem produtos disponíveis</h3>
        <p>Não há produtos cadastrados no momento. Volte em breve!</p>
    </div>
    HTML;
  } ?>

  <footer>
    © 2025 AlimentaAngola. Todos os direitos reservados.
  </footer>
</body>
</html>

