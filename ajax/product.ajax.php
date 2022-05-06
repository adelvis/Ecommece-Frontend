<?php


require_once "../controller/product.controller.php";
require_once "../model/product.model.php";


/**
 * 
 */
class AjaxProducts
{
	
	public $value;
	public $item;
	public $route;



	public function ajaxViewProduct()
	{
		# code...

		$item1 = $this->item;
		$value1 = $this->value;

		$item2 = "route";
		$value2 = $this->route; 

		$answer = ControllerProduct::ctrUpdateProduct($item1, $value1, $item2, $value2);

		echo $answer;


	}

	/*===================================================
	=            Traer el producto por el Id            =
	=================================================== */
	public $id;

	public function ajaxGetProduct(){

		$item = "id";
		$value = $this->id;

		//$item = $this->"id";
		//$value = $this->id;

		$answer = ControllerProduct::ctrViewInfProduct($item, $value);



		echo json_encode($answer);




	}
	

	
	
}

if(isset($_POST["value"])){


		$view = new AjaxProducts();

		$view -> value = $_POST["value"];

		$view -> item = $_POST["item"];

		$view -> route = $_POST["route"];


		$view-> ajaxViewProduct();




}

if(isset($_POST["id"])){



	$product = new AjaxProducts();

	$product -> id = $_POST["id"];

	$product-> ajaxGetProduct();

}

