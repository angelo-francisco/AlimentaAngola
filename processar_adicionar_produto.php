<?php

  require_once "db.php";
  
  apenasAdmins();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"], $_POST["categoria"], $_POST["preco"], $_POST["descricao"], $_FILES["foto"])) {
      $nome = trim($_POST["nome"]);
      $categoria = trim($_POST["categoria"]);
      $preco = trim($_POST["preco"]);
      $descricao = trim($_POST["descricao"]);
      $foto = $_FILES["foto"]; 

       if (empty($nome) || empty($categoria) || empty($preco) || empty($descricao) || $foto['error'] !== 0) {
        adicionarMensagem("Por favor, preencha todos os campos corretamente", "error", "adicionar_produto.php");
      }

      $nomeTemporario = $foto['tmp_name'];
      $nomeOriginal = basename($foto['name']);
      
      $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
      $nomeFinal = uniqid('img_', true) . '.' . $extensao;

      $diretorio = 'uploads/';
      $caminhoCompleto = $diretorio . $nomeFinal;

      if (move_uploaded_file($nomeTemporario, $caminhoCompleto)) {
        $nome = mysqli_real_escape_string($conn, $nome);
        $descricao = mysqli_real_escape_string($conn, $descricao);
        $preco = mysqli_real_escape_string($conn, $preco);
        $categoria = mysqli_real_escape_string($conn, $categoria);
        $foto = mysqli_real_escape_string($conn, $caminhoCompleto); 
        
        $resultado = mysqli_query($conn, "INSERT INTO tb_produtos(nome, descricao, preco, id_categoria, foto) VALUES ('$nome', '$descricao', '$preco', '$categoria', '$foto')");

        if ($resultado) {
          adicionarMensagem("Novo produto adicionado com sucesso", "success", "adicionar_produto.php");
        } else {
          adicionarMensagem("Falha ao adicionar produto, tente mais tarde.", "error", "adicionar_produto.php");
        }
      } else {
        adicionarMensagem("Falha ao carregar imagem, tente mais tarde.", "error", "adicionar_produto.php");
      }
    
    } else {
        adicionarMensagem("Os dados não foram recebidos, tente mais tarde.", "error", "adicionar_produto.php");
    }
  }

?>
