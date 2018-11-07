$(document).ready(function () {
    cargarComboTE("#tipo_evento","");
});


$(document).on('change','#rbtipo', function(){ 
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 
    var today = yyyy+'-'+mm+'-'+dd;
//    document.getElementById("txtfecha1").value = today;
    var value = $(this).val();
    if(value==='1')
    {
        document.getElementById("txtfecha1").value = today;
    }else if(value==='3')
    {
        document.getElementById("txtfecha1").value = today;
    }
});

function cargarComboTE(p_nombreCombo, p_tipo){
    $.post
    (
    "../controlador/tipo.evento.cargar.combo.controlador.php"
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
                html += '<option value="'+item.codigo_tipo_evento+'">'+item.descripcion+'</option>';
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


