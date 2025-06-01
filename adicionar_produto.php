<?php

//SERVE PARA IMPORTAR O CONTEUDO DO ARQUIVO "DB.PHP", ONDE ESTÁ A CONEXÃO BANCO DE DADOS E AS FUÇÕES.
  require_once "db.php";

  //VERIFICA SE A PESSOA ESTÁ LOGADA NO SITEMA.
  apenasPessoasLogadas();

  //VERFICA SE A PESSSOA LOGADA É UM ADMINISTRADOR.
  apenasAdmins();
  
  //ESTA FUNÇÃO PEGA TODAS AS CATEGORIAS SALVAS NO BANCO DE DADOS E AS COLOCA NA VARIÁVEL "$CATEGORIA".
  $categorias = pegarCategorias($conn);

  //CRIAR A VARIAVEL "$PRODUTO" VAZIA, POIS ELA SÓ SERÁ USADA SE FOR UMA EDIÇÃO.
  $produto = null;
  
  //VERIFICA SE TEM UM ENDEREÇO ID DE PRODUTO PASSADO NA URL E SE É UM VALOR NÚMERICO.
  if (isset($_GET["id_produto"]) && is_numeric($_GET["id_produto"])) {

    //O ID QUE FOI VERFICADO SERÁ SALVO EM UMA VARIÁVEL.
    $id_produto = $_GET["id_produto"];
    
    //BUSCA OS DADOS DO PRODUTOR NO BANCO DE DADOS E SALVA NA VARIÁVEL $PRODUTO".
    $produto = pegarProdutoPeloId($conn, $id_produto);

    //BUSCAA CATEGORIA DO PRODUTO.
    $categoria_do_produto = pegarCategoriaPeloId($conn, $produto["id_categoria"]);
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">

  <!--ESTÁ A IMPORTAR ARQIVOS DE ESTILO CSS PARA ESTILIZAR A PÁGINA-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <h1 class="page-title">Cadastrar Produto</h1>
      <p class="page-subtitle">Adicione um novo produto ao catálogo do AlimentaAngola</p>
    </div>

    <!--EXIBE UMA MENSAGEM. ESSA É A FORMA CURTA DE "PHP ECHO"-->
    <?= mostrarMensagens() ?>
    
    <div class="form-container">

    <!--OS DADOS SERÁO LEVADOS PARA "PROCESSAR_ADICIONAR_PRODUTO.PHP" E CASO SEJA UMA EDIÇÃO O ID DO PRODUTO VAI JUNTO COM A URL.-->
      <form id="product-form" action="processar_adicionar_produto.php<?= $produto ? "?id_produto=" . $produto["id_produto"] : "" ?>" method="POST" enctype="multipart/form-data">
        
      <!--CAMPO PAARA ESCREVER O NOME DO PRODUTO-->
      <div class="form-grid">
          <div class="form-group">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" name="nome" class="form-input" required placeholder="Ex: Maçã, Pão" value="<?= $produto["nome"] ?? '' ?>">
          </div>

          <!--CAMPO DE SELEÇÃO COM AS CATEGORIAS DISPONÍVEIS-->
          <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" name="categoria" class="form-select" required>
              <?php

              //Se não for uma edição, aparece a opção inicial pedindo para escolher a categoria.
              if (!$produto) {?>
              <option selected disabled>Selecione uma categoria</option>
              <?php } ?>
              
              <?php

              //SE FOR EDIÇÃO, A CATEGORIA DO PRODUTO APARECE SELECIONADA AUTOMALICAMENTE.
                foreach($categorias as $categoria) {
                  if ($categoria_do_produto["nome"] === $categoria["nome"]) {
                    echo "<option value='{$categoria["id_categoria"]}' selected>{$categoria["nome"]}</option>";  
                  } else {
                    echo "<option value='{$categoria["id_categoria"]}'>{$categoria["nome"]}</option>";  
                  }
                }
              ?>
            </select>
          </div>

      <!--CAMPO PARA O PREÇO DO PRODUTO-->
          <div class="form-group">
            <label for="preco" class="form-label">Preço</label>
            <div class="price-group">
              <input type="number" id="preco" name="preco" class="form-input" required placeholder="0.00" step="0.01" min="0" value="<?= $produto["preco"] ?? '' ?>">
            </div>
          </div>

          <!--PERMITE SELECIONAR IMAGEM PARA O PRODUTO, MESMO SE ESTIVER EDITANDO-->
          <div class="form-group full-width">
            <label for="descricao" class="form-label">Descrição do Produto</label>
            <textarea id="descricao" name="descricao" class="form-textarea" placeholder="Descreva o produto, suas características, benefícios..."><?= $produto["descricao"] ?? '' ?></textarea>
          </div>

          <div class="form-group full-width">
            <label class="form-label">Imagem do Produto</label>
            <?php if ($produto) { ?>
            <small>Selecione a imagem novamente, ou o produto ficara sem.</small>
            <?php } ?>
            <div class="image-upload-area">
              <input type="file" id="foto" name="foto" accept="image/*" class="file-input" required>
            </div>
          </div>
        </div>

        <!--SE FOR EIÇÃO, IRÁ MOSTRAR DOIS BOTÕES: ATUALIZAR E CANCELAR. SE FOR NOVO PRODUTO, MOSTRA APENAS O DE ADICIONAR-->
        <div class="btn-group">
          <?php if ($produto) { ?>
            <a type="submit" class="btn btn-secondary" href="ver_produtos.php" style="text-decoration: none;">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Produto</button>
          <?php } else {?>
          <button type="submit" class="btn btn-primary">Adicionar Produto</button>
          <?php } ?>
        </div>
      </form>
    </div>  
  </main>
</body>
</html>
