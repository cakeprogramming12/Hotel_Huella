<?php
// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['fingerprint_id'];  // Obtener el ID del formulario

    // Validar el ID (asegurarse de que es un número entre 1 y 127)
    if ($id < 1 || $id > 127) {
        echo "ID inválido. Por favor, ingresa un valor entre 1 y 127.";
    } else {
        // Enviar el ID al Arduino (a través del puerto serial o una petición HTTP)
        $response = enrollFingerprint($id);

        // Mostrar la respuesta del Arduino (éxito o error)
        echo $response;
    }
}

// Función para enrollar la huella
function enrollFingerprint($id) {
    // El script de Arduino debería estar escuchando una solicitud a través del puerto serial o de una red (HTTP)
    
    // Ejemplo: Enviar el ID a través de la conexión serial (para Raspberry Pi o un puerto serial)
    // Comando a enviar al Arduino, usando exec() o un socket de red
    $command = "php /ruta/a/tu/script_arduino_serial.php $id"; // Usando PHP para ejecutar el comando que interactúa con Arduino

    // Ejecutar el comando en el sistema (suponiendo que tienes un script PHP que maneja la comunicación serial)
    $output = shell_exec($command);

    // Devolver el resultado del enrollado de huella
    return $output;
}
?>

<!-- Interfaz HTML simple para ingresar el ID -->
<form method="POST">
    <label for="fingerprint_id">Ingresa el ID de huella (1-127):</label>
    <input type="number" id="fingerprint_id" name="fingerprint_id" min="1" max="127" required>
    <button type="submit">Enrollar Huella</button>
</form>