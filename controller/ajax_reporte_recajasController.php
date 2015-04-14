<?php
require_once("../config/config.php");
require_once("../Model/recajasModel.php");
$recf=new recajas;
$rf=$recf->recajas_porfecha($_POST["feini"],$_POST["fefin"]);

//print_r($rf);exit;
//r.id_recajas, r., r., r.id_banco, r.ciudad, r., r.id_cliente, b., c.nombrecli, c.identifica

?>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		
		<td>Fecha</td>
		<td>Beneficiario</td>
		<td>N° Recaja</td>
		<td>Valor</td>
		<td>Banco</td>
		<td>V. Consignacion</td>
		
	</tr>
	 
	 <?php
	   $t=0;
	   foreach($rf as $l)
	   {
	 ?>	
	 <tr>
		<td><?php echo $l["fecha"];?></td>
		<td><?php echo $l["nombrecli"];?></td>
		<td><?php echo $l["numrecaja"];?></td>
		<td><?php echo number_format($l["valorec"],2);?></td>
		<td><?php echo $l["nombreban"]." ".$l["cuenta"];?></td>
		<td><?php echo number_format($l["valorec"],2);?></td>
	  </tr>
	  <?php
	    $t +=$l["valorec"];
	   }
	 ?>	
	 <tr>
	 	<td></td>
	 	<td><pre>Totales </pre></td>
	 	<td></td>
	 	<td><pre><?php echo number_format($t,2); ?></pre></td>
	 	<td></td>
	 	<td><pre><?php echo number_format($t,2); ?></pre></td>
	 </tr>
</table>
    <pre class="prettyprint
    linenums">
    0k...
    </pre>