<?php
    require_once "db.php";

    soPessoasNaoAutenticadas();
  ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/base.css">  
  <link rel="stylesheet" href="css/login.css"> 
  <link rel="icon" type="image/x-icon" href="imgs/logo.png">
  <title>Cadastro | AlimentaAngola</title>
</head>
<body>
  <div class="floating-elements"></div>
  
  <!--TUDO DENTRO DESSSA DIV FORMA O BLOCO CENRAL DE CADASTRO, ESTILIZANDO COM CSS-->
  <div class="login-container">

  <!--EXIBE O LOGOTIPO DO SISTEMA-->
    <div class="logo-section">
      <div class="logo-placeholder">
        <img src="imgs/logo.png" alt="">
      </div>
    </div>

    <!--EXIBE MESNAGENS DE ERRO OU SUCESSO-->
    <h2 class="form-title">Cadastrar Nova Conta</h2>
    <?= mostrarMensagens() ?>

    <!--ESSE FORM ENVIA OS DADOS DE FORMA SEGURA PARA O ARQUIVO "PRPCESSAR_CADASTRO.PHP", QUE IRA TRATAR O CADASTRO-->
    <form action="processar_cadastro.php" method="POST">

    <!--CAMPO PARA O USUARIO DIGITAR O SEU NOME, OBRIGANDO A PESSOA A PREENCHER GRAÇAS AO REQUIRED-->
      <div class="form-group">
        <label for="usuario" class="form-label">Usuário</label>
        <input type="text" name="username" id="usuario" class="form-input" required>
      </div>

      <!--MESMA LÓGICA-->
      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-input" required>
      </div>
        
      <!--MESMA LÓGICA-->
      <div class="form-group">
        <label for="senha" class="form-label">Senha</label>

        <!--MINLENGHT EXIGE NO MINIMO 8 ACARACTERES PARA A SENHA-->
        <input type="password" name="password" id="senha" class="form-input" minlength="8" required>
      </div>
      
      <!--BOTÃO DE ENVIAR-->
      <div class="btn-group">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>
    
    <div class="links">
      <a href="index.php" class="back-link">Voltar para a Home</a>
      <a href="login.php" class="back-link">Já tem conta? LogIn</a>
    </div>
</body>
</html>
