<?php
	class Conexion
	{
		public static function AccederDatos()
		{
			try
			{
				return $conexion=new PDO("mysql:host=localhost;charset=utf8;dbname=userandloc", "root", "");
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
				die();
			}
		}
	}
?>