function cargarComboMensaje(p_nombreCombo, p_tipo){
    $.post
    (
    "../controlador/mensaje.cargar.combo.controlador.php"
    ).done(function(resultado){
    var datosJSON = $.parseJSON( JSON.stringify(resultado) );
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione un tipo de evento</option>';
            }else{
                html += '<option value="0">Todos los tipos de eventos</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_mensaje+'">'+item.tipo_mensaje+'</option>';
            });
            $(p_nombreCombo).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}