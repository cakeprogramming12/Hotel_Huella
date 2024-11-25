<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if ($_POST['submit']) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_GET['id'];

    $query = "UPDATE cleaner SET username = ?, email = ?, password = ?, updation_date = NOW() WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        die("Error en la consulta: " . $mysqli->error);
    }
    $rc = $stmt->bind_param('sssi', $username, $email, $password, $id);
    $stmt->execute();

    echo "<script>alert('Los detalles del cleaner se han actualizado correctamente');</script>";
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
    <title>Editar Detalles del Cleaner</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
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
                        </br></br>
                        <h2 class="page-title">Editar Detalles del Cleaner</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles del Cleaner</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <?php
                                            $id = $_GET['id'];
                                            $ret = "SELECT * FROM cleaner WHERE id = ?";
                                            $stmt = $mysqli->prepare($ret);
                                            if (!$stmt) {
                                                die("Error en la consulta: " . $mysqli->error);
                                            }
                                            $stmt->bind_param('i', $id);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            while ($row = $res->fetch_object()) {
                                            ?>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nombre de Usuario</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="username"
                                                        value="<?php echo $row->username; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo Electrónico</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="email"
                                                        value="<?php echo $row->email; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password"
                                                        value="<?php echo $row->password; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha de Registro</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $row->reg_date; ?>" disabled>
                                                    <span class="help-block m-b-none">La fecha de registro no se puede
                                                        modificar.</span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Actualizar Detalles">
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
    <script src="js/main.js"></script>
</body>

</html>