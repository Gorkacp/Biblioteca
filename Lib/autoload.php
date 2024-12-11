<?php
function autoload($class) {
    // Cargar los modelos desde la carpeta Models
    if (file_exists('Models/' . $class . '.php')) {
        include 'Models/' . $class . '.php';
    }
    // Cargar los controladores desde la carpeta Controllers
    elseif (file_exists('Controllers/' . $class . '.php')) {
        include 'Controllers/' . $class . '.php';
    }
    // Cargar la clase Validator desde la carpeta src
    elseif (file_exists('src/validator.php') && $class == 'Validator') {
        include 'src/validator.php';
    }
    else {
        echo "Clase $class no encontrada."; // Por si no encontramos la clase
    }
}
spl_autoload_register('autoload');
?>

