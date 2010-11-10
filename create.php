<?php

include 'config/Includes.php';

$TarTable->setTable("tabela");

$TarTable->insert(array(
	"titulo" => $_POST['titulo'],
	"descricao" => $_POST['descricao'],
	"nivel" => $_POST['nivel'],
));

$TarTable->unsetBase();

header("Location: index.php");

?>