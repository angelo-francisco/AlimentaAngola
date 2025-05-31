<?php
  require_once "db.php";

  soPessoasNaoAutenticadas();
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"], $_POST["password"])) {
      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);

      if (empty($username) || empty($password)) {
        adicionarMensagem("Preencha todos os campos, por favor.", "error", "login.php");
      } else {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $resultado = mysqli_query($conn, "SELECT * FROM tb_usuarios WHERE username='$username'");
        $usuario = mysqli_fetch_array($resultado);
        
        if(mysqli_num_rows($resultado) < 1) {
          adicionarMensagem("Este usuário não está registrado", "error", "login.php");
        }

        if (password_verify($usuario["password"], $password)) {
          adicionarMensagem("Username/Password incorrectos", "error", "login.php");
        }

        $_SESSION["usuario"] = $usuario;
        $_SESSION["usuario_esta_logado"] = true;
        
        adicionarMensagem("Você está autenticado", "success", "index.php");
      }
    } else {
        adicionarMensagem("Os dados não foram recebidos, tente mais tarde.", "error", "login.php");
    }
  }

?>
