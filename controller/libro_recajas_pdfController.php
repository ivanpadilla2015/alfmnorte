<?php
require_once("Model/recajasModel.php");
$rpdf=new recajas;
if(isset($_GET["fe1"]) and isset($_GET["fe2"]))
{
	if(!empty($_GET["fe1"]) and !empty($_GET["fe2"]))
	{
		
		$lrpdf=$rpdf->recajas_porfecha($_GET["fe1"], $_GET["fe2"]);
		
		require_once("view/libro_recajas_pdf.phtml");
	}else
		{
			header("location:".Conectar::ruta()."?accion=libro_recajas");exit;
		}

}
else {
	header("location:".Conectar::ruta()."?accion=libro_recajas");exit;
}
?>