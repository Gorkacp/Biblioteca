<?php
// Incluir archivo de configuración para la base de datos
require_once 'config/DataBase.php'; // Asegúrate de que la ruta sea correcta

// Incluir el controlador y otros archivos necesarios
require_once 'controllers/LibroController.php';
require_once 'models/Libro.php';

// Lógica para manejar las acciones
$action = $_GET['action'] ?? 'index'; // Acción por defecto es 'index'

switch ($action) {
    case 'index':
        $controller = new LibroController();
        $controller->indexAction(); // Mostrar todos los libros
        break;

    case 'agregar':
        $controller = new LibroController();
        $controller->agregarAction(); // Acción para agregar un nuevo libro
        break;

    case 'ver':
        $controller = new LibroController();
        $controller->verAction(); // Acción para ver los detalles de un libro
        break;

    case 'editar':
        $controller = new LibroController();
        $controller->editarAction(); // Acción para editar un libro
        break;

    case 'eliminar':
        $controller = new LibroController();
        $controller->eliminarAction(); // Acción para eliminar un libro
        break;

    default:
        echo "Acción no encontrada.";
        break;
}
?>
