<?php
require_once("model/contratosModel.php");
$coe=new Contratos;
$dato=$coe->ver_contrato();
$cevpro=$coe->listaprov();
$cetcon=$coe->tiposcon();
$cedep=$coe->depen();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
		$coe->editacontra();exit;	
}
require_once("view/editacontratos.phtml");
?>