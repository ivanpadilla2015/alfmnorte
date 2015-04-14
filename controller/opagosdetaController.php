<?php
require_once("model/ordenpagoModel.php");
$opd=new opagos;
$op=$opd->opagos_id($_GET["idop"]);
$re=$opd->busreten();

require_once("view/opagosdeta.phtml");
?>