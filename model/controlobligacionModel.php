<?php
class Obligacion extends Conectar
{
	private $arobli=array(); 
	private $idobli=array();
	private $vdobli=array();
	private $adici=array();
	private $oblicon=array();
	// ver todas los encabezados de la obligacion
	public function verobligacion()
	{
		$dbh=parent::con();
		$sql="SELECT o.id_obligacion, c.num_contrato,p.nombre,o.fechaobliga, o.detalle, o.id_opago, o.id_egreso
		            FROM obligacion o, contratos c, proveedores p
					WHERE  o.id_contrato=c.id_contrato
					AND c.id_proveedor = p.id_proveedor order by  o.id_obligacion DESC";
			
		foreach($dbh->query($sql) as $fila)
		{
				$this->arobli[]=$fila;
		}
		//print_r($this->item) ;
		$dbh = null;
		return $this->arobli;
	}
	
	// encabezado de la obligacion por id
	public function obligacionporid($id)
	{
			
		$dbh=parent::con();
		$sql="SELECT o.id_obligacion,c.num_contrato, c.valorcontrato, p.nombre,o.fechaobliga, c.fechacontrato, o.detalle, c.saldo, c.id_contrato, 
		           o.totalobliga, c.registro_pres_inic, c.valoranticipo, c.objetocontrato, c.valoradicion, c.fecha_anticipo, c.amortizar, c.plazoejecucion,
		           c.interadmi
		            FROM obligacion o, contratos c, proveedores p
					WHERE  o.id_obligacion=? 
					AND o.id_contrato=c.id_contrato
					AND c.id_proveedor = p.id_proveedor order by  o.id_obligacion";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute(array($id)))
		{
			
			if($fila=$stmt->fetch())
			{
			   $this->idobli[]=$fila;
			 
			}  
		}
		
		$dbh = null;
		return $this->idobli;
	}
	
	
	public function adicionesporid($id)
	{
		$dbh=parent::con();
		$sql="SELECT o.id_obligacion, a.id_contrato, a.id_adicion, a.valoradi, a.registro_New, a.fechaadi
		           FROM obligacion o,  contradicion a
					WHERE  id_obligacion=? 
					AND o.id_contrato=a.id_contrato
					ORDER  by  o.id_obligacion";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute(array($id)))
		{
			
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			   $this->adici[]=$fila;
			 
			}  
		}
		
		$dbh = null;
		return $this->adici;
		
	}
	//*********************Ver obligaciones de un contrato***************
	public function verobliga_conatrato($idc,$ido)
	{
		$dbh=parent::con();													// todas las obligaciones de un contratos y la obligacion diferente a la actual
		$sql="SELECT o.id_obligacion, o.totalobliga, o.id_opago, o.id_contrato, a.numorden,a.fecha, o.fechaobliga 
		          FROM obligacion o LEFT JOIN opagos a ON o.id_opago=a.id_opago
		          WHERE  o.id_contrato=? AND o.id_obligacion!=$ido";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute(array($idc)))
		{
			
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			   $this->oblicon[]=$fila;
			 
			}  
		}
		
		$dbh = null;
		return $this->oblicon;
		
	}
	// ver los detalles de la obligacion por id 
	public function verdetaobli($id) 
	{
		 
		$dbh=parent::con();
		$sql="select id_deta_obliga, altas, facturas, valor, id_obligacion,fechadeta, sdo_amortizo, val_apagar,
		          porfacturar  from deta_obligacion where id_obligacion=? ";
		$stmt=$dbh->prepare($sql);
		if ($stmt->execute(array($id)))
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->vdobli[]=$fila;
			}
		}
		return $this->vdobli;	
		$dbh=null;
	}
	public function agrega_deta_obli()
	{
		if (empty($_POST["alta"]) or empty($_POST["factura"]) or empty($_POST["valor"]))
		{
			     header("location: ".Conectar::ruta()."?accion=oblideta&id=$_POST[id_obli]");exit;
		}
		$sdo_amortizo=$_POST["valor"]*$_POST["amortizar"];
		 if($_POST["amortizar"]>0)
		 	{	
		 		$val_apagar=$_POST["valor"]-($_POST["valor"]*$_POST["amortizar"]);
		 	}else
		 	  {
		 	  	$val_apagar=$_POST["valor"]-$_POST["valorpagar"];
		 	  }	
		 $porfacturar=$_POST["porfac"]-$_POST["valor"];
		$dbh=parent::con();
		$sql="insert into  deta_obligacion
		values
		(null, ?, ?, ?, ?, ?, ?, ?, ?)";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["alta"],  PDO :: PARAM_STR);
		$gsent->bindValue(2, $_POST["factura"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["valor"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["id_obli"], PDO :: PARAM_INT);
	    $gsent->bindValue(5, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(6,$sdo_amortizo, PDO :: PARAM_INT);
		$gsent->bindValue(7,$val_apagar, PDO :: PARAM_INT);
		$gsent->bindValue(8,$porfacturar, PDO :: PARAM_INT);
		$gsent->execute();
		//*************************************************************
		$sql="update contratos
		         set
		         saldo=?
		         where id_contrato=?";
		         $gsent=$dbh->prepare($sql);
		         $tota=$_POST["sal"]-$_POST["valor"];
		         $gsent->bindValue(1, $tota, PDO :: PARAM_INT);
				 $gsent->bindValue(2, $_POST["id_contra"], PDO :: PARAM_INT);
		$gsent->execute();
		//******************************total obligacion*************************************
		$sql="update obligacion
		         set
		         totalobliga=?
		         where id_obligacion=?";
		         $gsent=$dbh->prepare($sql);
		          $tot1=$_POST["tobliga"]+$_POST["valor"];
		         $gsent->bindValue(1, $tot1, PDO :: PARAM_INT);
				 $gsent->bindValue(2, $_POST["id_obli"], PDO :: PARAM_INT);
		$gsent->execute();
		$dbh=null;
		header("location:".Conectar::ruta()."?accion=oblideta&id=$_POST[id_obli]");exit;
		
	}
	public function eliminar_deta_obli()
		{
			//print_r($_GET);
			
			//la forma fácil
			//$sql="delete from personas where id_persona=".$_GET["id_persona"];
			//$this->dbh->exec($sql);
			
			
			//la forma bonita y segura
			$dbh=parent::con();
			$sql="delete from deta_obligacion where id_deta_obliga=?";
			$gsent=$dbh->prepare($sql);
		    $gsent->bindParam(1,$_GET["ido"]);
			$gsent->execute();
			//********************************************************************************
			$sql="update obligacion
		         set
		         totalobliga=?
		         where id_obligacion=?";
		         $gsent=$dbh->prepare($sql);
		          $tot1=$_GET["tobliga"]-$_GET["valor"];
		         $gsent->bindValue(1, $tot1, PDO :: PARAM_INT);
				 $gsent->bindValue(2, $_GET["id"], PDO :: PARAM_INT);
		$gsent->execute();
		//*************************************************************
		$sql="update contratos
		         set
		         saldo=?
		         where id_contrato=?";
		         $gsent=$dbh->prepare($sql);
		         $tota=$_GET["sal"]+$_GET["valor"];
		         $gsent->bindValue(1, $tota, PDO :: PARAM_INT);
				 $gsent->bindValue(2, $_GET["idc"], PDO :: PARAM_INT);
		$gsent->execute();
			$dbh=null;
			header("location: ".Conectar::ruta()."?accion=oblideta&id=$_GET[id]");exit;
		}
}
?>