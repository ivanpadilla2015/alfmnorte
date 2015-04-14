<?php
require_once("model/ordenpagoModel.php");
$gp=new opagos;
$busp=$gp->busprov();
$busr=$gp->busreten();
$bto=$gp->detobliga_id($_GET["ob"]);

if (isset($_POST["grabar"]) && $_POST["grabar"]="si")
 {
 	$gp->grabaopago();exit;
 }
require_once("view/opagosadd.phtml");
?>