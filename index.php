<?php

include 'config/Includes.php';

$select = $TarTable->select(array(
  "table" => "tabela",
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
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php
$TarTable->unsetBase();
?>
