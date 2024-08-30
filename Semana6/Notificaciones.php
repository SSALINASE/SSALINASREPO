<?php
function obtenerOfertasEspeciales() {
    return [
        "Lleva 4 y paga 8 en cualquier producto ¡¡ SOLO POR HOY !!",
        "Reserva tu vuelo antes que se agoten",
        "Sé el piloto de tu viaje"
    ];
}

function mostrarNotificaciones() {
    $ofertas = obtenerOfertasEspeciales();
    foreach ($ofertas as $oferta) {
        echo "<div class='notificacion'>$oferta</div>";
    }
}

mostrarNotificaciones()
;
