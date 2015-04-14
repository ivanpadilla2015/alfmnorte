<?php
require_once("../config/config.php");
require_once("../model/recalculosModel.php");
$dian=new Recalculos;
$dlib=$dian->dian_proveedor($_POST["feini"], $_POST["fefin"], $_POST["id"]);

//print_r($ylib);
 

?>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		
		<th>Fecha</th>
		<th>Opago</th>
		<th>Egreso</th>
		<th>proveedor</th>
		<th>Identificacion</th>
		<th>% Reten</th>
		<th>Base</th>
		<th>Retencion</th>
	</tr>
	
	 <?php
	   $t=0;
	   foreach($dlib as $l)
	   {
	   	//o.id_retencion, o.porcentaje, o., o., o.id_opago, r.Nombre_rete, op., p., p.nitproveedor, e.,
		//      e., e.id_banco, b.nombreban, b.cuenta
	 ?>	
	 <tr>
		<td><?php echo $l["fechaegre"];?></td>
		<td><?php echo $l["numorden"];?></td>
		<td><?php echo $l["numegreso"];?></td>
		<td><?php echo $l["nombre"];?></td>
		<td><?php echo $l["nitproveedor"];?></td>
		<td><?php echo $l["porcentaje"];?></td>
		<td><?php echo number_format($l["base"],2);?></td>
		<td><?php echo number_format($l["totalreten"],2);?></td>
	  <?php
	    $t +=$l["totalreten"];
	   }
	 ?>	
	</tr>
	<tr>
		<th colspan="7">Total</th>
		<th><?php echo number_format($t,2);?></th>
</table>
