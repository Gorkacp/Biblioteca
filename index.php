<?php
// Asegúrate de incluir el archivo de configuración y las clases necesarias
require_once 'config/DataBase.php'; // Ajusta la ruta según la ubicación de tu archivo
require_once 'controllers/AuthController.php'; // Asegúrate de incluir el controlador
require_once 'controllers/LibroController.php'; // Incluir el controlador de libros
require_once 'controllers/PréstamoController.php'; // Incluir el controlador de préstamos

// Obtener la conexión PDO usando la clase Database
$pdo = Database::getConnection();

// Inicializar los controladores
$authController = new AuthController($pdo);
$libroController = new LibroController();  // Crear una instancia de LibroController
$prestamoController = new PrestamoController($pdo);  // Pasamos $pdo al constructor de PrestamoController

// Verificar qué acción se solicita
$action = isset($_GET['action']) ? $_GET['action'] : 'login'; // Si no se pasa acción, se asume 'login'

// Ejecutar la acción correspondiente
switch ($action) {
    case 'login':
        $authController->loginAction();
        break;
    case 'registrar':
        $authController->registrarAction();
        break;
    case 'logout':
        $authController->logoutAction();
        break;
    case 'layout':
        $authController->layoutAction();
        break;
    case 'libros':
        $libroController->indexAction();  // Acción para listar libros
        break;
    case 'agregar':
        $libroController->agregarAction();  // Acción para agregar un libro
        break;
    case 'addLibro':
        $libroController->agregarAction();  // Acción para agregar un libro
        break;
    case 'editLibro':
        $libroController->editarAction();  // Acción para editar un libro
        break;
    case 'deleteLibro':
        $libroController->eliminarAction();  // Acción para eliminar un libro
        break;
    case 'prestamos':
        $prestamoController->prestamosAction();  // Acción para préstamos
        break;
    case 'addPrestamo':
        $prestamoController->addPrestamoAction();  // Acción para agregar un préstamo
        break;
    case 'editPrestamo':
        $prestamoController->editPrestamoAction();  // Acción para editar un préstamo
        break;
    case 'deletePrestamo':
        $prestamoController->deletePrestamoAction();  // Acción para eliminar un préstamo
        break;
    case 'usuarios':
        $authController->usuariosAction();  // Acción para usuarios (solo bibliotecarios)
        break;
    default:
        echo "Acción no encontrada"; // Mensaje si la acción no es válida
        break;
}
?>
