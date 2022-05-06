/*---------------------------------------------
	CARRUSEL
----------------------------------------------*/



$('.flexslider').flexslider({
    animation: "slide",
    controlNav: true,
    animationLoop: false,
    itemWidth: 100,
    itemMargin: 5
  });

$(".flexslider ul li img").click(function(event) {
	/* Act on the event */
	var captureIndex = $(this).attr("value");

	$(".infoproducto figure.visor img").hide();

	$("#lupa"+captureIndex).show();


});


/*---------------------------------------------
	EFECTO LUPA
----------------------------------------------*/

$(".infoproducto figure.visor img").mouseover(function(event) {
	/* Act on the event */

	var captureImg = $(this).attr('src');

	$(".lupa img").attr('src', captureImg);

	$(".lupa").fadeIn('fast');

	$(".lupa").css({
		"height": $(".visorImg").height()+"px",
		"background": "#eee",
		"width": "100%"
	});


});


$(".infoproducto figure.visor img").mouseout(function(event) {
	/* Act on the event */
	$(".lupa").fadeOut('fast');

});


/*---------------------------------------------
	EFECTO LUPA
----------------------------------------------*/



$(".infoproducto figure.visor img").mousemove(function(event){

	var posX = event.offsetX;
	var posY = event.offsetY;

	$(".lupa img").css({

		"margin-left":-posX+"px",
		"margin-top":-posY+"px"

	})

})


/*---------------------------------------------
	CONTADOR DE VISTAS
----------------------------------------------*/

contador=0;

$(window).on("load", function(){


	var vistas = $("span.vistas").html();
	var price = $("span.vistas").attr('tipo');

	contador = Number(vistas) + 1;

	$("span.vistas").html(contador);

	if(price==0){

		var item = "ViewsFree";


	}else{

		var item = "views";


	}

	// evaluamos la ruta actual para definir el producto a actualizar

	var urlActual = location.pathname;

	//console.log("urlActual",urlActual);
	var ruta = urlActual.split("/");


	var datos = new FormData();

	datos.append('value', contador);

	datos.append('item', item);

	datos.append('route', ruta.pop());

	$.ajax({

		
		url:hiddenPath+'ajax/product.ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType:false,
		processData:false,
		success: function(respuesta){

			//console.log("respuesta", respuesta);
		}

	});
	


})

/*---------------------------------------------
	altura comentario
----------------------------------------------*/
$(".comentarios").css({
	"height": $(".comentarios .alturaComentarios").height()+ "px",
	"overflow": 'hidden',
	"margin-bottom": "20px"
});

$("#verMas").click(function(event) {
	/* Act on the event */
	event.preventDefault();

	if($("#verMas").html()=="Ver más"){

		$(".comentarios").css({"overflow": 'inherit'});

		$("#verMas").html("Ver menos");



	}else{

		$(".comentarios").css({
			"height": $(".comentarios .alturaComentarios").height()+ "px",
			"overflow": 'hidden',
			"margin-bottom": "20px"
		});

		$("#verMas").html("Ver más");




	}

	


});


