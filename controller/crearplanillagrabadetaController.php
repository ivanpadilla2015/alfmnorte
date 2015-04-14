<?php
require_once("../config/config.php");
require_once("../model/planillaModel.php");
$pd=new planillas;

if(isset($_POST["va"]) and $_POST["va"]>0)
{
   $pd->addplanilladeta();
 }
$tot=$pd->totalplanilla();
$vp=$pd->verplanxid();
require_once("../view/crearplanillagrabadeta.phtml");
?>