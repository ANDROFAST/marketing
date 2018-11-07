
function cargaDatos(){
    $.post("../publico/cliente.datos.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu").html(codHtml);
    });
    
    /*$.post("../vista/cliente.cuenta.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu2").html(codHtml);
    });*/
}

function cargaPedidos(){
    $.post("../publico/cliente.pedidos.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu").html(codHtml);
    });
}


