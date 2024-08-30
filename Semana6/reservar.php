<?php
session_start();
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "agencia"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$inactive = 1800;
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        echo "La sesión ha expirado.";
    }
}
$_SESSION['timeout'] = time();

$notificaciones = [
    "¡Acumula el doble de millas siendo socio de nuestra agencia!"
];

$notificacionesJson = json_encode($notificaciones);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Agencia de Viajes</title>
</head>
<body>
<header>
    <div class="banner">
        <h1>Agencia de Viajes </h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Vuelos</a></li>
                <li><a href="#">Hoteles</a></li>
                <li><a href="OfertasSemana4.html">Ofertas</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="reservar.php">Reservar</a></li>
            </ul>
        </nav>

        <div id="cartIcon">
            🛒 <span id="cartCount">0</span>
        </div>
    </div>
</header>

<main>


    
    <div class="main2">
    <form action="registrar_reserva.php" method="POST">
            <div class="GrupoCampos">
            <label for="id_cliente">ID Cliente:</label>
            <input type="text" id="id_cliente" name="id_cliente" required>
        </div>
        <div class="GrupoCampos">
            <label for="fecha_reserva">Fecha Reserva:</label>
            <input type="date" id="fecha_reserva" name="Fecha de reserva" required>
        </div>
        <div class="GrupoCampos">
            <label for="id_vuelo">Id Vuelo:</label>
            <input type="text" id="id_vuelo" name="id_vuelo" required>
        </div>
        <div class="GrupoCampos">
            <label for="id_hotel">Id Hotel:</label>
            <input type="text" id="id_hotel" name="id_hotel" required>
        </div>
        <div class="GrupoCampos BotonFormulario">
            <input type="submit" value="Agregar Reserva">
        </div>
        </form>
    </div>

    <div class="Contenedor-Ofertas">
        <h2>Ofertas de Paquetes</h2>
        <div id="ofertas">
        </div>
    </div>
</main>

<footer>
    <p>Agencia de Viajes para Viajar Mucho Mucho pero Mucho</p>
</footer>

<script src="scripts.js"></script>
<div id="ContNotifi"></div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let notificaciones = <?php echo $notificacionesJson; ?>;
        notificaciones.forEach(function(notificacion) {
            alert(notificacion); 
        });
    });
</script> 
</body>
</html>
