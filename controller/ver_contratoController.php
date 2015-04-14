<?php
/*print_r($_GET);
exit;*/
require_once ("model/contratosModel.php");
$c=new Contratos;
$dato=$c->ver_contrato();
require_once("view/ver_contrato.phtml");
?>