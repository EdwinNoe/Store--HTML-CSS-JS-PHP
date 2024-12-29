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

<body onload="LeeElemento();DetProducto();">
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
        <h1 id="DescFact" Style="color: var(--blanco);">Factura</h1>
        <div class="laptop2">
            <div class="laptop__contenido"></div>
            <form class="formulario"></form>
            <table class="invoice">
                <thead>
                    <tr class="HeaFactura">
                        <th class="EncFactura">Img</th>
                        <th class="EncFactura">No Items</th>
                        <th class="EncFactura">Descripcion</th>
                        <th class="EncFactura">Procesador</th>
                        <th class="EncFactura">Cantidad</th>
                        <th class="EncFactura">Precio</th>
                        <th class="EncFactura">Total</th>
                    </tr>
                </thead>
                <tr class="LinFactura">
                    <td class="DetFactura" id="DetPC1"><img id="imgP" class="laptop__imagen2" src="img/3.jpg" alt="Imagen del producto"></td>
                    <td class="DetFactura" id="DetPC2">1.</td>
                    <td class="DetFactura" id="DetPC3">Macbook Air Pro 14</td>
                    <td class="DetFactura" id="DetPC4">Procesador Intel i5</td>
                    <td class="DetFactura" id="DetPC5">3</td>
                    <td class="DetFactura" id="DetPC6">1230.25</td>
                    <td class="DetFactura" id="DetPC7">4300.00</td>
                </tr>
                <tr class="LinFactura LinFactura__subs">
                    <td class="DetFactura" id="DetPC26" colspan="6">Subtotal</td>
                    <td class="DetFactura" id="DetPC27">400.00</td>
                </tr>
                <tr class="LinFactura LinFactura__subs">
                    <td class="DetFactura" id="DetPC36" colspan="6">Impuesto</td>
                    <td class="DetFactura" id="DetPC37">400.00</td>
                </tr>
                <tr class="LinFactura LinFactura__subs">
                    <td class="DetFactura" id="DetPC46" colspan="6">Total</td>
                    <td class="DetFactura" id="DetPC47">400.00</td>
                </tr>
            </table>
            </form>
        </div>
        </div>
    </main>
    <footer class="footer">
        <p class="footer__texto">FrontEnd Store - todos los derechos reservados 2024.</p>
    </footer>
</body>

</html>