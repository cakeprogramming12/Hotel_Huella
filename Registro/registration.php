<?php
session_start();
include('includes/config.php');

if (isset($_POST['submit'])) {
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $lname = trim($_POST['lname']);
    $gender = $_POST['gender'];
    $contactno = trim($_POST['contact']);
    $emailid = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validaciones del servidor
    $errors = [];
    if (!preg_match("/^[a-zA-Z]+$/", $fname)) {
        $errors[] = "El primer nombre solo puede contener letras sin espacios, intente nuevamente.";
    }
    if (!empty($mname) && !preg_match("/^[a-zA-Z]*$/", $mname)) {
        $errors[] = "El segundo nombre solo puede contener letras sin espacios, intente nuevamente.";
    }
    if (!preg_match("/^[a-zA-Z]+$/", $lname)) {
        $errors[] = "El apellido paterno solo puede contener letras, intente nuevamente.";
    }
    if (!preg_match("/^\d{10}$/", $contactno)) {
        $errors[] = "El número de contacto debe contener exactamente 10 dígitos, intente nuevamente.";
    }
    if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido, intente nuevamente.";
    }
    if ($password !== $cpassword) {
        $errors[] = "Las contraseñas no coinciden, intente nuevamente.";
    }

    // Verificar si el correo ya existe
    $email_check_query = "SELECT email FROM userRegistration WHERE email = ?";
    $stmt = $mysqli->prepare($email_check_query);
    $stmt->bind_param("s", $emailid);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "El correo electrónico ya está registrado.";
    }
    $stmt->close();

    if (count($errors) > 0) {
        echo '<div class="error-container">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    } else {
        $query = "INSERT INTO userRegistration(firstName, middleName, lastName, gender, contactNo, email, password) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssiss', $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
        $stmt->execute();

        // Redirigir a login.php después de registrar al usuario
        header("Location: login.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Registro de Usuarios</title>
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
        width: 33%;
        height: 100%;
        background-color: #007bff;
        border-radius: 5px;
    }

    .page-title {
        color: #333;
        font-weight: bold;
        margin: 20px 0;
    }

    .panel-primary {
        border-color: #007bff;
    }

    .panel-primary .panel-heading {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .error-container {
        margin: 20px 0;
        padding: 15px;
        border: 2px solid red;
        background-color: #ffe5e5;
        color: #d60000;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
    }

    .error-container p {
        margin: 0;
        padding: 5px;
    }
    </style>
    <script>
    function valid() {
        const password = document.getElementById("password").value;
        const cpassword = document.getElementById("cpassword").value;
        if (password !== cpassword) {
            alert("Las contraseñas no coinciden, intente nuevamente.");
            return false;
        }

        const contact = document.getElementById("contact").value;
        if (!/^\d{10}$/.test(contact)) {
            alert("El número de contacto debe contener exactamente 10 dígitos, intente nuevamente.");
            return false;
        }

        const fname = document.getElementById("fname").value;
        const lname = document.getElementById("lname").value;
        if (!/^[a-zA-Z]+$/.test(fname) || !/^[a-zA-Z]+$/.test(lname)) {
            alert("El nombre y los apellidos solo pueden contener letras, intente nuevamente.");
            return false;
        }

        return true;
    }
    </script>
</head>

<body>
    <div class="progress-bar-container">
        <h4>Paso 1 de 3</h4>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
    </div>

    <div class="ts-main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">🏆 Registrarte no te cuesta nada 🥳</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Llena toda la información</div>
                                    <div class="panel-body">
                                        <form method="post" action="" name="registration" class="form-horizontal"
                                            onSubmit="return valid();">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Primer Nombre</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fname" id="fname" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Apellido Paterno</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mname" id="mname" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Apellido Materno</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="lname" id="lname" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Género</label>
                                                <div class="col-sm-8">
                                                    <select name="gender" class="form-control" required="required">
                                                        <option value="">Seleccionar Género</option>
                                                        <option value="male">Hombre</option>
                                                        <option value="female">Mujer</option>
                                                        <option value="others">Otros</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">No de Contacto</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contact" id="contact" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Confirmar Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="cpassword" id="cpassword"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="reset">Cancelar</button>
                                                <input type="submit" name="submit" Value="Registro"
                                                    class="btn btn-primary">
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
    <script src="js/bootstrap.min.js"></script>
</body>

</html>