<?php
require_once("../config/config.php");
require_once("../Model/recalculosModel.php");
$lbn=new Recalculos;
$ben=$lbn->busc_banco_id($_POST["id"]);
echo number_format($ben["saldo_mes_ante"],2);
?>
