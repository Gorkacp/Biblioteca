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
    // Puedes agregar más condiciones para otras carpetas si es necesario
    else {
        echo "Clase $class no encontrada.";
    }
}

spl_autoload_register('autoload');
?>

