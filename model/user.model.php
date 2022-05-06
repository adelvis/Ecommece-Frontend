<?php

/**
 * 
 */
require_once "conexion.php";


class ModelUser {

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlUserRegister($table, $datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( name, 	password, email, modo, photo, 	verification, emailEncriptado) 
			VALUES
			(:nombre, :password, :email, :modo, :foto, :verificacion, :emailEncriptado)");


		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);


		

		if($stmt->execute($data)){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlUserRegister2($table, $datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( nombre, password, email, modo, foto, verificacion, emailEncriptado) 
			VALUES
			(:nombre, :password, :email, :modo, :foto, :verificacion, :emailEncriptado)");


		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);


		var_dump("hola desde modal");

		var_dump($data);

		var_dump($stmt->execute());

		/*

		if($stmt->execute($data)){

			return "ok";

		}else{

			return "error";
		
		}*/

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar DE USUARIO
	=============================================*/

	static public function mdlViewUser($table,$item, $value ){

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt-> fetch();




		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

			$stmt->execute();

			return $stmt-> fetchAll();



		}

		$stmt->close();

		$stmt = null; 







	}
	
	/*=============================================
	Actualizar USUARIO
	=============================================*/

	static public function mdlUpdateUser($table,$id, $item, $value  ){


		$stmt = Conexion::conectar()->prepare("UPDATE $table SET $item = :$item WHERE id =:id");

		$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt-> bindParam(":id", $id, PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}

	/*=============================================
	Actualizar Perfil de USUARIO
	=============================================*/

	static public function mdlUpdateProfile($table, $datos){

		 
	
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET name= :name, email= :email, password= :password, photo= :photo WHERE id =:id");

		


		$stmt-> bindParam(":name", $datos["nombre"], PDO::PARAM_STR);
		$stmt-> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt-> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt-> bindParam(":photo", $datos["foto"], PDO::PARAM_STR);
		$stmt-> bindParam(":id", $datos["id"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;



	}

	/*=============================================
	Mostrar DE Compras de USUARIO
	=============================================*/

	static public function mdlViewShopping($table,$item, $value ){

	

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item = :$item");

		$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt-> fetchAll();




		$stmt->close();

		$stmt = null; 

	}

	/*=============================================
	Mostrar DE Comentario de USUARIO
	=============================================*/

	static public function mdlViewCommentProfile($table, $datos){

		if($datos["idUsuario"] !="") {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_user = :id_user AND id_product = :id_product");

			$stmt-> bindParam(":id_user", $datos["idUsuario"], PDO::PARAM_INT);
			$stmt-> bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);

			$stmt->execute();

			return $stmt-> fetch();


		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE  id_product = :id_product ORDER BY Rand()");

			$stmt-> bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);

			$stmt->execute();

			return $stmt-> fetchAll();





		}



		$stmt->close();

		$stmt = null; 


	}
	/*=============================================
	Actualzar DE Comentario de USUARIO
	=============================================*/

	static public function mdlUpdateComment($table, $datos){



		$stmt = Conexion::conectar()->prepare("UPDATE $table SET qualification= :qualification, comment= :comment WHERE id =:id");

	


		$stmt-> bindParam(":qualification", $datos["calificacion"], PDO::PARAM_STR);
		$stmt-> bindParam(":comment", $datos["comentario"], PDO::PARAM_STR);
		$stmt-> bindParam(":id", $datos["id"], PDO::PARAM_INT);


		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;







	}

	/*=============================================
	REGISTRO DE LISTA DE DESEO DE USUARIO
	=============================================*/

	static public function mdlAddListDesire($table, $datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( id_user, 	id_product) 
			VALUES
			(:id_user, :id_product)");


		$stmt->bindParam(":id_user", $datos["idUser"], PDO::PARAM_INT);
		$stmt->bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LISTA DE DESEO DE USUARIO
	=============================================*/

	static public function mdlViewListDesire($table, $item){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_user = :id_user ORDER BY id DESC");

		$stmt-> bindParam(":id_user", $item, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt-> fetchAll();

		$stmt->close();

		$stmt = null; 







	}

	/*=============================================
	QUITAR PRODUCTO DE LA LISTA DE DESEO DE USUARIO
	=============================================*/

	static public function mdlDeleteDesire($table, $datos){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;


	}


	/*=============================================
	ELIMINAR UN USUARIO
	=============================================*/

	static public function mdlDeleteUser($table, $id){

	
		$consulta = "DELETE FROM `users` WHERE `id`=:id";
			
		$stmt = Conexion::conectar()->prepare($consulta);

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	
	}


	/*=============================================
	ELIMINAR COMENTARIO DE USUARIO
	=============================================*/

	static public function mdlDeleteComent($table, $id){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id_user = :id_user");

		$stmt -> bindParam(":id_user", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;


	}



	/*=============================================
	ELIMINAR COMPRAS DE USUARIO
	=============================================*/


	static public function mdlDeleteShopping($table, $id){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id_user = :id_user");

		$stmt -> bindParam(":id_user", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;


	} 



	/*=============================================
	ELIMINAR LISTAR DE DESEOS DE USUARIO
	=============================================*/


	static public function mdlDeleteListDesire($table, $id){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE id_user = :id_user");

		$stmt -> bindParam(":id_user", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;


	} 

	/*=============================================
	AGREGAR UN COMENTARIO
	=============================================*/
	static public function mdlAddComment($table, $datos){



		$stmt = Conexion::conectar()->prepare("INSERT INTO $table ( id_user, 	id_product) 
			VALUES 	(:id_user, :id_product)");


		$stmt->bindParam(":id_user", $datos["idUser"], PDO::PARAM_INT);
		$stmt->bindParam(":id_product", $datos["idProduct"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}



}