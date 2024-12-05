<?php 
# Controlador para gestionar los usuarios.
require_once 'config/DataBase.php';

class UsuarioController {
    public function registrarUsuario($dni, $nombre_usuario, $contrasena, $nombre, $apellido1, $apellido2, $direccion, $email, $telefono, $rol) {
        global $pdo;
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
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