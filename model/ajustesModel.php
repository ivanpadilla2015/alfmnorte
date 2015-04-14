<?php 
class ajustes extends Conectar
{
	private $tipos=array();
	private $bancs=array();
	private $funs=array();
	
	public function add_ajustes()
	{
		$dbh=parent::con();
		$sql="insert into  ajustes
		values
		(null,?,?,?,?,?,?,?)";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["num"],  PDO :: PARAM_INT);
		$gsent->bindValue(2, $_POST["fe"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["deta"], PDO :: PARAM_STR);
	    $gsent->bindValue(4, $_POST["idban"], PDO :: PARAM_INT);
		$gsent->bindValue(5, $_POST["valo"], PDO :: PARAM_INT);
		$gsent->bindValue(6, $_POST["idusu"], PDO :: PARAM_INT);
		$gsent->bindValue(7, $_POST["tipo"], PDO :: PARAM_INT);
		$gsent->execute();
		$dbh=null;
		header("location:".Conectar::ruta()."?accion=crearajustes&m=2");exit;
		
	}
	
	public function listabancos()
	{
		$conn=parent::con();
		$sql="select id_banco, nombreban, cuenta from bancos order by nombreban asc";
		$stmt=$conn->prepare($sql);
		if ($stmt->execute())
		{
			
			while($fila=$stmt->fetch())
			{
			
				$this->bancs[]=$fila;
			}
		}
		$conn = null;
		return $this->bancs;
	}
	
	public function bustipo_aj()
	{
		$conn=parent::con();
	    $sql="SELECT Nom_Tipo_Ajuste, id_tipo_a  FROM tipo_ajuste";
		$stmt = $conn->prepare($sql);	
		if ($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->tipos[]=$fila;
			}
		}
		$dbh = null;
		return $this->tipos;
		
	}
	
	public function busfuncio()
	{
		$conn=parent::con();
	    $sql="SELECT id_funcionario, nombre_func  FROM funcionarios";
		$stmt = $conn->prepare($sql);	
		if ($stmt->execute())
		{
			while($fila=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->funs[]=$fila;
			}
		}
		$dbh = null;
		return $this->funs;
		
	}
	
	public function calnum_ajuste() //devuelve el ultimo numero egreso
	{
			$conn=parent::con();
			$sql="SELECT MAX(numajuste) AS can FROM ajustes";
			$gsent = $conn->prepare($sql);	
			$gsent->execute();
			$cain=$gsent->fetch(PDO::FETCH_ASSOC);
			return $cain;
	}
	public function ajuste_pornum($num)
	{
		$conn=parent::con();
		$sql="select a.id_ajuste, a.numajuste, a.fecha_ajuste, a.detajuste, a.id_banco, b.nombreban, b.cuenta, a.valor_ajuste, a.id_funcionario, f.nombre_func
		      from ajustes a, bancos b, funcionarios f  
		      where numajuste=? 
		      AND a.id_banco=b.id_banco
		      AND a.id_funcionario=f.id_funcionario";
		$gsent = $conn->prepare($sql);		
		$gsent->bindParam(1, $num, PDO::PARAM_INT);
		$gsent->execute();
		if($fila=$gsent->fetch(PDO::FETCH_ASSOC))
		$conn=null;
		return $fila;
	}
	
	
	
	
}
?>