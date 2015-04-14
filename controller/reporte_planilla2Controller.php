<?php
require_once("model/ingresoModel.php");
$impl=new Ingreso;
$tpl=$impl->impre_ingreso_pla($_GET["idnump"]);
$tpla=$impl->agrup_ingreso_pla($_GET["idnump"]);
$tplas=$impl->ingre_total_num($_GET["idnump"]);
//print_r($_GET);exit;
//print_r($tin);exit;
//$tin=tpl
//ting=tpla
//$tles=tplas
require_once("view/reporte_planilla2.phtml");
?>