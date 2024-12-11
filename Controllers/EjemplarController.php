<?php
require_once 'models/Ejemplar.php'; 
require_once 'config/Database.php';

class EjemplarController {
    // Método en EjemplarController para listar los ejemplares según el rol
    public function listarEjemplares($rol) {
        try {
            // Obtener la conexión PDO desde la clase Database
            $pdo = Database::getConnection(); // Cambiar de $this->pdo a Database::getConnection()

            // Consulta según el rol
            if ($rol === 'bibliotecario') {
                // Obtener todos los ejemplares (sin filtrado de estado)
                $stmt = $pdo->prepare("SELECT ejemplares.*, libros.titulo 
                                         FROM ejemplares 
                                         INNER JOIN libros ON ejemplares.libro_id = libros.id");
            } else {
                // Si es lector, solo mostrar ejemplares disponibles
                $stmt = $pdo->prepare("SELECT ejemplares.*, libros.titulo 
                                         FROM ejemplares 
                                         INNER JOIN libros ON ejemplares.libro_id = libros.id 
                                         WHERE ejemplares.descripcion_estado = 'disponible'");
            }

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $ejemplares = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verifica si no hay ejemplares disponibles
            if (empty($ejemplares)) {
                $mensaje = "No hay ejemplares disponibles.";
            } else {
                $mensaje = null;
            }

            // Pasar los ejemplares y el mensaje a la vista
            include __DIR__ . '/../views/AñadirPrestamo.php'; // Incluye la vista

        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}
?>
