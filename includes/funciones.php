<?php

function obtener_productos(){
    try{
        //importar las credenciales
        require 'database.php';
        //consulta SQL
        $sql = "select * from productos where estado = 1;";
        //Realizar la consulta
        $consulta = mysqli_query($db, $sql);
        //acceder a los resultados
       // echo "<pre>";
       //   var_dump(mysqli_fetch_assoc($consulta));
        //echo "</pre>";
        //Cerrar la conexion (opcional)
         return $consulta;
        $resultado = mysqli_close($db);
        //echo $resultado;
    }catch(\Throwable $th){
        var_dump($th);
    }
}
function obtener_prod_totales(){
    try{
        //importar las credenciales
        require 'database.php';
        //consulta SQL
        $sql = "select count(1) as Total from productos where estado = 1;";
        //Realizar la consulta
        $consulta = mysqli_query($db, $sql);
        //acceder a los resultados
        /*echo "<pre>";
          var_dump(mysqli_fetch_assoc($consulta));
        echo "</pre>";*/
        //Cerrar la conexion (opcional)
         return $consulta;
        $resultado = mysqli_close($db);
        //echo $resultado;
    }catch(\Throwable $th){
        var_dump($th);
    }
}
function obtener_productos_pagina($Inicio, $No_Reg){
    try{
        //importar las credenciales
        require 'database.php';
        //consulta SQL
        $sql = "select * from productos where estado = 1 limit ".$Inicio.",".$No_Reg.";";
        //Realizar la consulta
        $consulta = mysqli_query($db, $sql);
        //acceder a los resultados
       // echo "<pre>";
       //   var_dump(mysqli_fetch_assoc($consulta));
        //echo "</pre>";
        //Cerrar la conexion (opcional)
         return $consulta;
        $resultado = mysqli_close($db);
        //echo $resultado;
    }catch(\Throwable $th){
        var_dump($th);
    }
}
function Crear_productos($desc, $cantidad, $precio, $modelo, $marca, $caract){
    try{
        //importar las credenciales
        require 'database.php';
        //consulta SQL
        date_default_timezone_set('America/Tegucigalpa');
        $date = date('Y-m-d h:i:s', time());
        $cantidad = (int)$cantidad;
        $precio = (float)$precio;
        $sql = "insert into productos ( create_time, descripcion, cantidad, precio, modelo, marca, caracteristicas, estado)
        values (  '$date', '$desc',  $cantidad,  $precio,  '$modelo', '$marca', '$caract', 1);";
        //Realizar la consulta
        /*echo "<pre>";
          echo $sql;
        echo "</pre>";*/
        $consulta = mysqli_query($db, $sql);
        //acceder a los resultados
       // echo "<pre>";
       //   var_dump(mysqli_fetch_assoc($consulta));
        //echo "</pre>";
        //Cerrar la conexion (opcional)
         return $consulta;
        $resultado = mysqli_close($db);
        //echo $resultado;
    }catch(\Throwable $th){
        var_dump($th);
    }
}
function Crear_productosSP($desc, $cantidad, $precio, $modelo, $marca, $caract){
    try{
        //importar las credenciales
        require 'database.php';
        //consulta SQL
        date_default_timezone_set('America/Tegucigalpa');
        $date = date('Y-m-d h:i:s', time());
        $cantidad = (int)$cantidad;
        $precio = (float)$precio;
        $sql1 = "select max(id) + 1 as idM from productos";
        $consulta1 = mysqli_query($db, $sql1);
        $res1 = mysqli_fetch_assoc($consulta1);
        $id = $res1['idM'];
        echo "Total Reg: ".$id;

        $sql2 = "SET  @Pi_id = $id,      
        @pd_fecha_creacion = '$date',
        @pv_descripcion = '$desc',    
        @pi_cantidad = $cantidad,          
        @pf_precio= $precio,
        @pv_modelo = '$modelo',     
        @pv_marca = '$marca',       
        @pv_caracteristica = '$caract', 
        @pv_estado = 1;";
        $sql3 = "CALL tiendavirtual.CrearProducto(
        @Pi_id,        @pd_fecha_creacion,              @pv_descripcion,    
        @pi_cantidad,         @pf_precio,           @pv_modelo,             
        @pv_marca,              @pv_caracteristica,                @pv_estado,                
        @pv_codigoError, @pv_DescError);";
        $sql4 = "select @pv_codigoError, @pv_DescError;";
        //Realizar la consulta
        /*echo "<pre>";
          echo $sql;
        echo "</pre>";*/
        echo "Query: ".$sql;
        mysqli_query($db, $sql2);
        mysqli_query($db, $sql3);
        $consulta = mysqli_query($db, $sql4);
        //acceder a los resultados
        echo "<pre>";
          var_dump(mysqli_fetch_assoc($consulta));
        echo "</pre>";
        //Cerrar la conexion (opcional)
         return $consulta;
        $resultado = mysqli_close($db);
        //echo $resultado;
    }catch(\Throwable $th){
        var_dump($th);
    }
}