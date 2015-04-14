<?php
require_once("public/Zebra_Pagination.php");
$paginacion = new Zebra_Pagination();
//*********************************************************
require_once("model/egresosModel.php");
$top=new Egresos;
$datop=$top->listado_opagos();
//*******************************************************
$paginacion->records(count($datop));
$registros_por_pagina=10;
$paginacion->records_per_page($registros_por_pagina);
$datop = array_slice(
    $datop,
    (($paginacion->get_page() - 1) * $registros_por_pagina),
    $registros_por_pagina
);
require_once("view/paraegreso.phtml");
?>