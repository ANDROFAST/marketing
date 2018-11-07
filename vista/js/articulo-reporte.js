$(document).ready(function(){
    cargarComboLinea("#cbolinea","todos");
    cargarComboTipo("#cbotipo","todos");
});

$("#cbolinea").change(function(){
    var codigoLinea = $("#cbolinea").val();
    cargarComboCategoria("#cbocategoria", "todos", codigoLinea);
});
      

