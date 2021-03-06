
/*INICIO: BUSQUEDA DE CLIENTES*/
$("#txtproveedor").autocomplete({
    source: "../controlador/proveedor.autocompletar.controlador.php",
    minLength: 3, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_enfocar_registro,
    select: f_seleccionar_registro
});

function f_enfocar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtproveedor").val(registro.razon_social);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtruc").val(registro.ruc);
    $("#lbldireccion").val(registro.direccion);
    $("#lbltelefono").val(registro.telefono);
    
    event.preventDefault();
}
/*FIN: BUSQUEDA DE CLIENTES*/


/*Inicio busqueda articulo*/
$("#txtarticulo").autocomplete({
    source: "../controlador/articulo.autocompletar.controlador.php",
    minLength: 3, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_enfocar_registroArticulo,
    select: f_seleccionar_registroArticulo
});

function f_enfocar_registroArticulo(event, ui){
    var registro = ui.item.value;
    $("#txtarticulo").val(registro.nombre);
    //$("#txtcodigoarticulo").val(registro.nombre);
    event.preventDefault();
}

function f_seleccionar_registroArticulo(event, ui){
    var registro = ui.item.value;
    $("#txtprecio").val(registro.precio);
    $("#txtcodigoarticulo").val(registro.codigo);
    $("#txtarticulo").val(registro.nombre);
    $("#txtstock").val(registro.cantidad);
    $("#txtcantidad").focus();
    event.preventDefault();
}