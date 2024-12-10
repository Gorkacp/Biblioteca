<?php
// Asegúrate de incluir el archivo de configuración y las clases necesarias
require_once 'config/DataBase.php'; // Ajusta la ruta según la ubicación de tu archivo
require_once 'controllers/AuthController.php'; // Asegúrate de incluir el controlador

// Obtener la conexión PDO usando la clase Database
$pdo = Database::getConnection();

// Inicializar el controlador
$controller = new AuthController($pdo);

// Verificar qué acción se solicita
$action = isset($_GET['action']) ? $_GET['action'] : 'login'; // Si no se pasa acción, se asume 'login'

// Ejecutar la acción correspondiente
switch ($action) {
    case 'login':
        $controller->loginAction();
        break;
    case 'registrar':
        $controller->registrarAction();
        break;
    case 'logout':
        $controller->logoutAction();
        break;
    case 'layout':
        $controller->layoutAction();
        break;
    case 'libros':
        $controller->librosAction();  // Acción para libros
        break;
    case 'prestamos':
        $controller->prestamosAction();  // Acción para préstamos
        break;
    case 'usuarios':
        $controller->usuariosAction();  // Acción para usuarios (solo bibliotecarios)
        break;
    default:
        echo "Acción no encontrada"; // Mensaje si la acción no es válida
        break;
}
?>

