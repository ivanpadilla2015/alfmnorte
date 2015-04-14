<?php
require_once("../config/config.php");
require_once("../Model/contratosModel.php");
$vde=new Contratos;
$bda=$vde->opagosxid($_POST["dato"]);
//echo $bda["detalle"];exit;
echo $bda["detalle"];

?>