<?php
// Clase Usuario: Representa a los usuarios de la biblioteca
class Usuario {
    private $id;
    private $dni;
    private $nombre_usuario;
    private $contrasena;
    private $rol;

    public function __construct($dni, $nombre_usuario, $contrasena, $rol, $id = null) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre_usuario = $nombre_usuario;
        $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT); // Cifra la contraseña
        $this->rol = $rol;
    }

    // Método para registrar un nuevo usuario
    public function registrar($pdo) {
        $sql = "INSERT INTO usuarios (dni, nombre_usuario, contrasena, rol) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->dni, $this->nombre_usuario, $this->contrasena, $this->rol]);
    }

    // Método para verificar la existencia de un usuario
    public static function verificarUsuario($pdo, $nombre_usuario) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        return $stmt->fetch();
    }

    // Método para autenticar al usuario
    public static function autenticar($pdo, $nombre_usuario, $contrasena) {
        $usuario = self::verificarUsuario($pdo, $nombre_usuario);
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
        return null;
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    public function getRol() {
        return $this->rol;
    }
}
?>