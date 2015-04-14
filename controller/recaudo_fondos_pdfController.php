<?php
require_once("Model/recajasModel.php");
$repdf=new recajas;
$rep=$repdf->recajas_ingreso($_GET["fe1"]);

require_once("view/recaudo_fondos_pdf.phtml");
?>