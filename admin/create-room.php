<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Inicializar la variable de mensaje si no está definida
if (!isset($_SESSION['msg'])) {
    $_SESSION['msg'] = ""; // Define la variable si no existe
}

// Código para agregar cuartos
if (isset($_POST['submit'])) {
    $room_type = $_POST['room_type'];
    $roomno = $_POST['rmno'];

    // Obtener el precio asociado al tipo de habitación seleccionado
    $sql = "SELECT fees FROM rooms WHERE room_type=? LIMIT 1";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s', $room_type);
    $stmt1->execute();
    $stmt1->bind_result($fees);
    $stmt1->fetch();
    $stmt1->close();

    // Verificar si el número de habitación ya existe
    $sql = "SELECT room_no FROM rooms WHERE room_no=?";
    $stmt2 = $mysqli->prepare($sql);
    $stmt2->bind_param('i', $roomno);
    $stmt2->execute();
    $stmt2->store_result();
    $row_cnt = $stmt2->num_rows;

    if ($row_cnt > 0) {
        echo "<script>alert('El cuarto ya existe');</script>";
    } else {
        $query = "INSERT INTO rooms (room_type, room_no, fees) VALUES (?, ?, ?)";
        $stmt3 = $mysqli->prepare($query);
        $stmt3->bind_param('sii', $room_type, $roomno, $fees);
        $stmt3->execute();
        $stmt3->close();

        // Mensaje de éxito
        $_SESSION['msg'] = "El cuarto se ha agregado correctamente.";
        echo "<script>alert('El cuarto se ha agregado correctamente');</script>";
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
    <title>Crear Cuarto</title>
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
                        <h2 class="page-title">Agregar un Cuarto</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cuartos</div>
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
                                                    <select name="room_type" id="room_type" class="form-control"
                                                        required>
                                                        <option value="">Seleccionar Tipo de Habitación</option>
                                                        <?php
                                                        $sql = "SELECT DISTINCT room_type, fees FROM rooms";
                                                        $stmt = $mysqli->prepare($sql);
                                                        $stmt->execute();
                                                        $res = $stmt->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            echo "<option value='" . $row->room_type . "'>" . $row->room_type . " - Precio: $" . $row->fees . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">No. de Cuarto</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="rmno" id="rmno"
                                                        value="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Crear Cuarto">
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