<?php
  session_start();
  
  //inicia conexao com o banco de dados.
  require_once "mensagens.php";
  
  $USUARIO = "root";
  $SERVIDOR = "localhost";
  $PASSWORD = "";
  $DATABASE_NAME = "db_alimenta_angola";

  $conn = mysqli_connect($SERVIDOR, $USUARIO, $PASSWORD, $DATABASE_NAME);

  // SE A CONEXAO FALHAR, O SISTEMA EXIBE O ERRO E PARA TUDO.
  if (!$conn) {
    die("Falha ao conectar ao banco de dados, Erro: " . mysqli_connect_error());
  }

  //VERIFICA SE EXISTE USUARIO LOGADO NO SISTEMA.
  function usuario_esta_logado() {
    if (isset($_SESSION["usuario_esta_logado"], $_SESSION["usuario"])) {
      return true;
    }
    return false;
  }

  //SO QUEM E LOGADO PODE CONTINUAR, CASO O CONTRAIO IRA TE REDIRECIONAR PARA A PAGINA DE LOGIN.
  function apenasPessoasLogadas() {
     if (!usuario_esta_logado()) {
      header("Location: login.php");
      exit;
    }
  }

  //VERIFICA SE O USUARIO LOGADO TEM CARGO DE ADMIM.
  function usuario_e_admin() {
    if (usuario_esta_logado()) {
      if ($_SESSION["usuario"]["cargo"] == "admin") {
        return true;
      }
    }
    return false;
  }

  //SE A PESOA JA ESTIVER LOGADA, ELA NAO PODE ACESSAR AS PAGINAS COMO LOGIN OU CADASTRO, E É MANDADA PARA A PAGINA PRINCIPAL.
  function soPessoasNaoAutenticadas() {
    if (usuario_esta_logado()) {
      header("Location: index.php");
      exit;
    }
  }

  //SE NAO FOR ADMIN, O SITEMA MOSTRA UMA MENSAGEM DE ERRO E REDIRECIONA O USUARIO PARA HOME.
  function apenasAdmins() {
    if (!usuario_e_admin()) {
      adicionarMensagem("Você não tem permissão para acessar esta página", "error", "index.php");
    }
  }

  //BUSCA TODAS AS CATEGORIAS DO BANCO DE DADOS E RETORNA EM FORMATO DE LISTA (ARRAY).
  function pegarCategorias($conn  ) {
    $categorias = [];
    $resultado = mysqli_query($conn, "SELECT * FROM tb_categorias");
    
    while($linha = mysqli_fetch_assoc($resultado)) {
      $categorias[] = $linha;
    }

    return $categorias;
  }

//FAZ A MESMA COISA SO QUE PARA OS PRODUTOS. 
  function pegarProdutos($conn) {
    $produtos = [];
    $resultado = mysqli_query($conn, "SELECT * FROM tb_produtos");
    
    while($linha = mysqli_fetch_assoc($resultado)) {
      $produtos[] = $linha;
    }

    return $produtos;
  }

  //PEGA UMA UNICA CATEGORIA COM BASE NO ID_CATEGORIA.
  function pegarCategoriaPeloId($conn, $id_categoria) {
    $id_categoria = mysqli_real_escape_string($conn, $id_categoria);
    $resultado = mysqli_query($conn, "SELECT * FROM tb_categorias WHERE id_categoria='$id_categoria'");
    $categoria = mysqli_fetch_assoc($resultado);

    return $categoria;
  }

  //FAZ A MESMA COISA.
  function pegarProdutoPeloId($conn, $id_produto) {
    $id_produto = mysqli_real_escape_string($conn, $id_produto);
    $resultado = mysqli_query($conn, "SELECT * FROM tb_produtos WHERE id_produto='$id_produto'");
    $produto = mysqli_fetch_assoc($resultado);

    return $produto;
  }

// APAGA UM PRODUTO DO BANCO DE DADOS COM BASE NO ID_PRODUTOS. RETORNA TRU SE CONSEGUIU APAGAR E FALSE SE DEU ERRO. 
  function eliminarProduto($conn, $id_produto) {
    $id_produto = mysqli_real_escape_string($conn, $id_produto);
    $resultado = mysqli_query($conn, "DELETE FROM tb_produtos WHERE id_produto='$id_produto'");

    return $resultado ? true : false;
  }
?>
