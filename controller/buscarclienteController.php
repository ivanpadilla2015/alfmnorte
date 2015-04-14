<?php

require_once("../config/config.php");
require_once("../Model/clientesModel.php");
$bc=new clientes;
$busc=$bc->buscarcliente($_POST["iden"]);
echo $busc;
?>