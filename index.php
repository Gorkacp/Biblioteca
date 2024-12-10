<?php
// index.php
require_once 'controllers/AuthController.php';
require_once 'config/database.php';

$pdo = Database::getConnection();
$authController = new AuthController($pdo);

// Obtener la acción desde la URL
$action = $_GET['action'] ?? 'login'; // Acción por defecto

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
    default:
        $authController->loginAction(); // Acción por defecto si no se especifica
}
?>



