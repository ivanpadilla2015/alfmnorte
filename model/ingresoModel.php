<?php
class Ingreso extends Conectar
{
	private $cfun=array();
	private $lisin=array();
	private $impin=array();
	private $impig=array();
	
	public function calnumin()
	{
			$conn=parent::con();
			$sql="SELECT MAX(id_ingreso) AS can FROM ingresos";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cain=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cain;
	}
	
	public function grabaringre()
	{
		$conn=parent::con();
		$sql="insert  into  ingresos(id_ingreso, ningreso, id_planilla, fechain, valorin, id_funcionario)
		values
		(null, ?,?,?,?,?)"; // cuando se coloca solo los values no graba el registro si no estan completos los campos
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["numin"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["idpla"],  PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["fein"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["valorin"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["idf"], PDO :: PARAM_INT);
		$gsent->execute();
		//*******************************************************************************
		$sql="update planillas
				         set
				         legalizada=?
				         where id_planilla=?";
						 $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1,  $_POST["numin"], PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["idpla"], PDO :: PARAM_INT);
						 $gsent->execute();
		
		$conn=null;
		header("location:".Conectar::ruta()."?accion=paraingreso");exit;
	}
	
	public function funciona()
	   {
	   	$conn=parent::con();
		$sql="select id_funcionario, nombre_func from funcionarios";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->cfun[]=$fila;
					
			}
			$conn=null;
			return $this->cfun;
	   }
	   
	   public function listadoingreso()
		{
			$conn=parent::con();
			$sql="select id_ingreso, ningreso, id_planilla, fechain, valorin, id_funcionario
			         from ingresos order by id_ingreso";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->lisin[]=$fila;
			}
			$conn=null;
			return $this->lisin;
		}
		
		/***************************obtener el id creado para la recaja*******************************/
		
		
		public function impre_ingreso_pla($num)
		{  
			$dbh=parent::con();
			$sql="SELECT id_planilla AS id FROM ingresos where ningreso=?";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
			$gsent->execute();
			$id_p=$gsent->fetch(PDO::FETCH_ASSOC);
			
			$sql="SELECT p.id_planilla, p.id_banco, b.nombreban, b.cuenta , p.fechadeta, i.fechain, p.valordeta,p.id_cuenta, c.nombrecuenta, c.codigo, p.concepto, p.id_funcionario, f.nombre_func
				  FROM planilladeta p, bancos b, funcionarios f, cuentas c, ingresos i
				  WHERE p.id_planilla = ?
				  AND p.id_banco = b.id_banco
				  AND p.id_cuenta = c.id_cuenta
				  AND p.id_planilla = i.id_planilla
				  AND p.id_funcionario = f.id_funcionario order by p.id_banco";
			$gsent=$dbh->prepare($sql);
			$gsent->bindValue(1, $id_p["id"],  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->impin[]=$fila;
			}   
			$dbh = null;
			return $this->impin;
		}
		
		public function agrup_ingreso_pla($num)
		{
			$dbh=parent::con();
			$sql="SELECT id_planilla AS id FROM ingresos where ningreso=?";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
			$gsent->execute();
			$id_p=$gsent->fetch(PDO::FETCH_ASSOC);
			
			$sql="select id_planilla, id_banco, sum(valordeta) as valord from planilladeta 
			      where id_planilla = ? group by id_banco";
			$gsent=$dbh->prepare($sql);
			$gsent->bindValue(1, $id_p["id"],  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->impig[]=$fila;
			}   
			$dbh = null;
			return $this->impig;
			
		}
		
		public function ingre_total_num($num)
		{
			$dbh=parent::con();
			$sql="SELECT i.id_planilla AS id, i.valorin, f.nombre_func 
			      FROM ingresos i, funcionarios f
			      where ningreso = ?
			      AND i.id_funcionario = f.id_funcionario";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $num,  PDO :: PARAM_INT);
			$gsent->execute();
			$toin=$gsent->fetch(PDO::FETCH_ASSOC);
			$dbh = null;
			return $toin;
		}
		
}
?>