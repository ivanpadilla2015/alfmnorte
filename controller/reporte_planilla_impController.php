<?php
require_once("model/planillaModel.php");
$pla2=new planillas;
$vig=$pla2->all_vigencia();
/*print_r($vig);
exit;*/
if(isset($_POST["numpla"]) && $_POST["numpla"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_planilla&idnump=".$_POST["numpla"]."&vigen=".$_POST["vigen"]);exit;
}
require_once("view/reporte_planilla_imp.phtml");
?>