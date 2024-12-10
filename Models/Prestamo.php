<?php 
class Prestamo {
    // Aquí va la conexión a la base de datos, por ejemplo $pdo

    public static function obtenerTodos($pdo) {
        // Consulta SQL para obtener todos los préstamos
        $sql = "SELECT * FROM prestamos";  // Ajusta según tu estructura de base de datos

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Obtener todos los registros de la consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>