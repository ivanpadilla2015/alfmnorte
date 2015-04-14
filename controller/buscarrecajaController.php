<?php

require_once("../config/config.php");
require_once("../Model/recajasModel.php");
$rc=new recajas;
$buscr=$rc->buscarrecajas($_POST["num"]);
echo $buscr;
?>