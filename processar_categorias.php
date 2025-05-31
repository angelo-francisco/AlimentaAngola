<?php
require_once "db.php";

apenasPessoasLogadas();
apenasAdmins();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = trim($_POST["nome"]);

  if (!empty($nome)) {
    $sql = "INSERT INTO categorias (nome) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $nome);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  }

  header("Location: ver_categorias.php");
  exit;
} else {
  header("Location: adicionar_categoria.php");
  exit;
}
?>