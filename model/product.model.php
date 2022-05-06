<?php


/**
 * Gestiona  los productos
 */

 require_once "conexion.php";


class ModelProduct
{
	/*----------  Mostrar Categorias  ----------*/

	static public function mdlViewCategories($table, $item, $value)
	{
		# code...

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

	/*----------  Mostrar Subcategorias  ----------*/
	

	static public function mdlViewSubcategory($table, $item, $value){

		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item= :$item");

			$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);


			$stmt->execute();

			return $stmt-> fetchall();

		}else {


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

			$stmt->execute();

			return $stmt-> fetchAll();



			
		}	

		$stmt->close();

		$stmt = null;


	}



	/*----------  Mostrar Productos  ----------*/
	

	static public function mdlViewProducts($table, $sort, $item, $value, $base, $top, $mode){

		

		if($item != null){

			

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table WHERE $item = :$item ORDER BY $sort $mode LIMIT $base, $top");

			$sql= "SELECT *FROM $table WHERE $item = :$item ORDER BY $sort $mode LIMIT $base, $top";

			
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table ORDER BY $sort $mode LIMIT $base, $top");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;




	}

	/*----------  Mostrar InfoProducto  ----------*/
	

	static public function mdlViewInfProducts($table, $item, $value){

		if(!is_array($value)){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item= :$item");
	
	
			$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);
	
	
			$stmt->execute();
	
			return $stmt-> fetch();
	
			$stmt->close();
	
			$stmt = null;
		}


	}	

	/*----------  Mostrar Lista productos  ----------*/

	static public function mdlListProducts($table, $sort,$item, $value){


		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table WHERE $item= :$item ORDER BY $sort DESC");


			$stmt-> bindParam(":".$item, $value, PDO::PARAM_STR);
		
			$stmt->execute();

			return $stmt-> fetchAll();


		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table ORDER BY $sort DESC");

			$stmt->execute();

			return $stmt-> fetchAll();

		}	

		$stmt->close();

		$stmt = null;

	}


	/*----------  Mostrar Banner  ----------*/
	

	static public function mdlViewBanner($table, $route){


		$item ="route";


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item= :$item");

		$stmt-> bindParam(":".$item, $route, PDO::PARAM_STR);


		$stmt->execute();

		return $stmt-> fetch();

		$stmt->close();

		$stmt = null;

	}


	/*----------  Buscar  ----------*/

	static public function mdlSearhProducts($table, $search, $sort, $base, $top,$mode){



		$stmt = Conexion::conectar()->prepare("SELECT *FROM $table WHERE route like '%$search%' OR 	title like '%$search%' OR  headline like '%$search%' OR description like '%$search%' ORDER BY $sort $mode LIMIT $base, $top");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null;




	}

	/*----------Listar  Busqueda Producto  ----------*/

	static public function mdlListSearhProducts($table, $search){



		$stmt = Conexion::conectar()->prepare("SELECT *FROM $table WHERE route like '%$search%' OR 	title like '%$search%' OR  headline like '%$search%' OR description like '%$search%'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null;




	}

	/*-----------Actualiza el campo vista del producto------------------------------*/

	static public function mdlUpdateProduct($table, $item1, $value1, $item2, $value2){


		$stmt = Conexion::conectar()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2= :$item2");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);

		$stmt-> bindParam(":".$item2, $value2, PDO::PARAM_STR);


		if($stmt -> execute()){


			return "ok";


		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;




	}



}