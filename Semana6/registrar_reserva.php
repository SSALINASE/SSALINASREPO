<?php
$conn = new mysqli("localhost", "root", "", "agencia");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

for ($i = 1; $i <= 10; $i++) {
   
    $id_cliente = rand(1, 10);
    $fecha_reserva = date('Y-m-d', strtotime("+$i days"));
    $id_vuelo = rand(1, 3);
    $id_hotel = rand(1, 3);

    $stmt = $conn->prepare("INSERT INTO RESERVA ( id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES ( ?, ?, ?, ?)");
    $stmt->bind_param("isii", $id_cliente, $fecha_reserva, $id_vuelo, $id_hotel);

    if ($stmt->execute()) {
        echo "Reserva $i registrada exitosamente.<br>";
    } else {
        echo "Error en la reserva $i: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>



