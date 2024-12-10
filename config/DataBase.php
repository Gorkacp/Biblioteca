<?php
class Database {
    private static $host = 'localhost';  
    private static $dbname = 'biblioteca'; // Nombre de la base de datos
    private static $username = 'root'; // Usuario de base de datos
    private static $password = ''; // Contraseña de base de datos
    private static $pdo;

    // Método estático para obtener la conexión PDO
    public static function getConnection() {
        if (self::$pdo === null) {
            try {
                // Crear la conexión PDO si aún no se ha creado
                self::$pdo = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname,
                    self::$username,
                    self::$password
                );
                // Configurar el modo de errores
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "";  
            } catch (PDOException $e) {
                // Si hay error
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$pdo; // Retorna la instancia de la conexión PDO
    }
}
?>




