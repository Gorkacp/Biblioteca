<?php
// Función para calcular la fecha de devolución
function calcularFechaDevolucion($fecha_prestamo) {
    return date('Y-m-d', strtotime($fecha_prestamo . ' + 20 days'));
}

// Función para validar el DNI
function validarDNI($dni) {
    return true;
}
?>