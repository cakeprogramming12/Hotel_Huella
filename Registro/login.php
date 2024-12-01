<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT email, password, id FROM userregistration WHERE email=? and password=?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->bind_result($email, $password, $id);
    $rs = $stmt->fetch();
    $stmt->close();

    if ($rs) {
        $_SESSION['id'] = $id;
        $_SESSION['login'] = $email;
        $ip = $_SERVER['REMOTE_ADDR'];
        $log = "INSERT INTO userLog(userId, userEmail, userIp) VALUES ('$id', '$email', '$ip')";
        $mysqli->query($log);

        // Redirigir a dashboard.php después del inicio de sesión exitoso
        header("location:reservacion.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        zoom: 80%;
    }

    .progress-bar-container {
        background-color: #ffffff;
        padding: 20px;
        border-bottom: 2px solid #e0e0e0;
    }

    .progress-bar {
        height: 10px;
        width: 100%;
        background-color: #e0e0e0;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-bar .progress {
        width: 66%;
        height: 100%;
        background-color: #007bff;
        border-radius: 5px;
    }

    .page-title {
        color: #333;
        font-weight: bold;
        margin: 20px 0;
    }

    .well {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .text-light a {
        color: #007bff;
    }

    .text-light a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="progress-bar-container">
        <h4>Paso 2 de 3</h4>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
    </div>

    <div class="ts-main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">🙌 Ya casi terminamos, por favor ingresa tus cuenta para iniciar session
                            🥰
                        </h2>

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="well row pt-2x pb-3x bk-light">
                                    <div class="col-md-8 col-md-offset-2">
                                        <form action="" class="mt" method="post">
                                            <label for="" class="text-uppercase text-sm">Correo</label>
                                            <input type="text" placeholder="Email" name="email" class="form-control mb"
                                                required>
                                            <label for="" class="text-uppercase text-sm">Contraseña</label>
                                            <input type="password" placeholder="Contraseña" name="password"
                                                class="form-control mb" required>
                                            <input type="submit" name="login" class="btn btn-primary btn-block"
                                                value="Iniciar Sesión">
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center text-light">
                                    <a href="forgot-password.php" class="text-light">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>