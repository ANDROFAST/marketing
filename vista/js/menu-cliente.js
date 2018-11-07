
function cargaDatos(){
    $.post("../vista/cliente.datos.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu").html(codHtml);
    });
    
    /*$.post("../vista/cliente.cuenta.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu2").html(codHtml);
    });*/
}

function cargaPedidos(){
    $.post("../vista/cliente.pedidos.vista.php").done(function(html){
        var codHtml = html;
        $("#pnlMenu").html(codHtml);
    });
}


