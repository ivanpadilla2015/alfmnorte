<?php 
require_once("model/controlobligacionModel.php");
$dt=new Obligacion;
$o=$dt->obligacionporid($_GET["id"]);
$vo=$dt->verdetaobli($_GET["id"]);
if(isset($_POST["agregar"] )and $_POST["agregar"]="si" )
{
	$dt->agrega_deta_obli();exit;
	
}
require_once("view/oblideta.phtml");
?>