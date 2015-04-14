<?php
require_once("model/ingresoModel.php");
$imp1=new Ingreso;
$tin=$imp1->impre_ingreso_pla($_GET["idnumi"]);
$ting=$imp1->agrup_ingreso_pla($_GET["idnumi"]);
//print_r($ting);exit;
$tles=$imp1->ingre_total_num($_GET["idnumi"]);
//print_r($tin);exit;
require_once("view/reporte_ingreso2.phtml");
?>