<?php
// Funciones comunes para el proyecto

// Función para calcular la fecha de devolución
function calcularFechaDevolucion($fecha_prestamo) {
    return date('Y-m-d', strtotime($fecha_prestamo . ' + 20 days'));
}

// Función para validar el DNI
function validarDNI($dni) {
    // Implementar validación de DNI aquí
    return true;
}
?>