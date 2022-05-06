	/*=====================================
	         =      Buscador     =
	======================================-*/

	$("#buscador a").click(function(event) {
		/* Act on the event */

		if ($("#buscador input").val() == ""){

				 $("#buscador a").attr('href', "");


		}

	});

	$("#buscador input").change(function() {
		/* Act on the event */

		var search = $("#buscador input").val();

		var expression = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if (!expression.test(search)){

			$("#buscador input").val("");


		}else{

			var evalueSearch = search.replace(/[áéíóúÁÉÍÓÚ ]/g, "_");


			var routeSearch = $("#buscador a").attr('href');

			if ($("#buscador input").val() != ""){

				 $("#buscador a").attr('href', routeSearch+"/"+evalueSearch);


			}


		}


	});

	/*=====================================
	         =      Buscador con enter    =
	======================================-*/

	$("#buscador input").focus(function() {
		/* Act on the event */

		$(document).keyup(function(event) {
			/* Act on the event */

			event.preventDefault();

			if(event.keyCode ==13 && $("#buscador input").val() != ""){

				var routeSearch = $("#buscador a").attr('href');

				window.location.href = routeSearch;



			}



		});



	});