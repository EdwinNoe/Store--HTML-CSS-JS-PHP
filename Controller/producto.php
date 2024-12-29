<?php
        include '../Database/conexion.php';
        $pdo = new Conexion();
        //usando el metodo post se realizaran todas las consultas
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $entityBody = json_decode(file_get_contents('php://input'),true);
            if($entityBody['Operacion'] == 'ConsultaTotales'){
                $sql = "select count(1) as Total from productos where estado = 1;";   // 
                $sql = $pdo->prepare($sql);
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetchall());
            }
            if($entityBody['Operacion'] == 'Consulta'){
                $sql = "select * from productos where id = if(:id IS NULL,id,:id) and estado = 1;";   // 
                $sql = $pdo->prepare($sql);
                $sql->bindValue(':id', $entityBody['id']);
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetchall());
            }
            if($entityBody['Operacion'] == 'Crear'){
                $sql = "insert into productos (fecha_creacion, descripcion, cantidad, precio, modelo, marca, caracteristicas, estado)
                        values(:fecha_creacion, :descripcion, :cantidad, :precio, :modelo, :marca, :caracteristicas, :estado);";   
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':fecha_creacion', $entityBody['fecha_creacion']);
                $stmt->bindValue(':descripcion', $entityBody['descripcion']);
                $stmt->bindValue(':cantidad', $entityBody['cantidad']);
                $stmt->bindValue(':precio', $entityBody['precio']);
                $stmt->bindValue(':modelo', $entityBody['modelo']);
                $stmt->bindValue(':marca', $entityBody['marca']);
                $stmt->bindValue(':caracteristicas', $entityBody['caracteristicas']);
                $stmt->bindValue(':estado', $entityBody['estado']);
                $stmt->execute();
                $idPost = $pdo->lastInsertId();
                if($idPost){
                    header("HTTP/1.1 200 ok");
                    $Resp = '{"Registro Creado": "'.$idPost.'"'.
                        '"Resultado":"Success}"';
                    echo json_encode($Resp);
                }else{
                    header("HTTP/1.1 301 Error");
                    $Resp = '{"Registro Creado": "'.$idPost.'"'.
                        '"Resultado":"Error en procesamiento}"';
                    echo json_encode($Resp);
                }
            }    
            if ($entityBody['Operacion'] == 'Actualizar') {
                // Verificar si 'id' está presente en el array
                if (isset($entityBody['id'])) {
                    // Preparar la consulta SQL
                    $sql = "UPDATE productos
                            SET fecha_creacion = COALESCE(:fecha_creacion, fecha_creacion),
                                descripcion = COALESCE(:descripcion, descripcion),
                                cantidad = COALESCE(:cantidad, cantidad),
                                precio = COALESCE(:precio, precio),
                                modelo = COALESCE(:modelo, modelo),
                                marca = COALESCE(:marca, marca),
                                caracteristicas = COALESCE(:caracteristicas, caracteristicas),
                                estado = COALESCE(:estado, estado)
                            WHERE id = :id;";
                    
                    // Preparar la sentencia SQL
                    $stmt = $pdo->prepare($sql);
            
                    // Vincular los valores, asegurándose de que los valores nulos sean manejados adecuadamente
                    $stmt->bindValue(':id', $entityBody['id']);
                    $stmt->bindValue(':fecha_creacion', isset($entityBody['fecha_creacion']) ? $entityBody['fecha_creacion'] : null);
                    $stmt->bindValue(':descripcion', isset($entityBody['descripcion']) ? $entityBody['descripcion'] : null);
                    $stmt->bindValue(':cantidad', isset($entityBody['cantidad']) ? $entityBody['cantidad'] : null);
                    $stmt->bindValue(':precio', isset($entityBody['precio']) ? $entityBody['precio'] : null);
                    $stmt->bindValue(':modelo', isset($entityBody['modelo']) ? $entityBody['modelo'] : null);
                    $stmt->bindValue(':marca', isset($entityBody['marca']) ? $entityBody['marca'] : null);
                    $stmt->bindValue(':caracteristicas', isset($entityBody['caracteristicas']) ? $entityBody['caracteristicas'] : null);
                    $stmt->bindValue(':estado', isset($entityBody['estado']) ? $entityBody['estado'] : null);
            
                    // Ejecutar la consulta
                    $resultado = $stmt->execute();
            
                    // Comprobar si la consulta fue exitosa
                    if ($resultado) {
                        header("HTTP/1.1 200 OK");
                        $Resp = [
                            "Registro Actualizado" => $stmt->rowCount(),
                            "Resultado" => "Success"
                        ];
                        echo json_encode($Resp);
                    } else {
                        header("HTTP/1.1 301 Error");
                        $Resp = [
                            "Registro Actualizado" => $stmt->rowCount(),
                            "Resultado" => "Error en procesamiento"
                        ];
                        echo json_encode($Resp);
                    }
                } else {
                    // Si 'id' no está presente en la solicitud, responder con un error
                    header("HTTP/1.1 301 Error");
                    $Resp = [
                        "Registro Actualizado" => 0,
                        "Resultado" => "Error el campo id es obligatorio"
                    ];
                    echo json_encode($Resp);
                }
            }
            
            if($entityBody['Operacion'] == 'Borrar' ){
                //echo 'PR: '.$entityBody['id'].' valor: '.(!empty(isset($entityBody['id'])));
                if(isset($entityBody['id'])){
                    $sql = "update productos 
                            set estado = 0
                            where id = :id;";  
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $entityBody['id']);
                    $resultado = $stmt->execute();
                    if($resultado){
                        header("HTTP/1.1 200 ok");
                        $Resp = '{"Registro Borrado": "'.$stmt->rowCount().'"'.
                            '"Resultado":"Success"}';
                        echo json_encode($Resp);
                    }else{
                        header("HTTP/1.1 301 Error");
                        $Resp = '{"Registro Borrado": "'.$stmt->rowCount().'"'.
                            '"Resultado":"Error en procesamiento"}';
                        echo json_encode($Resp);
                    }
                }else{
                    header("HTTP/1.1 301 Error");
                        $Resp = '{"Registro Borrado": "0"'.
                            '"Resultado":"Error el campo id es obligatorio"}';
                        echo json_encode($Resp);
                }
            }
            if($entityBody['Operacion'] == 'BorrarLista' ){
                //echo 'PR: '.$entityBody['id'].' valor: '.(!empty(isset($entityBody['id'])));
                if(isset($entityBody['id'])){
                    $sql = "update productos 
                            set estado = 0
                            where id in (".$entityBody['id'].");";  
                    $stmt = $pdo->prepare($sql);
                    $resultado = $stmt->execute();
                    if($resultado){
                        header("HTTP/1.1 200 ok");
                        $Resp = '{"Registro Borrado": "'.$stmt->rowCount().'"'.
                            '"Resultado":"Success"}';
                        echo json_encode($Resp);
                    }else{
                        header("HTTP/1.1 301 Error");
                        $Resp = '{"Registro Borrado": "'.$stmt->rowCount().'"'.
                            '"Resultado":"Error en procesamiento"}';
                        echo json_encode($Resp);
                    }
                }else{
                    header("HTTP/1.1 301 Error");
                        $Resp = '{"Registro Borrado": "0"'.
                            '"Resultado":"Error el campo id es obligatorio"}';
                        echo json_encode($Resp);
                }

            }
            exit;
         }
?>