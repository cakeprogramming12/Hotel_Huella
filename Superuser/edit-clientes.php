<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if ($_POST['submit']) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $updationDate = date("Y-m-d H:i:s");
    $id = $_GET['id'];

    $query = "UPDATE userregistration SET firstName = ?, middleName = ?, lastName = ?, gender = ?, contactNo = ?, email = ?, password = ?, updationDate = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssssssssi', $firstName, $middleName, $lastName, $gender, $contactNo, $email, $password, $updationDate, $id);
    $stmt->execute();
    echo "<script>alert('Los detalles del usuario se han actualizado correctamente');</script>";
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
    <title>Editar Detalles del Usuario</title>
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
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        </br></br>
                        <h2 class="page-title">Editar Detalles del Usuario</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles del Usuario</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <?php
                                            $id = $_GET['id'];
                                            $ret = "SELECT * FROM userregistration WHERE id = ?";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $id);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            while ($row = $res->fetch_object()) {
                                            ?>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="firstName"
                                                        value="<?php echo $row->firstName; ?>" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Segundo Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="middleName"
                                                        value="<?php echo $row->middleName; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Apellido</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="lastName"
                                                        value="<?php echo $row->lastName; ?>" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Género</label>
                                                <div class="col-sm-8">
                                                    <select name="gender" class="form-control" required>
                                                        <option value="Masculino"
                                                            <?php if ($row->gender == "Masculino") echo "selected"; ?>>
                                                            Masculino</option>
                                                        <option value="Femenino"
                                                            <?php if ($row->gender == "Femenino") echo "selected"; ?>>
                                                            Femenino</option>
                                                        <option value="Otro"
                                                            <?php if ($row->gender == "Otro") echo "selected"; ?>>Otro
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Teléfono</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contactNo"
                                                        value="<?php echo $row->contactNo; ?>" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo Electrónico</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" value="<?php echo $row->email; ?>"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="password"
                                                        value="<?php echo $row->password; ?>" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha de Registro</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?php echo $row->regDate; ?>"
                                                        class="form-control" disabled>
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
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>

</html>