<?php
require_once("model/egresosModel.php");
$pr=new Egresos;
$lp=$pr->listprovs();
$cj=$pr->calnumcj();
$re=$pr->busretenc();
require_once("view/cajamenoradd.phtml");
?>