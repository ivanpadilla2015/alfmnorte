<?php 
require_once("../config/config.php");
require_once("../Model/ordenpagoModel.php");
$gp=new opagos;
$bid=$gp->busreten_id($_POST["idf"]);
echo $bid["porc_rete"];
?>