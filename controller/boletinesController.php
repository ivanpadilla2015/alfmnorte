<?php
require_once("model/boletinesModel.php");
$bole=new boletin;
$vcus=$bole->valorcus();
$cabol=$bole->calnum_bol();
if(isset($_POST["fe"]))
{
	if(isset($_POST["grabar"]))  //para grabar o no el boletin
	{
		$resp="si";
	}else
		{
			$resp="no";
		}	
	if(isset($_POST["cerrar"]))  //para cerrar el mes
	{
		$cerrar="si";
	}else
		{
			$cerrar="no";
		}	
	header("location:".Conectar::ruta()."?accion=reporte_boletin&fe=".$_POST["fe"]."&resp=".$resp
	    ."&numbol=".$_POST["numbol"]."&ingrecus=".$_POST["ingrecus"]."&egrecus=".$_POST["egrecus"]
		."&vcvie=".$_POST["vcvienen"]."&cerrar=".$cerrar);exit;
}
require_once("view/boletines.phtml");
?>


