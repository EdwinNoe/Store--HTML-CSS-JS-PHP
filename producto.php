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
    <script src="js/script.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="LeeElemento();SelProducto();LeerWSPromocion();">
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
        <div class="laptop">
            <img id="imgP" class="laptop__imagen" src="img/3.jpg" alt="Imagen del producto">
            <div class="laptop__contenido">
                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer auctor lacus sapien, nec molestie ipsum bibendum eu. Nullam vitae velit massa. Pellentesque nec porttitor elit, ac luctus ex. Donec commodo
                    sem nec elit ullamcorper, vitae cursus felis facilisis.</p>
                <p>
                    <h3 id="PreProd" Style="color: var(--blanco); text-align: left; "></h3>
                    <h3 id="CanProd" Style="color: var(--blanco); text-align: left; "></h3>
                    <h3 id="SubProd" Style="color: var(--blanco); text-align: left; "></h3>
                </p>
                <form class="formulario">
                    <select id="TipoProcesador" class="formulario__campo">
                        <option selected disabled>--Seleccionar el procesador--</option>
                        <option>Core 5i</option>
                        <option>Core 7i</option>
                        <option>Core 9i</option>
                    </select>
                    <input id="CantElemento" class="formulario__campo" type="number" placeholder="cantidad" min="1">
                    <!-- step="2"-->
                    <input class="formulario__submit" type="button" value="Agregar al Carrito" onclick="AddElemento()">
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <p class="footer__texto">FrontEnd Store - todos los derechos reservados 2024.</p>
    </footer>
</body>

</html>