<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE FROM cleaner WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Dato Borrado');</script>";
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
    <title>Administrar Cleaners</title>
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
                        <h2 class="page-title">Administrar Cleaners</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalle de todos los Cleaners</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre de Usuario</th>
                                            <th>Email</th>
                                            <th>Contraseña</th>
                                            <th>Fecha de Registro</th>
                                            <th>Última Actualización</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre de Usuario</th>
                                            <th>Email</th>
                                            <th>Contraseña</th>
                                            <th>Fecha de Registro</th>
                                            <th>Última Actualización</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM cleaner";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo $row->username; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->password; ?></td>
                                            <td><?php echo $row->reg_date; ?></td>
                                            <td><?php echo $row->updation_date; ?></td>
                                            <td>
                                                <a href="edit-cleaner.php?id=<?php echo $row->id; ?>"><i
                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="manage-cleaner.php?del=<?php echo $row->id; ?>"
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