<?php

include 'config/Includes.php';

$TarTable->setTable("tabela");

?>

<h1>Novo</h1>

<form action="create.php" method="post">
	<fieldset>
		<legend>Novo</legend>
		
		<label for="titulo">titulo</label>
		<input type="text" id="titulo" name="titulo" />
		<br />
		
		<label for="descricao">descricao</label>
		<textarea id="descricao" name="descricao"></textarea>
		<br />
		
		<label for="nivel">nivel</label>
		<select id="nivel" name="nivel">
			<?php
				$niveis = $TarTable->select(array("table" => "nivel"));
				foreach($niveis as $nivel):
			?>
			<option value="<?php echo $nivel['id']; ?>"><?php echo $nivel['nome']; ?></option>
			<?php endforeach; ?>
		</select>
		<br />
		
		<button type="submit">Salvar</button>
		
	</fieldset>
</form>
<?php
$TarTable->unsetBase();
?>