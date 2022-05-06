<?php

/**
 * Model Slider
 */

require_once "conexion.php";

class ModelSlide {


	static public function mdlViewSlide($table){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table ORDER BY orden ASC");

		$stmt->execute();

		return $stmt-> fetchAll();

		$stmt->close();

		$stmt = null;


}











}
	
	
	



