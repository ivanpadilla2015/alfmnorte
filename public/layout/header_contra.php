<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Agencia Logistica Reg Norte</title>
   <link href="<?php echo Conectar::ruta();?>public/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Conectar::ruta();?>public/css/jquery-ui.css" />
   <link rel="stylesheet" href="<?php echo Conectar::ruta();?>public/css/demos.css" />
   <script>
   $(function() {
   		$( "#datepicker" ).datepicker();
        $( "#datepicker2" ).datepicker();
        	
	});
	</script>
    <style>
      body {
	 
      padding-top: 30px; /* 60px to make the container go all the way to the bottom of the topbar */
	    
      }
	</style>
    <link href="<?php echo Conectar::ruta();?>public/css/bootstrap-responsive.css" rel="stylesheet">
  </head>

 <body  onload="mueveReloj('contenedor_reloj')">
    <div class="container" >
    	<h3>Usuario Contratos</h3>
		    <ul class="nav nav-tabs">
		    	<li><a href="<?php echo Conectar::ruta();?>?accion=home">Home</a></li>
		    	<li><a href="<?php echo Conectar::ruta();?>?accion=contratos">Contratos</a></li>
			    <li class="dropdown">
			    	<a class="dropdown-toggle" data-toggle="dropdown" href="">
			    	Obligacion
			    	<b class="caret"></b>
			    	</a>
			    	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=controlobligacion">Sin Amortizar</a></li>
						<li><a href="#">Con Amortizar</a></li>
						<li class="divider"></li>
						<li><a href="#">Otros link</a></li>
					</ul>
			    	
			    </li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Reportes
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="#">Por Obligacion</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=listado_proveedores"">Proveedores</a></li>
						<li class="divider"></li>
						<li><a href="#">Otros link</a></li>
					</ul>
			    </li>
			    <li><a href="<?php echo Conectar::ruta();?>?accion=contratoadicion">Adición</a></li>
			    <li><a href="<?php echo Conectar::ruta();?>?accion=add_proveedor">Proveedor</a></li>
			    <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					 Mantenimento
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=recalcularcontra">Recalcular por Contrato</a></li>
						<li class="divider"></li>
						<li><a href="#">Otros link</a></li>
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
				<h4 style="color: red">Advertencia: Solo quedan 1 días de Lecencia Freeware, realice copias de la Base de Datos!!!</h4>
</div>