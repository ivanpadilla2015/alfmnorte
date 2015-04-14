<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Agencia Logistica Reg Norte</title>
    <link href="<?php echo Conectar::ruta();?>public/css/bootstrap.css" rel="stylesheet">
    
    <style>
      body {
	 
      padding-top: 30px; /* 60px to make the container go all the way to the bottom of the topbar */
	    
      }
	</style>
    <link href="<?php echo Conectar::ruta();?>public/css/bootstrap-responsive.css" rel="stylesheet">
  </head>

 <body  onload="mueveReloj()">
 	
    <div class="container" >
    	<h3>Usuario Administrador</h3>
		    <ul class="nav nav-tabs">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Contratos
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="#">De Ingreso</a></li>
						<li><a href="#">De Egreso</a></li>
						<li class="divider"></li>
						<li><a href="#">Otros link</a></li>
					</ul>
			   </li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Presupuesto
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="#">Con Ordenes de Pago</a></li>
						<li><a href="#">Sin Ordenes de Pago</a></li>
						<li><a href="#">Caja Menor</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
			   </li>
			   <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Tesoreria
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="#">Comprobante Ingreso</a></li>
						<li><a href="#">Recajas</a></li>
					</ul>
			   </li>
			   <li><a href="#">Otros</a></li>
			   
			  
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