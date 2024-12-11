<?php
class Ejemplar {
    private $id;
    private $libro_id;
    private $codigo;
    private $descripcion_estado;

    // Constructor
    public function __construct($libro_id, $codigo, $descripcion_estado, $id = null) {
        $this->id = $id;
        $this->libro_id = $libro_id;
        $this->codigo = $codigo;
        $this->descripcion_estado = $descripcion_estado;
    }

    // Método para obtener ejemplares según el rol (lector o bibliotecario)
    public static function obtenerEjemplaresPorRol($pdo, $rol) {
        if ($rol == 'lector') {
            // Obtener ejemplares disponibles para los lectores (sin préstamos activos)
            $sql = "SELECT e.*, l.titulo
                    FROM ejemplares e
                    JOIN libros l ON e.libro_id = l.id
                    WHERE e.descripcion_estado = 'disponible'
                    AND NOT EXISTS (
                        SELECT 1 FROM prestamos p WHERE p.ejemplar_id = e.id AND p.estado = 'activo'
                    )";
        } elseif ($rol == 'bibliotecario') {
            // Obtener todos los ejemplares para los bibliotecarios (incluyendo prestados, reservados, dañados)
            $sql = "SELECT e.*, l.titulo
                    FROM ejemplares e
                    JOIN libros l ON e.libro_id = l.id
                    WHERE e.descripcion_estado IN ('disponible', 'prestado', 'reservado', 'dañado')";
        } else {
            // Si el rol no es válido, devolver un array vacío.
            return [];
        }

        // Preparar y ejecutar la consulta con parámetros
        $stmt = $pdo->prepare($sql);
        $stmt->execute();  // Ejecutar la consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retornar todos los resultados como un array asociativo
    }

    // Método para obtener un ejemplar por su ID
    public static function obtenerPorId($pdo, $id) {
        $sql = "SELECT * FROM ejemplares WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);  // Asegúrate de pasar el ID como parámetro
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Asegúrate de que obtienes un solo resultado
    }
}

?>

