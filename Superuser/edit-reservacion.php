<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_POST['submit'])) { // Verifica si 'submit' está definido
    $id = $_GET['id'];

    // Captura los valores del formulario
    $roomno = $_POST['roomno'];
    $feespm = $_POST['feespm'];
    $foodstatus = $_POST['foodstatus'];
    $stayfrom = $_POST['stayfrom'];
    $duration = $_POST['duration'];
    $contactno = $_POST['contactno'];
    $emailid = $_POST['emailid'];
    $confirmada = isset($_POST['confirmada']) ? 1 : 0;

    // Actualizar la base de datos
    $query = "UPDATE registration SET roomno=?, feespm=?, foodstatus=?, stayfrom=?, duration=?, contactno=?, emailid=?, confirmada=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sississii', $roomno, $feespm, $foodstatus, $stayfrom, $duration, $contactno, $emailid, $confirmada, $id);
    $stmt->execute();
    echo "<script>alert('Los detalles de la reservación se han actualizado correctamente');</script>";
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
    <title>Editar Reservación</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Editar Detalles de Reservación</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalles de Reservación</div>
                            <div class="panel-body">
                                <form method="post" class="form-horizontal">
                                    <?php
                                    $id = $_GET['id'];
                                    $ret = "SELECT * FROM registration WHERE id=?";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('i', $id);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Número de Habitación</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="roomno" value="<?php echo $row->roomno; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Costo Mensual</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="feespm" value="<?php echo $row->feespm; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Estado de Comida</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="foodstatus" value="<?php echo $row->foodstatus; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Fecha de Inicio</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="stayfrom" value="<?php echo $row->stayfrom; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Duración</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="duration" value="<?php echo $row->duration; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Teléfono</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="contactno" value="<?php echo $row->contactno; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Correo Electrónico</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="emailid" value="<?php echo $row->emailid; ?>"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Estado Confirmada</label>
                                        <div class="col-sm-8">
                                            <input type="checkbox" name="confirmada"
                                                <?php echo $row->confirmada ? 'checked' : ''; ?>>
                                            <label>¿Confirmada?</label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <input type="submit" name="submit" class="btn btn-primary"
                                                value="Actualizar Reservación">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>

</html>