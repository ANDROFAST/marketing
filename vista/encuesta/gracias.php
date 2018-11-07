<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    ini_set('html_errors', false);

    require('conexion.php');

$consulta = null;
$perfil = "";
$busca = false;
if (null !== filter_input(INPUT_GET, 'perfil')) {
    $cvePersona = $_SESSION['cvePersona'];

    $sql=('SELECT distinct p.cvePerfil, p.descripcion as perfil, pp.cvePersona '
            . 'FROM perfilesPersona pp Join perfil p on p.cvePerfil = pp.cvePerfil '
            . 'WHERE pp.cvePersona = '. $cvePersona);
    $consulta = pg_query($conexion, $sql) or die('Error en: ');
    $busca = true;
}else{
    $perfil = "Gracias por tiempo, estamos mejorando para ti.";
}
   
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Gracias por su tiempo</title>
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/funciones.js"></script>
    </head>
    <body>
        <div id="login">
            Bienvenido <?php echo $_SESSION['usuario'] . ' ' ?>
            <br /><a href="logout.php">Salir del sistema</a>
        </div>
        <div class="wrap">
            <h1>Encuesta Guardada:</h1>
            <h2>
                <?php
                    if($busca){
                       while ($result = mysqli_fetch_object($consulta)) {
                            echo '<label name="perfiles">' . $result->perfil  .'</label><br/>';
                       }
                    }else{
                        echo '<label name="perfiles">' . $perfil  .'</label><br/>';
                    }
                ?>
            </h2>
            <section style="text-align: center" id="secGracias">
                <input type="button" value="Repetir encuesta" onclick="redireccionar(7);">
            </section>
        </div>
    </body>
</html>