<?php

/**
 * 
 */
class ControllerProduct 
{
	/*----------  Mostrar Categorias  ----------*/
	

	static public function ctrViewCategories($item, $value)
	{
		# code...
		$table = "categories"; 

		$answer = ModelProduct::mdlViewCategories($table, $item, $value);

		return $answer;



	}


	/*----------  Mostrar Subcategorias  ----------*/
	

	static public function ctrViewSubcategory($item, $value){

		$table = "subcategory"; 

		$answer = ModelProduct::mdlViewSubcategory($table, $item, $value);

		return $answer;




	}

	/*----------  Mostrar Productos  ----------*/
	

	static public function ctrViewProducts($sort,$item, $value, $base, $top, $mode){


		$table = "products"; 

		$answer = ModelProduct::mdlViewProducts($table, $sort, $item, $value, $base, $top, $mode);

		return $answer;




	}


	/*-----------Mostrar InfoProductos------------------------------*/


	static public function ctrViewInfProduct($item, $value){


		//var_dump($value);

		$table = "products"; 

		$answer = ModelProduct::mdlViewInfProducts($table, $item, $value);

		return $answer;






	}

	/*-----------Lista Productos------------------------------*/

	static public function ctrListProducts($sort,$item, $value){


		$table = "products"; 

		$answer = ModelProduct::mdlListProducts($table, $sort,$item, $value);

		return $answer;


	}

	/*-----------Banner------------------------------*/


	static public function ctrViewBanner($route){


		$table="banner";


		$answer = ModelProduct::mdlViewBanner($table, $route);

		return $answer;


	}



	/*-----------Buscador------------------------------*/


	static public function ctrSearhProducts($search, $sort, $base, $top,$mode){


		$table="products";


		$answer = ModelProduct::mdlSearhProducts($table, $search, $sort, $base, $top,$mode);


		return $answer;


	}

	/*-----------Listar productos buquedar------------------------------*/


	static public function ctrListSearchProducts($search){


		$table="products";


		$answer = ModelProduct::mdlListSearhProducts($table, $search);
		

		return $answer;


	}

	/*-----------Actualiza el campo vista del producto------------------------------*/
	static public function ctrUpdateProduct($item1, $value1, $item2, $value2){

		$table="products";


		$answer = ModelProduct::mdlUpdateProduct($table, $item1, $value1, $item2, $value2);
		

		return $answer;






	}

}