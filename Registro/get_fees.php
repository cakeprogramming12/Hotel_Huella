<?php
include('includes/config.php');

if (isset($_POST['room_no'])) {
    $room_no = mysqli_real_escape_string($mysqli, $_POST['room_no']);
    $query = "SELECT fees FROM rooms WHERE room_no = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $room_no);
    $stmt->execute();
    $stmt->bind_result($fees);
    $stmt->fetch();
    echo $fees;
}
?>