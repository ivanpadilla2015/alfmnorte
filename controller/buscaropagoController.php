<?php

require_once("../config/config.php");
require_once("../Model/ordenpagoModel.php");
$bo=new opagos;
$busco=$bo->buscaropago($_POST["iden"]);
echo $busco;
?>