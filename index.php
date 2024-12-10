<?php
// Asegúrate de incluir el archivo de configuración y las clases necesarias
require_once 'config/DataBase.php'; // Ajusta la ruta según la ubicación de tu archivo
require_once 'controllers/AuthController.php'; // Asegúrate de incluir el controlador
require_once 'controllers/PréstamoController.php'; // Incluir el controlador de préstamos

// Obtener la conexión PDO usando la clase Database
$pdo = Database::getConnection();

// Inicializar los controladores
$authController = new AuthController($pdo);
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
        $authController->librosAction();  // Acción para libros
        break;
    case 'prestamos':
        $prestamoController->prestamosAction();  // Acción para préstamos
        break;
    case 'addPrestamo':
        $prestamoController->addPrestamoAction();  // Acción para agregar un préstamo
        break;
    case 'usuarios':
        $authController->usuariosAction();  // Acción para usuarios (solo bibliotecarios)
        break;
    default:
        echo "Acción no encontrada"; // Mensaje si la acción no es válida
        break;
}
?>
