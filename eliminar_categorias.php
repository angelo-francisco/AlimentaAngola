<?php
require_once "db.php";

apenasPessoasLogadas();
apenasAdmins();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categoria = intval($_GET['id']);

    // Deleta a categoria do banco
    $stmt = $conn->prepare("DELETE FROM categorias WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);
    
    if ($stmt->execute()) {
        header("Location: ver_categorias.php?sucesso=1");
    } else {
        echo "Erro ao excluir a categoria.";
    }

    $stmt->close();
} else {
    echo "ID de categoria inválido.";
}
?>