<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Inicializar la variable de mensaje si no está definida
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = ""; // Define la variable si no existe
}

// Código para agregar una nueva habitación
if (isset($_POST['submit'])) {
    $room_type = $_POST['room_type'];
    $room_no = $_POST['room_no'];
    $fees = $_POST['fees'];

    // Verificar si el número de cuarto ya existe
    $sql = "SELECT room_no FROM rooms WHERE room_no=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('i', $room_no);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;

    if ($row_cnt > 0) {
        echo "<script>alert('El número de cuarto ya existe');</script>";
    } else {
        $query = "INSERT INTO rooms (room_type, room_no, fees, posting_date) VALUES (?, ?, ?, CURRENT_TIMESTAMP)";
        $stmt2 = $mysqli->prepare($query);
        $stmt2->bind_param('sii', $room_type, $room_no, $fees);
        $stmt2->execute();

        // Mensaje de éxito
        $_SESSION['msg'] = "La habitación se ha agregado correctamente.";
        echo "<script>alert('La habitación se ha agregado correctamente');</script>";
    }
}
?>
<!doctype html>
<html lang="es" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
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
                        <h2 class="page-title">Agregar Habitación</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Nueva Habitación</div>
                                    <div class="panel-body">
                                        <?php if (!empty($_SESSION['msg'])) { ?>
                                        <p style="color: red">
                                            <?php echo htmlentities($_SESSION['msg']); ?>
                                            <?php $_SESSION['msg'] = ""; // Limpiar el mensaje después de mostrarlo ?>
                                        </p>
                                        <?php } ?>

                                        <form method="post" class="form-horizontal">
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tipo de Habitación</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="room_type"
                                                        placeholder="Ejemplo: Sencilla, Doble, Suite"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Número de Cuarto</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="room_no"
                                                        placeholder="Ingrese el número de cuarto" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tarifa (Precio)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" name="fees"
                                                        placeholder="Ingrese la tarifa en números enteros"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Agregar Habitación">
                                            </div>
                                        </form>
                                    </div>
                                </div>
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