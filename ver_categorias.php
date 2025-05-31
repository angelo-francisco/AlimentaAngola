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
  <link rel="stylesheet" href="css/a.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">

  <title>Ver Categorias | AlimentaAngola</title>
</head>
<b>
  <h1>Lista de Categorias</h1> 

  <?php foreach($categorias as $categoria): ?>
  <li>
    ID: <?= htmlspecialchars($categoria['id_categoria']) ?> -
    Nome: <?= htmlspecialchars($categoria['nome']) ?>
    |
    <a href="eliminar_categoria.php?id=<?= $categoria['id_categoria'] ?>" onclick="return confirm('Tem certeza que deseja eliminar esta categoria?')">
      Eliminar
    </a>
  </li>
<?php endforeach; ?>
</body>
</html>