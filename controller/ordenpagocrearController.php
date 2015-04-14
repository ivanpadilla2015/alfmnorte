<?php
require_once("model/ordenpagoModel.php");
$ob=new opagos;
$dob=$ob->allobligacion();
require_once("view/ordenpagocrear.phtml") ;
?>