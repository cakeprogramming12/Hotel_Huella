<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "delete from rooms where id=?";
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
    <title>Manage Rooms</title>
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
                        </br></br>
                        <h2 class="page-title">Administrar Cuartos</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalle de todos los Cuartos</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Serie.</th>
                                            <th>Tipo de Habitación</th>
                                            <th>No Cuarto.</th>
                                            <th>Costes</th>
                                            <th>Estado (Ocupada)</th>
                                            <th>Fecha Contabilización</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Serie.</th>
                                            <th>Tipo de Habitación</th>
                                            <th>No Cuarto.</th>
                                            <th>Costes</th>
                                            <th>Estado (Ocupada)</th>
                                            <th>Fecha Contabilización</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM rooms";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->room_type; ?></td>
                                            <td><?php echo $row->room_no; ?></td>
                                            <td><?php echo $row->fees; ?></td>
                                            <td><?php echo $row->ocupada ? 'Sí' : 'No'; ?></td>
                                            <td><?php echo $row->posting_date; ?></td>
                                            <td>
                                                <a href="edit-room.php?id=<?php echo $row->id; ?>"><i
                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="manage-rooms.php?del=<?php echo $row->id; ?>"
                                                    onclick="return confirm('¿Desea eliminar este registro?');"><i
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