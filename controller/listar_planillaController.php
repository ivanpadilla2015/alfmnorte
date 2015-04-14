<?php
require_once("model/planillaModel.php");
$lpl=new planillas;
$lpli=$lpl->todaslasplanillas();
require_once("view/listar_planilla.phtml");
?>