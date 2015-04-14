<?php
require_once("../config/config.php");
require_once("../Model/egresosModel.php");
$le=new Egresos;
$ele=$le->eliminar_egreso($_POST["id_egre"], $_POST["id_opa"]);
echo "listo";
?>
