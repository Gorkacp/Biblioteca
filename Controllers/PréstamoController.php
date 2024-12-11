<?php
require_once 'models/Prestamo.php'; 
require_once 'config/DataBase.php';
class PrestamoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // Guardamos la conexión PDO
    }

    // Acción para mostrar los préstamos
    public function prestamosAction() {
        $sql = "SELECT prestamos.*, usuarios.nombre_usuario, libros.titulo
                FROM prestamos
                JOIN usuarios ON prestamos.socio_id = usuarios.id
                JOIN ejemplares ON prestamos.ejemplar_id = ejemplares.id
                JOIN libros ON ejemplares.libro_id = libros.id";
        
        $stmt = $this->pdo->query($sql);
        $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si el usuario está logueado y obtener los datos del usuario
        $usuario = null;
        if (isset($_SESSION['usuario_id'])) {
            $usuario_id = $_SESSION['usuario_id']; // Asumimos que el ID del usuario está guardado en la sesión
            $sqlUsuario = "SELECT * FROM usuarios WHERE id = :usuario_id";
            $stmtUsuario = $this->pdo->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':usuario_id', $usuario_id);
            $stmtUsuario->execute();
            $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
        }

        require 'views/prestamos.php'; //Conexion con prestamos.php
    }

    // Acción para agregar un nuevo préstamo
    public function addPrestamoAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $socio_id = $_POST['socio_id']; 
            $ejemplar_id = $_POST['ejemplar_id']; 
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];
    
            // Validar que los campos no estén vacíos
            if (empty($socio_id) || empty($ejemplar_id) || empty($fecha_prestamo) || empty($fecha_devolucion)) {
                echo "Todos los campos son obligatorios.";
                return;
            }
    
            // Verificar si el ejemplar existe
            $sqlEjemplar = "SELECT id FROM ejemplares WHERE id = :ejemplar_id AND descripcion_estado = 'disponible'";
            $stmtEjemplar = $this->pdo->prepare($sqlEjemplar);
            $stmtEjemplar->bindParam(':ejemplar_id', $ejemplar_id);
            $stmtEjemplar->execute();
            $ejemplar = $stmtEjemplar->fetch(PDO::FETCH_ASSOC);
    
            // Verificar si el socio existe
            $sqlSocio = "SELECT id FROM usuarios WHERE id = :socio_id AND rol = 'lector'";
            $stmtSocio = $this->pdo->prepare($sqlSocio);
            $stmtSocio->bindParam(':socio_id', $socio_id);
            $stmtSocio->execute();
            $socio = $stmtSocio->fetch(PDO::FETCH_ASSOC);
    
            if (!$ejemplar) {
                echo "El ejemplar no está disponible o no existe.";
                return;
            }
    
            if (!$socio) {
                echo "El socio no existe o no tiene el rol de lector.";
                return;
            }
    
            // Si ambos existen, proceder con la inserción del préstamo
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
            require 'views/AñadirPrestamo.php'; // Vista para agregar un préstamo
        }
    }

    public function editPrestamoAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Depurar los datos recibidos
            var_dump($_POST);  // Esto imprimirá todos los datos enviados en el formulario
            
            // Verifica si los campos existen antes de proceder
            if (isset($_POST['socio_id'], $_POST['ejemplar_id'], $_POST['fecha_prestamo'], $_POST['fecha_devolucion'])) {
                $id = $_POST['id'];  // ID del prestamo que se va a editar
                $socio_id = $_POST['socio_id'];
                $ejemplar_id = $_POST['ejemplar_id'];
                $fecha_prestamo = $_POST['fecha_prestamo'];
                $fecha_devolucion = $_POST['fecha_devolucion'];
    
                // Validar si los campos no están vacíos
                if (empty($socio_id) || empty($ejemplar_id) || empty($fecha_prestamo) || empty($fecha_devolucion)) {
                    echo "Todos los campos son obligatorios.";
                    return;
                }
    
                // La consulta para actualizar los datos del préstamo
                $sql = "UPDATE prestamos 
                        SET socio_id = :socio_id, ejemplar_id = :ejemplar_id, fecha_prestamo = :fecha_prestamo, fecha_devolucion = :fecha_devolucion 
                        WHERE id = :id";
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':socio_id', $socio_id);
                $stmt->bindParam(':ejemplar_id', $ejemplar_id);
                $stmt->bindParam(':fecha_prestamo', $fecha_prestamo);
                $stmt->bindParam(':fecha_devolucion', $fecha_devolucion);
                $stmt->bindParam(':id', $id);
    
                if ($stmt->execute()) {
                    echo "Préstamo editado con éxito.";
                    header('Location: index.php?action=prestamos');
                } else {
                    echo "Error al editar el préstamo.";
                }
            } else {
                echo "Faltan campos necesarios.";
            }
        } else {
            // Cargar los datos del préstamo a editar
            $id = $_GET['id']; // Obtener el ID del préstamo que se va a editar
            $sql = "SELECT * FROM prestamos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($prestamo) {
                require 'views/editarPrestamo.php'; // Vista para editar el préstamo
            } else {
                echo "Préstamo no encontrado.";
            }
        }
    }
    
    

    public function deletePrestamoAction() {
        $id = $_GET['id']; // Obtener el ID del préstamo que se va a eliminar
    
        // Verificar si el préstamo existe
        $sql = "SELECT id FROM prestamos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$prestamo) {
            echo "El préstamo no existe.";
            return;
        }
    
        // La consulta para eliminar un préstamo
        $sqlDelete = "DELETE FROM prestamos WHERE id = :id";
        $stmtDelete = $this->pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id);
    
        if ($stmtDelete->execute()) {
            echo "Préstamo eliminado con éxito.";
            header('Location: index.php?action=prestamos');
        } else {
            echo "Error al eliminar el préstamo.";
        }
    }
}
?>
