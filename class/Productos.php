<?php


class Productos{

        function listarProductos(){

            include_once('../php/db.php');

            $sql="Select p.*, e.nombre as estado, i.id as idinventario from productos p join estados e on (e.id=p.idestado) left join inventario i on (i.idproducto=p.id);";

            $result = mysqli_query($conn, $sql);

            #$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $respuesta=array();
            while ($rs=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $respuesta[]=$rs;
            }

            return($respuesta);

            mysqli_close($conn);

            

        }


        function guardarProductos($nombre,$referencia,$precio,$peso,$categoria,$estado,$imagen){
            include_once('../php/db.php');

            $sql="INSERT INTO productos (nombre,referencia,precio,peso,categoria,imagen,idestado) VALUES
            ('".$nombre."','".$referencia."',".$precio.",".$peso.",'".$categoria."','".$imagen."',".$estado.")";

            $respuesta="";

            if ($conn->query($sql) === TRUE) {
                $respuesta= "Se ha creado el producto";
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

            return($respuesta);

            mysqli_close($conn);
        }


        function actualizarProductos($idproducto,$nombre,$referencia,$precio,$peso,$categoria,$estado,$imagen){
            include_once('../php/db.php');


            
            $sql="update productos set nombre='".$nombre."',referencia='".$referencia."', precio=".$precio." , peso=".$peso." ,idestado=".$estado.",categoria='".$categoria."' ";

            if($imagen!=''){
                $sql.=" , imagen= '".$imagen."'";
            }

            $sql.="    where id=".$idproducto;

            #echo $sql;exit;

            $respuesta="";

            if ($conn->query($sql) === TRUE) {
                $respuesta= "Se han realizado los cambios";
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

            return($respuesta);

            mysqli_close($conn);
        }

        function listarKardex( ){

            include_once('../php/db.php');

            $sql="SELECT p.id as idproducto , p.nombre as producto, i.cant_disponible , i.fecha, i.fecha_modificacion from productos p  join inventario i on (i.idproducto=p.id)   ";

             

            $result = mysqli_query($conn, $sql);


            $respuesta=array();
            while ($rs=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $respuesta[]=$rs;
            }

            return($respuesta);
            mysqli_close($conn);
        }

        function listarKardexTaquilla( $filtro=''){

            include_once('../php/db.php');

            $sql="SELECT p.id as idproducto , p.nombre as producto, p.precio, p.idestado, p.imagen as imagen, i.cant_disponible , i.fecha, i.fecha_modificacion from productos p  join inventario i on (i.idproducto=p.id)   ";

            $sql.=" where p.idestado=1 and i.cant_disponible>0 ";

            if($filtro!=''){
                $sql.="and p.nombre ilike '%".$filtro."%'";
            }
            
            $result = mysqli_query($conn, $sql);


            $respuesta=array();
            while ($rs=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $respuesta[]=$rs;
            }

             

            return($respuesta);
            mysqli_close($conn);
        }

        function guardarKardex($idproducto,$cantidad){

            include_once('../php/db.php');

            $sql="INSERT INTO inventario (idproducto,cant_disponible,idestado ) VALUES
            (".$idproducto.",".$cantidad.",1 )";

            $respuesta="";

            if ($conn->query($sql) === TRUE) {
                $respuesta= "Se ha asigando el inventario";
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

           

            return($respuesta);
            mysqli_close($conn);
        }

        function actualizarKardex($idproducto,$cantidad){

            include_once('../php/db.php');


            
            $sql="update inventario set cant_disponible=".$cantidad."    where idproducto =".$idproducto;

            #echo $sql;exit;

            $respuesta="";

            if ($conn->query($sql) === TRUE) {
                $respuesta= "Se han realizado los cambios";
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

            

            return($respuesta);

            mysqli_close($conn);
        }


        function validarDisponibilidadProducto($idproducto){

            include('../php/db.php');

            $sql="SELECT cant_disponible from inventario where idproducto=".$idproducto;

            $result = mysqli_query($conn, $sql);

            $rs=mysqli_fetch_array($result, MYSQLI_ASSOC);
 
            $cantidad=$rs['cant_disponible'];

            mysqli_close($conn);

            return($cantidad);

            

        }



        function encabezadoFactura($valor){

            include('../php/db.php');

            $sql="INSERT INTO facturas (valor, idestado ) VALUES
            (".$valor.", 1 )";

            $respuesta="";

            #$id=mysql_insert_id();

            $conn->query($sql);

            $id=$conn->insert_id;

            if ($id>0) {
                $respuesta= $id;
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

           

            return($respuesta);
            mysqli_close($conn);
        }


        function detalleFactura($idproducto,$cantidad,$idfactura){

            include('../php/db.php');

            $sql="INSERT INTO facturas_detalle (idproducto, cantidad, idestado, idfactura ) VALUES
            (".$idproducto.", ".$cantidad.", 1 ,".$idfactura.")";

            $conn->query($sql);

            $id=$conn->insert_id;

            $sql="update inventario set cant_disponible=cant_disponible-".$cantidad."    where idproducto =".$idproducto;
           
            $conn->query($sql);
           
           
           
            $respuesta="";

            #$id=mysql_insert_id();

            

            

            if ($id>0) {
                $respuesta= $id;
            } else {
                $respuesta= "Error: " . $sql . "<br>" . $conn->error;
            }

           

            return($respuesta);
            mysqli_close($conn);
        }

}

?>