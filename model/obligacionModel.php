<?php 
class obligacion extends Conectar
{
	private $obli=array();
	private $funcio=array();
	
	
	public function add_obligacion()
	{
		
		if (empty($_POST["id_contra"]) or empty($_POST["fecha"]) or empty($_POST["funciona"]))
		{
			     header("location: ".Conectar::ruta()."?accion=obligacion");exit;
		}
		//print_r($_POST);exit;
		$dbh=parent::con();
		$sql="insert  into  obligacion(id_obligacion, detalle, id_contrato, fechaobliga, id_funcionario)
		values
		(null, ?, ?, ?, ?)"; // cuando se coloca solo los values no graba el registro
		$tot=0;
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["deta"],  PDO :: PARAM_STR);
		$gsent->bindValue(2, $_POST["id_contra"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["fecha"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["funciona"], PDO :: PARAM_INT);
		/*$gsent->bindValue(5, $tot, PDO :: PARAM_INT);
		$gsent->bindValue(6, $tot, PDO :: PARAM_INT);
		$gsent->bindValue(7, $tot, PDO :: PARAM_INT);*/
	    $gsent->execute();
		$dbh=null;
		header("location:".Conectar::ruta()."?accion=obligacion&m=2");exit;
		
	}
	
	public function editarproveedor_por_id($id)
	{
		if (isset($_GET["id"]))	
		{
			
				$dbh=parent::con();
				$sql="select * from proveedores where id_proveedor=?";
				$stmt=$dbh->prepare($sql);
				if ($stmt->execute(array($id)))
				{
				  if($fila=$stmt->fetch())
					{
						    $this->proid[]=$fila;
					}
					return $this->proid;
					$dbh=null;
				}
			}
		
		}
		
	
	public function numcontrato()
	{
		$dbh=parent::con();
		$sql="select  c.id_contrato, c.num_contrato, p.nombre from contratos c, proveedores p   where c.id_proveedor=p.id_proveedor ";
		foreach($dbh->query($sql) as $fila)
		{
				$this->obli[]=$fila;
		}
		$dbh = null;
		return $this->obli;
	}
	public function funcionario()
	{
		$dbh=parent::con();
		$sql="select id_funcionario, nombre_func from funcionarios ";
		foreach($dbh->query($sql) as $fila)
		{
			$this->funcio[]=$fila;
		}
		$dbh = null;
		return $this->funcio;
	}
	
	
	
}
?>