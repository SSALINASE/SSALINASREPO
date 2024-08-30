<?php
$conn = new mysqli("localhost", "root", "", "agencia");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT HOTEL.nombre, COUNT(RESERVA.id_reserva) as numero_reservas 
        FROM HOTEL 
        JOIN RESERVA ON HOTEL.id_hotel = RESERVA.id_hotel 
        GROUP BY HOTEL.nombre 
        HAVING COUNT(RESERVA.id_reserva) > 2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Hotel: " . $row["nombre"] . " - Número de reservas: " . $row["numero_reservas"] . "<br>";
    }
} else {
    echo "No hay hoteles con más de 2 reservas.";
}

$conn->close();
?>
