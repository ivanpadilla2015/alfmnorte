<?php
class recajas extends Conectar
{
	private $bans=array();	
	private $puc=array();
	private $allc=array();	
	private $detar=array();
	private $detar2=array();
	private $recfe=array();	
	private $reci=array();	
	
	public function calnum_rec()
	{
			$conn=parent::con();
			$sql="SELECT MAX(numrecaja) AS can FROM recajas";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cain=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cain;
	}
	public function grabarecaja()
	{
		$conn=parent::con();
		$sql="insert  into  recajas
		values
		(null, ?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["numrec"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["ferec"],  PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["ban"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["ciud"], PDO :: PARAM_STR);
		$gsent->bindValue(5, $_POST["vrec"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["clien"], PDO :: PARAM_INT);
		$gsent->execute();
		/***************************obtener el id creado para la recaja*******************************/
		$sql="SELECT MAX(id_recajas) AS id FROM recajas";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$idr=$gsent->fetch(PDO::FETCH_ASSOC);
		//**************************detalle recadeta*****************************************************
		$count = count($_POST["conc"]);
		for ($i = 0; $i < $count; $i++)
		{
			$concepto=$_POST["conc"][$i];	
			$cuenta=$_POST["cuen"][$i];
			$chequenum=$_POST["ncheque"][$i];
			$banco=$_POST["banc"][$i];
			$valorporc=$_POST["valo"][$i];
			
			$sql="insert  into  recadeta(id_recadeta, id_recajas, concepto, cuenta, chequenum, banco, valorporc)
			values
			(null, ?,?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $idr["id"],  PDO :: PARAM_INT);
			$gsent->bindValue(2, $concepto,  PDO :: PARAM_STR);
			$gsent->bindValue(3, $cuenta,  PDO :: PARAM_STR);
			$gsent->bindValue(4, $chequenum,  PDO :: PARAM_STR);
			$gsent->bindValue(5, $banco,  PDO :: PARAM_STR);
			$gsent->bindValue(6, $valorporc,  PDO :: PARAM_INT);
			$gsent->execute();
		}
		//**************************detalle recadeta2*****************************************************
			
			$sql="insert  into  recadeta2
			values
			(null, ?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $idr["id"],  PDO :: PARAM_INT);
			$gsent->bindValue(2, $_POST["idpuc"],  PDO :: PARAM_INT);
			$gsent->bindValue(3, $_POST["valoaux"],  PDO :: PARAM_STR);
			$gsent->execute();
		
		$conn=null;
		header("location:".Conectar::ruta()."?accion=crearecajas");exit;
		
	}

	public function listado_bancos()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta from bancos order by nombreban asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->bans[]=$fila;
			}
		}
		$conn = null;
		return $this->bans;
	}
	
	public function listado_puc()
	{
		$conn=parent::con();
		$sql="select * from puc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			while($fila=$stmt->fetch())
			{
			
				$this->puc[]=$fila;
			}
		}
		$conn = null;
		return $this->puc;
	}
	public function allclientes()
	{
		$conn=parent::con();
		$sql="select id_cliente, nombrecli from cliente_cartera order by nombrecli";
		foreach ($conn->query($sql) as $row) 
		{
			$this->allc[]=$row;
		}
		$conn=null;
		return $this->allc;
	}
	//***************************************PARA REPORTES RECAJAS*****************************************
	public function recajas_pornum($num)
	{
		$dbh=parent::con();
		$sql="SELECT r.id_recajas, r.numrecaja, r.fecha, r.id_banco, r.ciudad, r.valorec, r.id_cliente, b.nombreban, c.nombrecli, c.identifica
			  FROM recajas r, cliente_cartera c, bancos b
			  WHERE numrecaja = ?
			  AND r.id_cliente = c.id_cliente
			  AND r.id_banco = b.id_banco";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
		$gsent->execute();
		$reca=$gsent->fetch(PDO::FETCH_ASSOC);    
		$dbh = null;
		return $reca;
	}
	public function recadeta_porid($id)
	{
		$conn=parent::con();
		$sql="select id_recadeta,concepto, cuenta,chequenum, banco, valorporc 
		      from recadeta where id_recajas=?";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->detar[]=$fils;
		}
		$conn=null;
		return $this->detar;
	}
	public function recadeta2_porid($id)
	{
		$conn=parent::con();
		$sql="select a.id_recadeta2,a.id_puc, a.valoraux,p.nombrepuc, p.numero 
		      from recadeta2 a, puc p where id_recajas=?
		      AND  a.id_puc = p.id_puc";
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->detar2[]=$fils;
		}
		$conn=null;
		return $this->detar2;
	}
	public function recajas_porfecha($fe,$fe2)
	{
		$dbh=parent::con();
		$sql="SELECT r.id_recajas, r.numrecaja, r.fecha, r.id_banco, r.ciudad, r.valorec, r.id_cliente, b.nombreban, b.cuenta, c.nombrecli, c.identifica
			  FROM recajas r, cliente_cartera c, bancos b
			  WHERE r.fecha >= ? and r.fecha <= ?
			  AND r.id_cliente = c.id_cliente
			  AND r.id_banco = b.id_banco
			  order by r.fecha";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $fe,  PDO :: PARAM_INT);
		$gsent->bindValue(2, $fe2,  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->recfe[]=$fils;
		}
		$conn=null;
		return $this->recfe;  
		
	}
	public function recajas_ingreso($fe)
	{
		$dbh=parent::con();
		$sql="SELECT r.id_recajas, r.numrecaja, r.fecha, r.id_banco, r.valorec, b.nombreban, b.cuenta
			  FROM recajas r, bancos b
			  WHERE r.fecha = ? 
			  AND r.id_banco = b.id_banco
			  order by r.fecha";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $fe,  PDO :: PARAM_INT);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
				$this->reci[]=$fils;
		}
		$conn=null;
		return $this->reci;  
		
	}
	public function buscarrecajas($bus)
	{
			$conn=parent::con();
	    	$sql="SELECT numrecaja, id_recajas  FROM recajas where numrecaja=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $bus, PDO::PARAM_INT);
			$gsent->execute();
			if($gsent->fetch(PDO::FETCH_ASSOC))
			{
				$encon="Error, Recaja Ya Existe";
			}else
			{
				$encon="OK, Número Disponible";
			}    
			return $encon;
		
		}
}
?>