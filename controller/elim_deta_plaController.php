<?php 
//print_r($_GET);exit;
require_once("../config/config.php");
require_once("../model/planillaModel.php");
$pds=new planillas;
$ep=$pds->eliminar_deta_plan();
$tot=$pds->totalplanilla();
$vp=$pds->verplanxid();
require_once("../view/crearplanillagrabadeta.phtml");
?>