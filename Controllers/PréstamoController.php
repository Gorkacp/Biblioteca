<?php 
# Controlador para gestionar los préstamos.
require_once 'config/DataBase.php';

class PrestamoController {
    public function prestarLibro($ejemplar_id, $socio_id) {
        global $pdo;
        $fecha_prestamo = date('Y-m-d');
        $fecha_devolucion = date('Y-m-d', strtotime("+20 days"));
        $sql = "INSERT INTO prestamos (ejemplar_id, socio_id, fecha_prestamo, fecha_devolucion) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$ejemplar_id, $socio_id, $fecha_prestamo, $fecha_devolucion]);
    }

    public function devolverLibro($prestamo_id) {
        global $pdo;
        $fecha_devolucion = date('Y-m-d');
        $sql = "UPDATE prestamos SET estado = 'devuelto' WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$prestamo_id]);

        // Registrar la devolución
        $sql = "INSERT INTO devoluciones (prestamo_id, fecha_devolucion) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$prestamo_id, $fecha_devolucion]);
    }

    public function mostrarPrestamosActivos() {
        global $pdo;
        $sql = "SELECT * FROM prestamos WHERE estado = 'activo'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function mostrarPrestamosRetrasados() {
        global $pdo;
        $sql = "SELECT * FROM prestamos WHERE estado = 'retrasado'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>