<?php
  require_once "db.php";

  soPessoasNaoAutenticadas();
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
      $username = trim($_POST["username"]);
      $email = trim($_POST["email"]);
      $password = trim($_POST["password"]);

      if (empty($username) || empty($email) || empty($password)) {
        adicionarMensagem("Preencha todos os campos, por favor.", "error", "cadastro.php");
      } else {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $resultado = mysqli_query($conn, "SELECT * FROM tb_usuarios WHERE username='$username'");
        
        if(mysqli_num_rows($resultado) > 0) {
          adicionarMensagem("Esse username está indisponível.", "error", "cadastro.php");
        }

        if (strlen($password) < 8){
          adicionarMensagem("Sua password deve conter pelo menos 8 caracteres.", "error", "cadastro.php");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          adicionarMensagem("Esse email é inválido", "error", "cadastro.php");
        }

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        //Criptografar a senha. Quando uma senha passar por essa string, ela vai ficar toda bagunçada. 
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO tb_usuarios(username, email, password, cargo) VALUES ('$username', '$email', '$password', 'user')";
        $resultado = mysqli_query($conn, $query);

        if ($resultado) {
          adicionarMensagem("A sua conta foi criada.", "success", "login.php");
        } else {
          adicionarMensagem("Erro ao criar conta, tent mais tarde.", "error", "cadastro.php");
        }
      }
    } else {
        adicionarMensagem("Os dados não foram recebidos, tente mais tarde.", "error", "cadastro.php");
    }
  }

?>
