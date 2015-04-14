<?php
require_once("Model/recalculosModel.php");
$lpdf=new Recalculos;
if(isset($_GET["fe1"]) and isset($_GET["fe2"]) and isset($_GET["id"]))
{
	if(!empty($_GET["fe1"]) and !empty($_GET["fe2"]) and !empty($_GET["id"]))
	{
		$ypdf=$lpdf->librosbancos($_GET["fe1"], $_GET["fe2"], $_GET["id"]);
		$sal=$lpdf->busc_banco_id($_GET["id"]);
		//print_r($ypdf);
		$salpdf= $sal["saldo_mes_ante"];
		
		require_once("view/libro_banco_pdf.phtml");
	}else
		{
			header("location:".Conectar::ruta()."?accion=libro_banco");exit;
		}

}
else {
	header("location:".Conectar::ruta()."?accion=libro_banco");exit;
}
?>