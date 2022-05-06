<?php

	$url = Route::ctrRoute();

?>

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

							

						</h4>

					</div>

				</div>



			</div>


			<!--=============================================
			=     Boton checkout         =
			============================================= -->
			
			<div class="panel-heading cabeceracheckout">

				<?php

					if(isset($_SESSION["validarSession"])){

						if($_SESSION["validarSession"]=="ok"){


							echo '<a id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="'.$_SESSION['id'].'"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';




						}



					}else{


							echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';


					}	



				?>
				

		


			</div>




		</div>


	</div>
	

</div>

<!--=============================================
	=    VENTANA MODAL PARA CHECKOUT        =
============================================== -->

<div id="modalCheckout" class="modal fade modalFormulario" role="dialog">
	
	<div class="modal-content modal-dialog">
		
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">REALIZAR PAGO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

				<?php

					$answer = ControllerCart::ctrViewTarifa();

					echo '<input type="hidden" id="tasaImpuesto" name="tasaImpuesto" value="'.$answer["tax"].'">

						<input type="hidden" id="envioNacional" name="envioNacional" value="'.$answer["national_delivery"].'">

						<input type="hidden" id="envioInternacional" name="envioInternacional" value="'.$answer["international_delivery"].'">

						<input type="hidden" id="tasaMinimaNal" name="tasaMinimaNal" value="'.$answer["tax_min_nat"].'">

						<input type="hidden" id="tasaMinimaInt" name="tasaMinimaInt" value="'.$answer["tax_min_int"].'">

						<input type="hidden" id="tasaPais" name="tasaPais" value="'.$answer["country"].'">


					';

				?>


				<div class="formEnvio row">
					
					<h4 class="text-center well text-muted text-uppercase">Información de envío</h4>

					<div class="col-xs-12 seleccionePais">
						
						

					</div>
				</div>
				
				<br>

				<div class="formaPago row">

					<input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id']; ?>">
					
					<h4 class="text-center well text-muted text-uppercase">Elegir forma de Pago</h4>

					<figure class="col-md-6">
						<center>
							
							<input type="radio" name="pago" id="checkPaypal" value="paypal" checked>	

						</center>


						<img src="<?php $url;?>view/img/plantilla/paypal.jpg" class="img-thumbnail">						


					</figure>

					<figure class="col-md-6">
						<center>
							
							<input type="radio" name="pago" id="checkPayu" value="payu">	
						</center>

						<img src="<?php $url;?>view/img/plantilla/payu.jpg" class="img-thumbnail">	

					</figure>



				</div>

				<br>

				<div class="listaProductos row">
				
					<h4 class="text-center well text-muted text-uppercase">Productos a comprar</h4>

					<table class="table table-striped tablaProductos">
						
						<thead>
							<tr>
								
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>

							</tr>
						</thead>

						<tbody>
							

						</tbody>



					</table>	
					
					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">

							<tbody>
								
								<tr>
									<td>Subtotal</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorSubtotal" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Envío</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalEnvio" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Impuesto</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalImpuesto" valor="0">0</span></td>
								</tr>


								<tr>
									<td><strong>Total</strong></td>
									<td><strong><span class="cambioDivisa">USD</span> $<span class="valorTotalCompra" valor="0">0</span></strong></td>
								</tr>

							</tbody>


						</table>

						<div class="divisa">
							
							<select class="form-control" id="cambiarDivisa" name="divisa">
								
								

							</select>	

							<br>

						</div>

					</div>
					
					<div class="clearfix"></div>

					 <form  class="formPayu" style="display: none;">

						  <input name="merchantId"    type="hidden"  value=""   >
						  <input name="accountId"     type="hidden"  value="" >
						  <input name="description"   type="hidden"  value=""  >
						  <input name="referenceCode" type="hidden"  value="" >
						  <input name="amount"        type="hidden"  value=""   >
						  <input name="tax"           type="hidden"  value=""  >
						  <input name="taxReturnBase" type="hidden"  value="" >
						  <input name="shipmentValye" type="hidden"  value="" >
						  <input name="currency"      type="hidden"  value="" >
						  <input name="lng"    		  type="hidden"  value="es" >
						  <input name="confirmationUrl"    type="hidden"  value="" >
						  <input name="responseUrl"   type="hidden"  value="" >
						  <input name="declinedResponseUrl"     type="hidden"  value=""  >
						  <input name="displayShippingInformation"    type="hidden"  value="" >
						  <input name="signature"     type="hidden"  value=""  >
						  <input name="test"          type="hidden"  value="" >
						 
						  
						  
						  <input name="Submit"  class="btn btn-block btn-lg btn-default backColor"      type="submit"  value="PAGAR" >
					</form>

					<button class="btn btn-block btn-lg btn-default backColor btnPagar">PAGAR</button>

				</div>




			</div>

			<div class="modal-footer"></div>

		</div>

	</div>

</div>