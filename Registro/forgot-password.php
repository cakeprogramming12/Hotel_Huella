<?php
session_start();
include('includes/config.php');

$pwd = ''; // Inicializar la variable para la contraseña
$error = ''; // Inicializar la variable para mensajes de error

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Preparar la consulta
    $stmt = $mysqli->prepare("SELECT email, contactNo, password FROM userregistration WHERE email=? AND contactNo=?");
    $stmt->bind_param('ss', $email, $contact);
    $stmt->execute();
    $stmt->bind_result($username, $email_db, $password);
    $rs = $stmt->fetch();

    if ($rs) {
        $pwd = $password; // Asignar la contraseña si los datos son válidos
    } else {
        // Asignar mensaje de error si no se encuentran resultados
        $error = 'Correo electrónico o número de contacto incorrecto. Inténtelo de nuevo.';
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

    <title>Olvido de Contraseña</title>

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

    <div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
        <div class="form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1 class="text-center text-bold text-light mt-4x">Olvido de Contraseña</h1>
                        <div class="well row pt-2x pb-3x bk-light">
                            <div class="col-md-8 col-md-offset-2">
                                <?php if (!empty($pwd)) { ?>
                                <div class="alert alert-success">
                                    <p><strong>Tu contraseña es:</strong> <?php echo $pwd; ?></p>
                                    <p>Cambia la contraseña después de acceder.</p>
                                </div>
                                <?php } elseif (!empty($error)) { ?>
                                <div class="alert alert-danger">
                                    <p><?php echo $error; ?></p>
                                </div>
                                <?php } ?>
                                <form action="" class="mt" method="post">
                                    <label for="" class="text-uppercase text-sm">Tu correo electrónico</label>
                                    <input type="email" placeholder="Email" name="email" class="form-control mb"
                                        required>
                                    <label for="" class="text-uppercase text-sm">Tu número de contacto</label>
                                    <input type="text" placeholder="Número de contacto" name="contact"
                                        class="form-control mb" required>

                                    <input type="submit" name="login" class="btn btn-primary btn-block"
                                        value="Recuperar Contraseña">
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-light">
                            <a href="index.php" class="text-light">¿Deseas ingresar ahora?</a>
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