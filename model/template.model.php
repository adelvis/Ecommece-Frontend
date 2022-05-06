<?php


	require_once "conexion.php";

	/**
	 * Clase Modelo Plantilla
	 */
	class ModelTemplate
	{
		/*=============================================
		=   Section call Template Style dinamic        =
		=============================================*/
		static public function mdlStyleTemplate($table){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

			$stmt-> execute();

			return $stmt->fetch();

			
			$stmt->close();

			$stmt= null;



		}

		/*=============================================
		=   Obterner la cabecera (open graph)       =
		=============================================*/

		static public function mdlGetHeadGraph($table, $route){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE route = :route");

			$stmt-> bindParam(":route", $route, PDO::PARAM_STR);

			$stmt-> execute();

			return $stmt->fetch();

			
			$stmt->close();

			$stmt= null;





		}





	}


