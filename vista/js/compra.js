$("#btnregresar").click(function(){
   document.location.href = "compra.listado.vista.php"; 
});

$(document).ready(function(){
    cargarComboTC("#cbotipocomp", "seleccione");
    obtenerPorcentajeIGV();
});

$("#cbotipocomp").change(function(){
    var tipoComprobante = $("#cbotipocomp").val();
    cargarComboSerie("#cboserie", "todos", tipoComprobante);
});

$("#cboserie").change(function(){
    obtenerNumeroComprobante();
});

$("#btnagregar").click(function(){

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
    
    var fila = '<tr>'+
                    '<td class="text-center">'+ codigoArticulo + '</td>' +
                    '<td>'+ nombreArticulo + '</td>' +
                    '<td class="text-center">'+ precioVenta + '</td>' +
                    '<td class="text-center">'+ cantidadVenta + '</td>' +
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

function calcularTotal(){
    var subTotal = 0;
    var igv = 0;
    var neto = 0;
    var porcentajeIGV = 18;
    
    $("#detallecompra tr").each(function(){
        //find es para buscar
        //eq obtiene el valor de la columna indicada como parametro
        var importe = $(this).find("td").eq(4).html();
        neto += parseFloat(importe);
    });
    
    subTotal = neto / (1 + (porcentajeIGV / 100));
    igv = neto - subTotal;
    
    //mostrar totales
    $("#txtimporteneto").val(neto.toFixed(2));
    $("#txtimportesubtotal").val(subTotal.toFixed(2));
    $("#txtimporteigv").val(igv.toFixed(2));
}

function obtenerNumeroComprobante(){
    var p_tipoComprobante = $("#cbotipocomp").val();
    var p_serie = $("#cboserie").val();
    
   $.post
    (
	"../controlador/numero.comprobante.cargar.combo.controlador.php",
        { p_tipoComprobante : p_tipoComprobante,
          p_serie : p_serie
        }
    ).done(function(resultado){
	var datosJSON = $.parseJSON( JSON.stringify(resultado) );

        if (datosJSON.estado === 200){
            var numero = datosJSON.datos.numero;
           $("#txtnrodoc").val(numero.toString());            
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
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

function obtenerPorcentajeIGV(){
    $.post(
            "../controlador/configuracion.controlador.php",
            { codigo : 1 }
           ).done(function(resultado){
               var dataJSON = resultado;
               
               if( dataJSON.estado === 200 ){
                   var valor = dataJSON.datos;
                   
                   $("#txtigv").val(valor);
               } else{
                   swal("Mensaje del sistema", resultado, "warning");
               }
           }).fail(function(error){
               var datosJson = $.parseJSON( error.responseText );
               swal("Error", datosJson.mensaje, "error");
           });
}

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
                
                //procedo a grabar
                //Capturar todos los datos necesarios para registrar
                arrayDetalle.splice(0, arrayDetalle.length);//limpiar array
                //Recorrer cuerpo de la tabla
                $("#detallecompra tr").each(function(){
                    var codigoArticulo = $(this).find("td").eq(0).html();
                    var precioArticulo = $(this).find("td").eq(2).html();
                    var cantidad = $(this).find("td").eq(3).html();
                    var importe = $(this).find("td").eq(4).html();
                    
                    var objDetalle = new Object();
                    objDetalle.codigoArticulo = codigoArticulo;
                    objDetalle.precioArticulo = precioArticulo;
                    objDetalle.cantidad = cantidad;
                    objDetalle.importe = importe;
                    
                    arrayDetalle.push(objDetalle);
                });
                
                //convierte arrayDetalle a JSON
                var jsonDetalle = JSON.stringify(arrayDetalle);

                $.post(
                    "../controlador/compra.agregar.controlador.php",
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
                                document.location.href="compra.listado.vista.php";
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
