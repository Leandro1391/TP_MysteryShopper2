<?php 

include "clases/Locales.php";
// $_GET['accion'];


if ( !empty( $_FILES ) ) {
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    // $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    $uploadPath = "../". DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );
    $answer = array( 'respuesta' => 'Archivo Cargado!' );
    $json = json_encode( $answer );
    echo $json;
}elseif(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	if($accion=="traer")
	{
		$respuesta= array();
		//$respuesta['listado']=Persona::TraerPersonasTest();
		$respuesta['listado']=Locales::TraerTodosLosLocales();
		//$respuesta['listado']=Locales::TraerTodasLisLocaleses();
		//var_dump(Persona::TraerTodasLasPersonas());
		$arrayJson = json_encode($respuesta);
		echo  $arrayJson;
	}


	

}
else{

	$DatosPorPost = file_get_contents("php://input");
	$respuesta = json_decode($DatosPorPost);

	if(isset($respuesta->datos->accion)){

		switch($respuesta->datos->accion)
		{
			case "borrar":	
				if($respuesta->datos->local->foto!="pordefecto.png")
				{
					unlink("../fotos/".$respuesta->datos->local->foto);
				}
				Locales::BorrarLocales($respuesta->datos->local->id);
			break;

			case "insertar":	
				
				Locales::InsertarLocal($respuesta->datos->local);
			break;

			case "buscar":
			
				echo json_encode(Locales::TraerUnLocal($respuesta->datos->id));
				break;
	
			case "modificar":
			
				if($respuesta->datos->local->foto!="pordefecto.png")
				{
					$rutaVieja="../fotos/".$respuesta->datos->local->foto;
					$rutaNueva=$respuesta->datos->local->dni.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
					copy($rutaVieja, "../fotos/".$rutaNueva);
					unlink($rutaVieja);
					$respuesta->datos->local->foto=$rutaNueva;
				}
				Locales::ModificarLocales($respuesta->datos->local);
				break;
		}//switch($respuesta->datos->accion)
	}//if(isset($respuesta->datos->accion)){


}



 ?>