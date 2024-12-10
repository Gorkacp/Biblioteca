<?php
require_once 'models/Prestamo.php'; // Asegúrate de incluir el modelo de préstamo si lo necesitas

class PrestamoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // Guardamos la conexión PDO
    }

    // Acción para mostrar los préstamos
    public function prestamosAction() {
        // Modificamos la consulta SQL para hacer un JOIN con las tablas necesarias
        $sql = "SELECT prestamos.*, usuarios.nombre_usuario, libros.titulo
                FROM prestamos
                JOIN usuarios ON prestamos.socio_id = usuarios.id
                JOIN ejemplares ON prestamos.ejemplar_id = ejemplares.id
                JOIN libros ON ejemplares.libro_id = libros.id";
        
        $stmt = $this->pdo->query($sql);
        $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require 'views/prestamos.php'; // Asegúrate de tener la vista para mostrar los préstamos
    }

    // Acción para agregar un nuevo préstamo
    public function addPrestamoAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $socio_id = $_POST['socio_id']; // Cambié usuario_id por socio_id según la base de datos
            $ejemplar_id = $_POST['ejemplar_id']; // Cambié libro_id por ejemplar_id según la base de datos
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];

            if (empty($socio_id) || empty($ejemplar_id) || empty($fecha_prestamo) || empty($fecha_devolucion)) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            // La consulta ahora insertará en la tabla prestamos usando socio_id y ejemplar_id
            $sql = "INSERT INTO prestamos (ejemplar_id, socio_id, fecha_prestamo, fecha_devolucion) 
                    VALUES (:ejemplar_id, :socio_id, :fecha_prestamo, :fecha_devolucion)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':ejemplar_id', $ejemplar_id);
            $stmt->bindParam(':socio_id', $socio_id);
            $stmt->bindParam(':fecha_prestamo', $fecha_prestamo);
            $stmt->bindParam(':fecha_devolucion', $fecha_devolucion);

            if ($stmt->execute()) {
                echo "Préstamo agregado con éxito.";
                header('Location: index.php?action=prestamos');
            } else {
                echo "Error al agregar el préstamo.";
            }
        } else {
            require 'views/addPrestamo.php'; // Vista para agregar un préstamo
        }
    }
}
?>
