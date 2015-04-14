<?php
require_once("../config/config.php");
require_once("../model/ordenpagoModel.php");
$gd=new opagos;

if(isset($_POST["tota"]) and $_POST["tota"]>0)
{
 $gd->grabaopagodeta();
 }
$deta=$gd->verdeta();
$netpa=$gd->netopagar();
require_once("../view/opagosdetagra.phtml");
?>