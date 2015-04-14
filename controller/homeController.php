<?php 
require_once("public/Zebra_Pagination.php");
$paginacion = new Zebra_Pagination();
//***********************************************listado de contratos
require_once("model/userModel.php");
$ite= new Usuarios;
$datos=$ite->contratos_saldos();
//*****************************************para paginacion******************
$total_egresos=count($datos);
$paginacion->records(count($datos));
$registros_por_pagina=10;
$paginacion->records_per_page($registros_por_pagina);
$datos = array_slice(
    $datos,
    (($paginacion->get_page() - 1) * $registros_por_pagina),
    $registros_por_pagina
);
require_once("view/home.phtml");
?>