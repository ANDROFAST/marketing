function cargarComboTC(p_nombreCombo, p_tipo){
    $.post
    (
	"../controlador/tipo.comprobante.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = $.parseJSON( JSON.stringify(resultado) );
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione un tipo de comprobante</option>';
            }else{
                html += '<option value="0">Todas los tipos de comprobante</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_tipo_comprobante+'">'+item.descripcion+'</option>';
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