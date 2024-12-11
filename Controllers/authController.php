<?php
require_once __DIR__ . '/../models/Usuario.php';  
require_once __DIR__ . '/../models/Prestamo.php'; 
require_once __DIR__ . '/../models/Libro.php';
require_once __DIR__ . '/../src/validator.php';

class AuthController {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        // Iniciar la sesión si no está activa
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Acción para mostrar la vista de inicio de sesión
    public function loginAction() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /Biblioteca/index.php?action=layout'); // Redirigir si ya está logueado
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            if (empty($nombre_usuario) || empty($contrasena)) {
                echo "Por favor, ingrese el nombre de usuario y la contraseña.";
                return;
            }

            // Verificar el usuario en la base de datos
            $usuario = Usuario::autenticar($this->pdo, $nombre_usuario, $contrasena);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol']; // 'lector' o 'bibliotecario'
                header('Location: /Biblioteca/index.php?action=layout'); // Redirigir al layout después de iniciar sesión
                exit;
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        }

        include __DIR__ . '/../views/login.php';
    }

    // Acción para registrar un nuevo usuario
    public function registrarAction() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /Biblioteca/index.php?action=layout'); // Redirigir si ya está logueado
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];
            $dni = $_POST['dni'];
            $rol = $_POST['rol'];

            // Validaciones de los campos
            if (empty($nombre_usuario) || empty($contrasena) || empty($dni) || empty($rol)) {
                echo "Por favor, complete todos los campos.";
                return;
            }

            // Validar nombre de usuario
            if (!Validator::validarNombreUsuario($nombre_usuario)) {
                echo "El nombre de usuario debe tener al menos 4 caracteres y solo debe contener letras y números.";
                return;
            }

            // Validar contraseña
            if (!Validator::validarContrasena($contrasena)) {
                echo "La contraseña debe tener al menos 8 caracteres, y contener al menos una letra y un número.";
                return;
            }

            // Validar DNI
            if (!Validator::validarDNI($dni)) {
                echo "El DNI debe tener el formato correcto (8 dígitos + letra).";
                return;
            }

            // Validar rol
            if (!in_array($rol, ['lector', 'bibliotecario'])) {
                echo "El rol debe ser 'lector' o 'bibliotecario'.";
                return;
            }

            // Encriptar la contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $usuario = new Usuario($dni, $nombre_usuario, $contrasena_hash, $rol);

            if ($usuario->registrar($this->pdo)) {
                header('Location: /Biblioteca/index.php?action=login'); // Redirigir a la vista de login después de registrarse
                exit;
            } else {
                echo "El nombre de usuario ya está registrado.";
            }
        }

        include __DIR__ . '/../views/registro.php';
    }

    // Acción para cerrar sesión
    public function logoutAction() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header('Location: /Biblioteca/index.php?action=login');
        exit;
    }

    // Acción para mostrar el layout después de iniciar sesión
    public function layoutAction() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /Biblioteca/index.php?action=login');
            exit;
        }

        if ($_SESSION['rol'] == 'bibliotecario') {
            $contenido = 'Bienvenido bibliotecario';
        } else {
            $contenido = 'Bienvenido lector';
        }

        include __DIR__ . '/../views/layout.php';
    }

    public function librosAction() {
        // Obtener la conexión a la base de datos
        $pdo = Database::getConnection();
    
        // Obtener todos los libros
        $libros = Libro::obtenerTodos($pdo);
    
        // Incluir la vista donde se mostrarán los libros
        include 'views/libro.php'; // Asegúrate de que la ruta sea correcta
    }

    // Acción para mostrar la vista de préstamos
    public function prestamosAction() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /Biblioteca/index.php?action=login');
            exit;
        }

        // Obtener los préstamos desde la base de datos
        $prestamos = Prestamo::obtenerTodos($this->pdo);  

        // Si no hay préstamos, puedes inicializar un array vacio
        if (!$prestamos) {
        $prestamos = [];
        }

        // Pasar la variable $prestamos a la vista
        include __DIR__ . '/../views/prestamos.php'; 
    }

    // Dentro del método usuariosAction del controlador AuthController
    public function usuariosAction() {
        // Obtener la lista de usuarios desde el modelo
        $usuarios = Usuario::obtenerTodos($this->pdo);  // Esto debe devolver un array de usuarios
    
        // Pasar la lista de usuarios a la vista
        include 'views/usuario.php';  
    }
}
?>
