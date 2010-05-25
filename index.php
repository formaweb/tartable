<?php

include 'config/Includes.php';

$TarTable->setTable("products");

$TarTable->insert(array("name" => "Test"));

$TarTable->update(array("id" => 1), array("name" => "TestUPDATE"));

$TarTable->delete(array("id" => 1));

$TarTable->unsetBase();

?>