<?php
require_once("model/egresosModel.php");
$egre=new Egresos;
$ban=$egre->listabanco();
$neg=$egre->calnum_egre();
$pro=$egre->listprovs();
if (isset($_POST["grabar"]) and $_POST["grabar"]="si")
{  
   // print_r($_POST);exit;
	$egre->grabaregresinop();
	exit;
}
require_once("view/crearegresosinopago.phtml");
?>