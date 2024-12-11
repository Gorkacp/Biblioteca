<?php
// Las rutas necesarias
require_once 'config/DataBase.php'; 
require_once 'controllers/AuthController.php'; 
require_once 'controllers/LibroController.php'; 
require_once 'controllers/PréstamoController.php'; 
require_once 'controllers/EjemplarController.php';
require_once 'src/validator.php';


// Obtener la conexión PDO usando la clase Database
$pdo = Database::getConnection();

// Inicializar los controladores
$authController = new AuthController($pdo);
$libroController = new LibroController();  // Crear una instancia de LibroController
$prestamoController = new PrestamoController($pdo);  // Pasamos $pdo al constructor de PrestamoController
$ejemplarController = new EjemplarController($pdo);   // Crear una instancia de EjemplarController
// Verificar qué acción se solicita
$action = isset($_GET['action']) ? $_GET['action'] : 'login'; // Si no se pasa acción, se asume 'login'

// Ejecutar la acción correspondiente
switch ($action) {
    case 'login':
        $authController->loginAction();// Acción para listar logueo
        break;
    case 'registrar':
        $authController->registrarAction(); // Acción para listar registro.php
        break;
    case 'logout':
        $authController->logoutAction();// Acción para logins
        break;
    case 'layout':
        $authController->layoutAction();// Acción para layout
        break;
    case 'libros':
        $libroController->indexAction(); // Acción para listar libros
        break;
    case 'agregar':
        $libroController->agregarAction(); // Acción para agregar un libro
        break;
    case 'addLibro':
        $libroController->agregarAction(); // Acción para agregar un libro
        break;
    case 'editLibro':
        $libroController->editarAction();// Acción para editar un libro
        break;
    case 'editar':
        $libroController->editarAction();// Acción para editar un libro
        break;
    case 'deleteLibro':
        $libroController->eliminarAction(); // Acción para eliminar un libro
        break;
    case 'prestamos':
        $prestamoController->prestamosAction();// Acción para préstamos
        break;
    case 'addPrestamo':
        $prestamoController->addPrestamoAction();// Acción para agregar un préstamo
        break;
    case 'editPrestamo':
        $prestamoController->editPrestamoAction();// Acción para editar un préstamo
        break;
    case 'deletePrestamo':
        $prestamoController->deletePrestamoAction();// Acción para eliminar un préstamo
        break;
    case 'ejemplares':
        $ejemplarController->listarEjemplares($pdo, 'bibliotecario'); // Acción para listar ejemplares
        break;
    case 'usuarios':
        $authController->usuariosAction();// Acción para usuarios (solo bibliotecarios)
        break;
    default:
        echo "Acción no encontrada";// Mensaje si la acción no es válida
        break;
}


?>