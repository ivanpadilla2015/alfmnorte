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

 <body  onload="mueveReloj()">
    <div class="container" >
    	<h3>Usuario Cartera</h3>
		    <ul class="nav nav-tabs">
		       <li><a href="<?php echo Conectar::ruta();?>?accion=home">Home</a></li>
			   <li><a href="<?php echo Conectar::ruta();?>?accion=legalizaplanilla">Legalizar Plainlla</a></li>
			   
			   	<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Reportes
					<b class="caret"></b>
					</a>
				  	<ul class="dropdown-menu">
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_planilla_imp">Planilla</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=reporte_planilla_imp2">Planilla Oficio</a></li>
						<li><a href="<?php echo Conectar::ruta();?>?accion=listar_planilla">Listar Planilla</a></li>
						
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
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