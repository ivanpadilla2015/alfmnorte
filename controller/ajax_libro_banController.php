<?php
require_once("../config/config.php");
require_once("../Model/recalculosModel.php");
$lib=new Recalculos;
$ylib=$lib->librosbancos($_POST["feini"], $_POST["fefin"], $_POST["id"]);
$sal=$lib->busc_banco_id($_POST["id"]);
//print_r($ylib);
 
$total= $sal["saldo_mes_ante"];
?>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<td>Fecha</td>
		<td>Opago</td>
		<td>Ce</td>
		<td>Concepto</td>
		<td>Debe</td>
		<td>Haber</td>
		<td>Total</td>
		<td>TDcto</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Viene</td>
		<td><?php echo $sal["saldo_mes_ante"];?></td>
		<td></td>
	</tr>
	 <?php
	   foreach($ylib as $l)
	   {
	 ?>	
	 <tr>
		<td><?php echo $l["fecha"];?></td>
		<td><?php echo $l["opago"];?></td>
		<td><?php echo $l["ce"];?></td>
		<td><?php 
		      if($l["DC"]==1 or $l["DC"]==2)
			  {
			  	echo $l["concepto"].",  ".Conectar::FechaTexto2($l["fecha"]);
			  }else
			  	{
			  		echo $l["concepto"];
			  	}
		      
		 ?></td>
		<td><?php
				if($l["DC"]==1)
				{
					 echo number_format($l["valor"],2);
				}else
					echo 0;?>
		</td>
		<td><?php
				if($l["DC"]==2 or $l["DC"]==0)
				{
					 echo number_format($l["valor"],2);
				}else
					echo 0;?>
		</td>   
		<td><?php
			if($l["DC"]==1)
			  {
			  	$total +=$l["valor"];
				echo number_format($total,2);
			  }else
			  	{
			  		$total -=$l["valor"];
					echo number_format($total,2);
			  	}
			?>
		</td>
		<td>
			<?php 
		    if($l["DC"]==1)
		    {
		    	echo "Ingreso";
		    }else
				{
					echo "Egreso";
				}       ;?>
		</td>
	  </tr>
	  <?php
	    
	   }
	 ?>	
	
</table>
