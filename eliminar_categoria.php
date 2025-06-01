<?php
require_once "db.php";

apenasPessoasLogadas();
apenasAdmins();

if (isset($_GET['id_categoria']) && is_numeric($_GET['id_categoria'])) {
    $id_categoria = intval($_GET['id_categoria']);

    // Deleta a categoria do banco
    $stmt = $conn->prepare("DELETE FROM tb_categorias WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);
    
    if ($stmt->execute()) {
        adicionarMensagem("Categoria eliminada com sucesso", "success", "ver_categorias.php");
    } else {
        adicionarMensagem("Erro ao eliminar, tente mais tarde.", "error", "ver_categorias.php");
    }

    $stmt->close();
} else {
    adicionarMensagem("Categoria inválida", "error", "ver_categorias.php");
}
?>
