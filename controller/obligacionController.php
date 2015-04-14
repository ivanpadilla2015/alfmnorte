<?php 
require_once("model/obligacionModel.php");
$ob=new obligacion;
$dat=$ob->numcontrato();
$fu=$ob->funcionario();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	   $ob->add_obligacion(); exit;
}
require_once("view/obligacion.phtml");
?>