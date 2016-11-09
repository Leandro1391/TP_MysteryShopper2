<?php 


require_once("clases/usuario.php");
// $_GET['accion'];
if ( !empty( $_FILES ) ) 
{
    $temporal = $_FILES[ 'file' ][ 'tmp_name' ];
    $ruta = "..". DIRECTORY_SEPARATOR . 'imagenes' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $temporal, $ruta );
    echo "correcto";
}
if(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	if($accion=="traer")
	{
		$respuesta= array();
		//$respuesta['listado']=Persona::TraerPersonasTest();
		$respuesta['listado']=Usuario::TraerTodosLosUsuarios();
		//var_dump(Persona::TraerTodasLasPersonas());
		$arrayJson = json_encode($respuesta);
		echo  $arrayJson;
	}


	

}
else{

	$DatosPorPost = file_get_contents("php://input");
	$respuesta = json_decode($DatosPorPost);
	var_dump($respuesta);
	switch($respuesta->datos->accion)
	{
		case "borrar":
		{
			if($respuesta->datos->usuario->foto!="pordefecto.png")
			{
				unlink("../imagenes/".$respuesta->datos->usuario->foto);
			}
			Usuario::BorrarUsuario($respuesta->datos->usuario->id);
			break;
		}
		case "insertar":
		{
			if($respuesta->datos->usuario->foto!="pordefecto.png")
			{
				$rutaVieja="../imagenes/".$respuesta->datos->usuario->foto;
				$rutaNueva=$respuesta->datos->usuario->dni.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
				copy($rutaVieja, "../imagenes/".$rutaNueva);
				unlink($rutaVieja);
				$respuesta->datos->usuario->foto=$rutaNueva;
			}
			Usuario::InsertarUsuario($respuesta->datos->usuario);
			break;
		}
		case "buscar":
		{
			echo json_encode(Usuario::TraerUnUsuario($respuesta->datos->id));
			break;
		}
		case "modificar":
		{
			if($respuesta->datos->usuario->foto!="pordefecto.png")
			{
				$rutaVieja="../imagenes/".$respuesta->datos->usuario->foto;
				$rutaNueva=$respuesta->datos->usuario->dni.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
				copy($rutaVieja, "../imagenes/".$rutaNueva);
				unlink($rutaVieja);
				$respuesta->datos->usuario->foto=$rutaNueva;
			}
			Usuario::ModificarUsuario($respuesta->datos->usuario);
			break;
		}
		case "insertarUsuario":
		{
			$usuario=new Usuario(0, $respuesta->datos->usuario->mail, $respuesta->datos->usuario->nombre, $respuesta->datos->usuario->clave, "user");
			$usuario->InsertarUsuario();
			break;
		}
		case "buscarUsuario":
		{
			echo json_encode(Usuario::BuscarUsuario($respuesta->datos->id));
			break;
		}
		case "modificarUsuario":
		{
			$usuario=new Usuario($respuesta->datos->usuario->id, $respuesta->datos->usuario->correo, $respuesta->datos->usuario->nombre, $respuesta->datos->usuario->clave, "user");
			$usuario->ModificarUsuario();
			break;
		}
	}
	

	


	//echo $respuesta->datos->persona->nombre;

	


}




 ?>