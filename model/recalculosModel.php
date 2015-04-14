<?php
class Recalculos extends Conectar
{
	private $ladic=array();	
	private $laobli=array();
	private $tcontra=array();
	private $lbanc=array();
	private $lista=array();
	private $detin=array();
	private $reten=array();
	private $treten=array();
	private $tprov=array();
	private $reted=array();
	
	public function ver_allcontratos()
	{
		$dbh=parent::con();
		$sql="SELECT c.id_contrato, c.num_contrato, c.id_proveedor, p.nombre from contratos c, proveedores p
		 where c.id_proveedor=p.id_proveedor";
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
		{
				$this->tcontra[]=$fila;
		}
		
		$dbh = null;
		return $this->tcontra;
	}
	
	public function ver_contratoporid($id)
	{
		$dbh=parent::con();
		$sql="SELECT id_contrato, num_contrato,valorcontrato from contratos
		          where id_contrato=?";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
		$gsent->execute();
		$cont=$gsent->fetch(PDO::FETCH_ASSOC);    
		$dbh = null;
		return $cont;
	}
	public function las_adiciones($id)
	{
		$dbh=parent::con();
		$sql="SELECT id_adicion,valoradi from contradicion where id_contrato=?";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		if($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			  	   $this->ladic[]=$fila;
			}
		}
		$dbh = null;
		return $this->ladic;
	}
	
	public function las_obligaciones($id)
	{
		$dbh=parent::con();
		$sql="SELECT id_obligacion, id_contrato, totalobliga from obligacion where id_contrato=?";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		if($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			     $this->laobli[]=$fila;
			}
		}
		$dbh = null;
		return $this->laobli;
	}
	public function lista_banco()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta from bancos order by id_banco asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->lbanc[]=$fila;
				
			}
		}
		$conn = null;
		return $this->lbanc;
	}
	public function busc_banco_id($id)
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta, saldo_mes_ante, tipo_cuenta
		   from bancos 
           where id_banco = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		$fila=$stmt->fetch(PDO::FETCH_ASSOC);
		$conn = null;
		return $fila;
	}
	public function librosbancos($fi,$ff,$id)
	{
		$dbh=parent::con();
		$sql="(
				SELECT i.fechain AS fecha, 0 AS opago, 0 AS ce, CONCAT('CI-',i.ningreso)  AS concepto, p.valordeta AS valor, p.id_banco, 1 AS DC
				FROM ingresos i
				INNER JOIN planilladeta p ON i.id_planilla = p.id_planilla
				WHERE i.fechain >= ? and i.fechain <= ? and p.id_banco = ?
				)
				UNION (
				
				SELECT fecha AS fecha, 0 AS opago, 0 AS ce, CONCAT('RC-',numrecaja) AS concepto, valorec AS valor, id_banco, 1 AS DC
				FROM recajas WHERE fecha >= ? and fecha <= ? and id_banco = ?
				)
				UNION (
				
				SELECT fecha_ajuste AS fecha, 0 AS opago, 0 AS ce, CONCAT('CA-',numajuste) AS concepto, valor_ajuste AS valor, id_banco, 1 AS DC
				FROM ajustes WHERE id_tipo_a =1 and fecha_ajuste >= ? and fecha_ajuste <= ? and id_banco = ?
				)
				union
				(
				
				SELECT a.fecha_ajuste AS fecha, 0 AS opago, 0 AS ce, CONCAT('CA-', a.numajuste) AS concepto, a.valor_ajuste AS valor, a.id_banco, 2 AS DC
				FROM ajustes a
				WHERE a.id_tipo_a = 2 AND a.fecha_ajuste >= ? and a.fecha_ajuste <= ? AND a.id_banco = ?
				ORDER BY a.numajuste
				)
				UNION (
				
				SELECT e.fechaegre AS fecha, 0 AS opago, e.numegreso AS ce, p.nombre AS concepto, e.valoregre AS valor, e.id_banco, 0 AS DC
				FROM egresos e 
				INNER JOIN proveedores p ON p.id_proveedor = e.id_proveedor
				WHERE e.id_opago = 0 and e.fechaegre >= ? and e.fechaegre <= ? and e.id_banco = ?
				ORDER BY o.numorden
			    )
				UNION (
				
				SELECT e.fechaegre AS fecha, o.numorden AS opago, e.numegreso AS ce, p.nombre AS concepto, e.valoregre AS valor, e.id_banco, 0 AS DC
				FROM egresos e 
				INNER JOIN opagos o ON e.id_opago = o.id_opago
				INNER JOIN proveedores p ON p.id_proveedor = e.id_proveedor
				WHERE e.fechaegre >= ? and e.fechaegre <= ? and e.id_banco = ?
				ORDER BY o.numorden
			    )
				ORDER BY 1 , 3, 4";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(2, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(3, $id,  PDO :: PARAM_INT);
		$gsent->bindValue(4, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(5, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(6, $id,  PDO :: PARAM_INT);
		$gsent->bindValue(7, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(8, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(9, $id,  PDO :: PARAM_INT);
		$gsent->bindValue(10, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(11, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(12, $id,  PDO :: PARAM_INT);
		$gsent->bindValue(13, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(14, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(15, $id,  PDO :: PARAM_INT);
		$gsent->bindValue(16, $fi,  PDO :: PARAM_STR);
		$gsent->bindValue(17, $ff,  PDO :: PARAM_STR);
		$gsent->bindValue(18, $id,  PDO :: PARAM_INT);
		if($gsent->execute())
		{
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
			     $this->lista[]=$fila;
			}
		}
		$dbh = null;
		return $this->lista;
	}
	public function repoingresos($fi,$ff)
	{
			$conn=parent::con();
			$sql="(
					select a.numrecaja as ingreso, a.fecha, a.id_banco,b.concepto, b.valorporc as valor, 'recaja' as tipo, c.nombreban, c.cuenta  
			      	from recajas a inner join recadeta b on a.id_recajas = b.id_recajas
			      	INNER JOIN bancos c on a.id_banco = c.id_banco
			      	where a.fecha >= ? and a.fecha <= ?
			       )
			       UNION (
			       select a.numplanilla as ingreso, a.fecha, b.id_banco, b.concepto, b.valordeta as valor, 'planilla' as tipo, c.nombreban, c.cuenta 
			       from planillas a inner join planilladeta b on a.id_planilla = b.id_planilla
			       INNER JOIN bancos c on b.id_banco = c.id_banco
			       where a.fecha >= ? and a.fecha <= ?
			       )
			       ORDER BY 2";
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $fi,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $ff,  PDO :: PARAM_STR);
			$gsent->bindValue(3, $fi,  PDO :: PARAM_STR);
			$gsent->bindValue(4, $ff,  PDO :: PARAM_STR);
			$gsent->execute();
			while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->detin[]=$fils;
			}
			$conn=null;
			return $this->detin;
	}
	public function retencione_tipo($fi,$ff,$ban,$tipo)
	{
		$conn=parent::con();
		$sql="SELECT o.id_retencion, o.porcentaje, o.base, o.totalreten, o.id_opago, r.Nombre_rete, op.numorden, p.nombre, p.nitproveedor, e.fechaegre, e.numegreso, e.id_banco
			  FROM opagosdeta o
			  INNER JOIN egresos e on o.id_opago = e.id_opago
			  INNER JOIN retenciones r ON r.id_reten = o.id_retencion
			  INNER JOIN opagos op ON op.id_opago = o.id_opago
			  INNER JOIN proveedores p ON p.id_proveedor = op.id_proveedor
			  WHERE r.tipo = ? and e.fechaegre >= ? and e.fechaegre <= ? 
			  ORDER BY op.numorden ASC";
			  $gsent=$conn->prepare($sql);
			  $gsent->bindValue(1, $tipo,  PDO :: PARAM_STR);
			  $gsent->bindValue(2, $fi,  PDO :: PARAM_STR);
			  $gsent->bindValue(3, $ff,  PDO :: PARAM_STR);
			  
			  $gsent->execute();
			  while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
						$this->reten[]=$fils;
				}
				$conn=null;
				return $this->reten;
		
	}
	public function ver_retenciones($fi,$ff)
	{
		$conn=parent::con();
		$sql="SELECT o.id_retencion, o.porcentaje, o.base, o.totalreten, o.id_opago, r.Nombre_rete, op.numorden, p.nombre, p.nitproveedor, e.fechaegre,
		      e.numegreso, e.id_banco, b.nombreban, b.cuenta
			  FROM opagosdeta o
			  INNER JOIN egresos e on o.id_opago = e.id_opago
			  INNER JOIN bancos b on e.id_banco = b.id_banco
			  INNER JOIN retenciones r ON r.id_reten = o.id_retencion
			  INNER JOIN opagos op ON op.id_opago = o.id_opago
			  INNER JOIN proveedores p ON p.id_proveedor = op.id_proveedor
			  WHERE e.fechaegre >= ? and e.fechaegre <= ? 
			  ORDER BY op.numorden ASC";
			  $gsent=$conn->prepare($sql);
			  $gsent->bindValue(1, $fi,  PDO :: PARAM_STR);
			  $gsent->bindValue(2, $ff,  PDO :: PARAM_STR);
			  $gsent->execute();
			  while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
						$this->treten[]=$fils;
				}
				$conn=null;
				return $this->treten;
		
	}
	public  function ver_proveedres()
	{
		$conn=parent::con();
		$sql="select id_proveedor, nombre from proveedores order by nombre";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
		{
			$this->tprov[]=$fils;
		}
		$conn=null;
		return $this->tprov;
	}
	public function dian_proveedor($fi,$ff,$id)
	{
		$conn=parent::con();
		$sql="SELECT o.id_retencion, o.porcentaje, o.base, o.totalreten, o.id_opago, r.Nombre_rete, op.numorden, p.nombre, p.nitproveedor, e.fechaegre,
		      e.numegreso, e.id_banco, b.nombreban, b.cuenta
			  FROM opagosdeta o
			  INNER JOIN egresos e on o.id_opago = e.id_opago
			  INNER JOIN bancos b on e.id_banco = b.id_banco
			  INNER JOIN retenciones r ON r.id_reten = o.id_retencion
			  INNER JOIN opagos op ON op.id_opago = o.id_opago
			  INNER JOIN proveedores p ON p.id_proveedor = op.id_proveedor
			  WHERE e.fechaegre >= ? and e.fechaegre <= ? and p.id_proveedor = ?
			  ORDER BY op.numorden ASC";
			  $gsent=$conn->prepare($sql);
			  $gsent->bindValue(1, $fi,  PDO :: PARAM_STR);
			  $gsent->bindValue(2, $ff,  PDO :: PARAM_STR);
			  $gsent->bindValue(3, $id,  PDO :: PARAM_INT);
			  $gsent->execute();
			  while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
						$this->reted[]=$fils;
				}
				$conn=null;
				return $this->reted;
		
	}
}
?>