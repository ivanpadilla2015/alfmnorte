<?php
class boletin extends Conectar
{
	//private $bols=array();
	//private $ajuegre=array();
	private $v=array();
	private $bancb=array();
	private $bolefe=array();
	private $detbol=array();
	
	public function bancos_boletines()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, saldo, cuenta from bancos order by id_banco asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			
				$this->bancb[]=$fila;
			}
		}
		$conn = null;
		return $this->bancb;
	}
	//*********************************************Egresos*******************************************************************
	
	public function egresoxban($fecha,$idban)
	{   $bols=array();
		$dbh=parent::con();
		$sql="SELECT sum(e.valoregre) as valegre, e.id_banco, b.nombreban, b.cuenta, b.saldo 
			      FROM egresos e inner join bancos b on e.id_banco = b.id_banco
			      where e.fechaegre = ? 
			      and  e.id_banco = ? group by e.id_banco";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $fecha,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $idban,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$bols[]=$fila;
						
			}
			
			$dbh = null;
			return $bols;
	}
	public function egreso_ajuste($fecha,$idban)
	{	$ajuegre=array();
		$dbh=parent::con();
		$sql="SELECT sum(a.valor_ajuste) as valegre, a.id_banco, b.nombreban, b.cuenta, b.saldo 
			      FROM ajustes a inner join bancos b on a.id_banco = b.id_banco
			      where fecha_ajuste = ? 
			      and a.id_tipo_a = 2
			      and a.id_banco = ? group by a.id_banco";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $fecha,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $idban,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$ajuegre[]=$fila;
					
			}
			$dbh = null;
			return $ajuegre;
	}
	
	
	//************************************Ingresos****************************************
	public function ingresosxban($fecha,$idban)
	{   $bin=array();
		$dbh=parent::con();
		$sql="SELECT sum(i.valordeta) as valingre, i.id_banco 
			      FROM (planilladeta i inner join planillas p  on i.id_planilla = p.id_planilla) inner join bancos b
			      on i.id_banco = b.id_banco
			      where p.fecha = ? 
			      and  i.id_banco = ? group by i.id_banco";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $fecha,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $idban,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$bin[]=$fila;
						
			}
			
			$dbh = null;
			return $bin;
						
	}
	public function ingresosrecaja($fecha,$idban)
	{   $bin2=array();
		$dbh=parent::con();
		$sql="SELECT sum(r.valorec) as valingre, r.id_banco 
			      FROM recajas r inner join bancos b on r.id_banco = b.id_banco
			      where r.fecha = ? 
			      and  r.id_banco = ? group by r.id_banco";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $fecha,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $idban,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$bin2[]=$fila;
						
			}
			
			$dbh = null;
			return $bin2;
	}
	public function ingresosajuste($fecha,$idban)
	{   $bin3=array();
		$dbh=parent::con();
		$sql="SELECT sum(a.valor_ajuste) as valingre, a.id_banco 
			      FROM ajustes a inner join bancos b on a.id_banco = b.id_banco
			      where a.fecha_ajuste = ? 
			      and a.id_tipo_a = 1
			      and  a.id_banco = ? group by a.id_banco";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $fecha,  PDO :: PARAM_STR);
			$gsent->bindValue(2, $idban,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$bin3[]=$fila;
						
			}
			
			$dbh = null;
			return $bin3;
	}
	//*******************************************************************
	public function totalizaregre($a,$fecha)
	{  //$a arreglo bancos,$fecha fecha a buscar
		for($i=0;$i<count($a);$i++)	
		{
					
				
				$idban=$a[$i]["id_banco"];	
				/////********************************************egreoss
				
				$fil=self::egresoxban($fecha,$a[$i]["id_banco"]);
				$fil2=self::egreso_ajuste($fecha,$idban);
				$te=0;
				if(count($fil)>0)//egresos
				{
					$te=$te + $fil[0]["valegre"];
					$this->v[$i]["nombreban"]=$a[$i]["nombreban"];
					$this->v[$i]["vienen"]=$a[$i]["saldo"];
					//$this->v[$i]["valegre"]=$fil[0]["valegre"];
					//$this->v[$i]["id_banco"]=$a[$i]["id_banco"];
				}else
					{
						$this->v[$i]["nombreban"]=$a[$i]["nombreban"];
						$this->v[$i]["vienen"]=$a[$i]["saldo"];
						//$this->v[$i]["valegre"]=0;
						//$this->v[$i]["id_banco"]=$a[$i]["id_banco"];
					}
				if(count($fil2) > 0) //egresos de ajustes
				{
					$te=$te + $fil2[0]["valegre"];	
				}
				$this->v[$i]["valegre"]=$te;
				//***************************Ingresos*****************************************
				$ti=0;
				$fin=self::ingresosxban($fecha,$a[$i]["id_banco"]);
				$fin2=self::ingresosrecaja($fecha,$a[$i]["id_banco"]);
				$fin3=self::ingresosajuste($fecha,$a[$i]["id_banco"]);
				if(count($fin)>0) 
				{
					$ti=$ti + $fin[0]["valingre"];
				}	
				if(count($fin2)>0) 
				{
					$ti=$ti + $fin2[0]["valingre"];
				}	
				if(count($fin3) > 0) 
				{
					$ti=$ti + $fin3[0]["valingre"];
				}
				$this->v[$i]["valingre"]=$ti;		
				$this->v[$i]["id_banco"]=$a[$i]["id_banco"];
				$this->v[$i]["cuenta"]=$a[$i]["cuenta"];
		}
		
		return $this->v;
	}
	//************************************************************************************************************************
	public function calnum_bol()
	{
			$conn=parent::con();
			$sql="SELECT MAX(num_boletin) AS can FROM boletines_conse";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cabo=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cabo;
	}
	public function valorcus()
	{
			$conn=parent::con();
			$sql="SELECT valorcustodia FROM custodia where id_custodia = 1";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cus=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cus;
	}
	//***********************grabar Boletin saldos en Bancos****** 
	//Array ( [0] => Array ( [nombreban] => BBVA AHORROS [vienen] => 325186797.00 [valegre] => 0 [valingre] => 0 [id_banco] => 1 )
	public function grabarsaldosban($saldo)
	{
			
		$conn=parent::con();
		$vcusto=($_GET["vcvie"] + $_GET["ingrecus"]) - $_GET["egrecus"];
		$sql="insert  into  boletines
			values
			(null, ?,?,?,?,?,?)";
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $_GET["numbol"],  PDO :: PARAM_INT);
			$gsent->bindValue(2, $_GET["fe"],  PDO :: PARAM_STR);
			$gsent->bindValue(3, $_GET["vcvie"],  PDO :: PARAM_INT);
			$gsent->bindValue(4, $_GET["ingrecus"],  PDO :: PARAM_INT);
			$gsent->bindValue(5, $_GET["egrecus"],  PDO :: PARAM_INT);
			$gsent->bindValue(6, $vcusto,  PDO :: PARAM_INT);
			$gsent->execute();
		//obtener el ultimo id del  boletin creado
		$sql="SELECT MAX(id_boletin) AS id FROM boletines";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$ido=$gsent->fetch(PDO::FETCH_ASSOC);
			
		foreach($saldo as $b)
		{
			$idb=$b["id_banco"];	
			$newsal=($b["vienen"] + $b["valingre"])-$b["valegre"];	
			$sql="update bancos
		         set
		         saldo=?
		         where id_banco = ?";
				$gsent=$conn->prepare($sql);
				$gsent->bindValue(1, $newsal,  PDO :: PARAM_INT);
				$gsent->bindValue(2, $idb,  PDO :: PARAM_INT);
				$gsent->execute();	
			//****************************************detalle de boletines*********************
			$sql="insert  into  boletines_deta
			values
			(null, ?,?,?,?,?,?)";
			$gsent=$conn->prepare($sql);
			$gsent->bindValue(1, $ido["id"],  PDO :: PARAM_INT);
			$gsent->bindValue(2, $idb,  PDO :: PARAM_STR);
			$gsent->bindValue(3, $b["vienen"],  PDO :: PARAM_INT);
			$gsent->bindValue(4, $b["valingre"],  PDO :: PARAM_INT);
			$gsent->bindValue(5, $b["valegre"],  PDO :: PARAM_INT);
			$gsent->bindValue(6, $newsal,  PDO :: PARAM_INT);
			$gsent->execute();
				
		}
		
		
		$sql="update custodia
		         set
		         valorcustodia=?
		         where id_custodia = 1";
				 $gsent=$conn->prepare($sql);
				 $gsent->bindValue(1, $vcusto,  PDO :: PARAM_INT);
				 $gsent->execute();	
		
		$sql="update boletines_conse
		         set
		         num_boletin=?
		         where id_boletin_cons = 1";
				$gsent=$conn->prepare($sql);
				$gsent->bindValue(1, $_GET["numbol"],  PDO :: PARAM_INT);
				$gsent->execute();	
		$conn=null;
				 
		
		$conn=null;
			
	}
	public function grabarsaldosban_men($salmen)
	{
		$conn=parent::con();
		foreach($salmen as $b)
		{
			$idb=$b["id_banco"];	
			$newsal=($b["vienen"] + $b["valingre"])-$b["valegre"];	
			$sql="update bancos
		         set
		         saldo_mes_ante=?
		         where id_banco = ?";
				$gsent=$conn->prepare($sql);
				$gsent->bindValue(1, $newsal,  PDO :: PARAM_INT);
				$gsent->bindValue(2, $idb,  PDO :: PARAM_INT);
				$gsent->execute();	
		}
		$newbol=0;
		$sql="update boletines_conse
		         set
		         num_boletin=?
		         where id_boletin_cons = 1";
				$gsent=$conn->prepare($sql);
				$gsent->bindValue(1, $newbol,  PDO :: PARAM_INT);
				$gsent->execute();	
		$conn=null;
	}
	public function seleboletin()
	{//DAYOFMONTH('1998-02-03');MONTHNAME(fecha) as
		$conn=parent::con();
		$sql="select id_boletin, numboletin, fecha
		 from boletines order by fecha asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
			
				$this->bolefe[]=$fila;
			}
		}
		$conn = null;
		return $this->bolefe;
	}
	public function boletin_id($id)
	{
		$conn=parent::con();
		$sql="select id_boletin, numboletin, fecha, custodia_vien, custodia_ing, custodia_egre, custodia_pasan
		 from boletines  where id_boletin = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bindValue(1, $id,  PDO :: PARAM_INT);
		$stmt->execute();
		$bole=$stmt->fetch(PDO::FETCH_ASSOC);
		$conn = null;
		return $bole;
	}
	public function buscdeta_boletin($id)
	{
		$dbh=parent::con();
		$sql="SELECT a.id_boletin, a.id_banco, b.nombreban, b.cuenta, a.vienen, a.ingresos, a.egresos, a.saldo_pasa 
			      FROM boletines_deta a inner join bancos b on a.id_banco = b.id_banco
			      where a.id_boletin = ? ";
			$gsent = $dbh->prepare($sql);	
			$gsent->bindValue(1, $id,  PDO :: PARAM_INT);
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->detbol[]=$fila;
						
			}
			 
			$dbh = null;
			return $this->detbol;
	}   
}
?>