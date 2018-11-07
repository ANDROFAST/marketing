$("#btnregresar").click(function(){
   document.location.href = "pedido.listado.vista.php"; 
});

$(document).ready(function(){

    cargarComboTE("#cboevento", "seleccione");
    obtenerPorcentajeIGV();
});

$("#cboevento").change(function(){
  var tipoEvento = $("#cboevento").val();
});
$("#cboanio").change(function(){
  var anio = $("#cboanio").val();
});


$("#btnagregar").click(function(){
    //alert("Cantidad: "+$("#txtcantidad").val() +"\nStock: "+$("#txtstock").val());
    
    if( parseInt($("#txtcantidad").val()) > parseInt($("#txtstock").val()) ){
        swal("Mensaje", "Estock insuficiente", "warning");
        return 0;
    }
    
    if( parseInt($("#txtcantidad").val()) === 0 ){
        swal("Mensaje", "Debe asignar una cantidad mayor a cero", "warning");
        return 0;
    }
    
    if( $("#txtcodigoarticulo").val().toString() === "" ){
        swal( "Verifique" ,"Debe seleccionar un articulo", "Warning");
        
        $("#txtarticulo").focus();
        return 0;
    }
    
    var codigoArticulo = $("#txtcodigoarticulo").val();
    var nombreArticulo = $("#txtarticulo").val();
    var precioVenta = $("#txtprecio").val();
    var cantidadVenta = $("#txtcantidad").val();
    var importe = precioVenta * cantidadVenta;
    var descuento=0.00;
    var fila = '<tr>'+
                    '<td class="text-center">'+ codigoArticulo + '</td>' +
                    '<td>'+ nombreArticulo + '</td>' +
                    '<td class="text-center">'+ precioVenta + '</td>' +
                    '<td class="text-center" id="ccantidad">'+ cantidadVenta + '</td>' +
                    '<td class="text-center" id="cdescuento">'+ descuento.toFixed(2) + '</td>' +
                    '<td class="text-center">'+ importe + '</td>' +
                    '<td id="celiminar"><a href="javascript:void()"><i class="fa fa-trash"></i></a></td>' +
               '</tr>';
    
    //Agregar registro al detalle de la venta
    $("#detallecompra").append(fila);
    
    //llama a la funcion para calcular totales
    calcularTotal();
    
    //Limpiar controles
    $("#txtcodigoarticulo").val("");
    $("#txtarticulo").val("");
    $("#txtprecio").val("");
    $("#txtcantidad").val("");
    $("#txtstock").val("");
    $("#txtarticulo").focus();
});

$(document).on("click", "#celiminar", function(){
    var filaEliminar = $(this).parents().get(0);
    
    swal({
        title: "Confirme",
        text: "¿Desea eliminar el registro seleccionado",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#ff0000',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, 
    function(isConfirm){
        
        if( isConfirm ){
            filaEliminar.remove();
            calcularTotal();
            $("#txtarticulo").focus();
        }//fin if       
    }
    );
});


$(document).on("dblclick", "#ccantidad", function () {
    if ($(this).html().substring(0,6) === "<input") {
        return 1; 
    }
    
    var cantidad = $(this).html();
    var htmlCajaTexto = '<input type="text" id="txtCANT" class="form-control" value="'+cantidad+'"/>';
    $(this).html(htmlCajaTexto);
    $("#txtCANT").focus();
});

$(document).on("dblclick", "#cdescuento", function () {
    if ($(this).html().substring(0,6) === "<input") {
        return 1; 
    }
    
    var descuento = $(this).html();
    var htmlCajaTexto = '<input type="text" id="txtDESC" class="form-control" value="'+descuento+'"/>';
    $(this).html(htmlCajaTexto);
    $("#txtDESC").focus();
});

function calcularTotal(){
    var neto = 0;

    
    $("#detallecompra tr").each(function(){
        //find es para buscar
        //eq obtiene el valor de la columna indicada como parametro
        var importe = $(this).find("td").eq(5).html();
        neto += parseFloat(importe);
    });
    
    
    //mostrar totales
    $("#txtimporteneto").val(neto.toFixed(2));
}

$("#txtcantidad").keypress(function(evento){
    if( evento.which === 13 ){//si se presiono ENTER
        evento.preventDefault();
        
        $("#btnagregar").click();
    }
    else{
        return validarNumeros(evento);
    }
});


$(document).on("keypress", "#txtCANT", function (evento) {

    if (evento.which === 13){ 
       
        if($(this).val().length=== 0 || $(this).val()=== 0){                    
            
                var precio = $(this).parents().find("td").eq(2).html();   
                var cantidad = 0;
                var descuento =  $(this).parents().find("td").eq(4).html();
                //var importe = ( parseFloat(precio) * cantidad ) - descuento;
                var importe= 0;
                $(this).parents().find("td").eq(5).empty().append(importe.toFixed(2));            
                $(this).parents().find("td").eq(3).empty().append(0);        
        }else{
                var precio1 = $(this).parents().find("td").eq(2).html();   
                var cantidad1 = $(this).val();                
                var descuento1 =  $(this).parents().find("td").eq(4).html();                
                var importe1 = ( parseFloat(precio1) * cantidad1 ) - descuento1;
                $(this).parents().find("td").eq(5).empty().append(importe1.toFixed(2));            
                $(this).parents().find("td").eq(3).empty().append(cantidad1);        
            
        }
    }else{
        return validarNumeros(evento);
    }    
    calcularTotal();
});

$(document).on("keypress", "#txtDESC", function (evento) {

    if (evento.which === 13){ 
       
        if($(this).val().length=== 0 || $(this).val()=== 0){                    
            
                var precio = $(this).parents().find("td").eq(2).html();   
                var cantidad = $(this).parents().find("td").eq(3).html();
                var importe = ( parseFloat(precio) * cantidad ) - 0;
                var des= 0;
                
                $(this).parents().find("td").eq(5).empty().append(importe.toFixed(2));            
                $(this).parents().find("td").eq(4).empty().append(des.toFixed(2));        
        }else{
                var precio = $(this).parents().find("td").eq(2).html();   
                var cantidad = $(this).parents().find("td").eq(3).html();
                var descuento = $(this).val();                
                var descfloat= parseFloat(descuento) - 0.00;
                var importe;
                if(cantidad==0){
                    importe = 0;
                }else{
                    importe = ( parseFloat(precio) * cantidad ) - descuento;
                }
                $(this).parents().find("td").eq(5).empty().append(importe.toFixed(2));            
                $(this).parents().find("td").eq(4).empty().append(descfloat.toFixed(2));        
            
        }
    }else{
        return validarNumeros(evento);
    }    
    calcularTotal();
});



//Para almacenar todos los articulos de la venta
var arrayDetalle = new Array();

/*Agregar una venta*/
$("#frmgrabar").submit(function(evento){
    evento.preventDefault();
    
    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar la venta?",
        
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
                imageUrl: "../imagenes/pregunta.png"
    },
    function(isConfirm){ 

            if (isConfirm){ //el usuario hizo clic en el boton SI     
                var item=0;
                //procedo a grabar
                //Capturar todos los datos necesarios para registrar
                arrayDetalle.splice(0, arrayDetalle.length);//limpiar array
                //Recorrer cuerpo de la tabla
                $("#detallecompra tr").each(function(){
                    var codigoArticulo = $(this).find("td").eq(0).html();
                    var precioArticulo = $(this).find("td").eq(2).html();
                    var cantidad = $(this).find("td").eq(3).html();
                    var descuento = $(this).find("td").eq(4).html();
                    var importe = $(this).find("td").eq(5).html();
                    item=item+1;
                    var objDetalle = new Object();
                    objDetalle.codigoArticulo = codigoArticulo;
                    objDetalle.precioArticulo = precioArticulo;
                    objDetalle.cantidad = cantidad;
                    objDetalle.descuento = descuento;
                    objDetalle.importe = importe;
                    objDetalle.item = item;
                    arrayDetalle.push(objDetalle);
                });
                
                //convierte arrayDetalle a JSON
                var jsonDetalle = JSON.stringify(arrayDetalle);

                $.post(
                    "../controlador/pedido.agregar.controlador.php",
                    {
                        p_datosFormulario: $("#frmgrabar").serialize(),
                        p_datosJsonDetalle: jsonDetalle
                    }
                  ).done(function(resultado){                    
              var datosJSON = resultado;

                      if (datosJSON.estado === 200){
              swal({
                                title: "Exito",
                                text: datosJSON.mensaje,
                                type: "success",
                                showCancelButton: false,
                                //confirmButtonColor: '#3d9205',
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            },
                            function(){
                                document.location.href="pedido.listado.vista.php";
                            });
                      }else{
                          swal("Mensaje del sistema", resultado , "warning");
                      }

                  }).fail(function(error){
            var datosJSON = $.parseJSON( error.responseText );
            swal("Error", datosJSON.mensaje , "error");
                  }) ;
                
            }
    });    
});
