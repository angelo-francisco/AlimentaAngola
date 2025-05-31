<?php foreach($categorias as $cat): ?>
  <tr>
    <td><?= $cat['id_categoria'] ?></td>
    <td><?= $cat['nome'] ?></td>
    <td>
      <a href="editar_categoria.php?id=<?= $cat['id_categoria'] ?>">Editar</a>
      <a href="categorias.php?excluir=<?= $cat['id_categoria'] ?>">Excluir</a>
    </td>
  </tr>
<?php endforeach; ?>