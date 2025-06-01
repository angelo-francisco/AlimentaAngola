<?php

//ISSO E UM LOOP FOREACH, ELE PERCORRE TODAS ASCATEGORIAS QUE ESTAO DENTRO DO ARRAY "$CATEGORIAS". CADA VOLTA DE LOOP, ELE COLOCA UMA UNICA CATEGORIA DENTRO DA VARIAVEL "$CAT"
foreach($categorias as $cat): ?>

<!--COMAS TR, CRIOU-SE UMA NOVA LINHA NA TABELA ONDE COMA A UJUDA DO TD, MOSTRA*SE OS DADOS DA CATEGORIA.-->
  <tr>
    <!--MOSTRA O ID DA CATEGORIA-->
    <td><?= $cat['id_categoria']
     ?></td>

     <!--MOSTRA O NOME DA CATEGORIA-->
    <td><?= $cat['nome'] ?></td>

    <td>

    <!--LINK PARA EDITAR A CATEGORIA MANDANDO O IDPELA URL-->
      <a href="editar_categoria.php?id=<?= $cat['id_categoria'] ?>">Editar</a>

      <!---LINK PARA EXCLUIR A CATEGORIA-->
      <a href="categorias.php?excluir=<?= $cat['id_categoria'] ?>">Excluir</a>
    </td>
  </tr>

  <!--FINALIZAR O FOREACH-->
<?php endforeach; ?>