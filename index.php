<?php

include 'config/Includes.php';

$TarTable->setTable("products");

$TarTable->delete(array("id" => 1));

$TarTable->unsetBase();

?>