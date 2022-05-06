<?php

require_once "conexion.php";

class ModelNotifications{
		
	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/

	static public function mdlViewNotifications($table){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		
		$stmt = null;
	
	}

	/*=============================================
	ACTUALIZAR NOTIFICACIONES
	=============================================*/

	static public function mdlUpdateNotifications($table, $item, $value){

		$stmt = Conexion::conectar()->prepare("UPDATE $table SET $item = :$item");


		$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}