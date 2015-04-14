<?php
require_once("model/ordenpagoModel.php");
$dop=new opagos;
$opn=$dop->opagos_pornum($_GET["idnum"]);
$detop=$dop->verdeta_porid($opn["id_opago"]);
require_once("view/reporte_orden_pago.phtml");
?>
