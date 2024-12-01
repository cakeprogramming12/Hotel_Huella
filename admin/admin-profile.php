No<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Código para actualizar el correo electrónico
if ($_POST['update']) {
    $email = $_POST['emailid'];
    $aid = $_SESSION['id'];
    $udate = date('Y-m-d');
    $query = "UPDATE admin SET email=?, updation_date=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ssi', $email, $udate, $aid);
    $stmt->execute();
    echo "<script>alert('Correo electrónico actualizado correctamente');</script>";
}

// Código para cambiar contraseña
if (isset($_POST['changepwd'])) {
    $op = $_POST['oldpassword'];
    $np = $_POST['newpassword'];
    $ai = $_SESSION['id'];
    $udate = date('Y-m-d');

    // Verificar contraseña anterior
    $sql = "SELECT password FROM admin WHERE id=? AND password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('is', $ai, $op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt = $chngpwd->num_rows;

    if ($row_cnt > 0) {
        // Actualizar contraseña
        $con = "UPDATE admin SET password=?, updation_date=? WHERE id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi', $np, $udate, $ai);
        $chngpwd1->execute();
        echo "<script>alert('Contraseña cambiada exitosamente');</script>";
    } else {
        echo "<script>alert('La contraseña anterior no coincide');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
    function valid() {
        const newPassword = document.changepwd.newpassword.value;
        const confirmPassword = document.changepwd.cpassword.value;

        if (newPassword !== confirmPassword) {
            alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
            document.changepwd.cpassword.focus();
            return false;
        }
        return true;
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
                        <h2 class="page-title">Administrar Perfil</h2>
                        <?php
                        $aid = $_SESSION['id'];
                        $ret = "SELECT * FROM admin WHERE id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $aid);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        while ($row = $res->fetch_object()) {
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles de Perfil</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Usuario</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="<?php echo $row->username; ?>" disabled
                                                        class="form-control">
                                                    <span class="help-block">El usuario no puede ser cambiado.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="emailid" id="emailid"
                                                        value="<?php echo $row->email; ?>" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha Registro</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $row->reg_date; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <button class="btn btn-default" type="reset">Cancelar</button>
                                                <input class="btn btn-primary" type="submit" name="update"
                                                    value="Actualizar Perfil">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cambiar Contraseña</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" name="changepwd" id="change-pwd"
                                            onSubmit="return valid();">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Contraseña Anterior</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="oldpassword" id="oldpassword"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Nueva Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="newpassword" id="newpassword"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Confirmar Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="cpassword" id="cpassword"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="reset">Cancelar</button>
                                                <input type="submit" name="changepwd" value="Cambiar Contraseña"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>

</html>