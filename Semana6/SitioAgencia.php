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
                <li><a href="SitioAgencia.php">Inicio</a></li>
                <li><a href="#">Vuelos</a></li>
                <li><a href="#">Hoteles</a></li>
                <li><a href="OfertasSemana4.html">Ofertas</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="reservar.php">Reservar</a></li>
                <li><a href="consulta_avanzada.php">Verificar Reservas</a></li>
            </ul>
        </nav>

        <div id="cartIcon">
            🛒 <span id="cartCount">0</span>
        </div>
    </div>
</header>

<main>
<div class="Formulario">
    <h2>Agregar Vuelo</h2>
    <form action="agregar_vuelo.php" method="POST">
        <div class="GrupoCampos">
            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" required>
        </div>
        <div class="GrupoCampos">
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required>
        </div>
        <div class="GrupoCampos">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="GrupoCampos">
            <label for="plazas_disponibles">Plazas Disponibles:</label>
            <input type="number" id="plazas_disponibles" name="plazas_disponibles" required>
        </div>
        <div class="GrupoCampos">
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" required>
        </div>
        <div class="GrupoCampos BotonFormulario">
            <input type="submit" value="Agregar Vuelo">
        </div>
    </form>

    <br><br>

    <h2>Agregar Hotel</h2>
    <form action="agregar_hotel.php" method="POST">
        <div class="GrupoCampos">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="GrupoCampos">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
        </div>
        <div class="GrupoCampos">
            <label for="habitaciones_disponibles">Habitaciones Disponibles:</label>
            <input type="number" id="habitaciones_disponibles" name="habitaciones_disponibles" required>
        </div>
        <div class="GrupoCampos">
            <label for="tarifa_noche">Tarifa por Noche:</label>
            <input type="text" id="tarifa_noche" name="tarifa_noche" required>
        </div>
        <div class="GrupoCampos BotonFormulario">
            <input type="submit" value="Agregar Hotel">
        </div>    </form>
</div>



  
    
    <div class="main">
        <div class="ContSeleccion">
            <label for="SeleccionDestino">🌍 <b>Destino</b></label>
            <select id="SeleccionDestino" onchange="ActualizarInfoPaquete()">
                <option value="">Selecciona un destino</option>
            </select>
            <div id="InfoPaquete">
            </div>
        </div>
        <div id="ContResultados">
        </div>
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
