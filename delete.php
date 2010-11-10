<?php
	
include 'config/Includes.php';

$TarTable->setTable("tabela");

$TarTable->delete((int) $_GET['id']);

$TarTable->unsetBase();

header("Location: index.php");
	
?>