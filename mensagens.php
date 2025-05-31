<?php

function adicionarMensagem($mensagem, $mensagem_tipo, $url) {
  $_SESSION["mensagem"] = $mensagem;
  $_SESSION["mensagem_tipo"] = $mensagem_tipo;

  header("Location: {$url}");
  exit;
}

function mostrarMensagens() {
  if (isset($_SESSION["mensagem"])) {
    $tipo = htmlspecialchars($_SESSION["mensagem_tipo"]);
    $mensagem = htmlspecialchars($_SESSION["mensagem"]);

    echo "<div class='alert {$tipo}'>{$mensagem}</div>";

    unset($_SESSION["mensagem"]);
    unset($_SESSION["mensagem_tipo"]);
  }
}


?>
