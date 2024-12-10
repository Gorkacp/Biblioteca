<?php 
# Controlador para gestionar los usuarios.
require_once 'config/DataBase.php';

class UsuarioController {
    public function registrarUsuario($dni, $nombre_usuario, $contrasena, $nombre, $apellido1, $apellido2, $direccion, $email, $telefono, $rol) {
        global $pdo;

        // Verificar que el DNI no esté vacío
        if (empty($dni)) {
            $_SESSION['register_error'] = "El DNI no puede estar vacío.";
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Verificar si el DNI ya está registrado
        $sql = "SELECT * FROM usuarios WHERE dni = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$dni]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $_SESSION['register_error'] = "El DNI ya está registrado.";
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Cifrar la contraseña
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$dni, $nombre_usuario, $contrasena_cifrada, $nombre, $apellido1, $apellido2, $direccion, $email, $telefono, $rol]);
    }

    public function autenticarUsuario($nombre_usuario, $contrasena) {
        global $pdo;
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
        return null;
    }

    public function obtenerUsuarios() {
        global $pdo;
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function obtenerUsuarioPorId($id) {
        global $pdo;
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
