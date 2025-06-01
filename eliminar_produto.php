<?php

  require_once "db.php";

  if (isset($_GET["id_produto"]) && !empty($_GET["id_produto"])) {
    $id_produto = $_GET["id_produto"];
    $resultado = eliminarProduto($conn, $id_produto);
    
    if (!$resultado) {
      adicionarMensagem("Erro ao eliminar produto, tente mais tarde", "error", "ver_produtos.php");
    }
    
    adicionarMensagem("Produto eliminado com sucesso", "success", "ver_produtos.php");
  } else { 
    adicionarMensagem("Nenhum produto foi selecionado", "error", "ver_produtos.php");
  }
?>
