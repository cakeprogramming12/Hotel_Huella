<?php
// Conexión a la base de datos
$host = 'localhost'; // Cambiar según configuración
$user = 'root';      // Cambiar según configuración
$password = '';      // Cambiar según configuración
$database = 'hostel'; // Cambiar por el nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los códigos de reserva existentes
$query = "SELECT codigo_alfanumerico FROM registration";
$result = $conn->query($query);

// Verificar si hubo un error en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_reserva = $conn->real_escape_string($_POST['codigo_reserva']);
    $id_huella = $conn->real_escape_string($_POST['id_huella']);

    // Verificar si el código de reserva existe y obtener el campo emailid
    $query1 = "SELECT emailid FROM registration WHERE codigo_alfanumerico = '$codigo_reserva'";
    $result1 = $conn->query($query1);

    // Verificar si hubo un error en la consulta
    if (!$result1) {
        die("Error en la consulta: " . $conn->error);
    }

    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $email = $row['emailid'];

        // Verificar si existe un registro con el mismo correo en userregistration
        $query2 = "SELECT * FROM userregistration WHERE email = '$email'";
        $result2 = $conn->query($query2);

        // Verificar si hubo un error en la consulta
        if (!$result2) {
            die("Error en la consulta: " . $conn->error);
        }

        if ($result2->num_rows > 0) {
            // Actualizar el campo huella con el ID de la huella
            $query3 = "UPDATE userregistration SET huella = '$id_huella' WHERE email = '$email'";
            if ($conn->query($query3) === TRUE) {
                $message = "ID de la huella actualizado correctamente.";
                $message_type = "success";
            } else {
                $message = "Error al actualizar el ID de la huella: " . $conn->error;
                $message_type = "danger";
            }
        } else {
            $message = "No se encontró un registro en userregistration con el correo proporcionado.";
            $message_type = "warning";
        }
    } else {
        $message = "El código de reserva no existe.";
        $message_type = "warning";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar ID de Huella</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        color: #fff;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }

    .form-container {
        background: #ffffff11;
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    .form-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .btn-custom {
        background-color: #00c1d4;
        border: none;
    }

    .btn-custom:hover {
        background-color: #007a84;
    }

    .btn-back {
        margin-top: 15px;
        background: transparent;
        border: 1px solid #fff;
        color: #fff;
    }

    .btn-back:hover {
        background: #fff;
        color: #00c1d4;
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Actualizar ID de Huella</h1>
        <?php if (isset($message)): ?>
        <div class="alert alert-<?= $message_type ?>" role="alert">
            <?= $message ?>
        </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="codigo_reserva" class="form-label">Código de Reserva</label>
                <select class="form-select" name="codigo_reserva" id="codigo_reserva" required>
                    <option value="" disabled selected>Seleccione un código de reserva</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['codigo_alfanumerico'] . "'>" . $row['codigo_alfanumerico'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No hay códigos disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_huella" class="form-label">ID de la Huella</label>
                <input type="text" class="form-control" name="id_huella" id="id_huella" required>
            </div>
            <button type="submit" class="btn btn-custom btn-lg w-100">Actualizar</button>
        </form>
        <a href="admin-profile.php" class="btn btn-back w-100">Volver al inicio de admin</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>