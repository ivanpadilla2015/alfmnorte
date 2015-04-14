<?php
require_once("model/recajasModel.php");
$re=new recajas;
$rcn=$re->recajas_pornum($_GET["idnumr"]);
$det1=$re->recadeta_porid($rcn["id_recajas"]);
$det2=$re->recadeta2_porid($rcn["id_recajas"]);
require_once("view/reporte_recajas.phtml");
?>