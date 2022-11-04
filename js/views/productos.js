//Variables Globales
var myArray = new Array();
var atDatos = new Array();
var nRegistros;

  
function cargar_datos_productos(page,size){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '1' , page:page,size:size },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {
            console.log(r2) 
           // return(false);           
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                
                    i = 0;               
                    var str_remp;
                    var select=' <select name="idproductoKardex" id="idproductoKardex"> ';
                    $.each(r2.resultado, function(m, n) {
                        atDatos[i] = n.nombre;
                        i++;
                         
                        var producto_comilla = "'"+n.nombre+"'";
                        var referencia_comilla = "'"+n.referencia+"'";                        
                        var estado_comilla = "'"+n.estado+"'";
                        var categoria_comilla = "'"+n.categoria+"'"; 

                        var btnEditar =  '<a href="javascript:;"><img src="imagenes/editar.png" class="img-fluid title="Editar" onclick="upProducto('+ n.id +','+ producto_comilla +','+referencia_comilla+','+n.precio+','+n.peso+','+estado_comilla+','+categoria_comilla+');"></a>'  


                        if(n.idinventario>0){

                        }else{
                            select+='<option value="'+n.id+'">'+n.nombre+'</option>';
                        }
                        
                         
                        var ver_imagen = '<img id="imagen' + n.id+'" src="data:image/jpeg;base64,' + n.imagen + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div>'+ btnEditar +'</div></td>'+
                                 
                                 
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.referencia +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>$'+ n.precio +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.peso +' g</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoria +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fecha +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fecha_modificacion +'</h4></td>'+										
                            '</tr>';				
                    });		
                    select+='</select>'	
                    $("#divProductoKardex").html(select)	             
                    $("#tbody_productos").html(str_remp);
                     
                    //$("#cant_pags").html("Pag. "+r2.pag_consulta+" de: "+r2.cant_pags+"&nbsp;&nbsp;&nbsp;&nbsp;")

                                                           
               
            }
        }        
    });    
}
//
function cargar_datos_kardex( ){    
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '25' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA
                var str_remp = "";
                i = 0;                  
                if(typeof r2.resultado.status === 'undefined'){                                  
                    var str_remp;
                    $.each(r2.resultado, function(m, n) {
                        atDatos[i] = n.nombre;
                        i++;
                         
                        var producto_comilla = "'"+n.producto+"'";
 

                        var btnEditar =  '<a href="javascript:;"><img src="imagenes/editar.png" class="img-fluid title="Editar" onclick="upKardex('+ n.idproducto +','+ producto_comilla +','+n.cant_disponible +');"></a>'  


                         
                         
                     
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div>'+ btnEditar +'</div></td>'+
                                 
                                 
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.producto +'</h4></td>'+
                                
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.cant_disponible +'</h4></td>'+
                                 
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fecha +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fecha_modificacion +'</h4></td>'+										
                            '</tr>';				
                    });	                          
                    $("#tbody_kardex").html(str_remp);
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}
//
function abreModalProducto(){
    limpiarGuardar('txtAddAtraccion', 'file', 'result', 'img');
    $('#addModalProducto').modal('show'); // abrir modal agregar atraccion 
} 


function abreModalKardex(){
     
    $('#addModalKardex').modal('show'); // abrir modal agregar atraccion 
    $("#cantidad").val('')
} 
//
 
 
 
function upProducto(id_u, nombre_u, referencia_u, precio_u, peso_u, estado_u, categoria_u ){
    let ext_img='jpeg';
    limpiarGuardar('txtupAtraccion', 'file2', 'result2', 'img2');
    var ximagen = "imagen"+id_u;
    g_ext = ext_img;
    console.log(g_ext);
    document.getElementById("img2").src = $("#"+ximagen).attr('src');
    console.log(ximagen);			
    $("#idproducto").val(id_u);
    $("#nombreUp").val(nombre_u);
    $("#referenciaUp").val(referencia_u);
    $("#precioUp").val(precio_u);
    $("#pesoUp").val(peso_u);

    let idestado=0;

    if(estado_u=='Activo'){
         idestado=1;
    }else{
         idestado=2;
    }


    $("#categoriaUp option[value="+ categoria_u +"]").attr("selected",true);
    $("#estadoUp option[value="+ idestado +"]").attr("selected",true);
    //$("#nombreUp").val(nombre_u);

    $('#upModalProductos').modal('show'); // abrir modal  
} 


function upKardex(idproducto_u,producto_u, cantidad_u ){
     		
    
     
    $("#productoKardexUp").val(producto_u);
    $("#cantidadUp").val(cantidad_u);
     
    $('#idproductoKardexUp').val(idproducto_u);
    $('#upModalKardex').modal('show'); // abrir modal  
} 
//
function openImage() { //Esta función validaría una imágen  
    try{			
        var input = this;
        var file = input.files[0];
        var fileName = input.value;
        var maxSize = 1048576; //bytes
        var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones válidas
        console.log(file.size);
        var error = {
            state: false,
            msg: ''
        };        
        if(this.files && file) {  
            for (var i = fileName.length-1; i >= 0; i--) {  
                if (fileName[i] == '.') {  
                    var ext = fileName.substring(fileName[i],fileName.length);  
                    if (!extensions.test(ext)) {
                        error.state = true;
                        error.msg+= 'La extensi\u00F3n del archivo no es v\u00E1lida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La im\u00E1gen no puede ocupar m\u00E1s de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                document.getElementById("result").innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result").innerHTML = "El archivo es v\u00E1lido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img").src = e.target.result;
                        console.log();
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result").innerHTML = "El archivo est\u00E1 da\u00F1ado";
                    document.getElementById("img").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona');
    }
}	
//
function openImage2() { //Esta funcion validara una imagen  
    try{
        console.log("Opem2");			
        var input = this;
        var file = input.files[0];
        var fileName = input.value;
        var maxSize = 1048576; //bytes
        var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones validas			
        var error = {
            state: false,
            msg: ''
        };  
        if(this.files && file) {  
            for (var i = fileName.length-1; i >= 0; i--) {  
                if (fileName[i] == '.') {  
                    var ext = fileName.substring(fileName[i],fileName.length);  
                    if (!extensions.test(ext)) {
                        error.state = true;
                        error.msg+= 'La extensi\u00F3n del archivo no es v\u00E1lida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La imagen no puede ocupar más de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                //document.getElementById(resultado).innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result2").innerHTML = "El archivo es v\u00E1lido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img2").src = e.target.result;							
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result2").innerHTML = "El archivo esta da\u00F1ado";
                    document.getElementById("img2").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona abrir imagen actualizar');
    }
}	
 
function adicionarProductos(nombre,referencia,precio,peso,estado,categoria, ext){

    

    let atResp=0;
     
    if(atResp == 0){
        let str_base64 = document.getElementById("img").src;
        //let imagen = (ext == 'JPG') ? str_base64.substring(23) : str_base64.substring(22);
        let imagen=str_base64;
        console.log("Enviado imagen:"+imagen);
         
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '3', nombre: nombre, referencia:referencia, precio:precio,peso:peso,estado:estado,categoria:categoria, imagen: imagen, extension: ext },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {

                    alert('Producto Creado Exitosamente');

                    $('#addModalProducto').modal('hide'); // oculta modal agregar atraccion                
    				cargar_datos_productos();              
                }else{
                    alert('Error al guardar');
                }
            }        
        });
    }else{
        alert('El nombre del producto '+nombre+', ya existe');
    }
}


function adicionarKardex(idproducto,cantidad){

    

    let atResp=0;
     
    if(atResp == 0){
         
         
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '7', idproducto:idproducto, cantidad:cantidad},
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {

                    alert('Inventario asignado Correctamente');

                    $('#addModalKardex').modal('hide'); // oculta modal agregar atraccion                
    				cargar_datos_kardex();
                    cargar_datos_productos();               
                }else{
                    alert('Error al guardar');
                }
            }        
        });
    }else{
        alert('El nombre del producto '+nombre+', ya existe');
    }
}
 
 
//
 
 
//
function limpiarGuardar(txt, fil, resul, imagen){
    txt = '#'+txt;
    fil = '#'+fil;
    $(txt).val(''); // Limpia campo nombre atraccion
    $(fil).val(''); //
    document.getElementById(resul).innerHTML = "Esperando archivo...";
    document.getElementById(imagen).value = "Sin_imagen.png";
    document.getElementById(imagen).src = "imagenes/Sin_imagen.png";    
}
//
function actualizarProductos(id, nombre,  referencia,precio,peso,estado,categoria,   base64){


    let atResp = 0;

    

    if(atResp==0){

         
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '5', id: id, nombre: nombre, referencia:referencia,precio:precio, peso:peso, estado:estado, categoria:categoria, base: base64 },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                            
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    $('#upModalProductos').modal('hide'); // se oculta modal                
                    cargar_datos_productos();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{

        alert('El nombre de la atracci\u00F3n: '+nombre+', ya existe');

    }
    
    
      
}


function actualizarKardex(id, cantidad){


    let atResp = 0;

    

    if(atResp==0){

         
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '8', id: id, cantidad:cantidad},
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                            
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    $('#upModalKardex').modal('hide'); // se oculta modal                
                    cargar_datos_productos();
                    cargar_datos_kardex();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{

        alert('El nombre de la atracci\u00F3n: '+nombre+', ya existe');

    }
    
    
      
}


$(document).on("click", "#regresar2", function(){
    window.location.href="caja.php";
});
 