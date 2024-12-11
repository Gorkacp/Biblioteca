<?php
// Validación para los formularios

class Validator {

    // Validar nombre de usuario (solo letras y números, mínimo 4 caracteres)
    public static function validarNombreUsuario($nombre_usuario) {
        // Solo acepta letras y números, con mínimo 4 caracteres
        return preg_match('/^[a-zA-Z0-9]{4,}$/', $nombre_usuario);
    }    

    // Validar teléfono
    public static function validarTelefono($telefono) {
        // Validación de formato de teléfono (solo números, longitud entre 9 y 15 caracteres)
        return preg_match('/^\+?[0-9]{9,15}$/', $telefono);
    }

    // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)
    public static function validarContrasena($contrasena) {
        // Contraseña debe tener al menos una letra, un número y longitud mínima de 8 caracteres
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $contrasena);
    }

    // Validar si el campo no está vacío
    public static function validarCampoVacio($campo) {
        return !empty(trim($campo));
    }

    // Validar número de DNI (8 dígitos + letra)
    public static function validarDNI($dni) {
        // Asegurarse de que el DNI no esté vacío antes de validarlo
        return preg_match('/^\d{8}[A-Za-z]$/', $dni);
    }

    // Validar longitud mínima de un campo
    public static function validarLongitudMinima($campo, $longitudMinima) {
        // Verificar si la longitud del campo es mayor o igual a la longitud mínima
        return strlen(trim($campo)) >= $longitudMinima;
    }

    // Validar si el valor es un número entero
    public static function validarNumeroEntero($numero) {
        // Verificar si el número es un entero
        return filter_var($numero, FILTER_VALIDATE_INT) !== false;
    }

    // Validar ISBN debe tener 13 dígitos y ser numérico
    public static function validarISBN($isbn) {
        // Validación de ISBN (13 dígitos numéricos)
        return preg_match('/^\d{13}$/', $isbn);
    }
}
?>
