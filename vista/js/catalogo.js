$(document).ready(function(){
    listar();//del cuadro de dialogo
    listado();//de la pagina principal
});

$("#btnadd").click(function(){
    detallePedido();
    swal("", "Producto agregado al carrito");

    $("#txtcantidad").val(1);//restablece a 1 input cantidad
});

$("#btnview").click(function(){
    $("#txtcantidad").val(1);//restablece a 1 input cantidad
    window.open("../vista/carrito.vista.php");
});

var codigol = 0;
$("#cbol li").click(function(){
    codigol = $(this).val();
    listado();
    codigol = 0;
});

var codigoc = 0;
$("#cboc li").click(function(){
    codigoc = $(this).val();
    listado();
    codigoc = 0;
});

var codigom = 0;
$("#cbom li").click(function(){
    codigom = $(this).val();
    listado();
    codigom = 0;
});
    
function listado(){
    
    var codigoLinea = $("#cbol li").val();
    if (codigoLinea === null){
        codigoLinea = 0;
    }
    else{
        codigoLinea = codigol;
    }
    
    var codigoCategoria = $("#cboc li").val();
    if (codigoCategoria === null){
        codigoCategoria = 0;
    }else{
        codigoCategoria = codigoc;
    }
    
    var codigoMarca = $("#cbom li").val();
    if (codigoMarca === null){
        codigoMarca = 0;
    }
    else{
        codigoMarca = codigom;
    }

    $.post
    (
        "../controlador/articulo.listado.controlador.php",
        {
            codigoLinea: codigoLinea,
            codigoCategoria: codigoCategoria,
            codigoMarca: codigoMarca
        }
    ).done(function(resultado){
        var datosJSON = resultado;
     
        if( datosJSON.estado === 200 ){
            var html = '<h2>Artículos</h2><hr>';
            
            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<div class="col-xs-6 col-md-3">';
                html += '<a class="thumbnail" style="text-decoration:none">';
                html += '<img src="../catalogo/'+ item.imagen +'.jpg" height="150"/>';               
                
                var articulo = "";
                if( item.producto.length > 31 ){
                    articulo = item.producto.substring(1, 31);
                }
                else{
                    articulo = item.producto;
                }
                
                html += '<p ALIGN=center><b>'+ articulo+ '</b></p>';
                html += '<p><h3>S/'+ item.precio + '</h3></p>';
                
                html += '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" id="btnagregar"'+ 
                             'onclick="leerDatos('+ item.codigo +')">AÑADIR AL CARRITO   ' 
                          +'<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>';

                
                html += '</a>';
                html += '</div>';
            });
            
            $("#pnImagen").html(html);

	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });
    
}

function listar(){
    var codigoLinea = 0;
    var codigoCategoria = 0;
    var codigoMarca = 0;
    
    $.post
    (
        "../controlador/articulo.listar.controlador.php",
        {
            codigoLinea: codigoLinea,
            codigoCategoria: codigoCategoria,
            codigoMarca: codigoMarca
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = '<tr>';
            var contador = 1;
            
            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                if( contador === 4 ){
                    html += '</tr><tr>';
                    contador = 0;
                }
                else{
                    html += '<td>'+item.nombre+ '<br>'+ item.precio +'</td>';
                }
                contador++;
            });
            
            html += '</tr>';
            
            $("#listado").append(html);
            
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });  
}

function leerDatos(codigo){
    
    $.post
        ( "../controlador/articulo.carrito.listar.combo.controlador.php",
            {
                p_codigo: codigo
            }
        ).done(function(resultado){
            var datosJSON = resultado;
            if (datosJSON.estado === 200){
                
                $.each(datosJSON.datos, function(i,item) {
                    document.getElementById("imgFoto").src = "../catalogo/"+item.foto+".jpg";
                    $("#lblarticulo").html( item.nombre);
                    $("#lblprecio").html( item.precio_venta );
                    $("#txtcodigoa").val( item.codigo_articulo );
                });               
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });
}

var pedido = "";//almacena los productos seleccionados
function detallePedido(){
    var foto = document.getElementById("imgFoto").src;
    var articulo = $("#lblarticulo").text();
    var precio = $("#lblprecio").text();
    var cantidad = $("#txtcantidad").val();
    var codigo = $("#txtcodigoa").val();
    
    pedido += foto +','+ articulo +','+ precio +','+ cantidad +','+ codigo +';';

    localStorage.setItem("productos", localStorage.getItem("productos")+ pedido);
}

$("#btndelete").click(function(){
    localStorage.setItem("productos", "");
    alert(localStorage.getItem("produtos"));
});