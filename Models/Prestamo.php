<?php 
class Prestamo {
    public static function obtenerTodos($pdo) {
        // Consulta SQL para obtener todos los préstamos, incluyendo los detalles del libro y el socio
        $sql = "
            SELECT 
                prestamos.*, 
                libros.titulo AS libro, 
                CONCAT(usuarios.nombre, ' ', usuarios.apellido1, ' ', usuarios.apellido2) AS socio
            FROM prestamos
            JOIN libros ON prestamos.ejemplar_id = libros.id
            JOIN socios ON prestamos.socio_id = socios.id
            JOIN usuarios ON socios.usuario_id = usuarios.id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


?>