function AddElemento() {
    let Total = document.querySelector('#CantElemento').value;
    let Seleccionado = document.getElementById('TipoProcesador');
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    let idProducto = urlParams.get('idProd');
    console.log('Total: ' + Total);
    if (Total > 0 && Total <= 5) {
        if (Seleccionado.selectedOptions[0].value !== '--Seleccionar el procesador--') {
            if (idProducto > 0) {
                document.getElementById('CanProd').innerHTML = 'Cantidad: ' + Total;
                document.getElementById('SubProd').innerHTML = 'Subtotal: ' + parseFloat(Math.round(Total * Prod[idProducto].Precio)).toFixed(2);
                setCookie('Productos', Total, 2);
                setCookie('ProdSeleccionado', idProducto + '|' +
                    Prod[idProducto].Desc + '|' +
                    Seleccionado.selectedOptions[0].value + '|' +
                    Total + '|' +
                    Prod[idProducto].Precio + '|' +
                    parseFloat(Math.round(Total * Prod[idProducto].Precio)).toFixed(2), 2);
                document.getElementById('idElemento').innerHTML = Total;

            } else {
                alert('Debe seleccionar un equipo valido');
            }
        } else {
            alert('Debe seleccionar un tipo de procesador valido');
        }
    } else {
        alert('El numero de productos debe ser mayor a 0 y menor que 6');
    }
}

function LeeElemento() {
    let Total = getCookie('Productos');
    if (Total > 0) {
        document.getElementById('idElemento').innerHTML = Total;
    }
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    //Productos=4;expires=72836482823;path=/
    //TotalApagar=2300.34;...;

}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    //alert('documentCookie: ' + decodedCookie);
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].split('=');
        if (c.length >= 2) {
            if (c[0].trim() === cname.trim()) {
                // console.log('c[0]:' + c[0]);
                // console.log('c[1]:' + c[1]);
                return c[1];
            }
        }
    }
    return "";
}
var Prod = [{ idProd: 1, Desc: 'MacBook pro14', Precio: 1890.00 },
    { idProd: 2, Desc: 'MacBook Air 13', Precio: 1350.99 },
    { idProd: 3, Desc: 'MacBook Pro16', Precio: 2199.99 },
    { idProd: 4, Desc: 'Lenovo thinkpad T114', Precio: 1325.99 },
    { idProd: 5, Desc: 'Lenovo thinkbook 16', Precio: 825.00 },
    { idProd: 6, Desc: 'Lenovo Yoga 14', Precio: 769.00 },
    { idProd: 7, Desc: 'Dell inspiron', Precio: 825.23 },
    { idProd: 8, Desc: 'Dell XPS', Precio: 1325.00 },
    { idProd: 9, Desc: 'Aliensware AW15', Precio: 2189.78 },
    { idProd: 10, Desc: 'Aliensware X16', Precio: 2513.99 },
    { idProd: 11, Desc: 'Aliensware M15', Precio: 2230.00 },
    { idProd: 12, Desc: 'Aliensware Gamming G23', Precio: 2340.99 },
    { idProd: 13, Desc: 'Samsung Galaxy Book6', Precio: 1449.00 },
    { idProd: 14, Desc: 'Samsung Notebook 9', Precio: 1289.78 }
];

function SelProducto() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idProducto = urlParams.get('idProd');
    //alert('Selecciono el producto: ' + idProducto);
    if (idProducto > 0) {
        document.getElementById('DescProd').innerHTML = Prod[idProducto].Desc;
        document.getElementById('PreProd').innerHTML = 'PRECIO: $ ' + Prod[idProducto].Precio;
        var imgPro = document.getElementById("imgP");
        imgPro.src = 'img/' + idProducto + '.jpg';
        //alert('Selecciono el producto: ' + idProducto);
    }
}

function DetProducto() {
    let Total = getCookie('Productos');
    //alert('Productos: ' + Total);
    if (Total > 0) {
        let DatosProd = getCookie('ProdSeleccionado');
        let info = DatosProd.split('|');
        //alert('Datos: ' + DatosProd);
        let idProducto = info[0];
        let Descripcion = info[1];
        let Procesador = info[2];
        let Cantidad = info[3];
        let Precio = info[4];
        let Total = info[5];
        let imgPro = document.getElementById("imgP");
        imgPro.src = 'img/' + idProducto + '.jpg';
        document.getElementById('DetPC3').innerHTML = Descripcion;
        document.getElementById('DetPC4').innerHTML = Procesador;
        document.getElementById('DetPC5').innerHTML = Cantidad;
        document.getElementById('DetPC6').innerHTML = Precio;
        document.getElementById('DetPC7').innerHTML = Total;
        document.getElementById('DetPC27').innerHTML = Total;
        document.getElementById('DetPC37').innerHTML = parseFloat(Math.round(Total * 0.15)).toFixed(2);
        document.getElementById('DetPC47').innerHTML = parseFloat(Math.round(Total * 1.15)).toFixed(2);
    }
}

function LeerWSProducto() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idProducto = urlParams.get('idProd');
    $.ajax({
        type: 'GET',
        url: 'http://localhost:3000/Controller/controlador.php?id=' + idProducto,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert('Producto: ' + data[0].descripcion);
        }
    });

}

function LeerWSPromocion() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var idProducto = urlParams.get('idProd');
    $.ajax({
        type: 'GET',
        url: 'http://localhost:30000/Controller/promocion.php?id=' + idProducto,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data[0].Descuento != '0.00') {
                document.getElementById('DescProd').innerHTML += '<br>Descuento de: ' + parseFloat(Math.round(data[0].Descuento * 100.00)).toFixed(2) + '%';
            }
            if (data[0].Aumento != '0.00') {
                document.getElementById('DescProd').innerHTML += '<br>Aumento de: ' + parseFloat(Math.round(data[0].Aumento * 100.00)).toFixed(2) + '%';
            }
            alert('Producto: ' + data[0].Descripcion);
        }
    });
}

function CrearWSProducto() {
    var WsDes = document.getElementById('descripcion').value;
    var WsCan = document.getElementById('cantidad').value;
    var WsPre = document.getElementById('precio').value;
    var WsMod = document.getElementById('modelo').value;
    var WsMar = document.getElementById('marca').value;
    var WsCar = document.getElementById('caracteristicas').value;
    var Query = '{"fecha_creacion": "2024-08-28 20:14:01", \n' +
        '"descripcion": "' + WsDes + '", \n' +
        '"cantidad": "' + WsCan + '", \n' +
        '"precio": "' + WsPre + '", \n' +
        '"modelo": "' + WsMod + '", \n' +
        '"marca": "' + WsMar + '", \n' +
        '"caracteristicas": "' + WsCar + '", \n' +
        '"estado": "1"}';
    $.ajax({
        type: 'POST',
        url: 'http://localhost:3000/Controller/controlador.php',
        contentType: 'application/json; charset=utf-8',
        data: Query,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert('data Exito: ' + data);
        },
        error: function(err) {
            console.log(err);
            alert('data Error: ' + err);
        }
    });
}

function EditElem(NoRow) {
    document.getElementById('id').value = document.getElementById('id_' + NoRow).innerHTML;
    document.getElementById('descripcion').value = document.getElementById('descripcion_' + NoRow).innerHTML;
    document.getElementById('cantidad').value = document.getElementById('cantidad_' + NoRow).innerHTML;
    document.getElementById('precio').value = document.getElementById('precio_' + NoRow).innerHTML;
    document.getElementById('modelo').value = document.getElementById('modelo_' + NoRow).innerHTML;
    document.getElementById('marca').value = document.getElementById('marca_' + NoRow).innerHTML;
    document.getElementById('caracteristicas').value = document.getElementById('caracteristicas_' + NoRow).innerHTML;
}


function EditElemSave() {
    var data = {
        Operacion: "Actualizar",
        id: document.getElementById('id').value,
        descripcion: document.getElementById('descripcion').value,
        fecha_creacion: "2024-08-28 20:14:01",
        cantidad: document.getElementById('cantidad').value,
        precio: document.getElementById('precio').value,
        modelo: document.getElementById('modelo').value,
        marca: document.getElementById('marca').value,
        caracteristicas: document.getElementById('caracteristicas').value,
        estado: "1"
    };

    $.ajax({
        type: 'POST',
        url: 'http://localhost:30000/Controller/producto.php',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(data),
        dataType: 'json',
        success: function(response) {
            console.log(response);
            alert('Operación exitosa: ' + JSON.stringify(response));
            location.reload();
        },
        error: function(err) {
            console.error('Error en la solicitud:', err);
            alert('Error en la operación: ' + (err.responseJSON ? err.responseJSON.message : 'Desconocido'));
        }
    });
}


function DelElem(NoRow) {
    document.getElementById('idE').value = document.getElementById('id_' + NoRow).innerHTML;
}

function DelElemSave() {
    var WsId = document.getElementById('idE').value;
    var Query = '{"Operacion": "Borrar", \n' +
        '"id": "' + WsId + '"}';
    $.ajax({
        type: 'POST',
        url: 'http://localhost:30000/Controller/producto.php',
        contentType: 'application/json; charset=utf-8',
        data: Query,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert('data Exito: ' + data);
            location.reload();
        },
        error: function(err) {
            console.log(err);
            alert('data Error: ' + err);
        }
    });

}

function AddElemSave() {
    // var WsId = document.getElementById('id').value;
    var WsDes = document.getElementById('descripcionA').value;
    var WsCan = document.getElementById('cantidadA').value;
    var WsPre = document.getElementById('precioA').value;
    var WsMod = document.getElementById('modeloA').value;
    var WsMar = document.getElementById('marcaA').value;
    var WsCar = document.getElementById('caracteristicasA').value;
    var Query = '{"Operacion": "Crear", \n' +
        '"fecha_creacion": "2024-08-28 20:14:01", \n' +
        '"descripcion": "' + WsDes + '", \n' +
        '"cantidad": "' + WsCan + '", \n' +
        '"precio": "' + WsPre + '", \n' +
        '"modelo": "' + WsMod + '", \n' +
        '"marca": "' + WsMar + '", \n' +
        '"caracteristicas": "' + WsCar + '", \n' +
        '"estado": "1"}';
    $.ajax({
        type: 'POST',
        url: 'http://localhost:30000/Controller/producto.php',
        contentType: 'application/json; charset=utf-8',
        data: Query,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert('data Exito: ' + data);
            location.reload();
        },
        error: function(err) {
            console.log(err);
            alert('data Error: ' + err);
        }
    });

}

function DelTodosClick() {
    var i = 0;
    var Lista = "";
    var checkbox = $('table tbody input[type="checkbox"]');
    $("input:checkbox[name='options[]']:checked").each(function() { //Para todos los checkbox seleccionados o checked   $(this).attr('id').
        Lista += $(this).closest("tr").find('td:nth-child(2)').text().trim() + ",";
        //alert('No: ' + $(this).closest("tr").find('td:nth-child(2)').text().trim()); //Toma la columna 2  Id de las filas seleccionadas
    });
    Lista = Lista.substring(0, Lista.lastIndexOf(',')); // genera la lista (1,8,9,6,) de Ids a borrar y se debe borrar la ultima coma ejemplo 1,8,9,6
    DelElemSaveLista(Lista);
}

function DelElemSaveLista(idLista) {
    var Query = '{"Operacion": "BorrarLista", \n' +
        '"id": "' + idLista + '"}';
    alert('Query: ' + Query);
    $.ajax({
        type: 'POST',
        url: 'http://localhost:30000/Controller/producto.php',
        contentType: 'application/json; charset=utf-8',
        data: Query,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert('data Exito: ' + data);
            location.reload();
        },
        error: function(err) {
            console.log(err);
            alert('data Error: ' + err);
        }
    });

}