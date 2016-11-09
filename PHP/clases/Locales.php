<?php
require_once"AccesoDatos.php";
class Locales
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
	public $localidad;
	public $direccion;
	public $gerente;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetLocalidad()
	{
		return $this->localidad;
	}
	public function GetDireccion()
	{
		return $this->direccion;
	}
	public function GetGerente()
	{
		return $this->gerente;
	}
	

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetLocalidad($valor)
	{
		$this->localidad = $valor;
	}
	public function SetDireccion($valor)
	{
		$this->direccion = $valor;
	}
	public function SetGerente($valor)
	{
		$this->gerente = $valor;
	}
	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Producto::TraerUnLocal($id);

			$this->id = $id;		
			$this->nombre = $obj->nombre;
			$this->localidad = $obj->localidad;
			$this->direccion = $obj->direccion;
			$this->gerente = $obj->gerente;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->nombre."-".$this->localidad."-".$this->direccion."-".$this->gerente;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnLocal($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mislocales WHERE id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnProducto(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$productoBuscado= $consulta->fetchObject('locales');
		return $productoBuscado;	
					
	}
	
	public static function TraerTodosLosLocales()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mislocales");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasProductos() ");
		$consulta->execute();			
		$arrLocales= $consulta->fetchAll(PDO::FETCH_CLASS, "locales");	
		return $arrLocales;
	}
	
	public static function BorrarLocal($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM mislocales	WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarProducto(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarLocal($local)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto 
				set nombre=:nombre,
				apellido=:apellido,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarProducto(:dni,:nombre,:apellido,:foto)");
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mislocales set nombre=:nombre,localidad=:localidad,direccion=:direccion,gerente=:gerente WHERE id=:id");
			$consulta->bindValue(':id',$local->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$local->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':localidad',$local->localidad, PDO::PARAM_STR);
			$consulta->bindValue(':direccion', $local->direccion, PDO::PARAM_STR);
			$consulta->bindValue(':gerente', $local->gerente, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarLocal($local)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mislocales (nombre,localidad,direccion,gerente)values(:nombre,:localidad,:direccion,:gerente)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarlocal (:nombre,:apellido,:dni,:foto)");
		$consulta->bindValue(':nombre',$local->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':localidad',$local->localidad, PDO::PARAM_STR);				
		$consulta->bindValue(':direccion', $local->direccion, PDO::PARAM_STR);
		$consulta->bindValue(':gerente', $local->gerente, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//



	// public static function TraerProductosTest()
	// {
	// 	$arrayDeProductos=array();

	// 	$producto = new stdClass();
	// 	$producto->id = "4";
	// 	$producto->nombre = "rogelio";
	// 	$producto->apellido = "agua";
	// 	$producto->dni = "333333";
	// 	$producto->foto = "333333.jpg";

	// 	//$objetJson = json_encode($producto);
	// 	//echo $objetJson;
	// 	$persona2 = new stdClass();
	// 	$persona2->id = "5";
	// 	$persona2->nombre = "Bañera";
	// 	$persona2->apellido = "giratoria";
	// 	$persona2->dni = "222222";
	// 	$persona2->foto = "222222.jpg";

	// 	$persona3 = new stdClass();
	// 	$persona3->id = "6";
	// 	$persona3->nombre = "Julieta";
	// 	$persona3->apellido = "Roberto";
	// 	$persona3->dni = "888888";
	// 	$persona3->foto = "888888.jpg";

	// 	$arrayDeProductos[]=$producto;
	// 	$arrayDeProductos[]=$persona2;
	// 	$arrayDeProductos[]=$persona3;
		 
		

	// 	return  $arrayDeProductos;
				
	// }	


}
