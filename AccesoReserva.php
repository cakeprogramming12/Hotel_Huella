<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo_reservacion'];
    $query = "SELECT * FROM registration WHERE codigo_alfanumerico=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $_SESSION['login'] = $row['emailid']; // Puedes usar cualquier identificador relevante
        header("Location: room-details.php");
        exit();
    } else {
        $error = "Código de reservación inválido. Intenta nuevamente.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Reservación</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
    body {
        background: url('img/login-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="text-center">Acceso a tu Reservación</h2>
        <form method="post" class="mt-4">
            <div class="form-group">
                <label for="codigo_reservacion">Código Alfanumérico de Reservación:</label>
                <input type="text" class="form-control" id="codigo_reservacion" name="codigo_reservacion" required>
            </div>
            <?php if (isset($error)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn-block">Acceder</button>
        </form>
    </div>
</body>

</html>