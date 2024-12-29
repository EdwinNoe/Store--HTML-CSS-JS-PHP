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

<body onload="LeeElemento()">
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
        <a class="navegacion__enlace" href="producto.php">Tienda</a>
        <a class="navegacion__enlace" href="crear.php">Crear Producto</a>
        <a class="navegacion__enlace" href="crud.php">Crud Producto</a>
    </nav>
    <main class="contenedor">
        <h1>Nosotros</h1>
        <div class="nosotros">
            <div class="nosotros__contenido">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus scelerisque enim et leo vehicula, eu ultricies purus faucibus. Nam vel odio fermentum, pretium libero at, bibendum erat. Mauris in ex vitae quam dignissim pulvinar at ut magna. Suspendisse
                    tempor velit et tincidunt scelerisque. Sed vel lacus vel augue condimentum consectetur. Quisque volutpat at velit vel faucibus. Sed porta, eros ut ornare malesuada, arcu risus vehicula elit, eu pulvinar arcu dolor ac ligula. Donec
                    sit amet venenatis erat. Maecenas consequat et tortor ac tristique. Donec pretium convallis venenatis. Integer venenatis velit vel mi rutrum luctus. Nulla quis iaculis ligula. Aenean ut urna ultrices, aliquam diam malesuada, convallis
                    sem. Aliquam pretium nisi tellus, a laoreet arcu auctor id. Curabitur ac massa tristique, consectetur elit non, consequat sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>

                <P>
                    Sed consequat facilisis tempus. Nunc non consequat quam. Donec augue tortor, mollis id felis id, cursus pretium est. Fusce non rhoncus erat. Vestibulum ut ipsum magna. Etiam vehicula malesuada nibh, sed sollicitudin ex elementum at. Nam id erat suscipit,
                    ultricies nulla eget, imperdiet arcu. Curabitur id ligula eget erat condimentum dapibus id et quam. Integer vel tristique dui, ac consectetur massa. Vivamus venenatis nibh bibendum erat dapibus rhoncus. Morbi eros turpis, tincidunt
                    vel tellus quis, pellentesque dictum mauris. Morbi arcu metus, lacinia vitae ex sed, pellentesque fermentum justo. Phasellus dignissim porta leo, quis viverra est vestibulum iaculis. Vestibulum dictum nunc a ligula ultricies, sit amet
                    gravida orci dignissim. Interdum et malesuada fames ac ante ipsum primis in faucibus. In et tortor in est varius venenatis vitae nec nisl. Proin a odio vehicula, tempor leo quis, congue dui. In tempus porta nulla vel rutrum. Nullam
                    lectus nisl, aliquet eu nulla eu, hendrerit hendrerit turpis. Phasellus eleifend ultricies sodales. Donec cursus justo mauris, eget rhoncus elit commodo vitae.
                </P>
            </div>
            <img class="nosotros__imagen" src="img/nosotros.jpg">
        </div>
    </main>
    <section class="contenedor__comprar">
        <h2 class="comprar__titulo">¿Porqué comprar con nosotros?</h2>
        <div class="bloques">
            <div class="bloque">
                <img class="bloque__imagen" src="img/icono_1.png" alt="Porque comprar">
                <h3 class="bloque__titulo">El mejor precio</h3>
                <p>Pellentesque nec urna ipsum. Nunc quam ex, rutrum et neque sed, ornare vestibulum nulla. Ut vestibulum lorem in libero pellentesque, non tristique ligula ornare./p>
            </div>
            <!--  .Bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="img/icono_2.png" alt="Porque comprar">
                <h3 class="bloque__titulo">Para Devs</h3>
                <p>Pellentesque nec urna ipsum. Nunc quam ex, rutrum et neque sed, ornare vestibulum nulla. Ut vestibulum lorem in libero pellentesque, non tristique ligula ornare./p>
            </div>
            <!--  .Bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="img/icono_3.png" alt="Porque comprar">
                <h3 class="bloque__titulo">Envio gratis</h3>
                <p>Pellentesque nec urna ipsum. Nunc quam ex, rutrum et neque sed, ornare vestibulum nulla. Ut vestibulum lorem in libero pellentesque, non tristique ligula ornare./p>
            </div>
            <!--  .Bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="img/icono_4.png" alt="Porque comprar">
                <h3 class="bloque__titulo">La mejor calidad</h3>
                <p>Pellentesque nec urna ipsum. Nunc quam ex, rutrum et neque sed, ornare vestibulum nulla. Ut vestibulum lorem in libero pellentesque, non tristique ligula ornare./p>
            </div>
            <!--  .Bloque-->
        </div>
        <!--  .Bloques-->

    </section>
    <footer class="footer">
        <p class="footer__texto">FrontEnd Store - todos los derechos reservados 2024.</p>
    </footer>
</body>

</html>