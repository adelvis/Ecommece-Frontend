<?php

/**
 * 
 */
class ControllerUser
{
	
	public function ctrUserRegister()
	{
		# code...

		if(isset($_POST["regUsuario"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

			   	$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			   	$encriptarEmail = md5($_POST["regEmail"]);


			   	$datos = array("nombre"=>$_POST["regUsuario"],
							   "password"=> $encriptar,
							   "email"=> $_POST["regEmail"],
							   "foto"=> "",
							   "modo"=> "directo",
							   "verificacion"=> 1,
							   "emailEncriptado"=>$encriptarEmail);

		

			   	$table = "users"; 


				$answer = ModelUser::mdlUserRegister($table, $datos);



				var_dump($answer);

				if($answer=="ok"){


					/*==============================================================
					=        ACTUALIZAR NOTIFICACIONES DE NUEVOS USUARIOS       =
					===============================================================*/

					$getNotifications = ControllerNotifications::ctrViewNotifications();

					$userNew = $getNotifications["usersNew"] +1 ;

					ModelNotifications::mdlUpdateNotifications("notificaciones", "usersNew", $userNew);

					/*==============================================================
					=        TRAE LOS DATOS DEL COMERCIO      =
					===============================================================*/


					$commerce=  ControllerCart::ctrViewTarifa();
  

					/*======================================
					=            validar correo            =
					======================================*/

					date_default_timezone_set("America/Caracas");

					$url = Route::ctrRoute();

					$mail = new PHPMailer;

					$mail->CharSet = 'UTF-8';

					$mail->isMail();

					$mail->setFrom($commerce["emailContact"], $commerce["name"]);

					$mail->addReplyTo($commerce["emailContact"], $commerce["name"]);

					$mail->Subject = "Por favor verifique su dirección de correo electrónico";

					$mail->addAddress($_POST["regEmail"]);
					
					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
						<center>
							
							<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
						
							<center>
							
							<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">

							<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>

							<a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">

							<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

							</a>

							<br>

							<hr style="border:1px solid #ccc; width:80%">

							<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

							</center>

						</div>

					</div>');
					

					$envio = $mail->Send();

					if(!$envio) {

						echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Ha ocurrido un problema enviando la verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

						</script>';



					}else {

						echo '<script> 

							swal({
								  title: "¡OK!",
								  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta!",
								  type:"success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';



					}


					



				}

				//return $answer;



			}else{


					echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';

			}




		}





	}

	/*=============================================
	=          Mostrar Usuario                  =
	=============================================*/
	
	static public function ctrViewUser($item, $value){


		$table="users";

		$answer = ModelUser::mdlViewUser($table,$item,$value );


		return $answer;






	}
	
	/*=============================================
	=          Actualizar Usuario                  =
	=============================================*/
	
	static public function ctrUpdateUser($id, $item, $value){


		$table="users";

		$answer = ModelUser::mdlUpdateUser($table,$id, $item, $value );


		return $answer;



	}

	/*=========================================
	=            Login de usuarios            =
	=========================================*/
	public function ctrUserLogin(){

		if(isset($_POST["ingEmail"])){


			if( preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$table="users";

				$item="email";

				$value= $_POST["ingEmail"];

				$answer = ModelUser::mdlViewUser($table,$item, $value);

				if($answer["email"]==$_POST["ingEmail"] && $answer["password"]==$encriptar){

					if($answer["verification"]==1){

						echo '<script> 

							swal({
								  title: "¡NO HA VERIFICADO SU CORREO ELECTRÓNICO!",
								  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$answer["email"].' para verificar la cuenta!",
								  type: "error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';




					}else{

						$_SESSION["validarSession"]="ok";
						$_SESSION["id"]=$answer["id"];
						$_SESSION["name"]=$answer["name"];
						$_SESSION["photo"]=$answer["photo"];
						$_SESSION["email"]=$answer["email"];
						$_SESSION["password"]=$answer["password"];
						$_SESSION["modo"]=$answer["modo"];

						echo '<script>


							window.location= localStorage.getItem("rutaActual");


							</script>
						';
									
						

					}



				}else{

					echo '<script> 

						swal({
							  title: "¡ERROR AL INGRESAR!",
							  text: "¡Por favor revise que el email exista o la contraseña coincida con la registrada!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									window.location= localStorage.getItem("rutaActual");

								}
						});

				</script>';




				}



			}else{

				echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';




			}	



		}





	}
	
	/*=============================================
	=           Olvido de contraseña           =
	=============================================*/

	public function ctrForgetPassword(){

		if(isset($_POST["passEmail"])){

			if( preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"]) ){


				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

				function generarPassword($longitud){

					$key = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

					$max = strlen($pattern)-1;

					for($i = 0; $i < $longitud; $i++){

						$key .= $pattern{mt_rand(0,$max)};

					}

					return $key;

				}

				$nuevaPassword = generarPassword(11);

				



				$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$table="users";

				$item1="email";
				$value1= $_POST["passEmail"];

				$answer1 = ModelUser::mdlViewUser($table,$item1,$value1 );

				if($answer1){

					$id= $answer1["id"];
					$item="password";
					$value = $encriptar;

					$answer = ModelUser::mdlUpdateUser($table,$id, $item, $value );

					if($answer  == "ok"){


						/*=============================================
						CAMBIO DE CONTRASEÑA
						=============================================*/

						date_default_timezone_set("America/Caracas");

						$url = Route::ctrRoute();

						$mail = new PHPMailer;

						$mail->CharSet = 'UTF-8';

						$mail->isMail();

						$mail->setFrom($commerce["emailContact"], $commerce["name"]);

						$mail->addReplyTo($commerce["emailContact"], $commerce["name"]);

						$mail->Subject = "Solicitud de nueva contraseña";

						$mail->addAddress($_POST["passEmail"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
								<center>
									
									<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
								
									<center>
									
									<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

									<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

									<a href="'.$url.'" target="_blank" style="text-decoration:none">

									<div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

						$envio = $mail->Send();

						if(!$envio){

							echo '<script> 

								swal({
									  title: "¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
									  type:"error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											history.back();
										}
								});

							</script>';

						}else{

							echo '<script> 

								swal({
									  title: "¡OK!",
									  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
									  type:"success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											history.back();
										}
								});

							</script>';

						}

					}



				}else{

					echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error el correo electronico, no está registrado!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';



				}






			}else{

				echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error el correo electronico, está mal escrito!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';





			}


		}



	}
	
	
	/*===============================================
	=          Registro desde Redes sociales         =
	===============================================*/

	
	static public function ctrSocialNetworksReg($datos){


		

			$table = "users"; 
			$item="email";
			$value= $datos["email"];
			$emailRepetido=false;


			$answer0 = ModelUser::mdlViewUser($table,$item, $value);

			if ($answer0){

				if($answer0["modo"] != $datos["modo"]){

					echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error el correo electronico '.$datos["email"] .', ya está registrado en el sistema con un metodo diferente a '.$datos["modo"] .' !",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';

					$emailRepetido=false;


				}

				$emailRepetido=true;

			}else{

				$answer = ModelUser::mdlUserRegister($table, $datos);

				if($answer == "ok"){

					/*==============================================================
					=        ACTUALIZAR NOTIFICACIONES DE NUEVOS USUARIOS       =
					===============================================================*/

					$getNotifications = ControllerNotifications::ctrViewNotifications();

					$userNew = $getNotifications["usersNew"] +1 ;

					ModelNotifications::mdlUpdateNotifications("notificaciones", "usersNew", $userNew);




					
				}

			}

			if($emailRepetido || $answer=="ok"){

				

				$answer2 = ModelUser::mdlViewUser($table,$item, $value);

				if($answer2["modo"]== "facebook"){

						session_start();

						$_SESSION["validarSession"]="ok";
						$_SESSION["id"]=$answer2["id"];
						$_SESSION["name"]=$answer2["name"];
						$_SESSION["photo"]=$answer2["photo"];
						$_SESSION["email"]=$answer2["email"];
						$_SESSION["password"]=$answer2["password"];
						$_SESSION["modo"]=$answer2["modo"];

						echo "ok";


				}else if ($answer2["modo"]== "google") {
					# code...

						$_SESSION["validarSession"]="ok";
						$_SESSION["id"]=$answer2["id"];
						$_SESSION["name"]=$answer2["name"];
						$_SESSION["photo"]=$answer2["photo"];
						$_SESSION["email"]=$answer2["email"];
						$_SESSION["password"]=$answer2["password"];
						$_SESSION["modo"]=$answer2["modo"];

						
						echo '<span style="color=white">ok</span>';





				}else{

					echo "";

				}





			}

		

	}
	
	
	/*===============================================
	=         Actualizar el perfil de usuario       =
	===============================================*/

	public function ctrUpdateProfile(){

		

		if(isset($_POST ["editarNombre"])){

			/*=============================================
			VALIDAR IMAGEN
			=============================================*/

			$ruta = $_POST["fotoUsuario"];

			if(isset($_FILES["datosImagen"]["tmp_name"]) && !empty($_FILES["datosImagen"]["tmp_name"])){

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/



				$directorio = "view/img/usuarios/".$_POST["idUsuario"];

				if(!empty($_POST["fotoUsuario"])){

					unlink($_POST["fotoUsuario"]);
				
				}else{

					//$createdir =mkdir($directorio, 0755,true);

					if(!mkdir($directorio, 0755, true)) {

					
					    
					}


				}

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				$aleatorio = mt_rand(100, 999);

				if($_FILES["datosImagen"]["type"] == "image/jpeg"){

					$ruta = "view/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";

					/*=============================================
					MOFICAMOS TAMAÑO DE LA FOTO
					=============================================*/


					$origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($_FILES["datosImagen"]["type"] == "image/png"){

					$ruta = "view/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".png";

					/*=============================================
					MOFICAMOS TAMAÑO DE LA FOTO
					=============================================*/

					$origen = imagecreatefrompng($_FILES["datosImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
    			
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}

			}

			if($_POST ["editarPassword"]==""){

				$password= $_POST ["passUsuario"];

			}else{

				$password=  crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			}

			$table= "users";

			$datos  = array("nombre" => $_POST ["editarNombre"],
							"email" => $_POST ["editarEmail"],
							"password" => $password,
							"foto" => $ruta,
							"id" => $_POST ["idUsuario"]);

			//var_dump($datos);

			$answer = ModelUser::mdlUpdateProfile($table, $datos);

			if($answer=="ok"){

						$_SESSION["validarSession"]="ok";
						$_SESSION["id"]=$datos["id"];
						$_SESSION["name"]=$datos["nombre"];
						$_SESSION["photo"]=$datos["foto"];
						$_SESSION["email"]=$datos["email"];
						$_SESSION["password"]=$datos["password"];
						$_SESSION["modo"]=$_POST ["modoUsuario"];

						echo '<script> 

							swal({
								  title: "OK!",
								  text: "¡Su cuenta ha sido actualizada correctamente!'.$createdir.'",
								  type:"success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';



			}





		}





	}



	/*===============================================
	=         Mostrar la lista de compras   =
	===============================================*/

	static public function ctlViewShopping($item, $value){


		$table= "shopping";


		$answer = ModelUser::mdlViewShopping($table, $item, $value );


		return $answer;




	}

	/*===============================================
	=         Mostrar COMENTARIOS   =
	===============================================*/

	static public function ctrViewCommentProfile($datos){


		$table= "comments";


		$answer = ModelUser::mdlViewCommentProfile($table, $datos);


		return $answer;




	}



	/*=========================================
	=            Actualizar Comentarios          =
	=========================================*/
	public function ctrUpdateComment(){

		if(isset($_POST["idComentario"])){

			if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["comentario"])){

				if($_POST["comentario"] !=""){

					$table= "comments";

					$datos = array("id"=>$_POST["idComentario"],
								   "calificacion"=>$_POST["puntaje"],
								   "comentario"=>$_POST["comentario"]);


					$answer = ModelUser::mdlUpdateComment($table, $datos);

					if($answer=="ok"){

						echo'<script>

								swal({
									  title: "¡GRACIAS POR COMPARTIR SU OPINIÓN!",
									  text: "¡Su calificación y comentario ha sido guardado!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
								},

								function(isConfirm){
										 if (isConfirm) {	   
										   history.back();
										  } 
								});

							  </script>';


					}


				}else{

					echo'<script>

						swal({
							  title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
							  text: "¡El comentario no puede estar vacío!",
							  type: "error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						},

						function(isConfirm){
								 if (isConfirm) {	   
								   history.back();
								  } 
						});

					  </script>';




				}



			}else{


				echo'<script>

					swal({
						  title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
						  text: "¡El comentario no puede llevar caracteres especiales!",
						  type: "error",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							   history.back();
							  } 
					});

				  </script>';



			}


		}	
	}


	/*===============================================
	=        Agregar Lista de Deseos  =
	===============================================*/

	static public function ctrAddListDesire($datos){


		$table= "desire";


		$answer = ModelUser::mdlAddListDesire($table, $datos);


		return $answer;




	}

	/*===============================================
	=        Mostrar Lista de Deseos  =
	===============================================*/

	static public function ctrViewListDesire($item){


		$table= "desire";


		$answer = ModelUser::mdlViewListDesire($table, $item);


		return $answer;




	}

	/*===============================================
	=       Quita de la Lista de Deseos  =
	===============================================*/

	static public function ctrDeleteDesire($datos){


		$table= "desire";


		$answer = ModelUser::mdlDeleteDesire($table, $datos);


		return $answer;




	}


	/*===============================================
	=      ELIMINAR USUARIO  =
	===============================================*/

	public function ctrDeleteUser(){

		if(isset($_GET["id"])){

			$table= "users";
			$table2= "comments";
			$table3= "shopping";
			$table4= "desire";

			if(isset($_GET["foto"])){

				unlink($_GET["foto"]);

				rmdir('view/img/usuarios/'.$_GET["id"]);



			}


			$answer = ModelUser::mdlDeleteUser($table, $id);

			echo $answer; 

			ModelUser::mdlDeleteComent($table2, $id);

			ModelUser::mdlDeleteShopping($table3, $id);

			ModelUser::mdlDeleteListDesire($table4, $id);

			if($answer=="okk"){

				$url = Route::ctrRoute();

				echo'<script>

								swal({
									  title: "¡SU CUENTA HA SIDO BORRADA!",
									  text: "¡Debe registrarse nuevamente si desea ingresar!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
								},

								function(isConfirm){
										 if (isConfirm) {	   
										   window.location ="'.$url.'logOut";
										  } 
								});

							  </script>';



			}




		}



	}


	/*=============================================
	FORMULARIO CONTACTENOS
	=============================================*/

	public function ctrFormContactenos(){

		if(isset($_POST['mensajeContactenos'])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreContactenos"]) &&
			preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["mensajeContactenos"]) &&
			preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailContactenos"])){

				/*=============================================
				ENVÍO CORREO ELECTRÓNICO
				=============================================*/

					date_default_timezone_set("America/Caracas");

					$url = Route::ctrRoute();

					$mail = new PHPMailer;

					$mail->CharSet = 'UTF-8';

					$mail->isMail();

					$mail->setFrom($commerce["emailContact"], $commerce["name"]);

					$mail->addReplyTo($commerce["emailContact"], $commerce["name"]);

					$mail->Subject = "Ha recibido una consulta";

					$mail->addAddress($commerce["emailContact"]);

					$mail->msgHTML('

						<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

						<center><img style="padding:20px; width:10%" src="http://www.tutorialesatualcance.com/tienda/logo.png"></center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">

							<center>

							<img style="padding-top:20px; width:15%" src="http://www.tutorialesatualcance.com/tienda/icon-email.png">


							<h3 style="font-weight:100; color:#999;">HA RECIBIDO UNA CONSULTA</h3>

							<hr style="width:80%; border:1px solid #ccc">

							<h4 style="font-weight:100; color:#999; padding:0px 20px; text-transform:uppercase">'.$_POST["nombreContactenos"].'</h4>

							<h4 style="font-weight:100; color:#999; padding:0px 20px;">De: '.$_POST["emailContactenos"].'</h4>

							<h4 style="font-weight:100; color:#999; padding:0px 20px">'.$_POST["mensajeContactenos"].'</h4>

							<hr style="width:80%; border:1px solid #ccc">

							</center>

						</div>

					</div>');

					$envio = $mail->Send();

					if(!$envio){

						echo '<script> 

							swal({
								  title: "¡ERROR!",
								  text: "¡Ha ocurrido un problema enviando el mensaje!",
								  type:"error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';

					}else{

						echo '<script> 

							swal({
							  title: "¡OK!",
							  text: "¡Su mensaje ha sido enviado, muy pronto le responderemos!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){
									 if (isConfirm) {	  
											history.back();
										}
							});

						</script>';

					}

			}else{

				echo'<script>

					swal({
						  title: "¡ERROR!",
						  text: "¡Problemas al enviar el mensaje, revise que no tenga caracteres especiales!",
						  type: "error",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							   	window.location =  history.back();
							  } 
					});

					</script>';


			}

		}

	}



}

