<?php

include 'config/Includes.php';

$TarTable->setTable("tabela");
/*$TarTable->insert(array(
  "titulo" => "Caio",
  "descricao" => "Um menino legal!",
));*/

$TarTable->delete(4, "tabela");

$TarTable->unsetBase();

?>