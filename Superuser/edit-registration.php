<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if ($_POST['submit']) {
    $roomno = $_POST['roomno'];
    $seater = $_POST['seater'];
    $feespm = $_POST['feespm'];
    $foodstatus = $_POST['foodstatus'];
    $duration = $_POST['duration'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contactno'];
    $emailid = $_POST['emailid'];
    $codigo_alfanumerico = $_POST['codigo_alfanumerico'];
    $id = $_GET['id'];

    $query = "UPDATE registration SET roomno = ?, seater = ?, feespm = ?, foodstatus = ?, duration = ?, firstName = ?, middleName = ?, lastName = ?, gender = ?, contactno = ?, emailid = ?, codigo_alfanumerico = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iissssssssssi', $roomno, $seater, $feespm, $foodstatus, $duration, $firstName, $middleName, $lastName, $gender, $contactno, $emailid, $codigo_alfanumerico, $id);
    $stmt->execute();
    echo "<script>alert('Los detalles del registro se han actualizado correctamente');</script>";
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
    <title>Editar Registro</title>
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
                        <h2 class="page-title">Editar Registro</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles del Registro</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <?php
                                            $id = $_GET['id'];
                                            $ret = "SELECT * FROM registration WHERE id = ?";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $id);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            while ($row = $res->fetch_object()) {
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Número de Habitación</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="roomno" value="<?php echo $row->roomno; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Seater</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="seater" value="<?php echo $row->seater; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Cuota mensual</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="feespm" value="<?php echo $row->feespm; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Estado de Comida</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="foodstatus"
                                                        value="<?php echo $row->foodstatus; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Duración</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="duration"
                                                        value="<?php echo $row->duration; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Primer Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="firstName"
                                                        value="<?php echo $row->firstName; ?>" class="form-control">
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
                                                        value="<?php echo $row->lastName; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Género</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gender" value="<?php echo $row->gender; ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contacto</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contactno"
                                                        value="<?php echo $row->contactno; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo Electrónico</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="emailid"
                                                        value="<?php echo $row->emailid; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Código Alfanumérico</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="codigo_alfanumerico"
                                                        value="<?php echo $row->codigo_alfanumerico; ?>"
                                                        class="form-control">
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