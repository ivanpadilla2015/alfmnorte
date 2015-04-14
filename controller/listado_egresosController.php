<?php
require_once("public/Zebra_Pagination.php");
$paginacion = new Zebra_Pagination();
require_once("model/egresosModel.php");
$legrs=new Egresos;
$list=$legrs->listegres();
//******************************************paginacion
$total_egresos=count($list);
$paginacion->records(count($list));
$registros_por_pagina=5;
$paginacion->records_per_page($registros_por_pagina);
$list = array_slice(
    $list,
    (($paginacion->get_page() - 1) * $registros_por_pagina),
    $registros_por_pagina
);
require_once("view/listado_egresos.phtml");
?>