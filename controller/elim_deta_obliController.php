<?php 
//print_r($_GET);exit;
require_once("model/controlobligacionModel.php");
$dt=new Obligacion;
$o=$dt->eliminar_deta_obli();
?>
