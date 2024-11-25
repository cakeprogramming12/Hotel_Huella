<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE FROM registration WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Registro eliminado con éxito');</script>";
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
    <title>Gestionar Registros</title>
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
                        </br></br>
                        <h2 class="page-title">Gestionar reservas</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalles de todos los registros</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Habitación</th>
                                            <th>Nombre Completo</th>
                                            <th>Contacto</th>
                                            <th>Email</th>
                                            <th>Fecha de Registro</th>
                                            <th>Código Alfanumérico</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Habitación</th>
                                            <th>Nombre Completo</th>
                                            <th>Contacto</th>
                                            <th>Email</th>
                                            <th>Fecha de Registro</th>
                                            <th>Código Alfanumérico</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT id, roomno, CONCAT(firstName, ' ', lastName) AS fullName, contactno, emailid, postingDate, codigo_alfanumerico FROM registration";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo $row->roomno; ?></td>
                                            <td><?php echo $row->fullName; ?></td>
                                            <td><?php echo $row->contactno; ?></td>
                                            <td><?php echo $row->emailid; ?></td>
                                            <td><?php echo $row->postingDate; ?></td>
                                            <td><?php echo $row->codigo_alfanumerico; ?></td>
                                            <td>
                                                <a href="edit-registration.php?id=<?php echo $row->id; ?>"><i
                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="manage-registration.php?del=<?php echo $row->id; ?>"
                                                    onclick="return confirm('¿Deseas borrar este registro?');"><i
                                                        class="fa fa-close"></i></a>
                                            </td>
                                        </tr>
                                        <?php
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