<?php
include_once 'Conexion/conexion.php';
$objeto_conexion = new Conexion();
$conexion = $objeto_conexion->Conectar();

// consulta sql para traer toda la informacion de las actividades que estan en la BD//

$sql = "SELECT * FROM `actividades`";
// $sql = "SELECT * FROM `actividades` LIMIT 50";
$resultado = $conexion->prepare($sql);
$resultado->execute();
$actividades = $resultado->fetchAll(PDO::FETCH_ASSOC);

// consulta sql para traer la informacion de las actividades sospechosas que estan en la BD//

$sql = "SELECT * FROM actividades 
WHERE AveragePaceInMinutesPerKilometer = 
(SELECT MIN(AveragePaceInMinutesPerKilometer)FROM actividades) OR
TotalElevationGainInMeters = (SELECT MAX(TotalElevationGainInMeters) FROM actividades WHERE TotalElevationGainInMeters > DurationInSeconds) OR
DurationInSeconds = (SELECT MAX(DurationInSeconds) FROM actividades) OR
DistanceInMeters = (SELECT MAX(DistanceInMeters) FROM actividades)
ORDER BY id ASC";
$resultado = $conexion->prepare($sql);
$resultado->execute();
$actividades_sospechosas = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />
    <title>Actividades</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="main.css">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>
    <!-- <header>
         <h1 class="text-center text-light">DATATABLES</h1>
         <h2 class="text-center text-light">Cómo <span class="badge badge-warning">Personalizar</span></h2> 
     </header>     -->
    <div style="height:50px"></div>

    <!--Ejemplo tabla con DataTables-->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">

                    <table id="example" class="table table-striped table-bordered" width="100%">
                    
                        <thead>
                            <tr>
                                <th>UserId</th>
                                <th>StartTimeInSeconds</th>
                                <th>DurationInSeconds</th>
                                <th>DistanceInMeters</th>
                                <th>Steps</th>
                                <th>AverageSpeedInMetersPerSecond</th>
                                <th>AveragePaceInMinutesPerKilometer</th>
                                <th>TotalElevationGainInMeters</th>
                                <th>AverageHeartRateInBeatsPerMinute</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($actividades as $actividad) {
                            ?>
                                <tr>
                                    <td><?php echo $actividad['UserId']; ?></td>
                                    <td><?php echo $actividad['StartTimeInSeconds']; ?></td>
                                    <td><?php echo $actividad['DurationInSeconds']; ?></td>
                                    <td><?php echo $actividad['DistanceInMeters']; ?></td>
                                    <td><?php echo $actividad['Steps']; ?></td>
                                    <td><?php echo $actividad['AverageSpeedInMetersPerSecond']; ?></td>
                                    <td><?php echo $actividad['AveragePaceInMinutesPerKilometer']; ?></td>
                                    <td><?php echo $actividad['TotalElevationGainInMeters']; ?></td>
                                    <td><?php echo $actividad['AverageHeartRateInBeatsPerMinute']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- El modal -->
    <div id="miModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" id="cerrarModal">&times;</span>
            <h2 style="text-align: center;">Registros Considerados como Sospechosos</h2>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>UserId</th>
                                        <th>StartTimeInSeconds</th>
                                        <th>DurationInSeconds</th>
                                        <th>DistanceInMeters</th>
                                        <th>Steps</th>
                                        <th>AverageSpeedInMetersPerSecond</th>
                                        <th>AveragePaceInMinutesPerKilometer</th>
                                        <th>TotalElevationGainInMeters</th>
                                        <th>AverageHeartRateInBeatsPerMinute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($actividades_sospechosas as $actividad_sospechosa) {
                                    ?>
                                        <tr>
                                            <td><?php echo $actividad_sospechosa['UserId']; ?></td>
                                            <td><?php echo $actividad_sospechosa['StartTimeInSeconds']; ?></td>
                                            <td><?php echo $actividad_sospechosa['DurationInSeconds']; ?></td>
                                            <td><?php echo $actividad_sospechosa['DistanceInMeters']; ?></td>
                                            <td><?php echo $actividad_sospechosa['Steps']; ?></td>
                                            <td><?php echo $actividad_sospechosa['AverageSpeedInMetersPerSecond']; ?></td>
                                            <td><?php echo $actividad_sospechosa['AveragePaceInMinutesPerKilometer']; ?></td>
                                            <td><?php echo $actividad_sospechosa['TotalElevationGainInMeters']; ?></td>
                                            <td><?php echo $actividad_sospechosa['AverageHeartRateInBeatsPerMinute']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- El modal -->

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>

    <!-- para usar botones en datatables JS -->
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!-- código JS propìo-->
    <script type="text/javascript" src="main.js"></script>

    <!-- script de inicizlizar la tabla -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>


</body>

</html>