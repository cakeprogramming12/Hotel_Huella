<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Código para agregar registros en la tabla userregistration
if ($_POST['submit']) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Contraseña sin encriptar
    $regDate = date("Y-m-d H:i:s"); // Fecha de registro actual

    // Verificar si el correo ya existe
    $sql = "SELECT email FROM userregistration WHERE email=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;

    if ($row_cnt > 0) {
        echo "<script>alert('El correo ya está registrado');</script>";
    } else {
        // Insertar el nuevo registro
        $query = "INSERT INTO userregistration (firstName, middleName, lastName, gender, contactNo, email, password, regDate) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssssss', $firstName, $middleName, $lastName, $gender, $contactNo, $email, $password, $regDate);
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
    <title>Agregar Usuario</title>
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
                        <h2 class="page-title">Agregar Usuario</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles del Usuario</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="firstName"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Segundo Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="middleName">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Apellido</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lastName"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Género</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="gender" required="required">
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Teléfono</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="contactNo"
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
                                                    value="Crear Usuario">
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