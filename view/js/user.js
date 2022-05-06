/*=============================================
CAPTURA DE RUTA
=============================================*/

var rutaActual = location.href;

$(".btnIngreso, .facebook, .google").click(function(){

	localStorage.setItem("rutaActual", rutaActual);

})


/*=============================================
FORMATEAR LOS INPUT
=============================================*/

$("input").focus(function(){

	$(".alert").remove();
})



/*===================================================
	=         Validar email repetido         =

===================================================*/

var validarEmailRepetido = false;

$("#regEmail").change(function() {

	/* Act on the event */

	

	var email= $("#regEmail").val();

	var datos = new FormData();

	datos.append('validarEmail', email);

	$.ajax({

		
		url:hiddenPath+'ajax/user.ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType:false,
		processData:false,
		success: function(respuesta){

			
			if(respuesta=="false"){

				//console.log(respuesta);
				$(".alert").remove();
				validarEmailRepetido = false;

			}else{

				var modo = $.parseJSON(respuesta).modo;


				if (modo=="directo"){

					modo ="esta página";

				}

				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>Error! </strong>El correo ya existe en la Base de Datos, fue registrado a través de '+modo+', por favor ingrese otro diferente</div>');

				validarEmailRepetido = true;

			}



		}

	});




});


/*===================================================
=            Validar registro de usuario            =
===================================================*/

function registroUsuario(){

	/*===================================================
	=         Validar Nombre         =
	===================================================*/

	var nombre = $("#regUsuario").val();

	if(nombre != ""){

		var expresion= /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

		if(! expresion.test(nombre)){

			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Error </strong>No se permite números ni caracteres especiales</div>');
		
			return false;


		}


	} else  {

		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN </strong>Este campo es obligatorio</div>');
		
		return false;



	}

	/*===================================================
	=         Validar Email         =
	===================================================*/

	var email = $("#regEmail").val();

	if(email != ""){

		var expresion= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if(! expresion.test(email)){

			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>Error </strong>No es un correo valido</div>');
		
			return false;


		}

		if(validarEmailRepetido){

			$("#regEmail").parent().before('<div class="alert alert-danger"><nstrong>Error! </strong>El correo ya existe en la Base de Datos, por favor ingrese otro diferente</div>');

			return false;

		}


	} else  {

		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN </strong>Este campo es obligatorio</div>');
		
		return false;



	}

	/*===================================================
	=         Validar Password         =
	===================================================*/

	var password = $("#regPassword").val();

	if(password != ""){

		var expresion= /^[a-zA-Z0-9]*$/;

		if(! expresion.test(password)){

			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>Error </strong>No se permite caracteres especiales</div>');
		
			return false;


		}


	} else  {

		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN </strong>Este campo es obligatorio</div>');
		
		return false;



	}






	/*===================================================
	=         Validar politicas de privacidad         =
	===================================================*/

	var politicas = $("#regPoliticas:checked").val();

	if (politicas != "on"){

		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN </strong>Debe aceptar nuestras condiciones de uso y politicas de privacidad</div>');
		
		return false;
	}
	

	return true;	

}

/*===================================================
=        Cambiar fotos        =
===================================================*/



$("#btncambiarFoto").click(function() {
	/* Act on the event */
	$("#imgPerfil").toggle();

	$("#subirImagen").toggle();


});

$("#datosImagen").change(function(event) {
	/* Act on the event */

	var imagen = this.files[0];

	if(imagen["type"]!="image/jpeg" && imagen["type"]!="image/png" ){

		$("#datosImagen").val("");	

		swal({
          title: "¡ERROR!",
          text: "¡Ocurrió un error al subir la imagen, la misma debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
      	},

      	function(isConfirm){
           	if (isConfirm) {    
              	window.location =hiddenPath+"profile";
            } 
      	});



	}else if(Number(imagen["size"])> 2000000){

		$("#datosImagen").val("");

		swal({
          title: "¡ERROR!",
          text: "¡Ocurrió un error al subir la imagen, la misma no debe pesar mas de 2 MB!",
          type: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
      	},

      	function(isConfirm){
           	if (isConfirm) {    
              	window.location =hiddenPath+"profile";
            } 
      	});


	}else{


		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src",  rutaImagen);

		})




	}



});

/*===================================================
=        comentarios        =
===================================================*/

$(".calificarProducto").click(function() {
	/* Act on the event */
	var idComentario = $(this).attr('idComentario');

	$("#idComentario").val(idComentario);





});

/*===================================================
=      cambios de estrellas        =
===================================================*/

$("input[name='puntaje']").change(function() {
	/* Act on the event */
	var puntaje=$(this).val();

	console.log("puntaje", puntaje);

	

	switch(puntaje){

		case "0.5":

			$("#estrellas").html('<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;


	
		case "1.0":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;	

		case "1.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;	

		case "2.0":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;	

		case "2.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;		

		case "3.0":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;	

		case "3.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;	

		case "4.0":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');


			break;		

		case "4.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ');


			break;	

		case "5.0":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+ 
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> ');


			break;					

	
	}

	


});

/*=============================================
VALIDAR EL COMENTARIO
=============================================*/

function validarComentario(){

	var comentario = $("#comentario").val();

	if(comentario != ""){

		var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(comentario)){

			$("#comentario").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten caracteres especiales como por ejemplo !$%&/?¡¿[]*</div>');

			return false;

		}

	}else{

		$("#comentario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>');

		return false;

	}

	return true;

}

/*=============================================
LISTA DE DESEOS
=============================================*/

$(".deseos").click(function(){


	var idProduct = $(this).attr('idProducto');
	console.log("idProduct", idProduct);


	var idUser = localStorage.getItem("user");
	console.log("idUser", idUser);

	if(idUser==null){

		swal({
		  title: "Debe ingresar al sistema",
		  text: "¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
		  type: "warning",
		  confirmButtonText: "¡Cerrar!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = hiddenPath;
				  } 
		});


	}else{

		$(this).addClass('btn-danger');

		var datos = new FormData();

		datos.append("idUser", idUser);
		datos.append("idProduct", idProduct);

		$.ajax({
			url:hiddenPath+'ajax/user.ajax.php',
			method: 'POST',
			data: datos,
			cache: false,
			contentType:false,
			processData:false,
		})
		.done(function() {
			console.log("success");
		});
		
		







	}






});

/*=============================================
QUITAR UN ELEMENTO DE LA LISTA DE DESEOS
=============================================*/

$(".quitarDeseo").click(function(event) {
	/* Act on the event */
	var idDesire = $(this).attr('idDeseo');

	$(this).parent().parent().parent().remove();


	var datos = new FormData();

	datos.append('idDesire', idDesire);


	$.ajax({
		url:hiddenPath+'ajax/user.ajax.php',
			method: 'POST',
			data: datos,
			cache: false,
			contentType:false,
			processData:false,
	})
	.done(function() {
		console.log("success");
	});
	




});


/*=============================================
QUITAR UN USUARIO
=============================================*/

$("#eliminarUsuario").click(function() {
	/* Act on the event */
	var id = $("#idUsuario").val();

	if($("#modoUsuario").val() =="directo"){

		if($("#fotoUsuario").val() !=""){

			var foto = $("#fotoUsuario").val();

		}

	}

	
	swal({
		  title: "¿Está usted seguro(a) de eliminar su cuenta?",
		  text: "¡Si borrar esta cuenta ya no se puede recuperar los datos!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "¡Si, borrar cuenta!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = "index.php?ruta=profile&id="+id+"&foto="+foto;
				  } 
		});



});

/*=============================================
VALIDACIÓN FORMULARIO CONTACTENOS
=============================================*/		

function validarContactenos(){

	var nombre = $("#nombreContactenos").val();
	var email = $("#emailContactenos").val();
	var mensaje = $("#mensajeContactenos").val();

	/*=============================================
	VALIDACIÓN DEL NOMBRE
	=============================================*/	

	if(nombre == ""){

		$("#nombreContactenos").before('<h6 class="alert alert-danger">Escriba por favor el nombre</h6>');

		return false;
		
	}else{

		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;	

		if(!expresion.test(nombre)){

			$("#nombreContactenos").before('<h6 class="alert alert-danger">Escriba por favor sólo letras sin caracteres especiales</h6>');

			return false;

		}

	}

	/*=============================================
	VALIDACIÓN DEL EMAIL
	=============================================*/	

	if(email== ""){

		$("#emailContactenos").before('<h6 class="alert alert-danger">Escriba por favor el email</h6>');
		
		return false;

	}else{

		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if(!expresion.test(email)){
			
			$("#emailContactenos").before('<h6 class="alert alert-danger">Escriba por favor correctamente el correo electrónico</h6>');
			
			return false;
		}	

	}

	/*=============================================
	VALIDACIÓN DEL MENSAJE
	=============================================*/	

	if(mensaje == ""){

		$("#mensajeContactenos").before('<h6 class="alert alert-danger">Escriba por favor un mensaje</h6>');
		
		return false;

	}else{

		var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(mensaje)){
			
			$("#mensajeContactenos").before('<h6 class="alert alert-danger">Escriba el mensaje sin caracteres especiales</h6>');
			
			return false;
		}	

	}

	return true;
}

