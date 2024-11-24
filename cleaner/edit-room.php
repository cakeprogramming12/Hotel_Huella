<?php 
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Code for updating room details
if ($_POST['submit']) {
    $clean = $_POST['clean'];  // Guardar el estado de limpieza
    $id = $_GET['id'];

    // Actualizar solo el estado de limpieza
    $query = "UPDATE rooms SET clean=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ii', $clean, $id);
    $stmt->execute();
    echo "<script>alert('Estado de limpieza actualizado correctamente');</script>";
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
    <title>Edit Room Details</title>
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
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        </br></br>
                        <h2 class="page-title">Editar Detalles de Cuarto</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles de Cuarto</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <?php	
                                                $id = $_GET['id'];
                                                $ret = "SELECT * FROM rooms WHERE id=?";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->bind_param('i', $id);
                                                $stmt->execute();
                                                $res = $stmt->get_result();

                                                while ($row = $res->fetch_object()) {
                                            ?>
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">No de Cuarto</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="rmno" id="rmno"
                                                        value="<?php echo $row->room_no; ?>" disabled>
                                                    <span class="help-block m-b-none">El número del cuarto no puede ser
                                                        cambiado.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Estado Limpieza</label>
                                                <div class="col-sm-8">
                                                    <select name="clean" class="form-control">
                                                        <option value="1"
                                                            <?php echo ($row->clean == 1) ? 'selected' : ''; ?>>Limpia
                                                        </option>
                                                        <option value="0"
                                                            <?php echo ($row->clean == 0) ? 'selected' : ''; ?>>No
                                                            Limpia</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php } ?>

                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Actualizar Estado de Limpieza">
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