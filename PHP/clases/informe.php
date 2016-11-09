<?php
require_once"AccesoDatos.php";
class informe
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
	public $localidad;
	public $direccion;
 	public $empleado;
 	public $puno;
 	public $pdos;
 	public $ptres;
 	public $pcuatro;
 	public $porcentaje;
	public $fecha;

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
	public function GetEmpleado()
	{
		return $this->empleado;
	}
	public function GetPuno()
	{
		return $this->puno;
	}
	public function GetPdos()
	{
		return $this->pdos;
	}
	public function GetTres()
	{
		return $this->ptres;
	}
	public function GetCuatro()
	{
		return $this->pcuatro;
	}
	public function GetPorcentaje()
	{
		return $this->porcentaje;
	}
	public function GetFecha()
	{
		return $this->fecha;
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
	public function SetEmpleado($valor)
	{
		$this->empleado = $valor;
	}
	public function SetPuno($valor)
	{
		$this->puno = $valor;
	}
	public function SetPdos($valor)
	{
		$this->pdos = $valor;
	}
	public function SetPtres($valor)
	{
		$this->ptres = $valor;
	}
	public function SetPcuatro($valor)
	{
		$this->pcuatro = $valor;
	}
	public function SetPorcentaje($valor)
	{
		$this->porcentaje = $valor;
	}
	public function SetFecha($valor)
	{
		$this->fecha = $valor;
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
			$this->empleado = $obj->empleado;
			$this->puno = $obj->puno;
			$this->pdos = $obj->pdos;
			$this->ptres = $obj->ptres;
			$this->pcuatro = $obj->pcuatro;
			$this->porcentaje = $obj->porcentaje;
			$this->fecha = $obj->fecha;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->nombre."-".$this->localidad."-".$this->direccion."-".$this->empleado."-".$this->puno."-".$this->pdos."-".$this->ptres."-".$this->pcuatro."-".$this->porcentaje."-".$this->fecha;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnInforme($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM informe WHERE id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnProducto(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$informeBuscado= $consulta->fetchObject('informes');
		return $informeBuscado;	
					
	}
	
	public static function TraerTodosLosInformes()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM informe");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasProductos() ");
		$consulta->execute();			
		$arrInformes= $consulta->fetchAll(PDO::FETCH_CLASS, "informe");	
		return $arrInformes;
	}

	public static function TraerInformesPorSucursal()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM informe ORDER BY nombre");
		$consulta->execute();			
		$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "informe");	
		return $arrPersonas;
	}
	
	public static function BorrarInforme($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM informe	WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarProducto(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarInforme($informe)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE informe set nombre=:nombre,localidad=:localidad,direccion=:direccion,empleado=:empleado,puno=:puno,pdos=:pdos,ptres=:ptres,pcuatro=:pcuatro,porcentaje=:porcentaje,fecha=:fecha WHERE id=:id");
			$consulta->bindValue(':id',$informe->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$informe->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':localidad',$informe->localidad, PDO::PARAM_STR);
			$consulta->bindValue(':direccion', $informe->direccion, PDO::PARAM_STR);
			$consulta->bindValue(':empleado', $informe->empleado, PDO::PARAM_STR);
			$consulta->bindValue(':puno', $informe->puno, PDO::PARAM_STR);
			$consulta->bindValue(':pdos', $informe->pdos, PDO::PARAM_STR);
			$consulta->bindValue(':ptres', $informe->ptres, PDO::PARAM_STR);
			$consulta->bindValue(':pcuatro', $informe->pcuatro, PDO::PARAM_STR);
			$consulta->bindValue(':porcentaje', $informe->porcentaje, PDO::PARAM_INT);
			$consulta->bindValue(':fecha', $informe->fecha, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarInforme($informe)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into informe (nombre,localidad,direccion,empleado,puno,pdos,ptres,pcuatro,porcentaje,fecha)values(:nombre,:localidad,:direccion,:empleado,:puno,:pdos,:ptres,:pcuatro,:porcentaje,:fecha)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarlocal (:nombre,:apellido,:dni,:foto)");
		$consulta->bindValue(':nombre',$informe->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':localidad',$informe->localidad, PDO::PARAM_STR);				
		$consulta->bindValue(':direccion', $informe->direccion, PDO::PARAM_STR);
		$consulta->bindValue(':empleado', $informe->empleado, PDO::PARAM_STR);
		$consulta->bindValue(':puno', $informe->puno, PDO::PARAM_STR);
		$consulta->bindValue(':pdos', $informe->pdos, PDO::PARAM_STR);
		$consulta->bindValue(':ptres', $informe->ptres, PDO::PARAM_STR);
		$consulta->bindValue(':pcuatro', $informe->pcuatro, PDO::PARAM_STR);
		$consulta->bindValue(':porcentaje', $informe->porcentaje, PDO::PARAM_INT);
		$consulta->bindValue(':fecha', $informe->fecha, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}		


}
