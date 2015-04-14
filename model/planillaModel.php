<?php

class planillas extends Conectar 
{
	private $ban=array();
	private $vpla=array();
	private $cpla=array();
	private $dtap=array();
	private $cue=array();
	private $fun=array();
	private $tpla=array();
	private $vige=array();
	
	public function addplanilla()
	{
		$conn=parent::con();
		$sql="insert  into  planillas(id_planilla, numplanilla, fecha)
		values
		(null, ?,?)"; // cuando se coloca solo los values no graba el registro
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["nump"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fep"], PDO :: PARAM_STR);
		$gsent->execute();
			/***************************obtener el id creado para la planilla*******************************/
		$sql="SELECT MAX(id_planilla) AS id FROM planillas";
		$gsent = $conn->prepare($sql);	
		$gsent->execute();
		$ido=$gsent->fetch(PDO::FETCH_ASSOC);
		$conn=null;
		header("location:".Conectar::ruta()."?accion=crearplanilladeta&nupla=$ido[id]&fe=$_POST[fep]");exit;
	}
	 public function calnumpla()
	{
			$conn=parent::con();
			$sql="SELECT MAX(numplanilla) AS can FROM planillas";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cap=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cap;
	}
	public function addplanilladeta()
	{
		
		$conn=parent::con();
		//, id_banco, fechadeta, valordeta
		$sql="insert  into planilladeta(id_detaplanilla, id_planilla, id_banco, fechadeta, valordeta)
		values
		(null,?,?,?,?)"; // cuando se coloca solo los values no graba el registro
		$gsent=$conn->prepare($sql);
		$gsent->bindValue(1, $_POST["id"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["ban"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["fe"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["va"], PDO :: PARAM_INT);
		$gsent->execute();
		/****************************************************/
		 $tp=self::totalplanilla();
		/***************************************************/
		$sql="update planillas
				         set
				         valorplanilla=?
				         where id_planilla=?";
						 $gsent=$conn->prepare($sql);
						 $to=$tp["total"]+$_POST["va"];
				         $gsent->bindValue(1, $to, PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["id"], PDO :: PARAM_INT);
						 $gsent->execute();
		
		$conn=null;
		//header("location:".Conectar::ruta()."?accion=crearplanilladeta&nupla=$ido[id]&fe=$_POST[fep]");exit;
	}
	public function verplanxid()
	{
		$conn=parent::con();
		$sql="select p.id_detaplanilla, p.id_planilla, p.id_banco, p.fechadeta, p.valordeta, b.nombreban
		          from planilladeta p, bancos b
		          where p.id_planilla=? and p.id_banco=b.id_banco order by id_detaplanilla";
		$gsent=$conn->prepare($sql);
		$gsent->bindParam(1, $_POST["id"], PDO::PARAM_INT);
		$gsent->execute();
			while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
					$this->vpla[]=$fils;
				}
		$conn=null;
		return $this->vpla;
	}
	public function listado_banco()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta from bancos order by nombreban asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->ban[]=$fila;
			}
		}
		$conn = null;
		return $this->ban;
	}
	public function eliminar_deta_plan()
		{
			$conn=parent::con();
			$sql="delete from planilladeta where id_detaplanilla=?";
			$gsent=$conn->prepare($sql);
		    $gsent->bindParam(1,$_GET["idd"]);
			$gsent->execute();
			/****************************************************/
		 $tp=self::totalplanilla();
		/***************************************************/
		$sql="update planillas
				         set
				         valorplanilla=?
				         where id_planilla=?";
						 $gsent=$conn->prepare($sql);
						 $to=$tp["total"]-$_POST["va"];
				         $gsent->bindValue(1, $to, PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["id"], PDO :: PARAM_INT);
						 $gsent->execute();
			$conn=null;
			//header("location: controller/opagosdetagraController.php&id=$_GET[idop]");exit;
			
		}
		public function totalplanilla()
			{
		    	$conn=parent::con();
		    	$sql="SELECT valorplanilla AS total  FROM planillas  where id_planilla=?";
				$gsent = $conn->prepare($sql);	
				$gsent->bindParam(1, $_POST["id"], PDO::PARAM_INT);
				$gsent->execute();
				$totalp=$gsent->fetch(PDO::FETCH_ASSOC);    
				$conn=null;
				return $totalp;
		    }
		
		public function listadoplanilla()
		{
			$conn=parent::con();
			$sql="select id_planilla, numplanilla, fecha, valorplanilla
			         from planillas  where legalizada=0 order by id_planilla DESC";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->cpla[]=$fila;
			}
			$conn=null;
			return $this->cpla;
		}
		public function todaslasplanillas()
		{
			$conn=parent::con();
			$sql="select id_planilla, numplanilla, fecha, valorplanilla, legalizada
			         from planillas  order by id_planilla DESC";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->tpla[]=$fila;
			}
			$conn=null;
			return $this->tpla;
		}
	//*************************************************************/
	    public function versilegal($idp)
		{
			$conn=parent::con();
			$sql="select id_detaplanilla, id_planilla, id_cuenta
		          from planilladeta 
		          where id_planilla=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $idp, PDO::PARAM_INT);
			$gsent->execute();
			$c=0;
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					if($fila["id_cuenta"]<1)
					{
						 $c++;
						 break ;  /* Sale del if y del while.*/
					}
					
			}
			$conn=null;
			return $c;
		}	
		/*************detalle de planilla para cartera***************************************/
		public function detaplaxid($idp)
		{
		$conn=parent::con();
		$sql="select p.id_detaplanilla, p.id_planilla, p.id_banco, p.fechadeta, p.valordeta, b.nombreban,
		          p.id_cuenta, p.concepto, p.id_funcionario
		          from planilladeta p, bancos b
		          where p.id_planilla=? and p.id_banco=b.id_banco order by id_detaplanilla";
		$gsent=$conn->prepare($sql);
		$gsent->bindParam(1, $idp, PDO::PARAM_INT);
		$gsent->execute();
			while($fils=$gsent->fetch(PDO::FETCH_ASSOC))
				{
					$this->dtap[]=$fils;
				}
		$conn=null;
		return $this->dtap;
	   }
	  /*****************************************************************************/ 
	   public function allcuentas()
	   {
	   	$conn=parent::con();
		$sql="select id_cuenta, codigo, nombrecuenta from cuentas";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->cue[]=$fila;
					
			}
			$conn=null;
			return $this->cue;
		}
	   public function allfuncionario()
	   {
	   	$conn=parent::con();
		$sql="select id_funcionario, nombre_func from funcionarios";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->fun[]=$fila;
					
			}
			$conn=null;
			return $this->fun;
		}
		//***************************************************************************************
		public function grabar_deta_pla()
		{ 
			$conn=parent::con();
			$sql="update planilladeta
				         set
				         id_cuenta=?,
				         concepto=?,
				         id_funcionario=?
				         where id_detaplanilla=?";
						 $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1, $_POST["cuen"], PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["conc"], PDO :: PARAM_STR);
						 $gsent->bindValue(3, $_POST["fun"], PDO :: PARAM_INT);
						 $gsent->bindValue(4, $_POST["ideta"], PDO :: PARAM_INT);
						 $gsent->execute(); 
			$sql="SELECT id_valo  FROM deta_valores where id_detaplanilla=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $_POST["ideta"], PDO::PARAM_INT);
			$gsent->execute();
			$ndet=$gsent->fetch(PDO::FETCH_ASSOC);
				
			if($ndet["id_valo"]>0)
			{
				$sql="update deta_valores
				         set
				         id_cuenta=?,
				         concepto=?,
				         merc1=?,
				         iva1=?,
				         merc2=?,
				         iva2=?,
				         merc0=?,
				         concesion=?,
				         total=?,
				         acta=?
				         where id_detaplanilla=?";
						 $gsent=$conn->prepare($sql);
						 $gsent->bindValue(1, $_POST["cuen"], PDO :: PARAM_INT);
						 $gsent->bindValue(2, $_POST["conc"], PDO :: PARAM_STR);
						 $gsent->bindValue(3, $_POST["m16"], PDO :: PARAM_STR);
						 $gsent->bindValue(4, $_POST["iva16"], PDO :: PARAM_INT);
						 $gsent->bindValue(5, $_POST["m5"], PDO :: PARAM_INT);
						 $gsent->bindValue(6, $_POST["iva5"], PDO :: PARAM_INT);
						 $gsent->bindValue(7, $_POST["mno"], PDO :: PARAM_INT);
						 $gsent->bindValue(8, $_POST["vconc"], PDO :: PARAM_INT);
						 $gsent->bindValue(9, $_POST["tota"], PDO :: PARAM_INT);
						 $gsent->bindValue(10, $_POST["acta"], PDO :: PARAM_STR);
						 $gsent->bindValue(11, $_POST["ideta"], PDO :: PARAM_INT);
						 $gsent->execute(); 
						 
			}else
				{
						
					$sql="insert  into deta_valores(id_valo,id_detaplanilla, id_planilla, id_cuenta, merc1, iva1,
					       merc2, iva2, merc0, concesion, total, acta)
					values
					(null,?,?,?,?,?,?,?,?,?,?,?)";
							 $gsent=$conn->prepare($sql);
							 $gsent->bindValue(1, $_POST["ideta"], PDO :: PARAM_INT);
							 $gsent->bindValue(2, $_POST["plaid"], PDO :: PARAM_INT);
							 $gsent->bindValue(3, $_POST["cuen"], PDO :: PARAM_INT);
							 $gsent->bindValue(4, $_POST["m16"], PDO :: PARAM_STR);
							 $gsent->bindValue(5, $_POST["iva16"], PDO :: PARAM_INT);
							 $gsent->bindValue(6, $_POST["m5"], PDO :: PARAM_INT);
							 $gsent->bindValue(7, $_POST["iva5"], PDO :: PARAM_INT);
							 $gsent->bindValue(8, $_POST["mno"], PDO :: PARAM_INT);
							 $gsent->bindValue(9, $_POST["vconc"], PDO :: PARAM_INT);
							 $gsent->bindValue(10, $_POST["tota"], PDO :: PARAM_INT);
							 $gsent->bindValue(11, $_POST["acta"], PDO :: PARAM_STR);
							 $gsent->execute(); 
			}    
		$conn=null;
		header("location:".Conectar::ruta()."?accion=legalizapla_deta&plaid=$_POST[plaid]");exit;
		}
		//******************************************************************************************
		public function cons_ultima()
		{
			$conn=parent::con();
			$sql="SELECT MAX(id_planilla) AS pla FROM planillas";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$np1=$gsent->fetch(PDO::FETCH_ASSOC);
			return $np1;
		}
		public function ultima_numpla()
		{
			$tpl=self::cons_ultima();
			$idp1=$tpl["pla"];	
			$conn=parent::con();
			$sql="SELECT numplanilla as can  FROM planillas where id_planilla=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $idp1, PDO::PARAM_INT);
			$gsent->execute();
			$ncap=$gsent->fetch(PDO::FETCH_ASSOC);
			return $ncap;
		}
		public function all_vigencia()
		{
			$conn=parent::con();
			$sql="SELECT * FROM vigencia";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			while($fila=$gsent->fetch(PDO::FETCH_ASSOC))
			{
					$this->vige[]=$fila;
					
			}
			$conn=null;
			return $this->vige;
		}
		
}


?>