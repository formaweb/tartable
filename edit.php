<?php

include 'config/Includes.php';

$TarTable->setTable("tabela");

$select = $TarTable->select(array(
	"where" => array("id" => (int) $_GET['id']),
));

?>

<h1>Editar</h1>

<?php foreach($select as $value): ?>
<form action="update.php?id=<?php echo $value['id']; ?>" method="post">
	<fieldset>
		<legend>Novo</legend>
		
		<label for="titulo">titulo</label>
		<input type="text" id="titulo" name="titulo" value="<?php echo $value['titulo']; ?>" />
		<br />
		
		<label for="descricao">descricao</label>
		<textarea id="descricao" name="descricao"><?php echo $value['descricao']; ?></textarea>
		<br />
		
		<label for="nivel">nivel</label>
		<select id="nivel" name="nivel">
			<?php
				$niveis = $TarTable->select(array("table" => "nivel"));
				foreach($niveis as $nivel):
			?>
			<option value="<?php echo $nivel['id']; ?>"<?php if($value['nivel'] == $nivel['id']): echo ' selected="selected"'; endif; ?>><?php echo $nivel['nome']; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		
		<button type="submit">Salvar</button>
		
	</fieldset>
</form>
<?php endforeach; ?>
<?php
$TarTable->unsetBase();
?>