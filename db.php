<?php
  session_start();
  
  //inicia conexao com o banco de dados.
  require_once "mensagens.php";
  
  $USUARIO = "root";
  $SERVIDOR = "localhost";
  $PASSWORD = "";
  $DATABASE_NAME = "db_alimenta_angola";


  $conn = mysqli_connect($SERVIDOR, $USUARIO, $PASSWORD, $DATABASE_NAME);

  if (!$conn) {
    die("Falha ao conectar ao banco de dados, Erro: " . mysqli_connect_error());
  }

  function usuario_esta_logado() {
    if (isset($_SESSION["usuario_esta_logado"], $_SESSION["usuario"])) {
      return true;
    }
    return false;
  }

  function apenasPessoasLogadas() {
     if (!usuario_esta_logado()) {
      header("Location: login.php");
      exit;
    }
  }

  function usuario_e_admin() {
    if (usuario_esta_logado()) {
      if ($_SESSION["usuario"]["cargo"] == "admin") {
        return true;
      }
    }
    return false;
  }
  
  function soPessoasNaoAutenticadas() {
    if (usuario_esta_logado()) {
      header("Location: index.php");
      exit;
    }
  }

  function apenasAdmins() {
    if (!usuario_e_admin()) {
      adicionarMensagem("Você não tem permissão para acessar esta página", "error", "index.php");
    }
  }

  function pegarCategorias($conn  ) {
    $categorias = [];
    $resultado = mysqli_query($conn, "SELECT * FROM tb_categorias");
    
    while($linha = mysqli_fetch_assoc($resultado)) {
      $categorias[] = $linha;
    }

    return $categorias;
  }


  function pegarProdutos($conn) {
    $produtos = [];
    $resultado = mysqli_query($conn, "SELECT * FROM tb_produtos");
    
    while($linha = mysqli_fetch_assoc($resultado)) {
      $produtos[] = $linha;
    }

    return $produtos;
  }

  function pegarCategoriaPeloId($conn, $id_categoria) {
    $resultado = mysqli_query($conn, "SELECT * FROM tb_categorias WHERE id_categoria={$id_categoria}");
    $categoria = mysqli_fetch_assoc($resultado);

    return $categoria;
  }
?>
