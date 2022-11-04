    function retornarDatosproducto(idproducto){
        var json_productos_nombres=localStorage.getItem('productos_nombres');
        var arr_productos_nombres= JSON.parse(json_productos_nombres);

        //console.log('arr_productos_nombres *****')
        //console.log(arr_productos_nombres)
        var reto='';
        arr_productos_nombres.forEach(function(producto, index) {
            
            if(producto['id']==idproducto){
            reto= producto
            }

        
        });

        return(reto);

    } 

    function cargar_datos_taquilla(filtro){
    // console.log('Cargar datos'); 

        var info_productos= JSON.parse( localStorage.getItem('productos_nombres'));

        if(info_productos==null){
            //console.log("El array esta vacio")

            $.ajax({        
                url: "ajax/ajxRequest.php",
                data: { op: '6' , filtro:filtro },
                dataType: 'json',
                type: 'POST',
                //async: false,
                success: function(r2) {            
                    if (r2.sts == 'OK') {              
                         
                                        
                            var str_remp='';
        
                            let productos = [];
        
 
                            $.each(r2.resultado, function(m, n) {

                                 

                                if(n.idestado==1){

                                    n.cant_taquilla=0;
                                    n.tipo_producto="producto";
                                    n.cantidadDisponible=n.cant_disponible;
            
                                    let nuevaLongitud = productos.push(n)
            
                                        str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye producto-info informacion" idproducto="'+n.idproducto+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 producto-add"    idproducto="'+n.idproducto+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="data:image/jpeg;base64,' + n.imagen + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.producto +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> <div><h2>Cantidad disponible: <span class="badge bg-success">'+n.cant_disponible+'</span></h2></div> </div>     </div>      </div>';

                                }
        
                                
                            
                                });
                                
                                
        
                                localStorage.setItem('productos_nombres',JSON.stringify(productos))
                                
                                str_remp=str_remp+'</div> '
        
                                //console.log(str_remp);
                                $("#productos").html(str_remp);
                                                                   
                    
                    }
                }        
            });

             
            

            //localStorage.setItem('metodosPago',JSON.stringify(mediosPago))


             $.ajax({        
                url: "ajax/ajxRequest.php",
                data: { op: '9' },
                dataType: 'json',
                type: 'POST',
                //async: false,
                success: function(r2) {            
                    if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                        
                        console.log(r2);

                        let str_select='<select name="metodos_pago" id="metodos_pago" class="selectAltura2"> <option value="0">Seleccione método Pago</option>';

                        let mediosPago= [];

                        $.each(r2.resultado, function(m, n) {

                             
                                str_select+=' <option value="'+n.id+'" requiereDatosAutorizacion="'+n.requiereDatosAutorizacion+'" >'+n.nombre+'</option> ';

                                 mediosPago.push(n)
                            
                        
                        });

                        str_select+='</select> <br>      ';


                     

                        $("#metodo_pago_select").html(str_select)

                        localStorage.setItem('metodosPago',JSON.stringify(mediosPago))
                        

                                                                 
                    
                    }
                }        
            });  


        } 


            
    }

 
    function pagar(){

 


        //armo los arrays que voy a enviar

        var arr_productos= JSON.parse( localStorage.getItem('productos_nombres'));

        let new_array=[];

        $.each(arr_productos, function(index, datos) {


            let new_sub_array=[];
            var c=0;
            if(datos['cant_taquilla']>0){
            
                new_array.push({cantidad: datos['cant_taquilla'], idTipoproducto: datos['idproducto'], producto:datos['producto'], precio:datos['precio']});
    
            }

        });

        let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));
        let array_medios_pago=[];

        $.each(metodosPago, function(index, datos) {
            if(datos['valorPago']>0){

                if(datos['numeroAutorizacion']>0 && datos['ultimosDigitos']>0){
                    array_medios_pago.push({idMetodoPago: datos['id'], valor: datos['valorPago'],numeroAutorizacion:datos['numeroAutorizacion'], ultimosDigitos:datos['ultimosDigitos'] });
                }else{
                    array_medios_pago.push({idMetodoPago: datos['id'], valor: datos['valorPago']});
                }
            
                
    
            }
        });


        console.log(array_medios_pago);
 
 
            $.ajax({        
                url: "ajax/ajxRequest.php",
                data: { op: '12', productos:JSON.stringify(new_array) },
                dataType: 'json',
                async: false, 
                type: 'POST',
                //async: false,
                success: function(r2) {
                    
 
                    if (r2.sts == 'OK') {                
                        
                            alert("Factura creada con exito")
                            location.reload();
 
                    }else{
                        alert(r2.resultado.message)
                    }
                }        
            });
 

    }


function listarMetodosPago(){


    let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

    let strMediosPago='<table class="table"> <tbody>';

    $.each(metodosPago, function(index, datos) {

        //console.log(datos);

        if(datos['valorPago']>0){
            console.log("Imprimo:")
            console.log(datos)

            strMediosPago+='<tr> <td>'+datos['nombre']+'</td> <td> <span class="badge badge-success rounded-pill">$'+datos['valorPago'].toLocaleString()+'</span> </td> <td><img src="imagenes/menos.svg" id="'+datos['id']+'"   class="eliminarMedioPago" style="cursor:pointer"   alt=""></td> </tr>'


        }//if >0

    });

    strMediosPago+='</tbody> </table> <div class="text-right pt-5" id="btn-pagar" ></div> ';

    $("#divMediosPago").html(strMediosPago);

}


var modal = document.getElementById("myModal");
	var btn = document.getElementsByClassName("btnModal");
	var span = document.getElementsByClassName("close")[0];
	var body = document.getElementsByTagName("body")[0];

		function formatear_sin_comas(valor){

			
			let valor2= valor.substr(0, valor.length-3)
			let valor3= valor2.replace(",", "");
			let valor4= valor3.replace(",", "");

			return(valor4);
		}
		

		function recalcular_cambio(eliminar_metodo_pago){
			 

		let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

		let valor_total_suma=0;

		$.each(metodosPago, function(index, datos) {

			if(datos['valorPago']>0){
				valor_total_suma+= parseInt(datos['valorPago']) ;
			}
		});
 
		var sumatoria_productos=$("#sumatoria_total").attr('val_sum');

		var cambio= parseFloat(valor_total_suma)-parseFloat(sumatoria_productos);
			
 

		if(cambio==0){

			$("#divCambio").html('<span class="badge bg-success">$'+cambio.toLocaleString()+'</span>')
			$("#btn-pagar").html('<input type="button" style="width: 100%" value="Pagar" id="pagar">')
			$("#divMetodoPago").hide();

		}else if(cambio>0){

			$("#divCambio").html('<span class="badge bg-danger">$'+cambio.toLocaleString()+'</span>')
			$("#btn-pagar").html('<input type="button" style="width: 100%" value="Pagar" id="pagar">')
			$("#divMetodoPago").hide();

		}else if (cambio<0){

			$("#divCambio").html('<span class="badge bg-light text-dark">$'+cambio.toLocaleString()+'</span>')
			$("#btn-pagar").html('')
			$("#divMetodoPago").show();

		}
 	
		}

	$(document).on("click", ".informacion", function(){
        
		 
		$("#miModal").modal("show");

		var idproducto=$(this).attr('idproducto');

		var info_productos= JSON.parse( localStorage.getItem('productos_nombres'));

	 

		var str_remp='';

		info_productos.forEach(function(datos, index) { 


			 
			if(idproducto== datos['id'] ){
				 

				str_remp=str_remp+' <div class="centrado" ><h2>'+datos['nombre']+'</h2></div>	<table  >	<tr> <td > <h3>Precio:  </h3> </td> <td colspan="2" class="centrado" > <h4>$'+datos['precio'].toLocaleString() +'</h4></td> </tr> <tr> <td > <h3>Descripcion:  </h3> </td> <td colspan="2" class="centrado" > <h4>'+datos['descripcion']+'</h4></td> </tr> <tr> <td > <h3> Categoria Edad:  </h3> </td> <td colspan="2" class="centrado" > <h4> De '+datos['categoriaEdad']['edadInicial']+' a '+datos['categoriaEdad']['edadFinal']+' años</h4></td> </tr> </table><br><br> <div  ><h2> Atracciones </h2></div> <table  > ';
				
				datos['atracciones'].forEach(function(datos2, index2) {

					str_remp=str_remp+' <tr> <td colspan="2"> '+datos2['nombre']+'</td> <td> <img src="http://20.44.111.223/api/contenido/imagen/' + datos2['imagenId'] + '" width="100" height="100" style="border-radius:10px;" class=" " alt=""> </td> </tr> ';
					
				});
				
				str_remp=str_remp+'</table> ';

			}

		});

		$("#contenidoModal").html(str_remp)

	 });


	 $(document).on("click", ".close", function(){
        
		$("#miModal").modal("hide");
  
	 });

	 $(document).on("keyup", "#filtrarproductos", function(){

		var filtro = $("#filtrarproductos").val();
        
		$(".active").each(function(index) {
			
			var tipo = $(this).attr('tipo');
			
			if(tipo=='productos'){
				cargar_datos_taquilla(filtro);
			}else if(tipo=='adicionales'){
				 
				cargar_adicionales(filtro)
			}
		});

	 });


	 $(document).on("click", ".eliminarMedioPago", function(){

		var idmetodoPago=$(this).attr('id');

		let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

		let new_array=[];

		$.each(metodosPago, function(index, datos) {
			if(datos['id']==idmetodoPago){
				datos.valorPago='';
				datos.numeroAutorizacion='';
				datos.ultimosDigitos='';
			}
			let nuevaLongitud = new_array.push(datos)

		});

		localStorage.setItem("metodosPago",JSON.stringify(new_array));

		$(this).parent().parent().remove();

		var eliminar_metodo_pago=1;

		recalcular_cambio(eliminar_metodo_pago);

		$("#metodos_pago").val(0);
		$("#div_campos_numericos").html(' ')
 		$("#div_numero_autorizacion").html('')
	    $("#div_ultimos_digitos").html('')
        $("#btn-agregar").html('')
		
	});

 


	 $(document).on("click", ".eliminar_producto", function(){
        
		var productos_nombres=JSON.parse( localStorage.getItem('productos_nombres'));

		var idproductoB=$(this).attr('id');

		let new_array=[];

		var nuevo_valor=0;

		$.each(productos_nombres, function(index, datos) {

			if(datos['id']==idproductoB){

				datos['cant_taquilla']-=1;
				nuevo_valor=datos['cant_taquilla'];

			}

			let nuevaLongitud = new_array.push(datos)

		});

		localStorage.setItem("productos_nombres",JSON.stringify(new_array));

		var sumatoria_total=$("#sumatoria_total").attr('val_sum')

		var sumatoria_pro= $(this).attr('sumatoria_producto');

		var restar= $(this).attr('precio_unidad')

		var valor_nuevo= parseInt(sumatoria_total)-parseInt(restar)

		var valor_nuevo_producto= parseInt(sumatoria_pro)-parseInt(restar)

		

		$(this).attr('sumatoria_producto',valor_nuevo_producto)
		$("#sumatoria_total").attr('val_sum', valor_nuevo )
		$("#sumatoria_total").html('$'+ valor_nuevo.toLocaleString() )

		var info_productos= JSON.parse( localStorage.getItem('productos_nombres'));

		var cantidad_actual=$(this).attr('cantidad');

		var cantidad_nueva = parseInt(cantidad_actual)-1;

		$.each(info_productos, function(index, datos) {

			

			if(datos['id']== idproductoB ){

				var precioB=datos['precio'];

				$("#unidad_producto_"+datos['tipo_producto']+'_'+idproductoB).html(''+cantidad_nueva+' Unidad / $'+precioB.toLocaleString()+' / Units')

				$("#sumatoria_producto_"+datos['tipo_producto']+'_'+idproductoB).html('$'+valor_nuevo_producto.toLocaleString());

				recalcular_cambio();

				if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
				}
			}

		});

		$(this).attr('cantidad',cantidad_nueva)

		if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
		}
		 
  
	 });


$(document).on("click", ".producto-add", function(){

		var arr_recorrer= JSON.parse( localStorage.getItem('productos_nombres'));
		var indice=$(this).attr("idproducto")
		let new_array=[];

		$.each(arr_recorrer, function(index, datos) {
		   console.log(datos)
 
		   	if(datos['idproducto']==indice){
			   datos['cant_taquilla']+=1;	
			}
 
			 let nuevaLongitud = new_array.push(datos)
			 
		 });

		 localStorage.setItem("productos_nombres",JSON.stringify(new_array));

		 var arr_pintar= JSON.parse( localStorage.getItem('productos_nombres'));

		 var arr_pintarAdd= JSON.parse( localStorage.getItem('adicionales_nombres'));

		 var long_val=0;

		 var pinta_adicionales=1;

		 if(arr_pintarAdd==null){
			pinta_adicionales=0;
		 }else{
			long_val=arr_pintarAdd.length;
		 }

		 

		 var validacion=0;

		 if(long_val>0){

		 }else{
			 validacion=1;
		 }

		 var str_div='';
		 var sumatoria=0;
		 var sumatoria_sub=0;
		 var cont=1;

		 var long=arr_pintar.length;

		 $.each(arr_pintar, function(index, datos) {

			if(datos['cant_taquilla']>0){

				sumatoria+=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
				sumatoria_sub=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])

			 	str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datos['producto']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;" id="unidad_producto_'+datos['tipo_producto']+'_'+datos['id']+'">'+datos['cant_taquilla']+' Unidad / $'+datos['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" id="'+datos['id']+'" tipo_producto="'+datos['tipo_producto']+'"  class="eliminar_producto" precio_unidad="'+datos['precio']+'" sumatoria_producto="'+sumatoria_sub+'" id="'+datos['id']+'" cantidad="'+datos['cant_taquilla']+'" style="cursor:pointer" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right" id="sumatoria_producto_'+datos['tipo_producto']+'_'+datos['id']+'">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>';

			}

			if(cont==long && validacion==1){

				str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;" id="sumatoria_total" val_sum="'+sumatoria+'"  >$'+sumatoria.toLocaleString()+'</div></div><div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">CAMBIO</div>    <div style="font-size: 24px;" id="divCambio" val_sum="'+sumatoria+'"  >$0</div></div>'

			}

			cont++;

		 });

		$("#div_productos").html(str_div)
 
		recalcular_cambio();
 
		
 });

 

	$(document).on("click", ".regresar", function(){
		window.location.href="productos.php";
	});

	$(document).on("click", ".borrar_num", function(){
		if( $("#div_efectivo").hasClass('tipo_pago_check')  ){

			var acumulado=$("#suma_efectivo").attr('acumulado');

			var str2 = acumulado.substring(0, acumulado.length - 1);

			if(str2==''){
				str2=0;
			}

			$("#suma_efectivo").attr('acumulado',str2);

			$("#suma_efectivo").html('$'+str2.toLocaleString());

			

		}else if( $("#div_tarjeta").hasClass('tipo_pago_check')){

			var acumulado=$("#suma_tarjeta").val();

			var str2 = acumulado.substring(0, acumulado.length - 1);

			if(str2==''){
	 
				str2=0;
			}
 

			$("#suma_tarjeta").attr('acumulado',str2);

			$("#suma_tarjeta").html('$'+str2.toLocaleString());

		}

		recalcular_cambio();

	});

	$(document).on("click", ".numeros", function(){

		if( $("#div_efectivo").hasClass('tipo_pago_check')  ){

			var acumulado=$("#suma_efectivo").attr('acumulado');

			var new_acumulado='';

			if(acumulado=='0'){
				 new_acumulado = $(this).attr('id');
			}else{
				 new_acumulado=acumulado+''+$(this).attr('id');
			}

			new_acumulado=parseInt(new_acumulado)

			if(new_acumulado<0){
				new_acumulado=0;
			}

			$("#suma_efectivo").html('$'+ new_acumulado.toLocaleString() );
			$("#suma_efectivo").attr('acumulado', new_acumulado)



		}else if( $("#div_tarjeta").hasClass('tipo_pago_check')){


			var acumulado=$("#suma_tarjeta").attr('acumulado');

			var new_acumulado='';

			if(acumulado=='0'){
				 new_acumulado = $(this).attr('id');
			}else{
				 new_acumulado=acumulado+''+$(this).attr('id');
			}

			new_acumulado=parseInt(new_acumulado)

			if(new_acumulado<0){
				new_acumulado=0;
			}

			$("#suma_tarjeta").html('$'+ new_acumulado.toLocaleString() );
			$("#suma_tarjeta").attr('acumulado', new_acumulado)




		} else{
			alert("No selecciono ninguna")
		}


		recalcular_cambio()

		var num=$(this).attr('id');
	});

	$(document).on("click", "#restablecer", function(){
		localStorage.clear();
		location.reload();
	});

	 

	$(document).on("click", "#agregar", function(){

		let requiereDatosAutorizacion= $('option:selected', "#metodos_pago").attr('requiereDatosAutorizacion');

		let idmetodoPago = $('option:selected', "#metodos_pago").val()

		let valorSub = $("#metodo_pago_input").val();
		let valor= formatear_sin_comas(valorSub);

		if(requiereDatosAutorizacion=='true'){

			var numero_autorizacion=$("#numero_autorizacion").val();
			var ultimos_digitos=$("#ultimos_digitos").val();

			if(numero_autorizacion>0){

			}else{
				alert("Debe ingresar el numero de autorizacion.");
				$("#numero_autorizacion").focus();
				return(false);
			}

			if(ultimos_digitos>0){
				
			}else{
				alert("Debe ingresar los ultimos 4 digitos");
				$("#ultimos_digitos").focus();
				return(false);
			}

		}else{
			var numero_autorizacion=0;
			var ultimos_digitos=0;
		}

		 

		let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

		 

		console.log(metodosPago)

		let new_array = [];

		$.each(metodosPago, function(m, n) {

			if( parseInt(n.id) == parseInt(idmetodoPago) ){
				n.valorPago=parseFloat(valor);
				n.numeroAutorizacion=numero_autorizacion;
				n.ultimosDigitos=ultimos_digitos;
			}

			let nuevaLongitud = new_array.push(n)

		});

		localStorage.setItem('metodosPago',JSON.stringify(new_array))

		$("#metodos_pago").val(0);
		$("#div_campos_numericos").html(' ')
 		$("#div_numero_autorizacion").html('')
	    $("#div_ultimos_digitos").html('')
        $("#btn-agregar").html('')

		listarMetodosPago();
		recalcular_cambio();
		//agregar(valor,requiereDatosAutorizacion,numero_autorizacion,ultimos_digitos);
	});

	$(document).on("click", "#pagar", function(){

 


		var sumatoria_total=$("#sumatoria_total").attr('val_sum');
	 

		let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

		let total_ingreso=0;

		$.each(metodosPago, function(index, datos) {

			if(datos['valorPago']>0){
				total_ingreso+= parseInt(datos['valorPago']) ;
			}
		});

 
		if(sumatoria_total==undefined || sumatoria_total==0  || total_ingreso<sumatoria_total ){
			alert("Valor ingresado no coincide!");
			return(false);
		}else{
 			 
				pagar();
			 
 
		}

		
	});

	$(document).on("keyup", "#metodo_pago_input", function(){

		$(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",").substr(0,16);;
        });
		recalcular_cambio();
	});

	$('#numero_autorizacion').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});


	$(document).on("keyup", "#numero_autorizacion", function(){

		var temp=$("#numero_autorizacion").val()

		var temp2= temp.replace(/[^0-9]/g,'')

		var temp3=temp2.substr(0,15);

		$("#numero_autorizacion").val(  temp3 );

	});


	$(document).on("keyup", "#ultimos_digitos", function(){

		var temp=$("#ultimos_digitos").val()

		if(temp.length>4){
			var remp = temp.slice(0,4); 

			$("#ultimos_digitos").val(remp)

		}else{
			$("#ultimos_digitos").val(  temp.replace(/[^0-9]/g,'') );
		}

		

	});


	$(document).on("keyup", "#suma_tarjeta", function(){

		$(event.target).val(function (index, value ) {
			return value.replace(/\D/g, "")
						.replace(/([0-9])([0-9]{2})$/, '$1.$2')
						.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
		});
		recalcular_cambio();
	});

	$(document).on("focus", "#suma_tarjeta", function(){

		//alert("Hola")

		$(event.target).val(function (index, value ) {
			return value.replace(/\D/g, "")
						.replace(/([0-9])([0-9]{2})$/, '$1.$2')
						.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
		});
		recalcular_cambio();
	});

	 

	function sleep (time) {
		return new Promise((resolve) => setTimeout(resolve, time));
	}
	

	$(document).on("click", "#div_efectivo", function(){

		$("#suma_efectivo").removeAttr("readonly");
		
		var sumatoria_total =$("#sumatoria_total").attr('val_sum');

		//var suma_tarjeta=$("#suma_tarjeta").attr('acumulado');

		 

		let suma_tarjeta_sub=$("#suma_tarjeta").val()
		let suma_tarjeta= formatear_sin_comas(suma_tarjeta_sub);



		if(suma_tarjeta>0){
			var valor_complementario= parseInt(sumatoria_total)-parseInt(suma_tarjeta);

			if(valor_complementario<0){
				valor_complementario=0;
			}else{
				valor_complementario=valor_complementario*100;
			}

			$("#suma_efectivo").val(valor_complementario)
			$("#suma_efectivo").blur();
			$("#suma_efectivo").focus();

			recalcular_cambio();
		}else{
			
		}

		$("#div_efectivo").addClass("tipo_pago_check");
		$("#div_tarjeta").removeClass("tipo_pago_check");
	});

	


	$(document).on("click", "#div_tarjeta", function(){

		$("#suma_tarjeta").removeAttr("readonly");

		var sumatoria_total =$("#sumatoria_total").attr('val_sum');

		let suma_efectivo_sub=$("#suma_efectivo").val()
		let suma_efectivo= formatear_sin_comas(suma_efectivo_sub);

		if(suma_efectivo==''){
			suma_efectivo=0;
		}

		if(suma_efectivo>0){
			var valor_complementario= parseInt(sumatoria_total)-parseInt(suma_efectivo);

			if(valor_complementario<0){
				valor_complementario=0;
			}else{
				valor_complementario=valor_complementario*100;
			}

			$("#suma_tarjeta").val(valor_complementario);
			$("#suma_tarjeta").blur();

		 
				$("#suma_tarjeta").focus();
			 
			recalcular_cambio();
		}else{
			 
		}

		$("#div_efectivo").removeClass("tipo_pago_check");
		$("#div_tarjeta").addClass("tipo_pago_check");
	});


	$(document).on("blur", "#numero_documento", function(){

		var tipo_documento=$("#tipo_documento").val();

		var numero_documento=$("#numero_documento").val();

		if(tipo_documento!='' && numero_documento!=''){

			validar_cliente(tipo_documento,numero_documento);

		}


	});


	$(document).on("blur", "#nombre", function(){

		var nombre=$("#nombre").val();

		var textoAreaDividido = nombre.split(" ");

		var c=0;
		var palabras_validas=0;

		$.each(textoAreaDividido, function(index, datos) {
			c++;

			if(datos.length>=3){
			palabras_validas++;
			}
			 

		});

		if(palabras_validas>=2){

		}else{
			alert("Ingrese un nombre valido! (Nombre y apellido)");
			 
			 
		}


	});

	$(document).on("change", "#metodos_pago", function(){

		let requiereDatosAutorizacion= $('option:selected', "#metodos_pago").attr('requiereDatosAutorizacion');

		let idmetodoPago = $('option:selected', "#metodos_pago").val()

		let metodoPago=$('option:selected', "#metodos_pago").text()

		

		//alert(requiereDatosAutorizacion)

		console.log('idmetodoPago:'+idmetodoPago)

		if(parseInt(idmetodoPago)  >0 ){


			if(requiereDatosAutorizacion=='true'){

				$("#div_campos_numericos").html('<div style="font-size: 12px;">'+metodoPago+' $<input type="numeric" id="metodo_pago_input" class="campo" value=""  ></div> ')

				$("#div_numero_autorizacion").html('  <div style="font-size: 12px;">Numero Autorización <input type="numeric" id="numero_autorizacion" class="campo" value=""  ></div>')

				$("#div_ultimos_digitos").html(' <div style="font-size: 12px;">Ultimos 4 digitos <input type="numeric" id="ultimos_digitos" class="campo" value=""  ></div> ')

				$("#btn-agregar").html('<input type="button" style="width: 100%" value="Agregar" id="agregar">')

			}else{

				$("#div_campos_numericos").html('<div style="font-size: 12px;">'+metodoPago+' $<input type="numeric" id="metodo_pago_input" class="campo" value=""  ></div>  ')

				$("#div_numero_autorizacion").html('')

				$("#div_ultimos_digitos").html('')

				$("#btn-agregar").html('<input type="button" style="width: 100%" value="Agregar" id="agregar">')

			}

			

		}else{

			$("#div_campos_numericos").html(' ')

			$("#div_numero_autorizacion").html('')

			$("#div_ultimos_digitos").html('')

			$("#btn-agregar").html('')

			

		}


		let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));
			$.each(metodosPago, function(index, datos) {
				if(datos['id']==idmetodoPago){
					if(datos['valorPago']>0){

						if(requiereDatosAutorizacion=='true'){
							$("#metodo_pago_input").val(datos['valorPago']);
							$("#numero_autorizacion").val(datos['numeroAutorizacion']);
							$("#ultimos_digitos").val(datos['ultimosDigitos'])
						}else{
							$("#metodo_pago_input").val(datos['valorPago']);
						}

					}

				}
			});


		 


	});


	window.onload = function () {


	localStorage.clear();


	$("#contenido_taquilla").show();

		

	$("#iniciar").hide();

	cargar_datos_taquilla();



	}


    $(document).on("click", "#productos2", function(){

		window.location.href="productos.php";
		
	});


    