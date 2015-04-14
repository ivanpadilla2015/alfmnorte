<?php
class Usuarios extends Conectar
{
	private $item=array();	
	public function salir()
	{
		session_destroy();
		header("location:".Conectar::ruta()."?accion=index&m=3");exit;
	}
	public function logueo()
	{
		//print_r($_POST);
		if(empty($_POST["login"]) or empty($_POST["pass"]))
		{
			
			header("location:".Conectar::ruta()."?accion=index&m=1");exit;
		}
		$dbh=parent::con();
		$sql="select id_usuario, nombre, id_tipo from usuarios where login=? and pass=?";
		$stmt=$dbh->prepare($sql);
		if($stmt->execute(array($_POST["login"],$_POST["pass"])))
		{
			
			if($fila=$stmt->fetch())
			{
			   $_SESSION["ses_id"]=$fila["id_usuario"];
			   $_SESSION["ses_login"]=$_POST["login"];
			   $_SESSION["ses_nombre"]=$fila["nombre"];
			   $_SESSION["ses_tipo"]=$fila["id_tipo"];
			   header("location:".Conectar::ruta()."?accion=home");exit;
			}else
			{
				header("location:".Conectar::ruta()."?accion=index&m=2");exit;
			}  
		}
		
		$dbh = null;
	}
	public function contratos_saldos()
	{
		$dbh=parent::con();
		$sql="SELECT id_contrato,num_contrato,valorcontrato,registro_pres_inic,fechacontrato,tipos_contratos.nombretipo, proveedores.nombre,
		           dependencias.nombre_depen,  saldo, valoranticipo, valoradicion
		            FROM contratos, proveedores, tipos_contratos,dependencias
					WHERE contratos.saldo >0
					AND contratos.id_tipo_contrato = tipos_contratos.id_tipo_contrato
					AND contratos.id_proveedor = proveedores.id_proveedor 
					AND contratos.id_dependencia=dependencias.id_dependencia
					ORDER BY id_contrato DESC";
		foreach($dbh->query($sql) as $fila)
		{
				$this->item[]=$fila;
		}
		//print_r($this->item) ;
		$dbh = null;
		return $this->item;
	}
	
}	

?>


