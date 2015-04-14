<?php
class Contratos extends Conectar
{
	private $fila=array();	
	private $pro=array();
	private $tcon=array();
	private $depe=array();
	private $contra=array();
	private $adic=array();
	private $egr=array();
	public function ver_contrato()
	{
		$dbh=parent::con();
		$sql="SELECT * from contratos where id_contrato=?";
		$stmt=$dbh->prepare($sql);
		$stmt->execute(array($_GET["id"]));
		if($fila=$stmt->fetch())
		{
				$this->fila[]=$fila;
		}
		$dbh = null;
		return $this->fila;
	}
	public function listaprov()
	{
		$dbh=parent::con();
		$sql="select id_proveedor, nombre from proveedores order by nombre asc";
		$stmt=$dbh->prepare($sql);
		if ($stmt->execute())
		{
			while($fila=$stmt->fetch())
			{
				$this->pro[]=$fila;
			}
		}
		$dbh = null;
		return $this->pro;
	}
	public function tiposcon()
	{
		$dbh=parent::con();
		$sql="select id_tipo_contrato, nombretipo from tipos_contratos order by nombretipo asc";
		foreach($dbh->query($sql) as $fila)
		{
				$this->tcon[]=$fila;
		}
		$dbh = null;
		return $this->tcon;
	}
	public function depen()
	{
		$dbh=parent::con();
		$sql="select id_dependencia, nombre_depen from dependencias order by nombre_depen asc";
		foreach($dbh->query($sql) as $fila)
		{
				$this->depe[]=$fila;
		}
		$dbh = null;
		return $this->depe;
	}
	public function contrato_depen($idc)
	{
		$dbh=parent::con();
		$sql="SELECT a.id_contrato, a.num_contrato, a.id_dependencia, d.nombre_depen from contratos a, dependencias d
		          where id_contrato=? AND a.id_dependencia=d.id_dependencia";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $idc,  PDO :: PARAM_INT);
		$gsent->execute();
		$condp=$gsent->fetch(PDO::FETCH_ASSOC);    
		$dbh = null;
		return $condp;
	}	
	public function grabarcontra()
	{
		$dbh=parent::con();
		$sql="insert  into  contratos(id_contrato, num_contrato,  id_proveedor, id_tipo_contrato, valorcontrato, valoranticipo,
		        fecha_anticipo, amortizar, registro_pres_inic, fechacontrato, interadmi, objetocontrato, saldo, id_dependencia, plazoejecucion)
		values
		(null, ?, ?, ?, ?,?, ?, ?, ?,?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro
		$tot=$_POST["vcontra"]-$_POST["anticipo"];
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["contrato"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["idpro"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["tipocon"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["vcontra"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["anticipo"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["feanticipo"], PDO :: PARAM_STR);
		$gsent->bindValue(7, $_POST["amortiza"], PDO :: PARAM_INT);
		$gsent->bindValue(8, $_POST["regpre"], PDO :: PARAM_INT);
		$gsent->bindValue(9, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(10, $_POST["ninter"], PDO :: PARAM_INT);
		$gsent->bindValue(11, $_POST["objcon"], PDO :: PARAM_STR);
		$gsent->bindValue(12, $tot, PDO :: PARAM_INT);
		$gsent->bindValue(13, $_POST["depen"], PDO :: PARAM_INT);
		$gsent->bindValue(14, $_POST["fepla"], PDO :: PARAM_INT);
		$gsent->execute();
		$dbh=null;
		header("location:".Conectar::ruta()."?accion=contratos&m=2");exit;
	}
	public function editacontra()
	{
		$dbh=parent::con();
		$sql="update contratos
		         set
		         num_contrato=?, id_proveedor=?, id_tipo_contrato=?, valorcontrato=?, valoranticipo=?,
		         fecha_anticipo=?, amortizar=?, registro_pres_inic=?, fechacontrato=?, interadmi=?, objetocontrato=?,
		         id_dependencia=?, plazoejecucion=?
		         where id_contrato=?";
		         $gsent=$dbh->prepare($sql);
				 
		         $gsent->bindValue(1, $_POST["contrato"],  PDO :: PARAM_INT);
				 $gsent->bindValue(2, $_POST["idpro"], PDO :: PARAM_INT);
				 $gsent->bindValue(3, $_POST["tipocon"], PDO :: PARAM_INT);
				 $gsent->bindValue(4, $_POST["vcontra"], PDO :: PARAM_INT);
				 $gsent->bindValue(5, $_POST["anticipo"], PDO :: PARAM_INT);
				 $gsent->bindValue(6, $_POST["feanticipo"], PDO :: PARAM_STR);
				 $gsent->bindValue(7, $_POST["amortiza"], PDO :: PARAM_INT);
				 $gsent->bindValue(8, $_POST["regpre"], PDO :: PARAM_INT);
				 $gsent->bindValue(9, $_POST["fecha"], PDO :: PARAM_STR);
				 $gsent->bindValue(10, $_POST["ninter"], PDO :: PARAM_INT);
				 $gsent->bindValue(11, $_POST["objcon"], PDO :: PARAM_STR);
				 $gsent->bindValue(12, $_POST["depen"], PDO :: PARAM_INT);
				 $gsent->bindValue(13, $_POST["fepla"], PDO :: PARAM_INT);
				  $gsent->bindValue(14, $_POST["id"], PDO :: PARAM_INT);
		         $gsent->execute();
				 $dbh=null;
				header("location:".Conectar::ruta()."?accion=editacontratos&m=3&id=".$_POST["id"]);exit;
	}
	public function ver_contratoall()
	{
		$dbh=parent::con();
		$sql="SELECT c.id_contrato, c.num_contrato, c.id_proveedor, p.nombre from contratos c, proveedores p
		 where c.id_proveedor=p.id_proveedor";
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
		{
				$this->contra[]=$fila;
		}
		
		$dbh = null;
		return $this->contra;
	}
	public function grabaradicion()
	{
		$conn=parent::con();
		$sql="insert  into  contradicion
		values
		(null, ?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["fecha"],  PDO :: PARAM_STR);
		$gsent->bindValue(2, $_POST["contra"],  PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["va_adi"],  PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["num_re"],  PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["fe_re"],  PDO :: PARAM_INT);
		$gsent->execute();
		//*******************************************************************************
		$ad=self::extra_adi();
		//***********************************************************************
			$sql="update contratos
				         set
				         valoradicion=?,
				         saldo=?
				         where id_contrato=?";
						 $gsent=$conn->prepare($sql);
						 $to=$ad["adicion"]+$_POST["va_adi"];
						 $sal=$ad["saldo"]+$_POST["va_adi"];// antes $ad["saldo"]+$to;
						 $gsent->bindValue(1,  $to, PDO :: PARAM_INT);
						 $gsent->bindValue(2,  $sal, PDO :: PARAM_INT);
						 $gsent->bindValue(3, $_POST["contra"], PDO :: PARAM_INT);
						 $gsent->execute();
		
		$conn=null;
		header("location:".Conectar::ruta()."?accion=contratoadicion");exit;
	}
	public function extra_adi()
	{
	    	$conn=parent::con();
	    	$sql="SELECT valoradicion  AS adicion, saldo  FROM contratos where id_contrato=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $_POST["contra"], PDO::PARAM_INT);
			$gsent->execute();
			$neto=$gsent->fetch(PDO::FETCH_ASSOC);    
			return $neto;
	}
	public function ver_adiciones()
	{
		$dbh=parent::con();
		$sql="SELECT id_adicion,fechaadi,valoradi,registro_new from contradicion where id_contrato=?";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(1, $_GET["id"], PDO::PARAM_INT);
		if($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			
				$this->adic[]=$fila;
			}
		}
		$dbh = null;
		return $this->adic;
	}
	public function ver_opagos()
	{
		$dbh=parent::con();
		$sql="SELECT o.id_opago,fecha, numorden, detalle, o.id_egreso,total,id_contrato, e.valoregre, e.fechaegre, e.numegreso 
		from opagos o left join egresos e on o.id_opago = e.id_opago 
		 where o.id_contrato=?";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(1, $_GET["id"], PDO::PARAM_INT);
		if($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			
				$this->egr[]=$fila;
			}
		}
		$dbh = null;
		return $this->egr;
	}
	
	public function opagosxid($id)
	{
		$dbh=parent::con();
		$sql="select id_opago, fecha, detalle, numorden
		      from opagos
		      where id_opago = ?";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT); 
		$stmt->execute();
		$fila=$stmt->fetch(PDO::FETCH_ASSOC);   
		$dbh = null;
		return $fila; 
	}
	
}
?>