<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>detalles de habitacion</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script language="javascript" type="text/javascript">
    function popUpWindow(URLStr, left, top, width, height) {
        var popUpWin = open(
            URLStr,
            'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            width + ',height=' + height + ',left=' + left + ',top=' + top);
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
                        <br><br>
                        <h2 class="page-title">
                            💵💵Vistazo de la reserva, por favor imprima su comprobante💵💵</h2>
                        <br>
                        <br>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Vistazo de tu reserva</div>
                            <div class="panel-body">
                                <table id="zctb" class="table table-bordered" cellspacing="0" width="100%">
                                    <tbody>
                                        <?php
                                        $aid = $_SESSION['login'];
                                        $ret = "SELECT * FROM registration WHERE emailid=?";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param('s', $aid);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td colspan="4">
                                                <h4>Información de la Habitación</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Último Acceso</b></td>
                                            <td colspan="3"><?php echo $row->postingDate; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Número de Habitación</b></td>
                                            <td><?php echo $row->roomno; ?></td>
                                            <td><b></b></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Coste por Mes</b></td>
                                            <td><?php echo $fpm = $row->feespm; ?></td>
                                            <td><b>Comida</b></td>
                                            <td><?php echo ($row->foodstatus == 0) ? "Sin comida" : "Con comida"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Estadía desde</b></td>
                                            <td><?php echo $row->stayfrom; ?></td>
                                            <td><b>Duración</b></td>
                                            <td><?php echo $dr = $row->duration; ?> noches</td>
                                        </tr>
                                        <tr>
                                            <td><b>Costo Total</b></td>
                                            <td colspan="3">
                                                <?php
                                                echo ($row->foodstatus == 1) ? (($dr * $fpm) + (200 * $dr)) : ($dr * $fpm);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <h4>Información Personal</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Nombre Completo</b></td>
                                            <td><?php echo $row->firstName . ' ' . $row->middleName . ' ' . $row->lastName; ?>
                                            </td>
                                            <td><b>Email</b></td>
                                            <td><?php echo $row->emailid; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Teléfono</b></td>
                                            <td><?php echo $row->contactno; ?></td>
                                            <td><b>Código de Reserva</b></td>
                                            <td><?php echo $row->codigo_alfanumerico; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <a href="generate_receipt.php" target="_blank" class="btn btn-primary">Generar
                                    Comprobante de Pago</a>
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
    <script src="js/main.js"></script>

</body>

</html>