<?php
require_once("../config/config.php");
require_once("../Model/recajasModel.php");
$recin=new recajas;
$rei=$recin->recajas_ingreso($_POST["fec"]);

//print_r($rei);exit;
//r.id_recajas, r., r., r.id_banco, r.ciudad, r., r.id_cliente, b., c.nombrecli, c.identifica

?>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		
		<td>Item</td>
		<td>Recaja No.</td>
		<td>Valor RC</td>
		<td>Efectivo</td>
		<td>Bbva 302-964150</td>
		<td>Bbva 090-453895</td>
		<td>Bbva 302-96444-0</td>
		<td>Caja 805-0201110</td>
		<td>Bogota 387-048028</td>
		
	</tr>
	 
	 <?php
	   $it=1;
	   foreach($rei as $l)
	   {
	 ?>	
	 <tr>
		<td><?php echo $it ++ ;?></td>
		<td><?php echo $l["numrecaja"];?></td>
		<td><?php echo number_format($l["valorec"],2);?></td>
		<td><?php echo number_format($l["valorec"],2);?></td>
		<td><?php if($l["id_banco"]==1){echo number_format($l["valorec"],2);}else{echo "0.00";};?></td>
		<td><?php if($l["id_banco"]==2){echo number_format($l["valorec"],2);}else{echo "0.00";};?></td>
		<td><?php if($l["id_banco"]==3){echo number_format($l["valorec"],2);}else{echo "0.00";};?></td>         
		<td><?php if($l["id_banco"]==4){echo number_format($l["valorec"],2);}else{echo "0.00";};?></td>
		<td><?php if($l["id_banco"]==5){echo number_format($l["valorec"],2);}else{echo "0.00";};?></td>
		<?php
		}
		?>
	  </tr>	
	
</table>