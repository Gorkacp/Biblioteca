<?php 
class Usuario {

    private $dni;
    private $nombre_usuario;
    private $contrasena;
    private $rol;

    public function __construct($dni, $nombre_usuario, $contrasena, $rol) {
        $this->dni = $dni;
        $this->nombre_usuario = $nombre_usuario;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
    }

    public static function autenticar($pdo, $nombre_usuario, $contrasena) {
        // Consulta de autenticación en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario");
        $stmt->execute(['nombre_usuario' => $nombre_usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }

        return false;
    }

    public function registrar($pdo) {
        // Verificar si el nombre de usuario ya está registrado
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = :nombre_usuario");
        $stmt->execute(['nombre_usuario' => $this->nombre_usuario]);

        if ($stmt->rowCount() > 0) {
            return false; // El nombre de usuario ya está registrado
        }

        // Consulta para registrar un nuevo usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (dni, nombre_usuario, contrasena, rol) VALUES (:dni, :nombre_usuario, :contrasena, :rol)");
        if ($stmt->execute([
            'dni' => $this->dni,
            'nombre_usuario' => $this->nombre_usuario,
            'contrasena' => $this->contrasena,
            'rol' => $this->rol
        ])) {
            return true; // Registro exitoso
        } else {
            // Devolver falso si hubo un error al registrar
            return false;
        }
    }

    // Método para obtener todos los usuarios
    public static function obtenerTodos($pdo) {
        // Consulta para obtener todos los usuarios de la base de datos
        $stmt = $pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve un array con todos los usuarios
    }
}



?>
