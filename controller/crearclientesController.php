<?php 
require_once("model/clientesModel.php");
$cli=new clientes;


if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	   $dato=$cli->buscarcliente($_POST["iden"]);
	   //print_r($dato);exit;
	   if($dato == "OK")
	   {
	   		$cli->add_cliente();
	    	exit;
	   }else
	   {
	   	header("location:".Conectar::ruta()."?accion=crearclientes&m=3");exit;
	   }
}
require_once("view/crearclientes.phtml");
?>