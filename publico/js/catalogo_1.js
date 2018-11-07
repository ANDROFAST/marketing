$(document).ready(function(){
    listar();//del cuadro de dialogo
    listado();//de la pagina principal
});

$("#btnadd").click(function(){
    detallePedido();

    swal("", "Producto agregado al carrito");
    $("#txtcantidad").val(1);//restablece a 1 input cantidad
   // setTimeout(window.location.reload(true),6000);
				    
});

$("#btnview").click(function(){
    $("#txtcantidad").val(1);//restablece a 1 input cantidad
    window.open("../publico/carrito.vista.php");
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

function listado(){
    
    var codigoTipo = $("#cbol li").val();
    if (codigoTipo === null){
        codigoTipo = 0;
    }
    else{
        codigoTipo = codigol;
    }
    
    var codigoCategoria = $("#cboc li").val();
    if (codigoCategoria === null){
        codigoCategoria = 0;
    }else{
        codigoCategoria = codigoc;
    }
      
    $.post
    (
        "../controlador/articulo.listado.controlador.php",
        {
            codigoTipo: codigoTipo,
            codigoCategoria: codigoCategoria
   
        }
    ).done(function(resultado){
        var datosJSON = resultado;
     
        if( datosJSON.estado === 200 ){
            var html = '<h2>Artículos</h2><hr>';
            
            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<div class="col-xs-6 col-md-3">';
                html += '<a class="thumbnail" style="text-decoration:none">';
                html += '<img src="../imagenes/articulos/'+ item.codigo +'.jpg" style="min-width: 250px; min-height:250px; max-width=250px; max-height: 250px";/>';               
                
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
    var codigoCategoria = 0;
    var codigoTipo = 0;
    
    $.post
    (
        "../controlador/articulo.listar.publico.controlador.php",
        {            
            codigoCategoria: codigoCategoria,
            codigoTipo: codigoTipo
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
                    document.getElementById("imgFoto").src = "../imagenes/articulos/"+item.codigo_articulo+".jpg";                     
                    $("#lblarticulo").html( item.nombre);
                    $("#lblprecio").html( item.precio_venta );
                    $("#txtcodigoa").val( item.codigo_articulo );
                });               
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });
}



var pedidoLS2=localStorage.getItem("articulos");


function detallePedido(){
    var registropedidosFor2="";
    var pedido="" ;//almacena los productos seleccionados
    var foto = document.getElementById("imgFoto").src;
    var articulo = $("#lblarticulo").text();
    var precio = $("#lblprecio").text();
    var cantidad = $("#txtcantidad").val();
    var codigo = $("#txtcodigoa").val();
    
    pedido += foto +','+ articulo +','+ precio +','+ cantidad +','+ codigo +';';
   
   console.log("consultaLS-"+pedidoLS2);
   var articulos = localStorage.getItem("articulos");
   
    if(articulos != undefined){        
        
    var productos = articulos.split(";");
    
    var registropedidosFor="";
    //corregir que en el carrito de compras un registro no se actualiza cuando es eliminado en otra pestaña 
    var registropedidosForVarMoment="";
    
    
           var pedidoACTUALIZARVALOR="";
                var pedidoACTUALIZARVALOR_SC="";
                var pedidoACTUALIZARVALOR_CC="";
              
    for( var i = 0; i < productos.length - 1; i++ ){
        var item = productos[i].split(",");
        var cant = parseInt(item[3])+parseInt(cantidad);     
      
                    if(item[4]==codigo){
                        pedidoACTUALIZARVALOR_CC = item[0] +','+ item[1] +','+ item[2] +','+ cant +','+ item[4] +';';
                        cant=parseInt(0);
                        pedido="";
                        console.log("condicion codigo celda: "+pedidoACTUALIZARVALOR_CC);
                    }else{
                        pedidoACTUALIZARVALOR_SC += item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';
                     //   pedidoACTUALIZARVALOR_SC += (item[4]==codigo)?"":pedido;
                      //  pedido=""
                        console.log("condicion sin cod celda: "+pedidoACTUALIZARVALOR_SC);
                    }                    
                   // pedido=""
              
              
        //}
    }
      //pedidoACTUALIZARVALOR=pedidoACTUALIZARVALOR_CC+pedidoACTUALIZARVALOR_SC;
      pedidoACTUALIZARVALOR=pedidoACTUALIZARVALOR_SC;
      
      var contenedor=pedidoACTUALIZARVALOR.split(";");
      var subcontenedor="";
      var subcontenedorCC="";
      var subcontenedorSC="";
      for( var i = 0; i < contenedor.length - 1; i++ ){
        var item = contenedor[i].split(",");
        if(item[4]!==codigo){
            subcontenedor+=item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';
           
        }else{
            subcontenedorSC=item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';
        }
    }
    
    console.log("cojunto datos subcontenedor antes de sum --- "+subcontenedor)
    console.log("actualizador --- "+pedidoACTUALIZARVALOR_CC)
    console.log("valor repetido --- "+pedidoACTUALIZARVALOR_CC)
    subcontenedor=subcontenedor+pedidoACTUALIZARVALOR_CC+pedido;
      console.log("conjunto de datos primero: "+pedidoACTUALIZARVALOR);
      console.log("conjunto de datos subcontenedor: "+subcontenedor);
      console.log("conjunto de datos pedido: "+pedido);
    /*
    console.log("RESTO REGISTRO ELSE - . "+registropedidosFor);
    console.log("cant F: "+cantidadFinal+ " Pedido Final cond"+ pedF)
    console.log("MEMORIA LOCAL GET ITEM "+localStorage.getItem("articulos"));    
    console.log("RESTO DE REGISTRO MISMA CANT. "+registropedidosFor);
    
    */
    
            localStorage.removeItem("articulos");            
            //localStorage.setItem("articulos", registropedidosFor);
            localStorage.setItem("articulos", subcontenedor);
            subcontenedor=""
            
           // registropedidosFor="";
            console.log("und--"+localStorage.getItem("articulos"));
            //.substring(9)
    }else{
        localStorage.setItem("articulos", pedido);
            console.log("else- "+localStorage.getItem("articulos"));
    }
        
}

$("#btndelete").click(function(){
   
  swal({
            title: "Confirme",
            text: "¿Está seguro de eliminar los productos agregados en su carrito de compras?",
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
                localStorage.setItem("articulos", "");
                swal("Éxito","Se eliminaron los productos añadidos en su carrito de compras","success")
            }
	});
    
  
});