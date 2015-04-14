<?php
require_once("model/ajustesModel.php");
$imp=new ajustes;
$aj=$imp->ajuste_pornum($_GET["idnuma"]);

//print_r($aj);exit;
require_once("view/reporte_ajustes.phtml");
?>