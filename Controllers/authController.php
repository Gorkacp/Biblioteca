<?php
// Incluir la conexión a la base de datos
require_once 'config/database.php'; // Ajusta la ruta según la ubicación de tu archivo
require_once 'models/Usuario.php'; // Asegúrate de que la clase Usuario está definida en este archivo

class AuthController {

    private $pdo;

    // Constructor que recibe la conexión PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Acción para mostrar la vista de inicio de sesión
    public function loginAction() {
        // Verificar si la sesión ya está activa, y solo iniciar la sesión si no lo está
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Asegúrate de iniciar la sesión solo si no está activa
        }

        // Verificar si el usuario ya está autenticado y redirigir
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /index.php?action=index'); // Redirigir al listado de libros si ya está logueado
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            // Verificar si los campos están vacíos
            if (empty($nombre_usuario) || empty($contrasena)) {
                echo "Por favor, ingrese el nombre de usuario y la contraseña.";
                return;
            }

            // Verificar el usuario en la base de datos
            $usuario = Usuario::autenticar($this->pdo, $nombre_usuario, $contrasena);

            if ($usuario) {
                // Iniciar sesión
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol']; // 'lector' o 'bibliotecario'
                header('Location: /index.php?action=index'); // Redirigir al listado de libros
                exit;
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        }

        // Incluir la vista de inicio de sesión
        include 'views/login.php';
    }

    // Acción para registrar un nuevo usuario
    public function registrarAction() {
        // Verificar si la sesión ya está activa, y si está logueado, redirigir
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['usuario_id'])) {
            header('Location: /index.php?action=index'); // Redirigir si ya está logueado
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar que los campos no estén vacíos
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];
            $dni = $_POST['dni'];
            $rol = $_POST['rol'];  // Obtener el rol seleccionado en el formulario

            if (empty($nombre_usuario) || empty($contrasena) || empty($dni) || empty($rol)) {
                echo "Por favor, complete todos los campos.";
                return;
            }

            // Hashear la contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

            // Crear el objeto usuario
            $usuario = new Usuario($dni, $nombre_usuario, $contrasena_hash, $rol);

            // Registrar al nuevo usuario
            if ($usuario->registrar($this->pdo)) {
                header('Location: /index.php?action=login'); // Redirigir a la vista de login después de registrarse
                exit;
            } else {
                echo "El nombre de usuario ya está registrado.";
            }
        }

        // Incluir la vista de registro
        include 'views/registro.php';
    }

    // Acción para cerrar sesión
    public function logoutAction() {
        // Verificar si la sesión ya está activa, y solo destruirla si está activa
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy(); // Destruir la sesión
        }
        header('Location: /index.php?action=login'); // Redirigir a la vista de login
        exit;
    }
}
?>
