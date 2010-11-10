<?php

include 'config/Includes.php';

$select = $TarTable->select(array(
  "table" => "tabela",
	//"where" => "titulo LIKE '%5%'",
  "order" => array(
    "nome",
  ),
));

?>

<h1>Listando</h1>

<table border="1">
	<thead>
		<tr>
			<th>id</th>
			<th>titulo</th>
			<th>descricao</th>
			<th>nivel</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($select as $value)
{
?>
		<tr>
			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['titulo']; ?></td>
			<td><?php echo $value['descricao']; ?></td>
			<td><?php echo $TarTable->join(array("id" => $value['nivel']), "nivel"); ?></td>
			<td>
				<a href="edit.php?id=<?php echo $value['id']; ?>">Editar</a>
				<a href="delete.php?id=<?php echo $value['id']; ?>">Deletar</a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php
$TarTable->unsetBase();
?>

<a href="new.php">Novo</a>