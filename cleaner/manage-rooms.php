<?php 
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Eliminar habitación
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE FROM rooms WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();   
    echo "<script>alert('Habitación eliminada exitosamente');</script>";
}

// Filtrado por estado de limpieza y ocupación
$filter = "";
if (isset($_POST['filter'])) {
    $clean_filter = $_POST['clean_filter'];
    $occupied_filter = $_POST['occupied_filter'];
    $conditions = [];

    if ($clean_filter !== "") {
        $conditions[] = "clean = " . intval($clean_filter);
    }

    if (!empty($conditions)) {
        $filter = "WHERE " . implode(" AND ", $conditions);
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
    <title>Administrar Habitaciones</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .limpia {
        color: green;
    }

    .no-limpia {
        color: red;
    }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        </br></br>
                        <h2 class="page-title">Administrar Habitaciones</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Filtrar Habitaciones</div>
                            <div class="panel-body">
                                <form method="post" class="form-inline">
                                    <div class="form-group">
                                        <label for="clean_filter">Estado Limpieza:</label>
                                        <select name="clean_filter" id="clean_filter" class="form-control">
                                            <option value="">Todos</option>
                                            <option value="0">No Limpia</option>
                                            <option value="1">Limpia</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="filter" class="btn btn-primary">Aplicar Filtro</button>
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Detalle de Habitaciones</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Serie</th>
                                            <th>No. Cuarto</th>
                                            <th>Tarifa</th>
                                            <th>Fecha de Publicación</th>
                                            <th>Estado de Limpieza</th>
                                            <th>Ocupada</th>
                                            <th>Tipo de Habitación</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Serie</th>
                                            <th>No. Cuarto</th>
                                            <th>Tarifa</th>
                                            <th>Fecha de Publicación</th>
                                            <th>Estado de Limpieza</th>
                                            <th>Ocupada</th>
                                            <th>Tipo de Habitación</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php	
                                        $ret = "SELECT * FROM rooms $filter";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row->room_no; ?></td>
                                            <td><?php echo $row->fees; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->posting_date)); ?></td>
                                            <td class="<?php echo ($row->clean == 1) ? 'limpia' : 'no-limpia'; ?>">
                                                <?php echo ($row->clean == 1) ? 'Limpia' : 'No Limpia'; ?>
                                            </td>
                                            <td class="<?php echo ($row->ocupada == 1) ? 'ocupada' : ''; ?>">
                                                <?php echo ($row->ocupada == 1) ? 'Sí' : 'No'; ?>
                                            </td>
                                            <td><?php echo $row->room_type; ?></td>
                                            <td>
                                                <a href="edit-room.php?id=<?php echo $row->id;?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;&nbsp;
                                                <a href="manage-rooms.php?del=<?php echo $row->id;?>"
                                                    onclick="return confirm('¿Deseas eliminar este registro?');">
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