<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Código para agregar registros en hotel_finances
if ($_POST['submit']) {
    $registration_id = $_POST['registration_id'];
    $amount_due = $_POST['amount_due'];
    $payment_date = $_POST['payment_date'];

    // Verificar si el registro ya existe
    $sql = "SELECT registration_id FROM hostel_finances WHERE registration_id=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s', $registration_id);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;
    
    if ($row_cnt > 0) {
        echo "<script>alert('El registro ya existe');</script>";
    } else {
        // Insertar el nuevo registro
        $query = "INSERT INTO hostel_finances (registration_id, amount_due, payment_date) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sds', $registration_id, $amount_due, $payment_date);
        $stmt->execute();
        echo "<script>alert('El registro se ha agregado correctamente, se procedera a escanear su huella');</script>";
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
    <title>Agregar Registro Financiero</title>
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
                        <h2 class="page-title">Agregar Registro Financiero</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-heading">Detalles del Registro</div>
                                    <div class="panel-body">
                                        <?php if (isset($_POST['submit'])) { ?>
                                        <p style="color: red">
                                            <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                        </p>
                                        <?php } ?>
                                        <form method="post" class="form-horizontal">
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">ID de Registro</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="registration_id"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Monto pagado</label>
                                                <div class="col-sm-8">
                                                    <input type="number" step="0.01" class="form-control"
                                                        name="amount_due" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha de Pago</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" name="payment_date"
                                                        required="required">
                                                </div>
                                            </div>


                                            <div class="col-sm-8 col-sm-offset-2">
                                                <input class="btn btn-primary" type="submit" name="submit"
                                                    value="Crear Registro">
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