<?php
require_once("model/planillaModel.php");
$pld=new planillas;
$pdq=$pld->detaplaxid($_GET["plaid"]);
$cus=$pld->allcuentas();
$fus=$pld->allfuncionario();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	//print_r($_POST);exit;	
	$pld->grabar_deta_pla();exit; 
}
require_once("view/legalizapla_deta.phtml");
?>