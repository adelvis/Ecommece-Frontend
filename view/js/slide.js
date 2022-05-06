/*=============================================
		=           Variables          =
=============================================*/

var item=0;

var itemPaginacion= $("#paginacion li");

var interrumpirCiclo = false;

var imgProducto = $(".imgProducto");

var titulos1 = $("#slide h1");

var titulos2 = $("#slide h2");

var titulos3 = $("#slide h3");

var btnVerProducto =  $("#slide button");

var detenerIntervalo = false;

var toogle =false;

var colorTitleButton="";
var colorButton="";

var flagcolorTitleButton= true;

$("#slide ul li").css({"width":100/$("#slide ul li").length + "%"})
$("#slide ul").css({"width":$("#slide ul li").length*100 + "%"})




/*=============================================
		=     Animacion Inicial        =
=============================================*/

$(imgProducto[item]).animate({"top": -10 + "%", "opacity":0}, 100);

$(imgProducto[item]).animate({"top": 30 + "px", "opacity":1}, 600);


$(titulos1[item]).animate({"top": -10 + "%", "opacity":0}, 100);

$(titulos1[item]).animate({"top": 30 + "px", "opacity":1}, 600);

$(titulos2[item]).animate({"top": -10 + "%", "opacity":0}, 100);

$(titulos2[item]).animate({"top": 30 + "px", "opacity":1}, 600);

$(titulos3[item]).animate({"top": -10 + "%", "opacity":0}, 100);

$(titulos3[item]).animate({"top": 30 + "px", "opacity":1}, 600);


$(btnVerProducto[item]).animate({"top": -10 + "%", "opacity":0}, 100);

$(btnVerProducto[item]).animate({"top": 30 + "px", "opacity":1}, 600);




/*=============================================
		=           Paginaciòn          =
=============================================*/

$("#paginacion li").click(function() {
	/* Act on the event */

	item  = $(this).attr('item')-1;

	movimientoSlide(item);

});


/*=============================================
		=           Avanzar          =
=============================================*/

function avanzar(){

	if(item == $("#slide ul li").length -1){

		item=0

	} else{

		item ++

	}

	interrumpirCiclo = true;

	movimientoSlide(item);






}



$("#slide #avanzar").click(function() {
	/* Act on the event */
	
	avanzar()

});

/*=============================================
		=           retroceder          =
=============================================*/

$("#slide #retroceder").click(function() {
	/* Act on the event */
	if(item == 0){

		item= $("#slide ul li").length -1;

	} else{

		item --

	}

	movimientoSlide(item);
	


});



/*=============================================
		=     Movimiento Slide        =
=============================================*/

function movimientoSlide(item){

	$("#slide ul li").finish();

	// http://easings.net/es


	$("#slide ul").animate({"left": item * -100 + "%"}, 1000, "easeOutQuart")

	$("#paginacion li").css({"opacity": .5})

	$(itemPaginacion[item]).css({"opacity": 1})

	interrumpirCiclo = true;


	$(imgProducto[item]).animate({"top": -10 + "%", "opacity":0}, 100);

    $(imgProducto[item]).animate({"top": 30 + "px", "opacity":1}, 600);


    $(titulos1[item]).animate({"top": -10 + "%", "opacity":0}, 100);

	$(titulos1[item]).animate({"top": 30 + "px", "opacity":1}, 600);

	$(titulos2[item]).animate({"top": -10 + "%", "opacity":0}, 100);

	$(titulos2[item]).animate({"top": 30 + "px", "opacity":1}, 600);

	$(titulos3[item]).animate({"top": -10 + "%", "opacity":0}, 100);

	$(titulos3[item]).animate({"top": 30 + "px", "opacity":1}, 600);


	$(btnVerProducto[item]).animate({"top": -10 + "%", "opacity":0}, 100);

    $(btnVerProducto[item]).animate({"top": 30 + "px", "opacity":1}, 600);



}

/*=============================================
		=     Intervalo              =
=============================================*/

setInterval(function(){

	if(interrumpirCiclo){

		interrumpirCiclo = false;

		detenerIntervalo = false;

		$("#slide ul li").finish();

	}else{

		if(!detenerIntervalo){

			avanzar();


		}
		
	}

	

},3000)

/*=============================================
=     Visualizaciòn de Flecha            =
=============================================*/

$("#slide").mouseover(function() {
	/* Act on the event */
	$("#slide #retroceder").css({"opacity": 1});

	$("#slide #avanzar").css({"opacity": 1});



	detenerIntervalo = true;
});

$("#slide").mouseout(function() {
	/* Act on the event */
	$("#slide #retroceder").css({"opacity": 0});

	$("#slide #avanzar").css({"opacity": 0});

	detenerIntervalo = false;
});

/*=============================================
=     Carmbiar el Color del boton             =
=============================================*/



$(".buttonVerProduct").mouseover(function() {
	/* Act on the event */

	if(flagcolorTitleButton){

		colorTitleButton=$(".buttonVerProduct").css('color'); 
		
		colorButton=$(".buttonVerProduct").css('background'); 
		
		flagcolorTitleButton=false;

	}
	
	$(".buttonVerProduct").css({'background':'black', 'color':'white'});
});

$(".buttonVerProduct").mouseout(function() {
	/* Act on the event */
	//alert(colorTitleButton);
	
	$(".buttonVerProduct").css({'background':colorButton, 'color':colorTitleButton} );
});



/*=============================================
=     esconder slide                      =
=============================================*/

$("#btnSlide").click(function() {
	/* Act on the event */


	if(!toogle){

		toogle =true;

		$("#slide").slideUp("fast");

		$("#btnSlide").html('<i class="fa fa-angle-down"></i>');

	} else {

		toogle =false;

		$("#slide").slideDown("fast");

		$("#btnSlide").html('<i class="fa fa-angle-up"></i>');



	}


	


});