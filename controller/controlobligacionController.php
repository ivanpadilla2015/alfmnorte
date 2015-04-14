<?php 
require_once("public/Zebra_Pagination.php");
$paginacion = new Zebra_Pagination();
//********************************************************para reporte de obligacion
require_once("model/controlobligacionModel.php");
$ob=new Obligacion;
$deto=$ob->verobligacion();
//********************************************************para paginacion
$total_egresos=count($deto);
$paginacion->records(count($deto));
$registros_por_pagina=5;
$paginacion->records_per_page($registros_por_pagina);
$deto = array_slice(
    $deto,
    (($paginacion->get_page() - 1) * $registros_por_pagina),
    $registros_por_pagina
);
require_once("view/controlobligacion.phtml");
?>