<?php
require_once("model/boletinesModel.php");
$impbcr=new boletin;
$nubol=$impbcr->boletin_id($_GET["idnumb"]);
$dbol=$impbcr->buscdeta_boletin($_GET["idnumb"]);
/*print_r($nubol);
echo "<br/>";
print_r($dbol);exit;*/
//obtener nombre de campos de a tabla en http://lists.mysql.com/mysql-es/2548
require_once("view/reporte_boletin_creados.phtml");

?>