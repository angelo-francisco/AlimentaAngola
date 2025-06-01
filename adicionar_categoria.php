<?php

//SERVE PARA IMPORTAR O CONTEUDO DO ARQUIVO "DB.PHP", ONDE ESTÁ A CONEXÃO BANCO DE DADOS E AS FUÇÕES.
  require_once "db.php";

  //VERIFICA SE A PESSOA ESTÁ LOGADA NO SITEMA.
  apenasPessoasLogadas();

  //VERFICA SE A PESSSOA LOGADA É UM ADMINISTRADOR.
  apenasAdmins();
  
  //ESTA FUNÇÃO PEGA TODAS AS CATEGORIAS SALVAS NO BANCO DE DADOS E AS COLOCA NA VARIÁVEL "$CATEGORIA".
  $categorias = pegarCategorias($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--ESTÁ A IMPORTAR ARQIVOS DE ESTILO CSS PARA ESTILIZAR A PÁGINA-->
  <link rel="stylesheet" href="css/base.css">  
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/adicionar_produto.css">
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>Novo Produto | AlimentaAngola</title>
</head>
<body>
  <?php include("navbar.php"); ?>

  <main class="main-container">
    <div class="page-header">
      <h1 class="page-title">Cadastrar categoria</h1>
      <p class="page-subtitle">Adicione uma nova categoria ao catálogo do AlimentaAngola</p>
    </div>

    <!--EXIBE UMA MENSAGEM. ESSA É A FORMA CURTA DE "PHP ECHO"-->
    <?= mostrarMensagens() ?>
    
    <!--ELE IRÁ ENVIAR OS DADOS DE FORMA SEGURA PARA "PROCESSAR_CATEGORIA.PHP"-->
    <div class="form-container">
      <form id="product-form" action="processar_categorias.php" method="POST" enctype="multipart/form-data"></form>

      <!--CRIAR UM CAMPO PARA DIGITAR O NOME DA NOVA CATEGORIA, NÃO PERMITINDO CAMPO VAZIO POR CONTA DO "REQUIRED"-->
        <div class="form-grid">
          <div class="form-group">
            <label for="nome" class="form-label">Nome da categoria</label>
            <input type="text" id="nome" name="nome" class="form-input" required placeholder="Ex: Doces e sobremesas, congelados">
          </div>

          <!--BOTÃO PARA EVIAR O FORMULÁRIO E ADICONAR NOVA CATEGORIA-->
        <div class="btn-group">
          <button type="submit" class="btn btn-primary">Adicionar categoria</button>
        </div>
      </form>
    </div>  
  </main>
</body>
</html>
