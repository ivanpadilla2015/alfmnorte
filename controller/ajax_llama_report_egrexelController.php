<?php
require_once("../config/config.php");
require_once("../Model/egresosModel.php");
$veregre=new Egresos;
$ref=$veregre->egreso_opago_excel($_POST["feini"],$_POST["fefin"]);
require_once("../view/ajax_llama_report_egrexel.phtml");
?>
