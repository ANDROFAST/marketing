$("#btnregresar").click(function(){
   document.location.href = "mensaje.listado.vista.php"; 
});

$(document).ready(function(){
    cargarComboMensaje("#cbomensaje", "seleccione");

});
$("#cbomensaje").change(function(){
  
});

$("#btnagregar").click(function(){
    
    var codigoCliente = $("#txtcodigocliente").val();
    var nombreCliente = $("#txtnombrecliente").val();
    var fecha = $("#txtfec").val();
    //var mensaje = $("#cbomensaje").val();
   // var mensaje = $("#cbomensaje option:selected").val();
    //var mensaje = $("#cbomensaje option:selected").text();
     var Codmensaje = $("#cbomensaje option:selected").val();
     var nombreMensaje = $("#cbomensaje option:selected").html();
   //  var codigoMensaje = $("#cbomensaje").val();

    
    var fila = '<tr>'+
                    '<td class="text-center">'+ codigoCliente + '</td>' +
                    '<td>'+ nombreCliente + '</td>' +
                    '<td class="text-center">'+ fecha + '</td>' +
                    '<td class="text-center">'+ Codmensaje+ '</td>' +
                    '<td class="text-center">'+ nombreMensaje+ '</td>' +                    
                    '<td id="celiminar"><a href="javascript:void()"><i class="fa fa-trash"></i></a></td>' +
               '</tr>';
    
    //Agregar registro al detalle de la venta
    $("#detallecompra").append(fila);
    
    //llama a la funcion para calcular totales
    
    //Limpiar controles
    $("#txtcodigocliente").val("");
    $("#txtnombrecliente").val("");
    $("#txtfec").val("");
    $("#txtcodigocliente").focus();
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
            $("#txtcodigocliente").focus();
        }//fin if       
    }
    );
});

var arrayDetalle = new Array();
/*Agregar una venta*/
$("#frmgrabar").submit(function(evento){
    evento.preventDefault();
    
    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar el evento",
        
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
                    var codigoCliente = $(this).find("td").eq(0).html();
                    var fecha = $(this).find("td").eq(2).html();
                    var Codmensaje = $(this).find("td").eq(3).html();
                    
                    var objDetalle = new Object();
                    objDetalle.codigoCliente = codigoCliente;
                    objDetalle.fecha = fecha;
                    objDetalle.Codmensaje = Codmensaje;
                    
                    arrayDetalle.push(objDetalle);
                });
                
                //convierte arrayDetalle a JSON
                var jsonDetalle = JSON.stringify(arrayDetalle);
                 $.post(
                    "../controlador/mensaje.agregar.controlador.php",
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
                                document.location.href="venta.listado.vista.php";
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