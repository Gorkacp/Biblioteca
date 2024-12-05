<?php
// Repositorio para gestionar los usuarios
class UsuarioRepository {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Obtener un usuario por nombre de usuario
    public function obtenerPorNombreUsuario($nombre_usuario) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        return $stmt->fetch();
    }

    // Verificar si existe un usuario
    public function verificarUsuario($nombre_usuario) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        return $stmt->fetch();
    }

    // Registrar un nuevo usuario
    public function registrarUsuario($dni, $nombre_usuario, $contrasena, $rol) {
        $sql = "INSERT INTO usuarios (dni, nombre_usuario, contrasena, rol) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dni, $nombre_usuario, password_hash($contrasena, PASSWORD_DEFAULT), $rol]);
    }
    
    // Autenticar un usuario
    public function autenticarUsuario($nombre_usuario, $contrasena) {
        $usuario = $this->obtenerPorNombreUsuario($nombre_usuario);
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
        return null;
    }
}
?>