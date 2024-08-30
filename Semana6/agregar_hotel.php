<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones_disponibles = $_POST['habitaciones_disponibles'];
    $tarifa_noche = $_POST['tarifa_noche'];

    $conn = new mysqli("localhost", "root", "", "agencia");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO HOTEL (nombre, ubicación, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche);

    if ($stmt->execute()) {
        echo "Hotel agregado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
