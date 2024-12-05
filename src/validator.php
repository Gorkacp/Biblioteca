<?php
// Validador para los formularios

class Validator {

    // Validar correo electrónico
    public static function validarEmail($email) {
        // Validación de formato de correo electrónico
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Validar teléfono
    public static function validarTelefono($telefono) {
        // Validación de formato de teléfono (solo números, longitud entre 9 y 15 caracteres)
        return preg_match('/^\+?[0-9]{9,15}$/', $telefono);
    }

    // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)
    public static function validarContrasena($contrasena) {
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $contrasena);
    }

    // Validar si el campo no está vacío
    public static function validarCampoVacio($campo) {
        return !empty(trim($campo));
    }

    // Validar número de DNI (en formato de 8 números y una letra)
    public static function validarDNI($dni) {
        // Expresión regular para validar el formato del DNI español (8 dígitos + letra)
        return preg_match('/^\d{8}[A-Za-z]$/', $dni);
    }

    // Validar que un campo tiene una longitud mínima
    public static function validarLongitudMinima($campo, $longitudMinima) {
        return strlen(trim($campo)) >= $longitudMinima;
    }

    // Validar si el valor es un número entero
    public static function validarNumeroEntero($numero) {
        return filter_var($numero, FILTER_VALIDATE_INT) !== false;
    }

    // Validar ISBN (debe tener 13 dígitos y ser numérico)
    public static function validarISBN($isbn) {
        return preg_match('/^\d{13}$/', $isbn);
    }
}
?>
