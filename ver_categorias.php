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
  <link rel="stylesheet" href="css/ver_produtos.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>Ver Categorias | AlimentaAngola</title>
</head>
<body>
  <?php include("navbar.php"); ?>

  <main class="main-container">
    <div class="page-header">
      <h1 class="page-title">Categorias Cadastrados</h1>
      <p class="page-subtitle">Veja todos as categorias adicionadas na plataforma</p>
    </div>

    <?= mostrarMensagens() ?>
    
    <table class="produtos-tabela">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categorias as $categoria): ?>
        <tr>
          <td><?= $categoria["id_categoria"] ?></td>
          <td><?= htmlspecialchars($categoria["nome"]) ?></td>
          <td class="td-action">
            <a href="eliminar_categoria.php?id_categoria=<?= $categoria["id_categoria"] ?>" class="btn-acao deletar">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
              </svg>
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</body>
</html>

