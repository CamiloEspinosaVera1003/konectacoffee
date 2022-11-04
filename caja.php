<?php
session_start();
include('php/db.php');
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caja</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">

	<style>
		.centrado {
			margin: auto;
			width: 100%;
			text-align: center;
			padding: 0px !important;
		}

		.cmn-divfloat {
			position: fixed !important;
			bottom: 45px;
			right: 15px;
			display: none;
		}
		.cmn-btncircle {
			width: 40px !important;
			height: 40px !important;
			padding: 6px 0px;
			border-radius: 15px;
			font-size: 18px;
			text-align: center;
		}

		.eye{
			
			z-index: 1;
			position: absolute;
			left:80%;
		}

		.txttab { color: #097BDC; }

		.heaven{
			
			
			z-index: 300;
		}

		.selectAltura {
			display:block;
			height:30px;
			width:200px!important;
			padding: 0.1em!important;
			color:#707070 ;	
		}


		.selectAltura2 {
			display:block;
			height:28px;
			width:180px!important;
			padding: 0.1em!important;
			color:#707070 ;	
			font-size:13px!important;
		}

		.tipo_pago_check{
			background:#FFFFFF; 
			border: #D4D4D4 solid 1px; 
			border-radius: 10px;
		}
		.pointer {
			cursor: pointer;
		}

		

	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
	<script src="js/funciones.js"></script>

	<script src="js/views/caja.js"></script>
  </head>
  <body>
  	

	<header>
		<nav class="color-cabezera container-fluid">
		   <div class="row justify-content-between">
			   
			   <div class="col-lg-1 col-3 d-flex align-items-center">
				   <figure class="pt-3">
					<img src="imagenes/Logo_konecta.png" class="img-fluid">
				   </figure>
			   </div>
			   <div class="d-flex justify-content-start">
				 
			   </div>
			   <div class="d-flex align-items-center justify-content-end">
				   <div style="background: #012E4B" class="py-3 px-2"><img src="imagenes/back.svg" alt=""/></div>
			 </div>
		   </div>
	   </nav> 
	</header>
	 
	 <main>
		<div class="container"> 
			<div class="row w-100 align-items-center">
			  <div class="col text-center">
				<a ><button type="button" class="btn btn-warning " id="iniciar" style="border-radius:0px 0px 10px 10px;color: white; background:rgb(255, 157, 0); border-bottom:5px solid rgb(233, 113, 0);margin-bottom:20px;">Iniciar proceso de compra</button></a>
	  
				<div id="fecha" class=""> </div>
	  
			  </div>	
			</div>
		
		
		  </div>
		 <section class="container-fluid pl-lg-0" id="contenido_taquilla" style="display:none;">
		 	<div class="row d-flex hide" >

				<div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					<figure class="sub-menues mb-3 mt-2 regresar"   style="background-color:#0A4970;cursor:pointer;"><img src="imagenes/Imagen-7.png"></figure>
					<div class="panel1 sombra">
						<div class="row">
							<div class="col-6 col-lg-12">
								<div class="row">
								<div class="col-3 col-lg-12 text-center pointer" id="productos2">
									<div class="c-verde mb-1">P</div>
									<p class="mb-3 d-none d-lg-block">Productos</p>
								</div>
								
								
								
								</div>
							</div>
							
						</div>
					
					</div>
				</div>
			 	 
				<div class="col-lg-7 pt-2 d-flex">
				  <div class="panel3 sombra">
				  	<div class="fondo-pesta">
					     <div class="row pr-0 pl-0 ml-0 mr-0">
							<div style="cursor:pointer" id="tabproductos" tipo="productos" class="active col-2 pes-act tabbla">
								<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
									<h3 id="ntab_productos" class="txttab">Productos</h3>
								</div>
							</div>
						
							
							 <div     class="col-3 pes-act-inv d-flex justify-content-center tabbla" 	style="border-radius: 0px;">
								 
								<figure class="d-flex align-items-center pt-3"> </figure>
							</div>
							 <div class="col-1 pes-act-inv3">
							 
							 </div>

							 <div class="col-1 pes-act-inv3">
							 
							 </div>

							 <div class="col-1 pes-act-inv3">
							 
							 </div>
					
					
							 <div class="col-md-4 col-0 pes-act-inv3">
							 	<div class="d-flex justify-content-end pt-3">
								 	<div><input type="text" class="campo" id="filtrarproductos" placeholder="Buscar" style="height: 30px;"></div>
								 </div>
							 </div>
					   </div>
					</div>
				   
					  <div class="row no-gutters pt-3" id="productos">
					  		 
						    
					  </div>
					  
				   </div>		  
				</div>
				<div class="col-lg-4 p-2">
					<div class="text-lg-right pb-2" style="font-size: 13px;"><a id="restablecer" href="#">Restablecer</a></div>
					<div class="panel3 sombra p-0" id="div_productos" style="background:#FFFCEF">
						 
					
						 
						 
						<div style="background: #EEEEFF"  class="p-2 d-flex justify-content-between">
							<div class="pt-2">TOTAL</div>
							<div style="font-size: 24px;">$0</div>
						</div>
					</div>
					<div class="panel3 sombra mt-3">
						<div class="d-flex p-1 justify-content-between no-gutters">
							<div class="col-lg-6 p-1" id="divMetodoPago">

							<div style="background: #FCF8F7; border-radius: 10px;" class="" >

							<div class="p-1 d-flex justify-content-between" style="cursor:pointer" class="metodo_pago_select" id="metodo_pago_select">

								<select name="metodos_pago" id="metodos_pago" class="selectAltura2">
									<option value="0">Seleccione método Pago</option>
									<option value="1" requieredatosautorizacion="false">Efectivo</option>
									<option value="2" requieredatosautorizacion="true">Tarjeta Debito</option>
									<option value="3" requieredatosautorizacion="true">Tarjeta Credito</option>
								</select>
						
							</div>

							<div class="d-flex justify-content-between pt-3" style="cursor:pointer"   class="div_campos_numericos" id="div_campos_numericos"></div>

							<div class="d-flex justify-content-between pt-3" style="cursor:pointer"   class="div_numero_autorizacion" id="div_numero_autorizacion"></div>

							<div class="d-flex justify-content-between pt-3" style="cursor:pointer"   class="div_ultimos_digitos" id="div_ultimos_digitos"></div>


							</div>

							<div class="d-flex justify-content-between " id="cambio">

								</div>

							<div class="text-right pt-5" id="btn-agregar" ></div> 

						</div>

								<div class="col-lg-6" id="divMediosPago">
 
								</div>
								<br>
 

							<div class="col-lg-6 p-1">
								<div style="background: #FCF8F7; border-radius: 10px;" class="" >
 
								</div>
								 
							</div>
							 
						</div>
					</div>
				</div>
			 </div>

			<div id="miModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Contenido del modal -->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" id="contenidoModal">
						

						
					</div>
					
					</div>
				</div>
			</div>


			 >
		 </section>
	  </main>
	   

	 
	<script src="js/jquery-3.4.1.min.js"></script>
 
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>