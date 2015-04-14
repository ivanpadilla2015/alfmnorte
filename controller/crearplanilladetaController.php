<?php
require_once("model/planillaModel.php");
$pla2=new planillas;
$ba=$pla2->listado_banco();
require_once("view/crearplanilladeta.phtml");
?>