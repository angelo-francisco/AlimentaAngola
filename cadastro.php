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
  
  <div class="login-container">
    <div class="logo-section">
      <div class="logo-placeholder">
        <img src="imgs/logo.png" alt="">
      </div>
    </div>

    <h2 class="form-title">Cadastrar Nova Conta</h2>
    <?= mostrarMensagens() ?>
    <form action="processar_cadastro.php" method="POST">
      <div class="form-group">
        <label for="usuario" class="form-label">Usuário</label>
        <input type="text" name="username" id="usuario" class="form-input" required>
      </div>

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-input" required>
      </div>
        
      <div class="form-group">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="password" id="senha" class="form-input" minlength="8" required>
      </div>
      
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
