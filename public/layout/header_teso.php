<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Agencia Logistica Reg Norte</title>
    <link href="<?php echo Conectar::ruta();?>public/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Conectar::ruta();?>public/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo Conectar::ruta();?>public/css/demos.css" />
    <style>
      body {
	 
      padding-top: 30px; /* 60px to make the container go all the way to the bottom of the topbar */
	    
      }
	</style>
	
    <link href="<?php echo Conectar::ruta();?>public/css/bootstrap-responsive.css" rel="stylesheet">
  </head>
<body  onload="mueveReloj('contenedor_reloj')">
    <div class="container" >
    	<h3>Usuario Tesoreria</h3>

		    <ul class="nav nav-tabs">
		    	<li><a href="<?php echo Conectar::ruta();?>?accion=home">Home</a></li>
				<li><a href="<?php echo Conectar::ruta();?>?accion=crearajustes"">Ajustes</a></li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Egresos
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=paraegreso">Con Ordenes de Pago</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=crearegresosinopago">Sin Ordenes de Pago</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=cajamenoradd">Caja Menor</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
			   </li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Ingresos
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=paraingreso">Comprobante Ingreso</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=crearecajas">Recajas</a></li>
					</ul>
			   </li>
			   <li><a href="#">Traspasos</a></li>
			   <li><a href="<?php echo Conectar::ruta();?>?accion=boletines">Boletines</a></li>
			   <li><a href="<?php echo Conectar::ruta();?>?accion=crearclientes">Clientes</a></li>
			   
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Planillas
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
				  		<li><a href="<?php echo Conectar::ruta();?>?accion=crearplanilla">Crear Planillas</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=listado_planilla">Editar Planillas</a></li>
					</ul>
			   </li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Reportes
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_recajas_imp">Recajas</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_planilla_imp">Planillas</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_ajustes_imp">Comprobante Ajuste</a></li>
						<!-- <li><a href="<?php echo Conectar::ruta();?>?accion=reporte_ingreso_imp">Comprobante Ingreso</a></li>-->
			
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_ingreso_ofi">Comprobante Ingreso</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=listado_egresos">Listado Egresos</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=boletines_creados">Boletines Creados</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=exportar_egresos_excel">Exportar Egresos</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=libro_banco">Libro de Banco</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_ingresos">Lista de Ingresos</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=bancoretenciones">Libro Aux Banco y Retenciones</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=libro_recajas">Libro Diario de Caja</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=recaudo_fondos">Informe Recaudo de Fondos</a></li>
					</ul>
			   </li>
			   <!-- <li><a href="<?php echo Conectar::ruta();?>?accion=legalizaplanilla">Legalizar Planillas</a></li>-->
		      <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Ordenes de Pagos
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=ordenpagocrear">Crear Opagos Con Obligacion</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=opagosindependientes">Crear Opagos Independientes</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=editar_opago">Editar Opagos</a></li>
						
					</ul>
			   </li>
			   <li><a href="<?php echo Conectar::ruta();?>?accion=add_proveedor">Proveedor</a></li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Mantenimiento
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=eliminar_opago">Borrar Opagos</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=eliminar_egreso">Borrar Egresos</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=eliminar_ingreso">Borrar Ingresos</a></li>
						
					</ul>
			   </li>
		    </ul>
			 <!--<div id="contenedor_reloj"></div> -->
			
		    	<div class="alert alert-info">
					<a class="close" data-dismiss="alert">×</a>
					<div id="contenedor_reloj"></div> 
					 <div id="contenedor_fecha"></div> 
					 <strong>Bienvenido(a)</strong> <i class="icon-user"></i>@_<?php echo $_SESSION["ses_nombre"];?>
           	           &nbsp&nbsp&nbsp<a href="<?php echo Conectar::ruta();?>?accion=salir"><span class="label">Cerrar Sesion</span></a>
				</div>
				
				
</div>