<?php
session_start();
include('php/db.php');
/*echo" <pre> ";
print_r($_SESSION);
echo" </pre> ";*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>inicio</title>
	 
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
			a{
			text-decoration:none;
			color:black;
			margin:0px;
			padding:0px;
		}
		li{
			margin-left:5px;
			padding:0px;
		}
		ul{
			margin:0px;
			padding:0px;
		}
		.pointer {
			cursor: pointer;
		}
		ul, ol{
			list-style:none;
		}
		#nav li ul{
			margin-left:5px;
			display:none;
			
		}
		#nav li:hover>ul{
			display: block;
		}
		.administracion #controlador #primer:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba1:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba2:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba3:hover{
			margin-bottom:300px;
		}
		hr{
			margin:0px;
			width:200px;
			size:30px;
			color:white;
		}
	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
	<script src="js/views/taquilla.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/productos.js"></script>
	 
	<script type="text/javascript" charset="utf8"  src="js/views/funciones.js"></script>
	<link rel="stylesheet" href="css/main.css">

	<script>

function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora

    horaImprimible = hora + " : " + minuto + " : " + segundo

	$("#Hora").html(horaImprimible)

    setTimeout("mueveReloj()",1000)
}

	$(document).on("click", "#taquilla", function(){

		window.location.href="taquilla.php";
		
	});

	$(document).on("click", "#registro", function(){

	window.location.href="registro_pasaportes.php";

	});

	 

	</script>
  </head>
  <body onload="mueveReloj()">
  	 
    <header>
	 	<nav class="color-cabezera container-fluid" style="padding:0px;position:fixed;z-index:1;">
			<div class="row">
				<div class="col-lg-2 col-3 d-flex align-items-center" >
					 
					<button style="border-color:#0A4970;margin-right:15px;padding:0px;border:none;"  type="button"
					data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
					aria-controls="offcanvasScrolling"
					><img style="width:10px;padding:15px;padding-bottom:20px;padding-top:20px;" class="color-menu" src="imagenes/open-menu.png" alt=""></button>
				
					<div style="background-color:#0A4970;padding:0px;margin:0px;height:537px;width:300px;"
						class="offcanvas offcanvas" tabindex="-1"
						data-bs-scroll="true" data-bs-backdrop="false"
						id="offcanvasScrolling"	aria-labelledby="offcanvasScrolling'">
					<button type="button" id="btnCerrar" data-bs-dismiss="offcanvas" aria-label="Close" style="margin-left:250px;background:none;border:none;margin-top:10px;" ><img src="imagenes/close-colorblanco.png" style="width:10px;"></button>	


						<div class="offcanvas-header">					
						<ul style="list-style-type:none;align-items:left" id="nav" class="administracion"> 
							<div style="width:500px;margin-left:0px;" id="controlador">
								<ul>
								
									
								</ul>
							</div>	
						</ul>
							
					</div>
				</div>
					<!-- Menú Tipo Hamburguesa inicio -->

				    <figure class="pt-3">
					 <img src="imagenes/Logo_konecta.png" class="img-fluid">
					</figure>
				</div>
				<div class="col-lg-5 d-lg-flex align-items-center d-none" style="margin-left:100px;">
					<input type="text" class="mr-2" value="Buscar">
					<figure class="pt-3"><img src="imagenes/s.png"></figure>
				</div>
				<div class="col-lg-4 col-7  d-flex align-items-center justify-content-end">
					<div class="text-white mr-3 pt-3" id="Hora">9:30 A.M.</div>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/Notificaciones.png"></figure>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/Línea 1.png"></figure>
					<div class="login mt-2">MB<div>
				</div>
			</div>
		</nav> 
	 </header>
	 <main>
	 <section class="container-fluid">
		  <article class="d-lg-flex align-items-md-end pt-3 pb-3 ">
		 	 <div class="nombre"><h1 class="pr-3 text-center">H </h1></div>
			<h3 class="pb-1 text-center">T </h3>
		  </article>	  
		 </section>
		 <section class="container-fluid pl-lg-0">
		 	<div class="row">
			 	 
				    <div class="col justify-content-md-center" id="contenido">
					 
                    <head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PCA-Atracciones</title>
		 
		<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">		 
		<script src="js/views/funciones.js"></script>
		<script src="js/popper.min.js"></script> 
		<script src="js/bootstrap-4.4.1.js"></script>
 	</head>
	 <style>
		 .selectAltura {
			display:block;
			height:40px;
			width:263px!important;
			padding: 0.1em!important;
			color:#707070 ;	
		}

		.input_pag {
			height:30px;
			width:32px!important;
		}

		.input_pag2 {
			height:30px;
			width:32px!important;
		}
	 </style>
  	<body>
  		<!-- body code goes here -->	 
		<main>
			<section class="container-fluid pl-lg-0">
				
		 		<div class="row d-flex">

				 <div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					<figure class="sub-menues mb-3 mt-2 regresar2" id="regresar2" style="background-color:#0A4970;cursor:pointer;"><img src="imagenes/Imagen-7.png"></figure>
					 
				</div>
			 		<div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					
					</div>
				 	<div class="panel3 sombra">
				  		<div class="fondo-pesta">
					    	<div class="row pr-0 pl-0 ml-0 mr-0">
								<div style="cursor:pointer" id="tab_atracciones" tipo="boletas" class="active col-3 pes-act tabb">
									<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
										<h3 id="ntab_boletas" class="txttab">Productos</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_cacceso" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_adicionales">Inventario</h3>
										</div>
									</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
							</div>
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_atracciones"> 
							<div class="text-center sub-titulo-form textos-medios  mb-4">Gestion de Productos</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalProducto();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										 
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchTerm" type="text" onkeyup="doSearch('tabla_productos', 'searchTerm')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>
					  	  	 
							<section class="px-3">
								<div>
									<table id="tabla_productos" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												 
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												<th class="col-1 text-center"><h2>Referencia</h2></th>
												<th class="col-1 text-center"><h2>Precio</h2></th>
												<th class="col-1 text-center"><h2>Peso</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>
												<th class="col-1 text-center"><h2>Categoria</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificacion</h2></th>

											</tr>
										</thead>
										<tbody id="tbody_productos">
											<!--Se llena la tabla-->
										</tboby>	
									</table>								
									 
								</div>
						  	</section>
					  	</section>
					  	<section class="px-3 pt-3" id="panel_Cacceso"><!--CONDICION DE ACCESO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Kardex de Inventario</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalKardex();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										 
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchCacceso" type="text" onkeyup="doSearch('tabla_cacceso', 'searchCacceso')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>					  	
						  	 
							<section class="px-3">
								<div>
									<table id="tabla_cacceso" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												 
												 
												<th class="col-1 text-center"><h2>Producto</h2></th>
												<th class="col-1 text-center"><h2>Cantidad Disponible</h2></th>
												 
												<th class="col-1 text-center"><h2>Fecha Creación</h2></th>
												 
												<th class="col-1 text-center"><h2>Fecha Modificación</h2></th>
												 

											</tr>
										</thead>
										<tbody id="tbody_kardex">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>
					</div>		  
				</div>
			</section>
			<!--MODALES ATRACCIONES-->
			<!--Modal agregar atracci&oacute;n-->
			<div class="modal" id="addModalProducto" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Productos</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close cerrar_modal" nombre_modal="addModalProducto" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre:</h4></div>
								<div class="col-10"><input type="text" id="nombre" class="inputNombres" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>referencia:</h4></div>
								<div class="col-10"><input type="text" id="referencia" class="inputNombres" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>					
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>precio:</h4></div>
								<div class="col-10"><input type="text" id="precio" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>peso:</h4></div>
								<div class="col-10"><input type="text" id="peso" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Estado:</h4></div>
								<div class="col-10">
									<select name="estado" id="estado" class="selectAltura">
										<option value="1" selected="selected">Activo</option>
										<!-- <option value="2">Anulado</option> -->
									</select>
								</div>
							</div>	

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>categoria:</h4></div>
								<div class="col-10">
									<select name="categoria" id="categoria" class="selectAltura">
										<option value="0"  >Selecccione una Opcion</option>
										<option value="bebidas"  >Bebidas</option>
										<option value="comestibles">Comestibles</option>
										  
									</select>
								</div>
							</div>	
							<div class="mb-3">
								<input type="file" id="file" accept=".jpg,.png"/>								
								<br>
								<div id="result"><h4>Esperando archivo...</h4></div>								
								<br>
								<img id="img" width="400" height="260"/>
							</div>
						</div>
						<div class="modal-footer">							
							 
							<div class="px-3"><input type="button" id="btnGuardarProducto" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar" class="cerrar_modal" nombre_modal="addModalProducto"></div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal actualizar atracci&oacute;n-->
			<div class="modal" id="upModalProductos" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar Productos</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close cerrar_modal" nombre_modal="upModalProductos" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
						<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre:</h4></div>
								<div class="col-10">
								<input type="hidden"  id="idproducto">	
								<input type="text" id="nombreUp" class="inputNombres" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>referencia:</h4></div>
								<div class="col-10"><input type="text" id="referenciaUp" class="inputNombres" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>					
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>precio:</h4></div>
								<div class="col-10"><input type="text" id="precioUp" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>peso:</h4></div>
								<div class="col-10"><input type="text" id="pesoUp" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>	
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Estado:</h4></div>
								<div class="col-10">
									<select name="estado" id="estadoUp" class="selectAltura">
										<option value="1" selected="selected">Activo</option>
										<option value="2">Anulado</option>  
									</select>
								</div>
							</div>	

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>categoria:</h4></div>
								<div class="col-10">
									<select name="categoria" id="categoriaUp" class="selectAltura">
										<option value="0"  >Selecccione una Opcion</option>
										<option value="bebidas"  >Bebidas</option>
										<option value="comestibles">Comestibles</option>
										  
									</select>
								</div>
							</div>
							<div class="mb-3">						
								<input type="file" id="file2" accept=".jpg,.png" />
								<br>
								<div id="result2">El archivo es valido</div>
								<br>
								<img id="img2" width="400" height="260" />
							</div>
						</div>
						<div class="modal-footer">					
							 					
							<div class="px-3"><input type="submit" id="btnActualizarProducto" value="Actualizar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar" class="cerrar_modal" nombre_modal="upModalProductos"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar atracciones--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" id="estadoModalAtraccion" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar atracciones</h2>
							<button type="button" class="close cerrar_modal" nombre_modal="estadoModalAtraccion" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							 
							<h3 id="p_cant"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADAtraccion();" value="Guardar"></div><!--id="btnADAtraccion"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar" class="cerrar_modal" nombre_modal="estadoModalAtraccion"></div>
							</div>
						</div>
					 
					</div>
				</div>
			</div>
			 
			 
			 
			 
			<!--MODALES KARDEX-->
			 
			<div class="modal" id="addModalKardex" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Cantidades a producto</h2>
							<button type="button" class="close cerrar_modal" nombre_modal="addModalKardex" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Producto</h4></div>
								<div class="col-10" id="divProductoKardex">
									
								 
							
							
								</div>
							</div>
							
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Cantidad</h4></div>
								<div class="col-10"><input type="text" id="cantidad" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							 
						</div>
						<div class="modal-footer">
							<div class="px-3"><input type="button" id="btnGuardarKardex" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar" class="cerrar_modal" nombre_modal="addModalKardex"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar condicion de acceso-->
			<div class="modal" id="upModalKardex" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar cantidades inventario</h2>
							<button type="button" class="close cerrar_modal"  nombre_modal="upModalKardex" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								
								<div class="col-2 pt-2"><h4>Producto</h4></div>
								<div class="col-10">
								<input type="hidden"  id="idproductoKardexUp" > 	
								<input type="text" readonly id="productoKardexUp" class="inputNombres" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Cantidad</h4></div>
								<div class="col-10"><input type="text" id="cantidadUp" class="inputValores" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							 
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarKardex" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar" class="cerrar_modal" nombre_modal="upModalKardex"></div>									
						</div>
					</div>
				</div>
			</div>
			 
			 
			 
	  	</main>
	  	<script>
			
			//		
			$(document).ready(function(){
				$('#panel_Cacceso').hide(); //muestro mediante id
				cargar_datos_productos();
				cargar_datos_kardex();
				 
							
			});
			//
			 
			$('#btnGuardarProducto').click(function(){
				//Toma el archivo elegido por el input 
				var value = document.getElementById("file").files[0];
				var sin_imagen = document.getElementById("result").innerHTML;    
				var nombre = $("#nombre").val();
				var referencia = $("#referencia").val();
				var precio = $("#precio").val();
				var peso = $("#peso").val();
				var estado = $("#estado").val();
				var categoria = $("#nombre").val();
				
				if(nombre != ''){
					if(sin_imagen != "Esperando archivo..."){
						let img_ext = value.name;
						img_ext = img_ext.toUpperCase(); 
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
						//
						adicionarProductos(nombre, referencia,precio,peso,estado,categoria, extension_img[1]);
					}else{
						alert('Escoga una imagen JPG o PNG');
					}
				}else{
					alert('Escriba el nombre del producto');
				}		
			});
			//
			$('#btnActualizarProducto').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#idproducto").val();
				var nombre_a = $("#nombreUp").val();
				var referencia_a = $("#referenciaUp").val();
				var precio_a = $("#precioUp").val();	
				var peso_a = $("#pesoUp").val();
				var estado_a = $("#estadoUp").val();
				var categoria_a = $("#categoriaUp").val();
				//
				if(nombre_a != '' &&referencia_a!='' && precio_a!='' && peso_a!='' && estado_a!='' && categoria_a!='' && imagen_a != ''){
					let str_base64 = document.getElementById("img2").src;
					let imagen = str_base64.split(',');	
					//console.log('IMAGEN: '+imagen[0]);		
					if(imagen[0] == "data:image/jpeg;base64" || imagen[0] == "data:image/jpg;base64" || imagen[0] == 'data:image/png;base64'){
						//console.log("base64: " imagen[0]);////////////////////////////
						var imagen_a = document.getElementById("file2").files[0];
						//let img_ext = imagen_a.name;
						//var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
					 
						//						
						actualizarProductos(id_a,nombre_a, referencia_a,precio_a,peso_a,estado_a,categoria_a, imagen[1]);
					}else{
						console.log("URL");/////////////////////////////
						actualizarProductos2(id_a,nombre_a);
					}		
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			//



			$(document).on("click", ".tabb", function(){		
				var id=$(this).attr('id');
				var tipo=$(this).attr('tipo');
				if(id=='tab_atracciones'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass( "pes-act-inv" )
						$(this).addClass("active pes-act")
						$("#tab_cacceso").removeClass("active pes-act")
						$("#tab_cacceso").addClass( "pes-act-inv" )
						//
						$("#ntab_adicionales").removeClass("txttab");
						$("#ntab_boletas").addClass("txttab");
						//
						$('#panel_Cacceso').hide();
						$('#panel_atracciones').show();
					}
				}else if(id=='tab_cacceso'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass('pes-act-inv')
						$(this).addClass("active pes-act")
						$("#tab_atracciones").removeClass("active pes-act")
						$("#tab_atracciones").addClass( "pes-act-inv" )
						//
						$("#ntab_boletas").removeClass("txttab");
						$("#ntab_adicionales").addClass("txttab");
						//
						$('#panel_atracciones').hide();
						$('#panel_Cacceso').show();
					}				
				}else if( $(this).hasClass("pes-act") ){				
				}				
			});
			//
			//<<<<<<<<<<<<<<<<<<<<<<<<<KARDEX>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//			
			$('#btnGuardarKardex').click(function(){
				//Toma el archivo elegido por el input 
				  
				var idproducto = $("#idproductoKardex").val();
				var cantidad = $("#cantidad").val();
				if(nombre != '' && cantidad>0){
					 
					 
						adicionarKardex(idproducto,cantidad);
					 
				}else{
					alert('Escriba el nombre de la Condici\u00F3n acceso');
				}		
			});

			 
			$('.cerrar_modal').click(function(){
				var nombre_modal=$(this).attr('nombre_modal')
				$("#"+nombre_modal).modal('hide');
				//$(this).parent().parent().hide();
			});

			//
			$('#btnActualizarKardex').click(function(){
				 	
				var id_a = $("#idproductoKardexUp").val();
				var cantidad_a = $("#cantidadUp").val();	
			 
				if(id_a != '' && cantidad_a != ''){
 					
						actualizarKardex(id_a,cantidad_a);
					 	
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			 		
		</script>	
	
		 
  	</body> 
					 
				  	</div>	  
			</div>
		 
		 </section>
	  </main>
	 <footer class="color-pie container-fluid">
	  	 	<section class="row">
		    	 <figure class="col-3 col-lg-1 home-pie d-flex align-items-center"><img src="imagenes/home-run.png"></figure>
				 <div class="col-9 col-lg-11 d-flex align-items-center justify-content-end">By Camilo Espinosa Vera</div>
		    </section>
	  </footer> 

	 
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>