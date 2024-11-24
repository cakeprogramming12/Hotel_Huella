<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    
    // Iniciar transacción para garantizar consistencia en las eliminaciones
    $mysqli->begin_transaction();

    try {
        // Eliminar registros relacionados en la tabla hostel_finances
        $delete_finances = "DELETE FROM hostel_finances WHERE registration_id = ?";
        $stmt_finances = $mysqli->prepare($delete_finances);
        $stmt_finances->bind_param('i', $id);
        $stmt_finances->execute();
        $stmt_finances->close();

        // Eliminar el registro principal en la tabla hostel_registration
        $delete_registration = "DELETE FROM registration WHERE id = ?";
        $stmt_registration = $mysqli->prepare($delete_registration);
        $stmt_registration->bind_param('i', $id);
        $stmt_registration->execute();
        $stmt_registration->close();

        // Confirmar cambios
        $mysqli->commit();

        echo "<script>alert('Registro eliminado exitosamente');</script>";
    } catch (Exception $e) {
        // Revertir cambios en caso de error
        $mysqli->rollback();
        echo "<script>alert('Error al eliminar los datos: {$e->getMessage()}');</script>";
    }
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
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            510 + ',height=' + 430 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }
    </script>
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
                        <h2 class="page-title">Administración de Registro de clientes</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Detalles de Cuarto</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Serie.</th>
                                            <th>Nombre del CLIENTE</th>
                                            <th>No de Contacto </th>
                                            <th>No de Cuarto</th>
                                            <th>Habitaciones</th>
                                            <th>Estadía desde</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Serie.</th>
                                            <th>Nombre del CLIENTE</th>
                                            <th>No de Contacto </th>
                                            <th>No de Cuarto</th>
                                            <th>Habitaciones</th>
                                            <th>Estadía desde</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
										$aid = $_SESSION['id'];
										$ret = "select * from registration";
										$stmt = $mysqli->prepare($ret);
										$stmt->execute();
										$res = $stmt->get_result();
										$cnt = 1;
										while ($row = $res->fetch_object()) {
										?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->firstName; ?> <?php echo $row->middleName; ?>
                                                <?php echo $row->lastName; ?></td>
                                            <td><?php echo $row->contactno; ?></td>
                                            <td><?php echo $row->roomno; ?></td>
                                            <td><?php echo $row->seater; ?></td>
                                            <td><?php echo $row->stayfrom; ?></td>
                                            <td>
                                                <a href="manage-students.php?del=<?php echo $row->id; ?>"
                                                    title="Delete Record"
                                                    onclick="return confirm('Do you want to delete');">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
											$cnt = $cnt + 1;
										} ?>
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