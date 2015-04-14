<?php
require_once("model/ajustesModel.php");
$ajust=new ajustes;
$tipa=$ajust->bustipo_aj();
$lb=$ajust->listabancos();
$lfus=$ajust->busfuncio();
$naj=$ajust->calnum_ajuste();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	$ajust->add_ajustes();
}
require_once("view/crearajustes.phtml");
?>