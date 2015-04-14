<?php
class opagos extends Conectar
{
	private $orde=array();   
	private $rete=array();   
	private $opa=array();
	private $oid=array();
	private $odeta=array();
	private $odeta2=array();
	private $allp=array();
	private $oidind=array();
	private $odeta1=array();
	
	public function allobligacion()
	{
		$conn=parent::con();
		$sql="SELECT o.id_obligacion, c.num_contrato,p.nombre,o.fechaobliga, o.detalle, o.id_opago, o.id_egreso, o.totalobliga, p.id_proveedor, o.id_contrato
		            FROM obligacion o, contratos c, proveedores p
					WHERE  o.id_opago=0 AND o.id_contrato=c.id_contrato
					AND c.id_proveedor = p.id_proveedor order by  p.nombre";
					
		foreach ($conn->query($sql) as $row) 
		{
			$this->orde[]=$row;
		}
		$conn=null;
		return $this->orde;
	}
	public function busprov()
	{
		$conn=parent::con();
		$sql="select id_proveedor, nombre from proveedores where id_proveedor=?";
		$gsent = $conn->prepare($sql);		
		$gsent->bindParam(1, $_GET["idp"], PDO::PARAM_INT);
		$gsent->execute();
		if($fila=$gsent->fetch(PDO::FETCH_ASSOC))
		$conn=null;
		return $fila;
	}
	
	public function allbusprov()
	{
		$conn=parent::con();
		$sql="select id_proveedor, nombre from proveedores order by nombre";
		foreach ($conn->query($sql) as $row) 
		{
			$this->allp[]=$row;
		}
		$conn=null;
		return $this->allp;
	}
		
		
	
	public function busreten()
	{
		$conn=parent::con();
		$sql="SELECT * from retenciones";
		foreach ($conn->query($sql) as $row) 
		{
			$this->rete[]=$row;
		}
		$conn=null;
		return $this->rete;
	}
	public function busreten_id($idg)
	{
			
		if (isset($_POST["idf"]))	
		{
				$conn=parent::con();
				$sql="SELECT * from retenciones where id_reten=?";
				$gsent = $conn->prepare($sql);		
				$gsent->bindParam(1, $_POST["idf"], PDO::PARAM_INT);
				$gsent->execute();
				if($fils=$gsent->fetch(PDO::FETCH_ASSOC))
					$conn=null;
				return $fils;
			}
		
		}
	public function detobliga_id($ob)
	{
		if (isset($_GET["ob"]))	
		{
				$conn=parent::con();
				$sql="SELECT * from deta_obligacion where id_obligacion=?";
				$gsent = $conn->prepare($sql);		
				$gsent->bindParam(1, $_GET["ob"], PDO::PARAM_INT);
				$gsent->execute();
				$a="";
				$f="";
				while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
					
					$a=$a.$fils["altas"]."-";
					$f=$f.$fils["facturas"]."-";
				}
				$dtob= "Alta(s):".$a."Factura(s):".$f;
				$conn=null;
				return $dtob;
			}
	}
	public function grabaopago()
	{ 
		$conn=parent::con();
		$sql="insert  into  opagos(id_opago, numorden, fecha, detalle, totsiniva, valor_iva, total,neto_pagar, id_tipo_orden, id_contrato, id_obligacion, id_proveedor)
		values
		(null, ?,?,?,?,?,?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["numo"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fe"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["deta"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["valorsiva"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["valoriva"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["valorsdes"], PDO :: PARAM_INT);
		$gsent->bindValue(7, $_POST["valorsdes"], PDO :: PARAM_INT);
		$gsent->bindValue(8, 1, PDO :: PARAM_INT);
		$gsent->bindValue(9, $_POST["contrato"], PDO :: PARAM_INT);
		$gsent->bindValue(10, $_POST["obli"], PDO :: PARAM_INT);
		$gsent->bindValue(11, $_POST["idp"], PDO :: PARAM_INT);
		$gsent->execute();
		/***************************obtener el id creado para la orden pago*******************************/
		$sql="SELECT MAX(id_opago) AS id FROM opagos";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$ido=$gsent->fetch(PDO::FETCH_ASSOC);
		/***********************************************************/
		$sql="update obligacion
				         set
				         id_opago=?
				         where id_obligacion=?";
				     $gsent=$conn->prepare($sql);
					 $gsent->bindValue(1, $ido["id"], PDO :: PARAM_INT);
					 $gsent->bindValue(2, $_POST["obli"], PDO :: PARAM_INT);
					 $gsent->execute();
		//print_r($ido);
		$conn=null;
		header("location:".Conectar::ruta()."?accion=opagosdeta&idop=". $ido["id"]);exit;
		
	}
	public function grabaopago_indepen()
	{ 
		$conn=parent::con();
		$sql="insert  into  opagos(id_opago, numorden, fecha, detalle, totsiniva, valor_iva, total,neto_pagar, id_tipo_orden, id_proveedor)
		values
		(null, ?,?,?,?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["numo"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fe"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["deta"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["valorsiva"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["valoriva"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["valorsdes"], PDO :: PARAM_INT);
		$gsent->bindValue(7, $_POST["valorsdes"], PDO :: PARAM_INT);
		$gsent->bindValue(8, 2, PDO :: PARAM_INT);
		$gsent->bindValue(9, $_POST["idp"], PDO :: PARAM_INT);
		$gsent->execute();
		/***************************obtener el id creado para la orden pago*******************************/
		$sql="SELECT MAX(id_opago) AS id FROM opagos";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$ido=$gsent->fetch(PDO::FETCH_ASSOC);
		$conn=null;
		header("location:".Conectar::ruta()."?accion=opagosdeta_indep&idop=". $ido["id"]);exit;
		
	}
	public function allopagos()
	{
		$conn=parent::con();
		$sql="SELECT op.id_opago, op.numorden, op.id_proveedor, op.fecha, op.detalle, op.totsiniva, op.valor_iva, op.total, op.id_tipo_orden,
		    if(op.id_contrato = 0,'Sin_Cont', id_contrato) as id_contrato, op.id_obligacion, p.nombre 
		            FROM opagos op, proveedores p
					WHERE op.id_egreso = 0
					AND op.id_proveedor = p.id_proveedor
					ORDER BY op.numorden desc";
					//AND c.id_proveedor = p.id_proveedor
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->opa[]=$fila;
			}
		}
		$conn = null;
		return $this->opa;
	}
	
	public function opagos_id($idop)
	{
		if (isset($_GET["idop"]))	
		{
				$conn=parent::con();
				$sql="SELECT op.id_opago, op.numorden, c.num_contrato, op.fecha, op.detalle, op.totsiniva, op.valor_iva, op.total, op.id_tipo_orden, op.id_contrato, op.id_obligacion, p.nombre
				         from opagos op, contratos c, proveedores p
				          where id_opago=?
				          AND op.id_contrato = c.id_contrato
						 AND c.id_proveedor = p.id_proveedor";
				$gsent = $conn->prepare($sql);		
				$gsent->bindParam(1, $_GET["idop"], PDO::PARAM_INT);
				$gsent->execute();
				while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
					$this->oid[]=$fils;
				}
				$conn=null;
				return $this->oid;
			}
	}
	public function opagos_id_indp($idop)
	{
				$conn=parent::con();
				$sql="SELECT op.id_opago, op.numorden, op.fecha, op.detalle, op.totsiniva, op.valor_iva, op.total, op.id_tipo_orden, op.id_contrato, op.id_obligacion, p.nombre
				         from opagos op, proveedores p
				          where id_opago=?
				          AND op.id_proveedor = p.id_proveedor";
				$gsent = $conn->prepare($sql);		
				$gsent->bindParam(1, $idop, PDO::PARAM_INT);
				$gsent->execute();
				while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
					$this->oidind[]=$fils;
				}
				$conn=null;
				return $this->oidind;
			
	}
	//***************************************PARA REPORTES ORDEN PAGO*****************************************
	public function opagos_pornum($num)
	{
		$dbh=parent::con();
		$sql="SELECT op.id_opago, op.numorden, op.fecha, op.detalle, op.totsiniva, op.valor_iva, op.total, op.neto_pagar, op.id_tipo_orden, op.id_contrato, op.id_egreso,
		                  op.id_obligacion, op.id_obligacion, p.nombre, p.nitproveedor
				          FROM opagos op, proveedores p
				          WHERE numorden=?
				          AND op.id_proveedor = p.id_proveedor";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
		$gsent->execute();
		$opornum=$gsent->fetch(PDO::FETCH_ASSOC);    
		$dbh = null;
		return $opornum;
	}
	public function verdeta_porid($id)
	{
		$conn=parent::con();
		$sql="select a.id_deta,a.id_retencion,r.Nombre_rete, a.porcentaje, a.base, a.totalreten, a.id_opago from opagosdeta a, retenciones r
		where id_opago=? and a.id_retencion=r.id_reten";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->odeta2[]=$fils;
		}
		$conn=null;
		return $this->odeta2;
	}
	//******************************FIN REPORTES ORDEN PAGO*****************************************************
	public function grabaopagodeta()
	{ 
		$conn=parent::con();
		$sql="insert  into  opagosdeta
		values
		(null, ?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["rete"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["porcret"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["bas"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["tota"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["id"], PDO :: PARAM_INT);
		$gsent->execute();
		//*************************************************************extrae el valor de netopagar
		$net=self::netopagar();
		
		//************************************************************restar cada detalle del valor opago
		//print_r($neto);exit;
		  if ($_POST["rete"]!=17)
			{	$sql="update opagos
				         set
				         neto_pagar=?
				         where id_opago=?";
						 $gsent=$conn->prepare($sql);
						 $to=$net["neto"]-$_POST["tota"];
				         $gsent->bindValue(1, $to, PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["id"], PDO :: PARAM_INT);
						 $gsent->execute();
			}
		$conn=null;
		//header("location:".Conectar::ruta()."?accion=opagosdetagra&idopd=". $_POST["id"]);exit;
		
	}
///////////////////////******************************calcular neto pagar y sindescuentos
    public function netopagar()
	{
    	$conn=parent::con();
    	$sql="SELECT neto_pagar AS neto, total AS sindes  FROM opagos where id_opago=?";
		$gsent = $conn->prepare($sql);	
		$gsent->bindParam(1, $_POST["id"], PDO::PARAM_INT);
		$gsent->execute();
		$neto=$gsent->fetch(PDO::FETCH_ASSOC);    
		return $neto;
    }
	public function verdeta()
	{
		$conn=parent::con();
		$sql="select a.id_deta,a.id_retencion,r.Nombre_rete, a.porcentaje, a.base, a.totalreten, a.id_opago from opagosdeta a, retenciones r
		where id_opago=? and a.id_retencion=r.id_reten";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["id"],  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->odeta[]=$fils;
		}
		$conn=null;
		return $this->odeta;
	}
	public function eliminar_deta_opa()
		{
			$conn=parent::con();
			$sql="delete from opagosdeta where id_deta=?";
			$gsent=$conn->prepare($sql);
		    $gsent->bindParam(1,$_GET["idd"]);
			$gsent->execute();
			/************************************************************/
			  $net=self::netopagar();
			/*************************************************************/
			 if ($_POST["rete"]!=17)
				{  $sql="update opagos
			         set
			         neto_pagar=?
			         where id_opago=?";
					 $gsent=$conn->prepare($sql);
					 $to=$net["neto"]+$_POST["tota"];
			         $gsent->bindValue(1, $to, PDO :: PARAM_INT);
					 $gsent->bindValue(2, $_POST["id"], PDO :: PARAM_INT);
					 $gsent->execute();
			   }
			$conn=null;
			//header("location: controller/opagosdetagraController.php&id=$_GET[idop]");exit;
			
		}
		public function verdeta2($id)
		{
			$conn=parent::con();
			$sql="select a.id_deta,a.id_retencion,r.Nombre_rete, a.porcentaje, a.base, a.totalreten, a.id_opago from opagosdeta a, retenciones r
			where id_opago=? and a.id_retencion=r.id_reten";
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->odeta1[]=$fils;
			}
			$conn=null;
			return $this->odeta1;
		}
		public function netopagar2($id)
		{
	    	$conn=parent::con();
	    	$sql="SELECT neto_pagar AS neto, total AS sindes  FROM opagos where id_opago=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $id, PDO::PARAM_INT);
			$gsent->execute();
			$neto=$gsent->fetch(PDO::FETCH_ASSOC);    
			return $neto;
	    }
	    public function edita_opagos($id)
		{
			$conn=parent::con();
			$sql="update opagos
			      set  
			      numorden = ?, fecha = ?, detalle =?, totsiniva = ?, valor_iva = ?,
			      total = ?
			      where id_opago = ?"; 
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $_POST["numo"],  PDO :: PARAM_INT);
			$gsent->bindValue(2, $_POST["fe"], PDO :: PARAM_STR);
			$gsent->bindValue(3, $_POST["deta"], PDO :: PARAM_STR);
			$gsent->bindValue(4, $_POST["valorsiva"], PDO :: PARAM_INT);
			$gsent->bindValue(5, $_POST["valoriva"], PDO :: PARAM_INT);
			$gsent->bindValue(6, $_POST["valorsdes"], PDO :: PARAM_INT);
			$gsent->bindValue(7, $id, PDO :: PARAM_INT);
			$gsent->execute();
			$conn=null;
			header("location:".Conectar::ruta()."?accion=editar_opago");exit;
		}
		public function opagos_egreso($num)
		{
			$dbh=parent::con();
			$sql="SELECT id_egreso, numegreso, valoregre
			      FROM egresos 
			      WHERE id_egreso=?";
			$gsent=$dbh->prepare($sql);
			$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
			$gsent->execute();
			$opornum=$gsent->fetch(PDO::FETCH_ASSOC);    
			$dbh = null;
			return $opornum;
		}
		
		public function eliminar_opagos($idop,$idobli)
		{
			$conn=parent::con();
			$sql="delete from opagos where id_opago=?";
			$gsent=$conn->prepare($sql);
		    $gsent->bindParam(1,$idop);
			$gsent->execute();	
			//**************************************************************
			$sql="delete from opagosdeta where id_opago=?";
			$gsent=$conn->prepare($sql);
		    $gsent->bindParam(1,$idop);
			$gsent->execute();	
			//***************************************************************
			$op=0;
			$sql="update obligacion
				         set
				         id_opago=?
				         where id_obligacion=?";
				     $gsent=$conn->prepare($sql);
					 $gsent->bindValue(1, $op, PDO :: PARAM_INT);
					 $gsent->bindValue(2, $idobli, PDO :: PARAM_INT);
					 $gsent->execute();
		
		$conn=null;
		header("location:".Conectar::ruta()."?accion=eliminar_opago");exit;
		}
		public function buscaropago($bus)
		{
			$conn=parent::con();
	    	$sql="SELECT numorden, id_opago  FROM opagos where numorden=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $bus, PDO::PARAM_INT);
			$gsent->execute();
			if($gsent->fetch(PDO::FETCH_ASSOC))
			{
				$encon="Error, Opago Ya Existe";
			}else
			{
				$encon="OK";
			}    
			return $encon;
		
		}
}
?>