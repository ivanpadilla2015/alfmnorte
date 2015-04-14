<?php
require_once("model/controlobligacionModel.php");
$dt=new Obligacion;
$io=$dt->obligacionporid($_GET["imp"]);
$ivo=$dt->verdetaobli($_GET["imp"]);
$rad=$dt->adicionesporid($_GET["imp"]);
require_once("view/reporte_control_obliga.phtml");
?>