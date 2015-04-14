<?php
require_once("Model/recajasModel.php");
$rec=new recajas;
$nrec=$rec->calnum_rec();
$bans=$rec->listado_bancos();
$pu=$rec->listado_puc();
$acli=$rec->allclientes();
//print_r($pu);exit;
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	//print_r($_POST);
	$rec->grabarecaja();
	exit;
}
require_once("view/crearecajas.phtml");
?>
