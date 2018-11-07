$(document).ready(function(){
    listar();
});

$("#btnagregar").click(function(){
   document.location.href = "venta.vista.php"; 
});

$("#btnfiltrar").click(function(){
    listar(); 
});

function listar(){
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    var tipo   = $("#rbtipo:checked").val();//toma el valor del que esta seleccionado
    
    $.post
    (
        "../controlador/venta.listado.controlador.php",
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2,
            p_tipo: tipo
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '<th>NUMERO</th>';
            html += '<th>TIPO COMPROBANTE</th>';
            html += '<th>SERIE</th>';
            html += '<th>DOCUMENTO</th>';
            html += '<th>FECHA</th>';
            html += '<th>CLIENTE</th>';
            html += '<th>SUBTOTAL</th>';
            html += '<th>IGV</th>';
            html += '<th>TOTAL</th>';
            html += '<th>PORCENTAJE IGV</th>';
            html += '<th>ESTADO</th>';
            html += '<th>USUARIO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                if( item.est === "Emitido" ){
                    html += '<tr>';
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-danger btn-xs" onclick="anular(' + item.nroventa + ')"><i class="fa fa-close"></i></button>';
                    html += '</td>'; 
                }else{
                    html += '<tr style="text-decoration:line-through; color:red">';
                    html += '<td align="center">';                    
                    html += '</td>';
                }
                
                html += '<td align="center">'+item.nroventa+'</td>';
                html += '<td>'+item.codigotc+'</td>';
                html += '<td>'+item.nros+'</td>';
                html += '<td>'+item.nrod+'</td>';
                html += '<td>'+item.fv+'</td>';
                html += '<td>'+item.cl+'</td>';
                html += '<td>'+item.subt+'</td>';
                html += '<td>'+item.igv+'</td>';
                html += '<td>'+item.total+'</td>';
                html += '<td>'+item.porigv+'</td>';
                html += '<td>'+item.est+'</td>';
                html += '<td>'+item.usu+'</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            
            $("#listado").html(html);
            
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "desc"]],
                "sScrollX" : "100%",
                "sScrollXInner": "150%",
                "bScrollCollapse": true,
                "bPaginate": true
            });
       
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });
    
}

function anular(numero_venta){
   swal({
            title: "Confirme",
            text: "¿Esta seguro de anular la venta seleccionada?",

            showCancelButton: true,
            confirmButtonColor: '#d93f1f',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../imagenes/eliminar.png"
	},
	function(isConfirm){
            if (isConfirm){
                $.post(
                    "../controlador/venta.anular.controlador.php",
                    {
                        p_numero_venta: numero_venta
                    }
                    ).done(function(resultado){
                        var datosJSON = resultado;   
                        if (datosJSON.estado===200){ //ok
                            listar();
                            swal("Exito", datosJSON.mensaje , "success");
                        }

                    }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                    });
                
            }
	});
   
}
