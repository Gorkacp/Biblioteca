<?php

// Incluir la clase Usuario (asegúrate de que la ruta sea correcta)
require_once __DIR__ . '/../models/Usuario.php';  // Ajusta la ruta según tu estructura de carpetas

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

            if (empty($nombre_usuario) || empty($contrasena) || empty($dni) || empty($rol)) {
                echo "Por favor, complete todos los campos.";
                return;
            }

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
}

