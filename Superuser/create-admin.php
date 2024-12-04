<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Código para agregar registros en la tabla admin
if ($_POST['submit']) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Contraseña sin encriptar
    $reg_date = date("Y-m-d H:i:s"); // Fecha de registro actual

    // Verificar si el usuario ya existe
    $sql = "SELECT username FROM admin WHERE username=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s', $username);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;

    if ($row_cnt > 0) {
        echo "<script>alert('El usuario ya existe');</script>";
    } else {
        // Insertar el nuevo registro
        $query = "INSERT INTO admin (username, email, password, reg_date) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $password, $reg_date);
        $stmt->execute();
        echo "<script>alert('El registro se ha agregado correctamente');</script>";
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
    <title>Agregar Administrador</title>
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
                        <br>
                        <br>
                        <h2 class="page-title">Agregar Administrador</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles del Administrador</div>
                                    <div class="panel-body">
                                        <?php if (isset($_POST['submit'])) { ?>
                                        <p style="color: red">
                                            <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                        </p>
                                        <?php } ?>
                                        <form method="post" class="form-horizontal">
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nombre de Usuario</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="username"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo Electrónico</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="email"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Crear Administrador">
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