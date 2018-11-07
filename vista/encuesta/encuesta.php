<?php
header("Content-Type: text/html;charset=utf-8");
ini_set('default_charset','utf8');

/*  Realizamos la conexión a la base de datos */
require('conexion.php');
$strCnx = "SELECT 
       p.codigo_pregunta, 
       p.descripcion as pregunta, 
       r.codigo_respuesta, 
       r.descripcion as respuesta, 
       r.valor,
       (Select COUNT(*) From preguntas) as total 
       FROM preguntas p 
        INNER JOIN respuestas r 
        ON p.codigo_pregunta = r.codigo_pregunta 
        ORDER BY pregunta, r.valor desc ";

$req = pg_query($strCnx);

$requerido = false;
if (null !== filter_input(INPUT_GET, 'requerido')) {
    $requerido = true;
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Encuesta No 1</title>
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/encuesta.js"></script>
    </head>
    <body>

        <form action="guardar.php" method="post" id="encuestaForm">
            <div class="wrapEncuesta">
                <h1>Encuesta No 1</h1>
                <?php
                    if($requerido){
                        echo '<label id="requerido">Todos los campos son requeridos</label><br/>';
                    }
                ?>
                <ul id="encuesta">
                    <?php
                    $i = 1;
                    $cveAnterior = "";
                    $cveActual = "";
                    while ($result = pg_fetch_object($req)) {
                        if($i == 1){
                            echo '<input type="hidden" name="total" value ="' . $result->total . '"/>';
                        }
                        $cveActual = $result->codigo_pregunta;
                        if ($cveAnterior !== "") {
                            if ($cveAnterior !== $cveActual) {
                                echo '<li name="pregunta">';
                                echo '<div class="content'.$i.'">';                                
                                echo '<input type="hidden" name="' . $result->codigo_pregunta . '"/>';
                                echo '<label name="pregunta">' . $i . '.- ' . $result->pregunta . '</label>';
                                echo '</div>';
                                echo '</li>';
                                $i++;
                              //  echo '<input type="hidden" name="opcion' . $result->codigo_respuesta . '" value="' . $result->perfil . '" />';
                                echo '<input type="hidden" name="valor' . $result->codigo_respuesta . '" value="' . $result->valor . '" />';
                                echo '<li name="respuesta"><input name="res' . $result->codigo_pregunta . '" class="radio" type="radio" value="' . + $result->codigo_respuesta . '"><span> ' . $result->respuesta . '</span></li>';
                            } else {
                               // echo '<input type="hidden" name="opcion' . $result->codigo_respuesta . '" value="' . $result->perfil . '" />';
                                echo '<input type="hidden" name="valor' . $result->codigo_respuesta . '" value="' . $result->valor . '" />';
                                echo '<li name="respuesta"><input name="res' . $result->codigo_pregunta . '" class="radio" type="radio" value="' . + $result->codigo_respuesta . '"><span> ' . $result->respuesta . '</span></li>';
                            }
                        } else {
                            echo '<li name="pregunta">';
                            echo '<div class="content'.$i.'">';
                            echo '<input type="hidden" name="' . $result->codigo_pregunta . '"/>';
                            echo '<label name="pregunta">' . $i . '.- ' . $result->pregunta . '</label>';
                            echo '</div>';
                            echo '</li>';
                            $i++;
                           // echo '<input type="hidden" name="opcion' . $result->codigo_respuesta . '" value="' . $result->perfil . '" />';
                            echo '<input type="hidden" name="valor' . $result->codigo_respuesta . '" value="' . $result->valor . '" />';
                            echo '<li name="respuesta"><input name="res' . $result->codigo_pregunta . '" type="radio" class="radio" value="' . + $result->codigo_respuesta . '"><span> ' . $result->respuesta . '</span></li>';
                        }
                        $cveAnterior = $cveActual;
                    }
                    pg_free_result($req)
                    //pg_close($strCnx);                    
                    ?>
                </ul>
                <input type="submit" name="aceptar" id="aceptar" value="Aceptar">
            </div>                    
        </form>
    </body>
</html>