
$(document).ready(function(){
    listarPedido(); 
    resumen();
    total();
});

function listarPedido(){
    var articulos = localStorage.getItem("productos");
    var productos = articulos.split(";");
    var contador = 0;//cuenta numero de articulos en el carrito
    
    for( var i = 0; i < productos.length - 1; i++ ){
        var item = productos[i].split(",");
        var pedido = "";
        
        for( var j = 0; j < item.length; j++ ){
            pedido = '<tr>'+
                    '<td class="text-center">'+ '<img style="width: 100px; height: 100px" src="' + item[0] + '"/></td>' +
                    '<td id="celiminar" style="text-align:left;"><b>'+ item[1].toUpperCase() + '<br><br><br><br></b>' +
                    '<a style="text-decoration:none">Editar</a> | <a href="javascript:deleteRow(this)" style="text-decoration:none;">Eliminar</a></td>' +
                    '<td style="text-align:right; color:red"><b>'+ 'S/.'+ item[2] + '</b></td>' +
                    '<td class="text-center"><b>'
                    + '<input type="number" name="txtcant'+i+'" id="txtcant'+i+'" min="1" max="15" value="'+ item[3] +'" class="form-control">' + 
                    '</b></td>'+
                    '<td style="text-align:right;"><b>'+ 'S/.'+ (item[2]*item[3]).toFixed(2) + '</b></td>';
        }
        //<a href="javascript:void()"><i class="fa fa-trash"></i></a>
        $("#detallePedido").append(pedido);  
        
        $("#txtcant"+i).change(function(){
            resumen();
            //al cambiar el numero actualiza el total
            $("#detallePedido tr").find("td").eq(4).html('<b>'+ 'S/.'+ (item[2] * $(this).val()).toFixed(2)+ '</b>'); 
        });
        
        contador++;
    }
    
    $("#lblnum").text(contador +" ARTÍCULOS");//nro de articulos en lista
}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById(".table").deleteRow(i);
}

function resumen(){
    /*resumen del pedido*/
    var nro = 0;
    var costo = 0.0;
    var dsct = 0.0;
    var total = 0.0;
    
    $("#detallePedido tr").each(function(){
        var importe = $(this).find("td").eq(4).text();
        var unitario = importe.substring(3);
        costo += parseFloat(unitario);
        //nro = $(this).find("td").eq(3).html();     
        nro++;
    });
    total = costo - dsct;
    
    $("#lblnro").html(nro);
    $("#lblct").html(costo.toFixed(2));
    $("#lbldsct").html(dsct.toFixed(2));
    $("#lbltl").html(total.toFixed(2));
}

$("#btnnext").click(function(){
    
    if( parseInt($("#txtlogincliente").val()) === 0 ){//si todavia no inicia sesion abre el login
        $("#myModalIS").modal();
    }
    else{
        document.location.href = "../vista/cliente.entrega.vista.php";
    }
});

function total(){
    //var arrayDetallePedido = new Array();
    //arrayDetallePedido.splice(0, arrayDetallePedido.length);//limpiar array
    
    $("#detallePedido tr").each(function(){
                    var codigoArticulo = $(this).find("td").eq(3).text();
                    /*var precioArticulo = $(this).find("td").eq(2).html();
                    var cantidad = $(this).find("td").eq(3).html();
                    var importe = $(this).find("td").eq(4).html();
                    
                    var objDetalle = new Object();
                    objDetalle.codigoArticulo = codigoArticulo;
                    objDetalle.precioArticulo = precioArticulo;
                    objDetalle.cantidad = cantidad;
                    objDetalle.importe = importe;
                    
                    arrayDetallePedido.push(objDetalle);*/
        alert(codigoArticulo);
                });
    
    
}