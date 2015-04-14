<?php 
//print_r($_GET);exit;
require_once("../config/config.php");
require_once("../model/ordenpagoModel.php");
$dtd=new opagos;
$od=$dtd->eliminar_deta_opa();
$deta=$dtd->verdeta();
$netpa=$dtd->netopagar();
require_once("../view/opagosdetagra.phtml");
?>