<?php
    require __DIR__ . '/includes/funciones.php';
	$Respuesta = obtener_prod_totales();
	$Totales = mysqli_fetch_assoc($Respuesta);
	$TotRegP = 0;
	$RegXPag = 0;
	$TotReg = 0;
	$inicio = 0;
	/*echo 'Totales: ';
	var_dump($Totales);*/
	if($Totales['Total'] > 0){
		$TotReg = $Totales['Total'];
		$TotRegP = sqrt($Totales['Total']); // se usa raiz cuadra para No Registros por Paginas total registro en tabla 
		if($TotRegP <= 5){ //si la cantidad de registros
			$RegXPag = 5;
			$TotRegP = $Totales['Total'] / 5;
		}else{
			if($Totales['Total'] % $TotRegP != 0){
				$TotRegP  =ceil($TotRegP);
				$RegXPag = floor(sqrt($Totales['Total']));
			}
		}
		/*echo 'Reg x pag: '.$RegXPag;
		echo 'Total Pag: '.$TotRegP;*/
	}
	if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
		//echo 'Pagina: '.$_GET['pagina'];
		$Previo = ($pagina > 1) ? $pagina - 1: 1;
		$Pactiva = $pagina;
		$Next = ($pagina < $TotRegP) ? $pagina + 1: $TotRegP;
		$inicio = ($pagina - 1)*5;
	}else{
		$pagina = 1;
		echo 'Pagina: '.$pagina;
		$Previo = 0;
		$Pactiva = 1;
		$Previo = $Pactiva - 1;
		$Next = $Pactiva + 1;
		$inicio = 0;
	}
	$consulta = obtener_productos_pagina($inicio, $RegXPag);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
	/*$(".editProduct").on("click", function() {   //adiciona descripcion a editmodal
        var descripcion = $(this).closest("tr").find('td:nth-child(3)').text().trim(); //get cat name
		console.log('Ejecuta editProduct: '+ descripcion);
        $('#descripcion').val(descripcion); //set value

    });*/
});
</script>
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
        <div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Administracion <b>Productos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Nuevo Producto</span></a>
						<a href="#deleteProductModalAll" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Borrar</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Descripcion</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Modelo</th>
						<th>Marca</th>
                        <th>Caracteristicas</th>
					</tr>
				</thead>
				<tbody>
					<?php while($producto = mysqli_fetch_assoc($consulta)){ ?>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox_<?php  echo $producto['id']; ?>" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td id="id_<?php  echo $producto['id']; ?>" hidden><?php  echo $producto['id']; ?></td>
						<td id="descripcion_<?php  echo $producto['id']; ?>"><?php  echo $producto['descripcion']; ?></td>
						<td id="cantidad_<?php  echo $producto['id']; ?>"><?php  echo $producto['cantidad']; ?></td>
						<td id="precio_<?php  echo $producto['id']; ?>"><?php  echo $producto['precio']; ?></td>
						<td id="modelo_<?php  echo $producto['id']; ?>"><?php  echo $producto['modelo']; ?></td>
                        <td id="marca_<?php  echo $producto['id']; ?>"><?php  echo $producto['marca']; ?></td>
						<td id="caracteristicas_<?php  echo $producto['id']; ?>"><?php  echo $producto['caracteristicas']; ?></td>
						<td>
							<a href="#editProductModal" class="edit editProduct" data-toggle="modal" onclick="EditElem('<?php  echo $producto['id']; ?>');"><i class="material-icons" data-toggle="tooltip"  title="Edit">&#xE254;</i></a>
							<a href="#deleteProductModal" class="delete" data-toggle="modal" onclick="DelElem('<?php  echo $producto['id']; ?>');"><i class="material-icons" data-toggle="tooltip"  title="Delete">&#xE872;</i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text" style="color:black;">Mostrando <b><?php  echo $RegXPag; ?></b> de <b><?php  echo $TotRegP; ?></b> Paginas</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="crud.php?pagina=<?php  echo $Previo; ?>">Previous</a></li>
					<li class="page-item <?php  echo ($Pactiva == 1) ? "active" : ""; ?>"><a href="crud.php?pagina=1" class="page-link">1</a></li>
					<?php for($i = 2; $i < $TotRegP; $i++){ ?>
					<li class="page-item <?php  echo ($Pactiva == $i) ? "active" : ""; ?>"><a href="crud.php?pagina=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a></li>
					<?php } ?>
					<li class="page-item"><a href="crud.php?pagina=<?php  echo $Next; ?>" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addProductModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Productos</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Descripcion</label>
						<input type="text" id="descripcionA" class="form-control" required id="descripcion1">
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="text" id="cantidadA" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="text" id="precioA" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Modelo</label>
						<input type="text" id="modeloA" class="form-control" required>
					</div>	
                    <div class="form-group">
						<label>Marca</label>
						<input type="text" id="marcaA" class="form-control" required>
					</div>	
                    <div class="form-group">
						<label>Caracteristicas</label>
                        <textarea id="caracteristicasA" class="form-control" required></textarea>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" value="Agregar" onclick="AddElemSave();">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editProductModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Editar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				   <div hidden class="form-group">
						<label >id</label>
						<input  type="text"  id="id" class="form-control" required>
					</div>				
                    <div class="form-group">
						<label>Descripcion</label>
						<input type="text"  id="descripcion" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="text"  id="cantidad" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="text"  id="precio" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Modelo</label>
						<input type="text"  id="modelo" class="form-control" required>
					</div>	
                    <div class="form-group">
						<label>Marca</label>
						<input type="text"  id="marca" class="form-control" required>
					</div>	
                    <div class="form-group">
						<label>Caracteristicas</label>
                        <textarea  id="caracteristicas" class="form-control" required></textarea>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-info" value="Guardar" onclick="EditElemSave();">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteProductModalAll" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Borrar Producto seleccionados</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Esta seguro que desea borrar los productos seleccionados?</p>
					<p class="text-warning"><small>Esta accion sera permanente.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-danger" value="Borrar" onclick="DelTodosClick();">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="deleteProductModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Borrar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div hidden class="form-group">
						<label hidden>id</label>
						<input hidden type="text" id="idE" class="form-control" required>
					</div>
				<div class="modal-body">					
					<p>Esta seguro que desea borrar este producto?</p>
					<p class="text-warning"><small>Esta accion sera permanente.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-danger" value="Borrar" onclick="DelElemSave();">
				</div>
			</form>
		</div>
	</div>
</div>
    </main>
    <footer class="footer">
        <p class="footer__texto">FrontEnd Store - todos los derechos reservados 2024.</p>
    </footer>
</body>

</html>