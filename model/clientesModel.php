<?php 
class clientes extends Conectar
{
	private $cli=array();
	
	
	/*public function edit_proveedor()
	{
		if (empty($_POST["nit"]) or empty($_POST["nom"]) or empty($_POST["tel"]))
		{
			     header("location: ".Conectar::ruta()."?accion=editarproveedor&m=1&id=".$_POST["id"]);exit;
		}
		$dbh=parent::con();
		$sql="update  proveedores
		set
		nombre=?, nitproveedor=?, digver=?, correo=?, telefono=?, direccion=?, Reprelegal=?, contacto=?,
		Cuenta=?, id_tipo_per=?, id_tipo_reten=?
		where id_proveedor=?";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["nom"],  PDO :: PARAM_STR);
		$gsent->bindValue(2, $_POST["nit"], PDO :: PARAM_INT);
		$gsent->bindValue(3, $_POST["digv"], PDO :: PARAM_INT);
		$gsent->bindValue(4, $_POST["correo"], PDO :: PARAM_STR);
	    $gsent->bindValue(5, $_POST["tel"], PDO :: PARAM_STR);
		$gsent->bindValue(6, $_POST["direcion"], PDO :: PARAM_STR);
		$gsent->bindValue(7, $_POST["repreleg"], PDO :: PARAM_STR);	
		$gsent->bindValue(8, $_POST["contacto"], PDO :: PARAM_STR);
		$gsent->bindValue(9, $_POST["cuenta"], PDO :: PARAM_STR);
		$gsent->bindValue(10, $_POST["tipoper"], PDO :: PARAM_INT);
	    $gsent->bindValue(11, $_POST["tiporete"], PDO :: PARAM_INT);
	     $gsent->bindValue(12, $_POST["id"], PDO :: PARAM_INT);
		$gsent->execute();
		$dbh=null;
		 header("location: ".Conectar::ruta()."?accion=editarproveedor&m=2&id=".$_POST["id"]);exit;
	}
	 * 
	 */
	public function add_cliente()
	{
		$dbh=parent::con();
		$sql="insert into  cliente_cartera
		values
		(null, ?, ?, ?, ?)";
		$gsent=$dbh->prepare($sql);
		$gsent->bindValue(1, $_POST["nom"],  PDO :: PARAM_STR);
		$gsent->bindValue(2, $_POST["tel"], PDO :: PARAM_STR);
		$gsent->bindValue(3, $_POST["direc"], PDO :: PARAM_STR);
		$gsent->bindValue(4, $_POST["iden"], PDO :: PARAM_INT);
	    
		$gsent->execute();
		$dbh=null;
		header("location:".Conectar::ruta()."?accion=crearclientes&m=2");exit;
		
	}
	
	public function buscarcliente($bus)
	{
			$conn=parent::con();
	    	$sql="SELECT identifica, id_cliente  FROM cliente_cartera where identifica=?";
			$gsent = $conn->prepare($sql);	
			$gsent->bindParam(1, $bus, PDO::PARAM_INT);
			$gsent->execute();
			if($gsent->fetch(PDO::FETCH_ASSOC))
			{
				$encon="Error, Cliente Ya Existe";
			}else
			{
				$encon="OK";
			}    
			return $encon;
		
		}
	
	/*public function editarproveedor_por_id($bus)
	{
		if (isset($_GET["bus"]))	
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
		
		
	public function tipoper()
	{
		$dbh=parent::con();
		$sql="select * from tipo_persona ";
		foreach($dbh->query($sql) as $fila)
		{
				$this->per[]=$fila;
		}
		$dbh = null;
		return $this->per;
	}
	public function tiporete()
	{
		$dbh=parent::con();
		$sql="select * from tipo_reten ";
		foreach($dbh->query($sql) as $fila)
		{
				$this->per2[]=$fila;
		}
		$dbh = null;
		return $this->per2;
	}
	public function listarpro()
	{
		$dbh=parent::con();
		$sql="select * from proveedores order by nombre asc";
		foreach($dbh->query($sql) as $fila)
		{
				$this->pro[]=$fila;
		}
		$dbh = null;
		return $this->pro;
	}
	*/
	
}
?>