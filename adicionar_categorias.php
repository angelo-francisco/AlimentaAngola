<?php
require_once "db.php";

//verificar se o usuario esta logado
apenasPessoasLogadas();

//garante que apenas adms tenham acesso a essa pagina
apenasAdmins();

$categorias = pegarCategorias($conn);

// Parte para Criar nova categoria
if (isset($_POST['nova_categoria'])) {
  $nome = $_POST['nome_categoria'];

  //inserir nova categoria no banco de dados, (após o if insset verificar se o usuario clicou no botão *criar*)
  mysqli_query($conn, "INSERT INTO categorias (nome) VALUES ('$nome')");
  header("Location: categorias.php");
}

// Parte para Excluir categoria
if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];

//apaga o bando de dados da categoria com o id que *$id = $_GET['excluir']* pegou.. de onde? da categoria que será excluida.
  mysqli_query($conn, "DELETE FROM categorias WHERE id_categoria = $id");

  //atualizar página para mostrar nova categoria sem ser necessario reenviar o formulário.
  header("Location: categorias.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Categorias | AlimentaAngola</title>
  <link rel="stylesheet" href="css/base.css">
</head>
<body>
  <?php include("navbar.php"); ?>

  <main class="main-container">
    <h1 class="page-title">Categorias</h1>

    <form method="POST">
      <input type="text" name="nome_categoria" placeholder="Nova categoria" required>
      <button type="submit" name="nova_categoria" class="btn btn-primary">Adicionar</button>
    </form>

    <table class="tabela">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
      </tr>

      <?php foreach($categorias as $cat): ?>

      <!--aqui temos os comenados que mostaram os botões de editar, excluir e mkostrar dados da categoria id e nome -->
        <tr>
          <td><?= $cat['id_categoria'] ?></td>
          <td><?= $cat['nome'] ?></td>
          <td>
            <a href="editar_categoria.php?id=<?= $cat['id_categoria'] ?>" class="btn">Editar</a>
            <a href="categorias.php?excluir=<?= $cat['id_categoria'] ?>" class="btn btn-danger" onclick="return confirm('Tens certeza?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </main>
</body>
</html>