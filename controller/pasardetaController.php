<?php
require_once("../config/config.php");
require_once("../model/contratosModel.php");
$conec=new Contratos;
$cdp=$conec->contrato_depen($_POST["idc"]);
$pri="De acuerdo con los estudios previos generado en la dependencia ".$cdp["nombre_depen"]; 
$seg=" de la Agencia Logística de las Fuerzas Militares Regional Norte, se celebró el contrato No. ".$cdp["num_contrato"];		 
$ter=", por tanto, autorizo el siguiente pago:" ;
echo $pri.$seg.$ter;
?>