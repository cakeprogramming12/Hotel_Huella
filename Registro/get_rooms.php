<?php
include('includes/config.php');

if (isset($_POST['room_type'])) {
    $room_type = mysqli_real_escape_string($mysqli, $_POST['room_type']);
    $query = "SELECT room_no FROM rooms WHERE room_type = ? AND ocupada = 0";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $room_type);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<option value=''>Selecciona la habitación</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['room_no'] . "'>" . $row['room_no'] . "</option>";
    }
}
?>