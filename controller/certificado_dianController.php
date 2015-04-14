<?php
require_once("model/recalculosModel.php");
$lpro=new Recalculos;
$lprov=$lpro->ver_proveedres();
require_once("view/certificado_dian.phtml");
?>