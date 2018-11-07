/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function solonumeros(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    numero="0123456789";
    especiales="8-37-38-46"; //array
    teclado_especial=false;
    
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial=true;
        }
    }
    
    if(numero.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}



function sololetras(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    letras="abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789";
    especiales="8-37-38-46-164"; //array
    teclado_especial=false;
    
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial=true;break;
        }
    }
    
    if(letras.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}

function permite(elEvento, permitidos) {
  // Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáÁéÉiÍóÓúÚ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [8, 37, 39, 46];
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
 
 
  // Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num':
      permitidos = numeros;
      break;
    case 'car':
      permitidos = caracteres;
      break;
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

