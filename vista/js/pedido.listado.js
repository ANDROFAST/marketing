$(document).ready(function(){
    listar();
});

$("#btnagregar").click(function(){
   document.location.href = "pedido.vista.php"; 
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
        "../controlador/pedido.listado.controlador.php",
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
            html += '<th>FECHA REGISTRO</th>';
            html += '<th>FECHA DE EVENTO</th>';            
            html += '<th>CLIENTE</th>';            
            html += '<th>TOTAL</th>';            
            html += '<th>DIRECCIÓN DE EVENTO</th>';            
            html += '<th>TIPO DE EVENTO</th>';            
            html += '<th>ESTADO</th>';
            html += '<th>USUARIO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                console.log(item.estado);
                if( item.estado === "Pendiente" || item.estado === "Atendido" || item.estado === "Finalizado"){
                    html += '<tr>';
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-danger btn-xs" onclick="anular(' + item.numero_pedido + ')"><i class="fa fa-close"></i></button>';
                    html += '</td>'; 
                }else{
                    console.log('2'+item.estado);
                   if(item.estado === "Anulado"){
                    html += '<tr style="text-decoration:line-through; color:red">';
                    html += '<td align="center">';                    
                    html += '</td>';
                    }
                }
                
                html += '<td align="center">'+item.numero_pedido+'</td>';
                html += '<td>'+item.fecha_registro+'</td>';
                html += '<td>'+item.fecha_evento+'</td>';
                html += '<td>'+item.cliente+'</td>';
                html += '<td>'+item.total+'</td>';
                html += '<td>'+item.direccion_evento+'</td>';
                html += '<td>'+item.tipevento+'</td>';
                html += '<td>'+item.estado+'</td>';
                html += '<td>'+item.usuario+'</td>';
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

function anular(numero_pedido){
   swal({
            title: "Confirme",
            text: "¿Esta seguro de anular el pedido seleccionado?",

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
                    "../controlador/pedido.anular.controlador.php",
                    {
                        p_numero_pedido: numero_pedido
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