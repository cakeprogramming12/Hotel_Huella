<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Filtrar por fechas si se envían las fechas a través del formulario
if(isset($_POST['submit'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $ret = "SELECT * FROM hostel_finances WHERE payment_date BETWEEN ? AND ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param('ss', $start_date, $end_date);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    // Si no se envían fechas, mostrar todos los registros
    $ret = "SELECT * FROM hostel_finances";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Administrar Finanzas</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <br><br>
                        <h2 class="page-title">Administrar Finanzas</h2>

                        <!-- Formulario para seleccionar el rango de fechas -->
                        <form method="post" class="form-inline">
                            <div class="form-group">
                                <label for="start_date">Fecha de Inicio:</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">Fecha de Fin:</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Filtrar</button>
                        </form>

                        <br>
                        <br>
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalle de Finanzas</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Registro</th>
                                            <th>Monto pagado</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Registro</th>
                                            <th>Monto pagado</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->registration_id; ?></td>
                                            <td><?php echo $row->amount_due; ?></td>
                                            <td><?php echo $row->payment_date; ?></td>
                                        </tr>
                                        <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>