<?php
require_once("../config/config.php");
require_once("../Model/recalculosModel.php");
$rein=new Recalculos;
$reing=$rein->repoingresos($_POST["feini"], $_POST["fefin"]);

//print_r($reing);exit;
 

?>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<td>Ingreso</td>
		<td>Fecha</td>
		<td>Concepto</td>
		<td>Banco</td>
		<td>Valor</td>
		<td>Tipo</td>
		
	</tr>
	 
	 <?php
	   foreach($reing as $l)
	   {
	 ?>	
	 <tr>
		<td><?php echo $l["ingreso"];?></td>
		<td><?php echo $l["fecha"];?></td>
		<td><?php echo $l["concepto"];?></td>
		<td><?php echo $l["nombreban"]." ".$l["cuenta"];?></td>
		<td><?php echo $l["valor"];?></td>
		<td><?php echo $l["tipo"];?></td>
	  </tr>
	  <?php
	    
	   }
	 ?>	
	
</table>
