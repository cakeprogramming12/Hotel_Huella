<?php  
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

// Verificar si el usuario ya tiene una reservación
$aid = $_SESSION['login'];
$reservation_check_query = "SELECT * FROM registration WHERE emailid=?";
$stmt = $mysqli->prepare($reservation_check_query);
$stmt->bind_param('s', $aid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Si ya tiene reservación, redirigir a factura.php
    header("Location: factura.php");
    exit();
}

if (isset($_POST['submit'])) {
    $roomno = mysqli_real_escape_string($mysqli, $_POST['room']);
    $feespm = mysqli_real_escape_string($mysqli, $_POST['fpm']);
    $foodstatus = mysqli_real_escape_string($mysqli, $_POST['foodstatus']);
    $stayfrom = mysqli_real_escape_string($mysqli, $_POST['stayf']);
    $duration = mysqli_real_escape_string($mysqli, $_POST['duration']);
    $fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
    $mname = mysqli_real_escape_string($mysqli, $_POST['mname']);
    $lname = mysqli_real_escape_string($mysqli, $_POST['lname']);
    $contactno = mysqli_real_escape_string($mysqli, $_POST['contact']);
    $emailid = mysqli_real_escape_string($mysqli, $_POST['email']);
    $random_code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

    // Validación: Fecha de estadía desde
    $current_date = date('Y-m-d');
    if ($stayfrom < $current_date) {
        echo "<script>alert('La estadía tiene que ser a partir del día de mañana.');</script>";
    } else {
        $query = "INSERT INTO registration (
            roomno, feespm, foodstatus, stayfrom, duration, firstName, middleName, lastName, contactno, 
            emailid, codigo_alfanumerico, postingDate
        ) VALUES (
            '$roomno', '$feespm', '$foodstatus', '$stayfrom', '$duration', '$fname', '$mname', '$lname', 
            '$contactno', '$emailid', '$random_code', NOW()
        )";

        if ($mysqli->query($query)) {
            // Actualizar el estado de la habitación seleccionada a "ocupada"
            $update_room_query = "UPDATE rooms SET ocupada = 1 WHERE room_no = ?";
            $stmt = $mysqli->prepare($update_room_query);
            $stmt->bind_param('s', $roomno);

            if ($stmt->execute()) {
                header("Location: factura.php");
                exit();
            } else {
                echo "<script>alert('Error al actualizar el estado de la habitación: " . $mysqli->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error al registrar: " . $mysqli->error . "');</script>";
        }
    }
}

// Obtener tipos de habitación únicos
$types_query = "SELECT DISTINCT room_type FROM rooms";
$types_result = $mysqli->query($types_query);
$room_types = [];
while ($row = $types_result->fetch_assoc()) {
    $room_types[] = $row['room_type'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Reservaciones</title>
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
        width: 100%;
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
    </style>
    <script src="js/jquery.min.js"></script>
    <script>
    function getRoomsByType(type) {
        $.ajax({
            type: "POST",
            url: "get_rooms.php",
            data: {
                room_type: type
            },
            success: function(data) {
                $('#room').html(data);
                $('#fpm').val(''); // Limpiar la tarifa cuando cambia el tipo de habitación
            }
        });
    }

    function getFees(room_no) {
        $.ajax({
            type: "POST",
            url: "get_fees.php",
            data: {
                room_no: room_no
            },
            success: function(data) {
                $('#fpm').val(data); // Actualizar la tarifa automáticamente
            }
        });
    }

    function validateDate() {
        const stayf = document.getElementById('stayf').value;
        const today = new Date().toISOString().split('T')[0];
        if (stayf < today) {
            alert('La fecha de estadía no puede ser anterior al día actual.');
            return false;
        }
        return true;
    }
    </script>
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <div class="progress-bar-container">
                            <h4>⭐⭐⭐ Listo, solo un paso de hacer tu reservación ⭐⭐⭐</h4>
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
                        </div>
                        <h2 class="page-title">Reservación</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Diligencia toda la información</div>
                                    <div class="panel-body">
                                        <form method="post" action="" class="form-horizontal"
                                            onsubmit="return validateDate();">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tipo de habitación</label>
                                                <div class="col-sm-8">
                                                    <select name="room_type" id="room_type" class="form-control"
                                                        onchange="getRoomsByType(this.value);" required>
                                                        <option value="">Selecciona el tipo</option>
                                                        <?php foreach ($room_types as $type) { ?>
                                                        <option value="<?php echo $type; ?>"><?php echo $type; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">No de Habitación</label>
                                                <div class="col-sm-8">
                                                    <select name="room" id="room" class="form-control"
                                                        onchange="getFees(this.value);" required>
                                                        <option value="">Selecciona la habitación</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Tarifa por mes</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fpm" id="fpm" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Desayuno</label>
                                                <div class="col-sm-8">
                                                    <input type="radio" value="0" name="foodstatus" checked="checked">
                                                    Sin Desayuno
                                                    <input type="radio" value="1" name="foodstatus"> Con comida 200 por
                                                    mes extra
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Estadía desde</label>
                                                <div class="col-sm-8">
                                                    <input type="date" name="stayf" id="stayf" class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Duración</label>
                                                <div class="col-sm-8">
                                                    <select name="duration" id="duration" class="form-control">
                                                        <option value="">Selecciona duración en noches, max 12</option>
                                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php
                                            $aid = $_SESSION['id'];
                                            $ret = "SELECT * FROM userregistration WHERE id=?";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $aid);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) { ?>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Primer nombre:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fname" id="fname" class="form-control"
                                                        value="<?php echo $row->firstName;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Segundo nombre:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mname" id="mname" class="form-control"
                                                        value="<?php echo $row->middleName;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Apellido:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="lname" id="lname" class="form-control"
                                                        value="<?php echo $row->lastName;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Género:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gender" class="form-control"
                                                        value="<?php echo $row->gender;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">No de Contacto:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contact" id="contact"
                                                        value="<?php echo $row->contactNo;?>" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Correo:</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        value="<?php echo $row->email;?>" readonly>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="reset">Cancelar</button>
                                                <input type="submit" name="submit" Value="Registrar"
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
    <script src="js/bootstrap.min.js"></script>
</body>

</html>