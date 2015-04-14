<?php
class Egresos extends Conectar
{
	private $pago=array();
	private $banc=array();
	private $lpros=array();
	private $lgres=array();
	private $lis=array();
	private $recexce=array();
	
	public function calnum_egre() //devuelve el ultimo numero egreso
	{
			$conn=parent::con();
			$sql="SELECT MAX(numegreso) AS can FROM egresos";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cain=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cain;
	}
	
	public function listado_opagos()
	{
		$conn=parent::con();
		$sql="SELECT o.id_opago, if(c.num_contrato, c.num_contrato, 'Sin_Cont') AS num_contrato, p.nombre, o.fecha, o.numorden, o.detalle, o.total, o.neto_pagar, o.id_contrato, o.id_obligacion, o.id_proveedor
			  FROM (opagos o LEFT JOIN proveedores p ON o.id_proveedor = p.id_proveedor) LEFT JOIN contratos c ON o.id_contrato = c.id_contrato
			  WHERE o.id_egreso = 0 ORDER BY o.numorden desc";
	    $gsent = $conn->prepare($sql);	
		$gsent->execute();
		while($fila=$gsent->fetch())
		{
			$this->pago[]=$fila;
		}
		$conn=null;
		return $this->pago;
	}
	public function listabanco()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta from bancos order by nombreban asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->banc[]=$fila;
			}
		}
		$conn = null;
		return $this->banc;
	}
	public function grabaregre()
	{
	  // print_r($_POST);exit;		
			
		$conn=parent::con();
		$sql="insert  into  egresos(id_egreso, numegreso, id_opago, id_proveedor, fechaegre, detallegre, id_banco, valoregre,
		numcheque, fecheque, chequenom, fejunta, fefactura, ferecibo)
		values
		(null, ?,?,?,?,?,?,?,?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["negreso"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["id_op"],  PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["id_prov"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(5, $_POST["detaegr"], PDO :: PARAM_STR);
		$gsent->bindValue(6, $_POST["numban"], PDO :: PARAM_INT);
		$gsent->bindValue(7, $_POST["vegre"], PDO :: PARAM_INT);
		$gsent->bindValue(8, $_POST["ncheque"], PDO :: PARAM_STR);
		$gsent->bindValue(9, $_POST["fecheq"], PDO :: PARAM_STR);
		$gsent->bindValue(10, $_POST["nomcheque"], PDO :: PARAM_STR);
		$gsent->bindValue(11, $_POST["fechaj"], PDO :: PARAM_STR);
		$gsent->bindValue(12, $_POST["fechaf"], PDO :: PARAM_STR);
		$gsent->bindValue(13, $_POST["fechar"], PDO :: PARAM_STR);
		$gsent->execute();
			/***************************obtener el id creado para el egreso*******************************/
		$sql="SELECT MAX(id_egreso) AS id FROM egresos";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$ido=$gsent->fetch(PDO::FETCH_ASSOC);
		//*******************************grabar egreso en opago para que salga del listado por egreso*********
		$sql="update opagos
				         set
				         id_egreso=?
				         where id_opago=?";
						 $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1,  $ido["id"], PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["id_op"], PDO :: PARAM_INT);
						 $gsent->execute();
		//**********************grabar egreso en obligacion**************************************
		if($_POST["id_obl"]>0){
				$sql="update obligacion
				         set
				         id_egreso=?
				         where id_obligacion=?";
						 $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1,  $ido["id"], PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["id_obl"], PDO :: PARAM_INT);
						 $gsent->execute();
		}
		$conn=null;
		header("location:".Conectar::ruta()."?accion=paraegreso");exit;
	   
	    	
	}
	
	public function grabaregresinop()
	{
		$conn=parent::con();
		$sql="insert  into  egresos(id_egreso, numegreso, id_proveedor, fechaegre, detallegre, id_banco, valoregre,
		numcheque, fecheque, chequenom, fejunta, fefactura, ferecibo)
		values
		(null, ?,?,?,?,?,?,?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["negreso"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["id_prov"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["detaegr"], PDO :: PARAM_STR);
		$gsent->bindValue(5, $_POST["numban"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["vegre"], PDO :: PARAM_INT);
		$gsent->bindValue(7, $_POST["ncheque"], PDO :: PARAM_STR);
		$gsent->bindValue(8, $_POST["fecheq"], PDO :: PARAM_STR);
		$gsent->bindValue(9, $_POST["nomcheque"], PDO :: PARAM_STR);
		$gsent->bindValue(10, $_POST["fechaj"], PDO :: PARAM_STR);
		$gsent->bindValue(11, $_POST["fechaf"], PDO :: PARAM_STR);
		$gsent->bindValue(12, $_POST["fechar"], PDO :: PARAM_STR);
		$gsent->execute();
		$conn=null;
		header("location:".Conectar::ruta()."?accion=paraegreso");exit;
	}

	public function listprovs()
	{
		$dbh=parent::con();
		$sql="select id_proveedor, nombre from proveedores order by nombre asc";
		foreach($dbh->query($sql) as $fila)
		{
				$this->lpros[]=$fila;
		}
		$dbh = null;
		return $this->lpros;
	}
	public function listegres()
	{
		$dbh=parent::con();
		$sql="select e.id_egreso, e.numegreso,e.id_proveedor, p.nombre,e.fechaegre, e.detallegre, e.id_banco, b.nombreban, e.valoregre, e.fejunta, e.fefactura, b.nombreban, b.cuenta, e.ferecibo
		 from egresos e, proveedores p, bancos b
		 where e.id_proveedor = p.id_proveedor
		 and e.id_banco = b.id_banco
		 order by numegreso desc";
		foreach($dbh->query($sql) as $fila)
		{
				$this->lgres[]=$fila;
		}
		$dbh = null;
		return $this->lgres;
	}
	public function calnumcj()  //corregiodo
	{
			$conn=parent::con();
			$sql="SELECT MAX(num_cajam) AS can FROM cajamenor";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cain=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cain;
	}
	
	public function grabarcajam()
	{
		$conn=parent::con();
		$sql="insert  into  cajamenor
		values
		(null, ?,?,?,?,?,?)"; 
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["numcj"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fec"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["prov"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["vtsini"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["vtiva"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["vtciva"], PDO :: PARAM_INT);
		$gsent->execute();
		$conn=null;
	}
	public function opago_paraegre($num)
	{  
			$dbh=parent::con();
			$sql="SELECT o.id_opago,o.numorden,p.nombre, o.detalle, o.neto_pagar,o.fecha, o.total, o.id_contrato, o.id_obligacion, o.id_proveedor
			  	  FROM opagos o LEFT JOIN proveedores p ON o.id_proveedor = p.id_proveedor
			  	  WHERE o.numorden = ?";
			$gsent=$dbh->prepare($sql);
			$gsent->bindValue(1, $num, PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->lis[]=$fila;
			}   
			$dbh = null;
			return $this->lis;
	}
	public function busretenc()
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
	public function egreso_opago_excel($feini,$fefin)
	{
		$conn=parent::con();
		$sql="select e.id_egreso, e.numegreso, e.fechaegre, e.id_opago, o.numorden, e.id_banco, b.nombreban , e.valoregre, e.id_proveedor, p.nombre, e.detallegre, e.fejunta, e.fefactura, e.ferecibo
		      from (egresos e left join opagos o on e.id_opago= o.id_opago) left join bancos b on e.id_banco = b.id_banco
		      left join proveedores p on e.id_proveedor = p.id_proveedor
			  where e.fechaegre>= ? and e.fechaegre<= ? order by e.numegreso";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $feini, PDO::PARAM_STR);
		$gsent->bindValue(2, $fefin, PDO::PARAM_STR);
		$gsent->execute();
	    while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->recexce[]=$fils;
		}
		$conn=null;
		return $this->recexce;
	}
	public function egrsospor_id($id)
	{
		$conn=parent::con();
		$sql="select e.id_egreso, e.numegreso, p.nombre, e.fechaegre, e.id_opago, e.id_banco, e.valoregre, e.id_proveedor, e.detallegre, e.fejunta, e.fefactura, e.ferecibo,
		      e.numcheque, e.fecheque, e.chequenom
		      from egresos e 
		      inner join proveedores p on e.id_proveedor = p.id_proveedor
		      where e.id_egreso = ?";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $id, PDO::PARAM_INT);	
		$gsent->execute();  
		$efils=$gsent->fetch(PDO::FETCH_ASSOC);
		$conn=null;
		return $efils;
		 
	}
	
	public function editar_egreso_id()
	{
		$conn=parent::con();	
		$sql="update egresos
				         set
				         numegreso = ?, fechaegre = ?, detallegre = ?, id_banco = ?, valoregre = ?, numcheque = ?, fecheque = ?,
				         chequenom = ?, fejunta = ?, fefactura = ?, ferecibo = ? 
				         where id_egreso = ?";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["negreso"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["detaegr"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["numban"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["vegre"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["ncheque"], PDO :: PARAM_STR);
		$gsent->bindValue(7, $_POST["fecheq"], PDO :: PARAM_STR);
		$gsent->bindValue(8, $_POST["nomcheque"], PDO :: PARAM_STR);
		$gsent->bindValue(9, $_POST["fechaj"], PDO :: PARAM_STR);
		$gsent->bindValue(10, $_POST["fechaf"], PDO :: PARAM_STR);
		$gsent->bindValue(11, $_POST["fechar"], PDO :: PARAM_STR);
		$gsent->bindValue(12, $_POST["id_egr"], PDO :: PARAM_STR);
		$gsent->execute();
		$conn=null;
		header("location:".Conectar::ruta()."?accion=listado_egresos");exit;
	}
	public function buscar_egreso($num)
	{
		$conn=parent::con();
		$sql="SELECT e.id_egreso, e.numegreso, e.fechaegre, e.id_opago, e.id_banco, e.valoregre, e.id_proveedor, e.detallegre, e.fejunta, e.fefactura, e.ferecibo,
		      e.numcheque, e.fecheque, e.chequenom, p.numorden
		      FROM egresos e LEFT JOIN opagos p ON e.id_opago = p.id_opago
		      WHERE e.numegreso = ?";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $num, PDO::PARAM_INT);	
		$gsent->execute();  
		$efils=$gsent->fetch(PDO::FETCH_ASSOC);
		$conn=null;
		return $efils;
	}
	public function eliminar_egreso($ide,$ido)
	{
		$conn=parent::con();
		$sql="delete from egresos where id_egreso=?";
			$gsent=$conn->prepare($sql);
		    $gsent->bindParam(1,$ide);
			$gsent->execute();	
			//***************************************************************
		 if($ido>0)	
		 {   $eg=0;
				$sql="update opagos
					         set
					         id_egreso=?
					         where id_opago=?";
					     $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1, $eg, PDO :: PARAM_INT);
						 $gsent->bindValue(2, $ido, PDO :: PARAM_INT);
						 $gsent->execute();
		  }
		
		$conn=null;
		//header("location:".Conectar::ruta()."?accion=eliminar_egreso");exit;
		}
	
}
?>