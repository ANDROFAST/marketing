function cargarComboDepartamento( cbo ){
    $.post
    (
	"../controlador/departamentos.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = '<option value="">Seleccionar departamento</option>';
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_departamento+'">'+item.nombre+'</option>';
            });
            
            $(cbo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarComboProvincia( cbo, cbodep ){
    var prov = $(cbodep).val();
    
    $.post
    (
	"../controlador/provincia.cargar.combo.controlador.php",
        { p_prov : prov }
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = '<option value="">Seleccionar provincia</option>';
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_provincia+'">'+item.nombre+'</option>';
            });
            
            $(cbo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarComboDistrito( cbo, cbodep, cboprov ){
    var prov = $(cboprov).val();
    var dep = $(cbodep).val();
    
    $.post
    (
	"../controlador/distrito.cargar.combo.controlador.php",
        { 
            p_dep : dep,
            p_prov : prov 
      }
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = '<option value="">Seleccionar distrito</option>';
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_distrito+'">'+item.nombre+'</option>';
            });
            
            $(cbo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

