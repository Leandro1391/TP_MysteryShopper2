<?php
require_once"AccesoDatos.php";
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $correo;
 	public $nombre;
  	public $clave;
  	public $tipo;
  	public $foto;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetCorreo()
	{
		return $this->correo;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetClave()
	{
		return $this->clave;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetCorreo($valor)
	{
		$this->correo = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetClave($valor)
	{
		$this->clave = $valor;
	}
	public function SetTipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Padron::TraerUnUsuario($id);
			
			$this->id = $id;
			$this->correo = $obj->correo;
			$this->nombre = $obj->nombre;
			$this->clave = $obj->clave;
			$this->tipo = $obj->tipo;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->id."-".$this->correo."-".$this->nombre."-".$this->clave."-".$this->tipo."-".$this->foto;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnUsuario($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios where id =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPadron(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$usuarioBuscado= $consulta->fetchObject('usuario');
		return $usuarioBuscado;	
					
	}
	
	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM misusuarios");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodosLosPadrones() ");
		$consulta->execute();			
		$arrUsuarios= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
		return $arrUsuarios;
	}
	
	public static function BorrarUsuario($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM misusuarios	WHERE id=:id");	
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPadron(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarUsuario($usuario)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update misusuarios 
				set correo=:correo,
				nombre=:nombre,
				clave=:clave,
				tipo=:tipo,
				foto=:foto
				WHERE id=:id");
			//$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			//$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarUsuario(:id,:dni,:sexo,:fecha,:partido,:foto)");
			$consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
			$consulta->bindValue(':correo',$usuario->correo, PDO::PARAM_STR);
			$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
			$consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':foto', $usuario->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarUsuario($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO misusuarios (correo,nombre,clave,tipo,foto)values(:correo,:nombre,:clave,:tipo,:foto)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarUsuario (:correo,:nombre,:clave,:tipo,:foto)");
		$consulta->bindValue(':correo',$usuario->correo, PDO::PARAM_STR);
		$consulta->bindValue(':nombre', $usuario->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
		$consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $usuario->foto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//



	public static function TraerPadronTest()
	{
		$arrayDePadron=array();

		$padron = new stdClass();
		$padron->id = "4";
		$padron->nombre = "rogelio";
		$padron->apellido = "agua";
		$padron->dni = "333333";
		$padron->foto = "333333.jpg";

		//$objetJson = json_encode($padron);
		//echo $objetJson;
		$padron2 = new stdClass();
		$padron2->id = "5";
		$padron2->nombre = "Bañera";
		$padron2->apellido = "giratoria";
		$padron2->dni = "222222";
		$padron2->foto = "222222.jpg";

		$padron3 = new stdClass();
		$padron3->id = "6";
		$padron3->nombre = "Julieta";
		$padron3->apellido = "Roberto";
		$padron3->dni = "888888";
		$padron3->foto = "888888.jpg";

		$arrayDePersonas[]=$padron;
		$arrayDePersonas[]=$padron2;
		$arrayDePersonas[]=$padron3;
		 
		

		return  $arrayDePadron;
				
	}	


}
