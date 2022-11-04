<?php
session_start();
     
    extract($_REQUEST);

    include_once "../class/Productos.php";

    $productos_class = new Productos();
   
    switch ($op) {
        case 1://Servicio Cargar datos  
   
                $datos=$productos_class->listarProductos();
 
                if ($datos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$datos ]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>$datos]);
                }
                   
        break;

           

        case 3://Guardar datos productos
            
            $anombre = addslashes($_POST['nombre']);
            $areferencia = addslashes($_POST['referencia']);
            $aprecio =  $_POST['precio'] ;
            $apeso =  $_POST['peso'] ;
            $acategoria = addslashes($_POST['categoria']);
            $aestado =  $_POST['estado'] ;
            $aimagenArr = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']);
            $aimagen_arr=explode(",",$aimagenArr);
            $aimagen= $aimagen_arr[1]; 
            

            $datos=$productos_class->guardarProductos($anombre,$areferencia,$aprecio,$apeso,$acategoria,$aestado,$aimagen);

            
            //
            if($datos == 'Se ha creado el producto'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;

         

         

        case 5://Actualiza nombre e imagen del producto
            $a_id = addslashes($_POST['id']);
            $a_nombre = addslashes($_POST['nombre']);
            $a_referencia = addslashes($_POST['referencia']);
            $a_precio =  $_POST['precio'] ;
            $a_peso =  $_POST['peso'] ;
            $a_estado =  $_POST['estado'] ;
            $a_categoria = addslashes($_POST['categoria']);
            $a_imagen = addslashes($_POST['base']);
             
            $datos=$productos_class->actualizarProductos($a_id,$a_nombre,$a_referencia,$a_precio,$a_peso,$a_categoria,$a_estado,$a_imagen);
             
            if($datos == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 6://Buscar disponibilidad productos


                if(isset($filtro)){
                    $datos=$productos_class->listarKardexTaquilla($filtro);
                }else{
                    $datos=$productos_class->listarKardexTaquilla();
                }

                

                if ($datos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$datos ]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>$datos]);
                }  
 
        break;

        case 7://Guardar datos productos
            
            $idproducto = addslashes($_POST['idproducto']);
            $cantidad = addslashes($_POST['cantidad']);
 

            $datos=$productos_class->guardarKardex($idproducto,$cantidad);

 
            if($datos == 'Se ha asigando el inventario'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;

        case 8://Actualiza nombre e imagen del producto
            $a_id = addslashes($_POST['id']);
            $a_cantidad = addslashes($_POST['cantidad']);
            
            $datos=$productos_class->actualizarKardex($a_id,$a_cantidad);
             
            if($datos == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        
        case 9:
 



                $metodosPgo[0]['nombre']="Efectivo";
                $metodosPgo[0]['id']=1;
                $metodosPgo[0]['requiereDatosAutorizacion']="false";

                $metodosPgo[1]['nombre']="Tarjeta Debito";
                $metodosPgo[1]['id']=2;
                $metodosPgo[1]['requiereDatosAutorizacion']="true";

                $metodosPgo[2]['nombre']="Tarjeta Credito";
                $metodosPgo[2]['id']=3;
                $metodosPgo[2]['requiereDatosAutorizacion']="true";

                echo json_encode(['sts'=>'OK', 'resultado'=>$metodosPgo]); 
        break;
         
        
         

        case 12:

            $fecha_actual=date('d-m-Y');
 
            $array['fecha']=$fecha_actual;
            $productos=json_decode($productos);
            #print_r($productos);exit;
            $c=0;
            $total=0;
            $errores='El/los producto/s :';
            foreach ($productos as $key  ) {
                 $cantidad=$productos_class->validarDisponibilidadProducto($key->idTipoproducto );

                 if($key->cantidad<=$cantidad){
                    $total+= ($key->precio*$key->cantidad);
                 }else{
                    $errores.=$key->producto." - ";
                    $c++;
                 }
            }

            if($c>0){
                $errores.=' no cuenta con suficientes existencias en inventario';
                print_r($errores);
                #exit;
            } else{
               
            }
             
            #print_r("El valor total es:".$total);
            $det=0;
            if($total>0){
                $ins=$productos_class->encabezadoFactura($total);

                foreach ($productos as $key  ) {
                    $det+=$productos_class->detalleFactura($key->idTipoproducto,$key->cantidad,$ins);
                }
            }
             if($det>0){ 
                echo json_encode(['sts'=>'OK','resultado'=>$det]); 
            }else{
                echo json_encode(['sts'=>'NO','resultado'=>$te]);
            }  

        break;
        
      

        case 25://Busca Kardex
                
                $datos=$productos_class->listarKardex();

                if ($datos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$datos ]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>$datos]);
                }     
        break;

        
         
        //
        default:
            echo 'No se seleccionó ninguna opción';
}
//
?>
