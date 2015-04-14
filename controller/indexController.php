<?php 
if(isset($_SESSION["ses_id"]))
{
	header("location:".Conectar::ruta()."?accion=home");exit;
}
require_once("model/userModel.php");
$u=new Usuarios;
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{   
	$u->logueo();exit;
}
require_once("view/index.phtml");
?>