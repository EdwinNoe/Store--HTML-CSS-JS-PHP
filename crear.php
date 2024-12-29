<?php
    require __DIR__ . '/includes/funciones.php';
    //$consulta = obtener_productos();
    /*echo "<pre>";
        var_dump($consulta);
    echo "</pre>";*/
     /* echo "<pre>";
         var_dump($_POST);
      echo "</pre>";*/
      $descripcion = '';
      $cantidad = '';
      $precio = '';
      $modelo = '';
      $marca = '';
      $caracteristicas = ''; 

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo "descripcion: ".$_POST['descripcion']."<br>";
        echo "cantidad: ".$_POST['cantidad']."<br>";
        echo "precio: ".$_POST['precio']."<br>";
        echo "modelo: ".$_POST['modelo']."<br>";
        echo "marca: ".$_POST['marca']."<br>";
        echo "caracteristicas: ".$_POST['caracteristicas']."<br>";
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $descripcion = $_POST['descripcion'] ;
        $cantidad = $_POST['cantidad'] ;
        $precio = $_POST['precio'] ;
        $modelo = $_POST['modelo'] ;
        $marca = $_POST['marca'] ;
        $caracteristicas = $_POST['caracteristicas'];
        $consulta = Crear_productosSP($descripcion, $cantidad, $precio, $modelo, $marca, $caracteristicas);
         echo "<pre>";
         var_dump(mysqli_fetch_assoc($consulta));
         echo "</pre>";
        //$resul = mysqli_fetch_assoc($consulta);
        //echo "pv_codigoError: ".$resul['pv_codigoError']."<br>";
        //echo "pv_DescError: ".$resul['pv_DescError']."<br>";

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontEnd Store</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" type="text/javascript">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="LeeElemento();SelProducto();">
    <header class="header">
        <a href="index.php">
            <img class="header__logo" src="img/logo.png" alt="Logotipo">
        </a>
        <div class="carrito">
            <a href="detalle.php">
                <svg class="carrito_icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="80" height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 17h-11v-14h-2" />
                <path d="M6 5l14 1l-1 7h-13" />
              </svg>
                <p id="idElemento" class="Elemento">0</p>
            </a>
        </div>
    </header>
    <nav class="navegacion">
        <a class="navegacion__enlace navegacion__enlace--activo" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="nosotros.php">Nosotros</a>
        <a class="navegacion__enlace" href="crear.php">Crear Producto</a>
        <a class="navegacion__enlace" href="crud.php">Crud Producto</a>
    </nav>
    <main class="contenedor">
        <h1 id="DescProd" Style="color: var(--blanco);"></h1>
            <!--img id="imgP" class="laptop__imagen" src="img/3.jpg" alt="Imagen del producto"-->
                <!--form class="formularioC" method="POST" action="/crear.php" enctype="multipart/form-data"-->
                 <form class="formularioC">
                <fieldset>
                    <legend>Resumen de datos ingresados</legend>

                    <div class="contenedor-campos">
                        <div class="campoC">
                            <label>Descripcion</label>
                            <input id="descripcion" name="descripcion"  class="formulario__campo" type="text" placeholder="Descripcion" value="<?php echo $descripcion; ?>">
                        </div>
                        <div class="campoC">
                            <label>Cantidad</label>
                            <input id="cantidad" name="cantidad" class="formulario__campo" type="number" placeholder="Cantidad" value="<?php echo $cantidad; ?>">
                        </div>
                        <div class="campoC">
                            <label>Precio</label>
                            <input id="precio" name="precio" class="formulario__campo" type="money" placeholder="Precio" value="<?php echo $precio; ?>">
                        </div>

                        <div class="campoC">
                            <label>Modelo</label>
                            <input id="modelo" name="modelo" class="formulario__campo" type="text" placeholder="Modelo" value="<?php echo $modelo; ?>">
                        </div>
                        <div class="campoC">
                            <label>Marca</label>
                            <input id="marca" name="marca" class="formulario__campo" type="text" placeholder="Marca" value="<?php echo $marca; ?>">
                        </div>

                        <div class="campoC">
                            <label>Caracteristicas</label>
                            <textarea id="caracteristicas" name="caracteristicas" class="formulario__campo" placeholder="Caracteristicas"><?php echo $caracteristicas; ?></textarea>
                        </div>
                        <input class="formulario__submit" type="button" value="Agregar Producto" onclick="CrearWSProducto()">
                    </div>
                </fieldset>
                </!--form>
    </main>
    <footer class="footer">
        <p class="footer__texto">FrontEnd Store - todos los derechos reservados 2024.</p>
    </footer>
</body>

</html>