<?php


 require_once "conexion.php";

/**
 * 
 */
class ModelVisits
{
	

	/*=============================================
	GUARDAR IP NUEVA
	=============================================*/


	static public function mdlSaveNewIp($table, $ip, $country, $visit){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(ip, country, visit) VALUES (:ip, :country, :visit)");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->bindParam(":country", $country, PDO::PARAM_STR);
		$stmt->bindParam(":visit", $visit, PDO::PARAM_INT);
	
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;



	}

	/*=============================================
	BUSCAR IP EXISTENTE
	=============================================*/


	static public function mdlSearchIp($table, $ip){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE ip = :ip ORDER BY `id` DESC");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		
		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null;




	}

	/*=============================================
	Insertar pais
	=============================================*/

	static public function mdlInsertCountry($table2, $country, $quantity, $codeCountry){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $table2 ( country, quantity, code) VALUES (:country, :quantity, :code)");

		$stmt->bindParam(":country", $country, PDO::PARAM_STR);
		$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
		$stmt->bindParam(":code", $codeCountry, PDO::PARAM_STR);
	
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;


	}

	/*=============================================
	Insertar pais
	=============================================*/

	static public function mdlSelectCountry($table2, $country){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table2 WHERE country = :country");

		$stmt->bindParam(":country", $country, PDO::PARAM_STR);
		
		$stmt->execute();

		return $stmt -> fetch();

		$stmt->close();

		$stmt = null;



	}

	/*=============================================
	Actualizar pais
	=============================================*/

	static public function mdlUpdateCountry($table2, $country, $quantity){

		$stmt = Conexion::conectar()->prepare("UPDATE $table2 SET quantity = :quantity WHERE country = :country");

		$stmt->bindParam(":country", $country, PDO::PARAM_STR);
		$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;



	}

	/*=============================================
	Mostrar total de visitas
	=============================================*/

	static public function mdlViewTotalVisits($table){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(quantity) as total FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;





	}
	
	/*============================================================
				=  Mostrar los primeros 6 paises       =
	===============================================================*/

	static public function mdlViewCountry($table){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table ORDER BY quantity DESC LIMIT 6");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;





	}

	
}