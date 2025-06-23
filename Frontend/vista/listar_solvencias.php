<?php include_once 'header.php';?>
<link rel="stylesheet" href="../estilos/css/style.css">
<title>listado de solvencias</title>
<style>
    .main-content {
        margin-left: 250px;
        margin-top: 50px;
        padding: 20px;
        box-sizing: border-box;
        width: calc(100% - 250px);
        
    }
    .table {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
        .action-buttons a::after {
        content: attr(data-tooltip);
        /* Obtiene el texto del atributo data-tooltip */
        position: absolute;
        bottom: -30px;
        /* Posiciona el tooltip debajo del botón */
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 10;
    }
    .license {
        background-color:rgb(255, 255, 255);
        color: crimson;
    }
 .license:hover{
        background-color:rgb(255, 255, 255);
        color: #ffcccc;
      transform: scale(2,2);
       
    } 

</style>

<main>
    <?php include_once 'panel_navegacion.php'; ?>
        <?php
    date_default_timezone_set('America/Caracas'); // Ajusta según tu ubicación   
 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "alcaldia_patente";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
     //verificar_licencia($fecha_expiracion, $password);
        
    if (isset($_GET['id_pat'])) {
        $id_pat = $_GET['id_pat'];
    
        // Sanitiza y valida el id_pat (cambia esto según tu lógica)
        $id_pat = filter_var($id_pat, FILTER_VALIDATE_INT);
    
        if ($id_pat !== false) {
            // Escapa los datos (importante para prevenir la inyección SQL, pero no suficiente por sí solo)
            $id_pat = mysqli_real_escape_string($conn, $id_pat);
    
            // Ejecuta la consulta SQL directamente
             $consulta = "SELECT p.fec_pat,l.fec_ven, p.num_pat, p.nom_pat, p.rif_pat, l.est_sol, l.id_sol
                         FROM solvencia l
                         JOIN patente p ON l.fky_pat = p.id_pat
                         WHERE l.fky_pat = $id_pat";
            /*$consulta = "SELECT * FROM factura WHERE cod_contribuyente = $id_pat";*/
    
            $result = mysqli_query($conn, $consulta);
    
            // Verifica si hay resultados
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='main-content'>
                            <h2 class='mb-4 text-center'>SOLVENCIAS EMITIDAS</h2>
                            <table class='table table-striped'>
                                <thead class='bg-primary text-white'>
                                <tr>
                                    <td>FECHA EMISION</td>
                                    <td>FECHA VENCIMIENTO</td>
                                    <td>Nº PATENTE</td>
                                    <td>RAZON SOCIAL</td>
                                    <td>CEDULA / RIF</td>
                                    <td>ACCCION</td>
                         
                                    </thead>
                                </tr>
                                <tbody>";
    
                    // Itera sobre los resultados y muestra la información
                    // <td><a class='btn btn-primary' href='modificar_factura.php?num_pat={$fila['num_pat']}'>MODIFICAR</a></td>
                    /*        <td><a class='btn btn-primary' href='reimprimir_factura.php?num_pat={$fila['num_pat']}'>IMPRIMIR</a></td>
                              <td><button class='btn btn-primary' onclick='verificarFactura(num_pat={$fila['num_pat']})'>Modificar Factura</button></td>
                              <td><a class='btn btn-primary' href='anular_factura.php?num_pat={$fila['num_pat']}'>ANULAR</a></td> */
                    while ($fila = mysqli_fetch_assoc($result)) {
                        $fecha_ven = new DateTime($fila['fec_ven']);
                        $hoy = new DateTime();
                        $clase = '';

                        // Compara las fechas
                        if ($fecha_ven < $hoy) {
                            $clase = 'table-danger'; // Rojo
                        } elseif ($fecha_ven == $hoy) {
                            $clase = 'table-warning'; // Amarillo
                        } else {
                            $clase = ''; // Verde
                        }

                    
                       // echo " Fecha vencimiento: $fecha_ven | Hoy: $hoy | Clase: $clase ";

                        echo "<tr class='$clase'>
                              <td>{$fila['fec_pat']}</td>
                              <td>{$fila['fec_ven']}</td>
                              <td>{$fila['num_pat']}</td>
                              <td>{$fila['nom_pat']}</td>
                              <td>{$fila['rif_pat']}</td>
                              <td><a href='../../Backend/controlador/solvencia.php?accion=eliminar&id_sol=" . $fila['id_sol'] . "'  class='license'  data-tooltip='ELIMINAR'><i class='fas fa-trash'></i></a></td>

                              </tr>";
                    }
    
                    echo "</tbody></table></div>";
                } else {
                    echo "<div class='container'>
                            <p class='text-center'>No hay pagos registrados para este contribuyente.</p>
                          </div>";
                }
    
                // Libera el resultado
                mysqli_free_result($result);
            } else {
                echo "<div class='container'>
                        <p class='text-center'>Error al ejecutar la consulta: " . mysqli_error($conn) . "</p>
                      </div>";
            }
        } else {
            echo "<div class='container'>
                    <p class='text-center'>ID de contribuyente no válido.</p>
                  </div>";
        }
    
        // Cierra la conexión a la base de datos
        mysqli_close($conn);
    } else {
        echo "<div class='container'>
                <p class='text-center'>Parámetro id_pat no proporcionado.</p>
              </div>";
    }

        ?>
    </table>


</main>
<!-- Enlace a Chart.js -->
<script src="../estilos/lib/js/jquery-3.6.0.min.js"></script>
<script src="../estilos/lib/js/chart.js"></script>
<script>
    
</script>
<?php include_once 'footer.php'; ?>