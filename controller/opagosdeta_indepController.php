<?php
require_once("model/ordenpagoModel.php");
$opd=new opagos;
$op=$opd->opagos_id_indp($_GET["idop"]);
$re=$opd->busreten();
require_once("view/opagosdeta_indep.phtml");
?>