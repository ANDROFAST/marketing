<?php
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    ini_set('html_errors', false);

   // $cvePersona = $_SESSION['cvePersona'];

    /*  Realizamos la conexión a la base de datos */
    require('conexion.php');
    $guardar = true;

    if (null === filter_input(INPUT_POST, 'Aceptar')) {
        $total = filter_input(INPUT_POST, 'total');
        $perfilSuma = 0;
        $perfil1 = 0;
        $perfil2 = 0;
        $perfil3 = 0;
        $perfil4 = 0;
        $perfil5 = 0;
        $perfil6 = 0;

        for ($i = 1; $i <= $total; $i++) {
            $codigo_respuesta = filter_input(INPUT_POST, 'res' . ($i));
           // $perfil = filter_input(INPUT_POST, 'opcion' . ($codigo_respuesta));
            $valor = filter_input(INPUT_POST, 'valor' . ($codigo_respuesta));

            if($codigo_respuesta == ""){
                header('location: encuesta.php?requerido');
                break;
            }

            // Permite guardar todas las respuestas en una tabla
            $strCnx = 'Insert into ficha_encuesta (codigo_respuesta) '
                    . 'values ('. intval($codigo_respuesta).'); ';
            $req = pg_query($strCnx)  or die('Error al insertar en la tabla ficha_encuestas:');


             // $strCnx = 'insert into respuestas (codigo_respuesta) values ('
             
            $strCnx = pg_query("SELECT * FROM respuestas WHERE codigo_respuesta = ".$codigo_respuesta);
            while($result = pg_fetch_object($strCnx)){
                $valor = $result->valor + 1; // obtenemos el valor de 'valor' y le añadimos 1 unidad
                pg_query("UPDATE respuestas SET valor =  '".$valor."' WHERE codigo_respuesta = ".$codigo_respuesta); //
            }
            
        } // Fin de contar perfiles

      

        $infoPerfil = "Select p.perfil, (Select SUM(r.valor)) as total, " .
                "(Select SUM(r.valor))/2 as mitad, " .
                "(Select SUM(r.valor))%2 as divi " .
                "From preguntas p " .
                "Join respuestas r on p.cvePregunta = r.cvePregunta " .
                " group by p.perfil " .
                "having Max(r.valor) " .
                "order by p.perfil ";
        $consultaPerfil = mysqli_query($conexion, $infoPerfil);

        $infoPerfil1 = 0;
        $infoPerfil2 = 0;
        $infoPerfil3 = 0;
        $infoPerfil4 = 0;
        $infoPerfil5 = 0;
        $infoPerfil6 = 0;
        $i = 1;
        while ($result = mysqli_fetch_object($consultaPerfil)) {
            $divisible = $result->divi;
            $total = 0;
            if($divisible == 0){
                $total = $result->mitad;
                $total--;
            }else{
                $total = $result->mitad;
                $total -= 0.5;
            }

            if($i == 1){
                $infoPerfil1 = intval($total);
            }else if($i == 2){
                $infoPerfil2 = intval($total);
            }else if($i == 3){
                $infoPerfil3 = intval($total);
            }else if($i == 4){
                $infoPerfil4 = intval($total);
            }else if($i == 5){
                $infoPerfil5 = intval($total);
            }else if($i == 6){
                $infoPerfil6 = intval($total);
            }
            $i++;
        }

        $info1 = "<script>console.log( 'Perfil1 info: " . $infoPerfil1 . "' );</script>";
        $info2 = "<script>console.log( 'Perfil2 info: " . $infoPerfil2 . "' );</script>";
        $info3 = "<script>console.log( 'Perfil3 info: " . $infoPerfil3 . "' );</script>";
        $info4 = "<script>console.log( 'Perfil4 info: " . $infoPerfil4 . "' );</script>";
        $info5 = "<script>console.log( 'Perfil5 info: " . $infoPerfil5 . "' );</script>";
        $info6 = "<script>console.log( 'Perfil6 info: " . $infoPerfil6 . "' );</script>";
        echo $info1;
        echo $info2;
        echo $info3;
        echo $info4;
        echo $info5;
        echo $info6;

        // En caso de que la persona se haya registrado antes 
        $sqlDelete = "Delete From perfilesPersona "
              ."where cvePersona = " . $cvePersona;

        $clave = "<script>console.log( '$cvePersona: " . $cvePersona . "' );</script>";
        echo $clave;
        mysqli_query($conexion, $sqlDelete);
        $sql = "";

        if($perfil1 > $infoPerfil1){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 1)";
            mysqli_query($conexion, $sql);
        }
        if($perfil2 > $infoPerfil2){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 2)";
            mysqli_query($conexion, $sql);
        }
        if($perfil3 > $infoPerfil3){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 3)";
            mysqli_query($conexion, $sql);
        }
        if($perfil4 > $infoPerfil4){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 4)";
            mysqli_query($conexion, $sql);
        }
        if($perfil5 > $infoPerfil5){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 5)";
            mysqli_query($conexion, $sql);
        }
        if($perfil6 > $infoPerfil6){
            $sql = "INSERT INTO perfilesPersona (cvePersona, cvePerfil)
                VALUES('.$cvePersona.', 6)";
            mysqli_query($conexion, $sql);
        }

        mysqli_free_result($consultaPerfil);
        if($sql != ""){
            //mysqli_close($conexion);
            header('location: gracias.php?perfil');
        }else{
            header('location: gracias.php');
        }
    }