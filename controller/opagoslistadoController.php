<?php
require_once("public/Zebra_Pagination.php");
$paginacion = new Zebra_Pagination();
//***************************************************************para reporte de orden opago
require_once("model/ordenpagoModel.php");
$opdl=new opagos;
$opl=$opdl->allopagos();
//*****************************Paginacion*****************************
$paginacion->records(count($opl));
$registros_por_pagina=10;
$paginacion->records_per_page($registros_por_pagina);
$opl = array_slice(
    $opl,
    (($paginacion->get_page() - 1) * $registros_por_pagina),
    $registros_por_pagina
);
require_once("view/opagoslistado.phtml");
?>
