
<div class="container-fluid well well-sm">
	

	<div class="container">
		
		<div class="row" >

			<!--=============================================
			=       Breadcrumb de Carrito de Compras           =
			============================================= -->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>

				<li class="active pagActiva"><?php echo $routes[0]  ?></li>
				
			</ul>

			<!-- end Breadcrumb de Product--->

		</div>

	</div>


</div>

<!--=============================================
=       Tabla  Carrito de Compras           =
============================================= -->

<div class="container-fluid">
	
	<div class="container">
		
		<div class="panel panel-default">
			
			<!--=============================================
			=       Cabecera de Carrito de Compras           =
			============================================= -->
			<div class="panel-heading cabeceraCarrito">
				
				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					<h3>
					
						<small>PRODUCTO</small>
					</h3>
				</div>
				
				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					<h3>
					
						<small>PRECIO</small>
					</h3>
				</div>
				
				<div class="col-sm-2 col-xs-0 text-center">
					<h3>
					
						<small>CANTIDAD</small>
					</h3>
				</div>
				
				<div class="col-sm-2 col-xs-0 text-center">
					<h3>
					
						<small>SUBTOTAL</small>
					</h3>
				</div>

			</div>

			<!--=============================================
			=       Cabecera de Carrito de Compras           =
			============================================= -->

			<div class="panel-body cuerpoCarrito">
				
				<div class="row itemCarrito">

					<div class="col-sm-1 col-xs-12">
						<br>
						<center>
							
							<button class="btn btn-default backColor">
								
								<i class="fa fa-times"></i>
							</button>



						</center>
						
					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure>
							
							<img src="http://localhost/e-backend/views/img/productos/cursos/curso05.jpg" class="img-thumbnail">

						</figure>


					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>
						
						<p class="tituloCarritoCompra text-left">Aprede javascript desde cero</p>



					</div>

					<div class="col-sm-2 col-sm-1 col-xs-12">
						
						<br>
						
						<p class="precioCarritoCompra text-center">USD $<span>10</span></p>



					</div>

					<div class="col-sm-2 col-sm-3 col-xs-8">
						
						<br>
						<div class="col-sm-8">
							<center>
								
								<input type="number" class="form-control text-center" min="1" value="1" readonly>

							</center>
							
						</div>

					</div>

					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						
							
						<br>
						
						<p><strong>USD $<span>10</span></p></strong>


					</div>
					


				</div>	

				<div class="clearfix"></div>

				<hr>	

				<div class="row itemCarrito">

					<div class="col-sm-1 col-xs-12">
						<br>
						<center>
							
							<button class="btn btn-default backColor">
								
								<i class="fa fa-times"></i>
							</button>



						</center>
						
					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure>
							
							<img src="http://localhost/e-backend/views/img/productos/ropa/ropa03.jpg" class="img-thumbnail">

						</figure>


					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>
						
						<p class="tituloCarritoCompra text-left">Vestido floreado</p>



					</div>

					<div class="col-sm-2 col-sm-1 col-xs-12">
						
						<br>
						
						<p class="precioCarritoCompra text-center">USD $<span>11</span></p>



					</div>

					<div class="col-sm-2 col-sm-3 col-xs-8">
						
						<br>
						<div class="col-sm-8">
							<center>
								
								<input type="number" class="form-control text-center" min="1" value="1" >

							</center>
							
						</div>

					</div>

					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						
							
						<br>
						
						<p><strong>USD $<span>11</span></p></strong>


					</div>
					


				</div>		

					
				
				<div class="clearfix"></div>

				<hr>	


			</div>

			<!--=============================================
			=      Suma total de Carrito de Compras           =
			============================================= -->


			<div class="panel-body sumaCarrito">
				
				<div class="col-md-4 col-sm-6 col-xs-12  pull-right well">
					
					<div class="col-xs-6">
						
						<h4>TOTAL: </h4>

					</div>

					<div class="col-xs-6">
						
						<h4 class="sumaSubTotal">

							<strong>USD $<span>21</span></strong>

						</h4>

					</div>

				</div>



			</div>


			<!--=============================================
			=     Boton checkout         =
			============================================= -->
			
			<div class="panel-heading cabeceracheckout">
				

				<button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button>


			</div>




		</div>


	</div>
	

</div>