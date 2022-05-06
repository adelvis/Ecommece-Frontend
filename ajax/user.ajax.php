<?php

require_once "../controller/user.controller.php";
require_once "../model/user.model.php";

/**
 * 
 */
class AjaxUsers 
{
	
	/*=============================================
	=           Validar email existente         =
	=============================================*/
	public $validarEmail;

	public function ajaxValidarEmail()
	{
		# code...
		$datos =$this->validarEmail;

		$answer = ControllerUser::ctrViewUser("email", $datos);

		echo json_encode($answer);




	}

	/*=============================================
	=           Registro con facebook        =
	=============================================*/

	public $email;
	public $nombre;
	public $foto;

	public function ajaxFaceBookReg(){

		$datos = array("nombre"=>$this->nombre,
					   "email"=>$this->email,
					   "foto"=>$this->foto,
					   "password"=>"null",
					   "modo"=>"facebook",
					   "verificacion"=>0,
					   "emailEncriptado"=>"null");

	

		$answer = ControllerUser::ctrSocialNetworksReg($datos);

		echo $answer;



	}
	/*=============================================
	=           Agregar a lista de deseos        =
	=============================================*/
	public $idUser;
	public $idProduct;

	public function ajaxAddDesire(){

		$datos  = array("idUser" 	 =>$this->idUser ,
						"idProduct"  =>$this->idProduct);


		$answer = ControllerUser::ctrAddListDesire($datos);

		echo $answer;



	}

	/*=============================================
	=           Quitar de  la lista de deseos        =
	=============================================*/

	public $idDesire;

	public function ajaxDeleteDesire(){


		$datos = $this->idDesire;

		$answer = ControllerUser::ctrDeleteDesire($datos);

		echo $answer;



	}



}

/*=============================================
	=           Validar email existente         =
=============================================*/

if(isset($_POST["validarEmail"])){

	$valEmail = new AjaxUsers();

	$valEmail-> validarEmail= $_POST["validarEmail"];

	$valEmail -> ajaxValidarEmail();


}

/*=============================================
	=       Registro de FaceBook         =
=============================================*/

if(isset($_POST["email"])){

	$facebookReg = new AjaxUsers();

	$facebookReg-> email= $_POST["email"];

	$facebookReg-> nombre= $_POST["nombre"];

	$facebookReg-> foto= $_POST["foto"];

	$facebookReg -> ajaxFaceBookReg();


}

/*=============================================
	=      Agregar deseo        =
=============================================*/

if(isset($_POST["idUser"])){

	

	$desire = new AjaxUsers();

	$desire-> idUser= $_POST["idUser"];

	$desire-> idProduct= $_POST["idProduct"];

	$desire-> ajaxAddDesire();




}

/*=============================================
	=      Quitar deseo        =
=============================================*/


if(isset($_POST["idDesire"])){

	$quitarDeseo = new AjaxUsers();
	$quitarDeseo -> idDesire = $_POST["idDesire"];
	$quitarDeseo ->ajaxDeleteDesire();
}
