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
    echo "<script>alert('Registro borrado correctamente');</script>";
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Administrar Registros</title>
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
                        <h2 class="page-title">Administrar Registros</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalles de Todos los Registros</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre Completo</th>
                                            <th>No. Cuarto</th>
                                            <th>camas</th>
                                            <th>Costo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Duración</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre Completo</th>
                                            <th>No. Cuarto</th>
                                            <th>camas</th>
                                            <th>Costo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Duración</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM registration";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->firstName . " " . $row->middleName . " " . $row->lastName; ?>
                                            </td>
                                            <td><?php echo $row->roomno; ?></td>
                                            <td><?php echo $row->seater; ?></td>
                                            <td><?php echo $row->feespm; ?></td>
                                            <td><?php echo $row->stayfrom; ?></td>
                                            <td><?php echo $row->duration; ?> meses</td>
                                            <td>

                                                <a href="manage-reservaciones.php?del=<?php echo $row->id; ?>"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar este registro?');"><i
                                                        class="fa fa-close"></i></a>
                                            </td>
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
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>