<?php
require_once("model/egresosModel.php");
$egre=new Egresos;
$ban=$egre->listabanco();
$legre=$egre->opago_paraegre($_GET["nop"]);



$neg=$egre->calnum_egre();
if (isset($_POST["grabar"]) and $_POST["grabar"]="si")
{  
   // print_r($_POST);exit;
	$egre->grabaregre();
	exit;
}
require_once("view/crearegreso.phtml");
?>