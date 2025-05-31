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

  <title>Ver Categorias | AlimentaAngola</title>
</head>
<b>
  <h1>Lista de Categorias</h1> 

  <?php if (count($categorias) > 0): ?>
    <ul>
      <?php foreach($categorias as $categoria): ?>
        <li>
          ID: <?= htmlspecialchars($categoria['id_categoria']) ?> -
          Nome: <?= htmlspecialchars($categoria['nome']) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Não há categorias cadastradas.</p>
  <?php endif; ?>
</body>
</html>