<?php

include 'config/Includes.php';

$TarTable->setTable("tabela");

$TarTable->update((int) $_GET['id'], array(
	"titulo" => $_POST['titulo'],
	"descricao" => $_POST['descricao'],
	"nivel" => $_POST['nivel'],
));

$TarTable->unsetBase();

header("Location: index.php");

?>