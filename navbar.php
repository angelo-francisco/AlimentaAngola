<?php
    require_once "db.php";
?>

<header>
    <div class="main">
        <img src="imgs/logo.png" alt="AlimentaAngola Logo" class="logo-img">
        <nav>
            <a href="index.php">Home</a>
            <a href="sobre_nos.php">Sobre Nós</a>
            <a href="carrinho.php">Carrinho</a>

            <?php
                if (usuario_e_admin()) {
                    echo "<a href='adicionar_produto.php'>Novo Produto</a>";
                    echo "<a href='ver_produtos.php'>Ver Produtos</a>";
                    echo "<a href='adicionar_categoria.php'>Nova Categoria</a>";
                    echo "<a href='ver_categorias.php'>Ver Categorias</a>";
                }
            ?>
            
        </nav>
    </div>
    
    <div class="auth">
        <?php
            if (usuario_esta_logado()) {
                echo "<a href='sair.php' class='login-btn'>Sair</a>";
            } else {
                echo "<a href='login.php' class='login-btn'>LogIn</a>";
            }
        ?>
    </div>
</header>
