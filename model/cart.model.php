<?php

 require_once "conexion.php";

/**
 * 
 */
class ModelCart
{
	

	/*======================================
	=            Mostrar tarifa            =
	======================================*/

	static public function mdlViewTarifa($table){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");


		$stmt->execute();

		return $stmt-> fetch();

		$stmt->close();

		$stmt = null; 





	}

	/*======================================
	=            Agregar compras          =
	======================================*/

	static public function mdlNewShopping($table, $datos){

		


		$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( id_user, 	id_product, method, address, country, 	email, 	quantity, 	price, idPayment, 	totalPayment ) 	VALUES
			(:id_user, :id_product, :method, :address, :country, :email, :quantity, :price, :idPayment, :totalPayment)");

		//$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( id_user, 	id_product, method, address, country, 	email, 	quantity, 	price) 	VALUES 	(:id_user, :id_product, :method, :address, :country, :email, :quantity, :price)");


		$stmt->bindParam(":id_user", $datos["idUser"], PDO::PARAM_INT);
		$stmt->bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);
		$stmt->bindParam(":method", $datos["method"], PDO::PARAM_STR);
		$stmt->bindParam(":address", $datos["address"], PDO::PARAM_STR);
		$stmt->bindParam(":country", $datos["country"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":quantity", $datos["quantity"], PDO::PARAM_INT);
		$stmt->bindParam(":price", $datos["price"]);
		$stmt->bindParam(":idPayment", $datos["idPayment"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPayment", $datos["totalPayment"]);
	
		

		if($stmt->execute($data)){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;




	}

	/*=============================================================
	=  Verificar que no tenga el producto adquirido           =
	==============================================================*/

	static public function mdlVerifyProduct($table, $datos){



		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_user = :id_user AND id_product= :id_product ");


		$stmt->bindParam(":id_user", $datos["idUser"], PDO::PARAM_INT);
		$stmt->bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);


		$stmt->execute();

		return $stmt-> fetchAll();

		$stmt->close();

		$stmt = null; 




	}



}