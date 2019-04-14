<?php
require_once '../datos/Conexion.clase.php';
session_start();
//try{
$usuario = 'postgres';
$password = '12345';
/*En este caso el tipo es pgsql, además le indicamos el puerto */
$conn = new PDO('pgsql:host=localhost;port=5432;dbname=Tesis', $usuario, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}catch(PDOException $e){
//echo "ERROR: " . $e->getMessage();
//}
require_once '../publico/sesion.cliente.validar.vista.php';
require_once '../util/funciones/estadoSesion.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>FiestHadas | Cotizacion de Articulos</title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
        <link rel="stylesheet" href="../util/bootstrap/css/bootstrap.min4.css" />
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    </head>
    <body>
        <div class="container">
            <?php
                $customer_details = '';
                $order_details = '';
                $total = 0;
                $stmt = $conn->query("SELECT numero_pedido FROM pedido ORDER BY 1 DESC LIMIT 1");
                $stmt->execute();

                //Guardo los datos de la BD en las variables de php
                foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $numero_pedido) {

                }

                $stmt = $conn->query("SELECT 
                                   concat(c.apellido_paterno ||' '|| c.apellido_materno ||', ' ||c.nombres) as nombre,
                                          c.telefono_movil,
                                          c.telefono_fijo,
                                          c.direccion,
                                          c.email,
                                          a.nombre,
                                          pd.precio,
                                          pd.cantidad,
                                          p.numero_pedido,
                                          p.direccion_evento,
                                          p.fecha_evento,
                                          p.dirigidoa
                                   FROM pedido p
                                                INNER JOIN pedido_detalle pd
                                                ON pd.numero_pedido= p.numero_pedido
                                                INNER JOIN cliente c
                                                ON c.codigo_cliente = p.codigo_cliente
                                                INNER JOIN articulo a
                                                ON a.codigo_articulo = pd.codigo_articulo
                                                WHERE p.numero_pedido ='" . $numero_pedido . "'");

                while ($row = $stmt->fetch()) {
                    $customer_details = '
                                 <p><label>&nbsp;&nbsp;&nbsp;Nombre de Cliente:</label> ' . $row[0] . '</p>
                                 <p><label>&nbsp;&nbsp;&nbsp;Teléfono Móvil:</label> '.$row[1].' - <label>Teléfono Fijo:</label> '.$row[2].'</p>
                                 <p><label>&nbsp;&nbsp;&nbsp;Dirección de Cliente:</label>    ' . $row[3] . '</p>
                                 <p><label>&nbsp;&nbsp;&nbsp;Correo electrónico:</label>     ' . $row[4] . '</p>
                                 &nbsp;<p><label>&nbsp;&nbsp;&nbsp;Fecha del evento:</label>   ' . $row['fecha_evento'] . '</p>
                                 <p><label>&nbsp;&nbsp;&nbsp;Dirección del evento:</label>   ' . $row['direccion_evento'] . '</p>
                                 <p><label>&nbsp;&nbsp;&nbsp;Dirigido a:</label>     ' . $row['dirigidoa'] . '</p>
                                 ';

                    $order_details .= "
                                    <tr>
                                        <td>" . $row[5] . "</td>
                                        <td>" . $row[6] . "</td>
                                        <td>" . $row[7] . "</td>
                                        <td>" . number_format($row[6] * $row[7], 2) . "</td>
                                    </tr>
                                    ";
                    $total = $total + ($row[6] * $row[7]);
                }
                echo '
                        <h3 align="center">Orden de Pedido No.'.$numero_pedido.'</h3>
                        <div class="table-responsive">
                            <table class="table" WIDTH="50%">
                            <tr>
                                <td><label>DETALLES DEL PEDIDO</label></td>
                            </tr>
                            <tr>
                                <td>'.$customer_details.'</td>
                            </tr>
                            <tr>
                                <td><label>DETALLES DE LA ORDEN</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">Nombre Producto</th>
                                            <th width="15%">Precio</th>
                                            <th width="15%">Cantidad</th>
                                            <th width="20%">Sub-Total</th>
                                        </tr>
                                        '.$order_details.'
                                        <tr>
                                            <td colspan="3" align="right"><label>Total</label></td>
                                            <td>'.number_format($total, 2).'</td>
                                        </tr>
                                    </table>
                        <button class="btn btn-primary" type="button" name="imprimir" value="Imprimir P&aacute;gina" onclick="window.print();">Imprimir</button>
                        </td>
						</tr>
					</table>
				</div>
				';

            ?>
        </div>
    </body>
</html>