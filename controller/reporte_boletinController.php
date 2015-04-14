<?php
require_once("model/boletinesModel.php");
$bol=new boletin;
if(isset($_GET["fe"]))
{
	//print_r($_GET);exit;	
	$banb=$bol->bancos_boletines();	
	$un=$bol->totalizaregre($banb,$_GET["fe"]);
	if(isset($_GET["resp"]) and $_GET["resp"]=="si")
	{
		$bol->grabarsaldosban($un);
		
		if($_GET["cerrar"]=="si"){
			$bol->grabarsaldosban_men($un);
			
		}
		
	}
	
}
  
//obtener nombre de campos de a tabla en http://lists.mysql.com/mysql-es/2548
require_once("view/reporte_boletin.phtml");

?>