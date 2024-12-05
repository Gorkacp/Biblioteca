<?php
// Conexión a la base de datos
require 'config/DataBase.php';  // Asegúrate de que el archivo de conexión está incluido correctamente

// Incluir autoload
require 'Lib/autoload.php';

// Incluir el controlador
$controller = new LibroController();

// Llamar al método adecuado
$controller->indexAction();  // Esto debería mostrar todos los libros
?>
