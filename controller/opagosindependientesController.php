<?php
require_once("model/ordenpagoModel.php");
$gp2=new opagos;
$busp=$gp2->allbusprov();
$busr=$gp2->busreten();

if (isset($_POST["grabar"]) && $_POST["grabar"]="si")
 {
 	$gp2->grabaopago_indepen();exit;
 }
require_once("view/opagosindependientes.phtml");
?>