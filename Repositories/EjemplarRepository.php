<?php
// Repositorio para gestionar los ejemplares
class EjemplarRepository {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los ejemplares disponibles
    public function obtenerEjemplaresDisponibles() {
        $sql = "SELECT * FROM ejemplares WHERE descripcion_estado = 'disponible'";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Obtener ejemplar por código
    public function obtenerPorCodigo($codigo) {
        $sql = "SELECT * FROM ejemplares WHERE codigo = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    // Agregar un nuevo ejemplar
    public function agregarEjemplar($libro_id, $codigo, $descripcion_estado) {
        $sql = "INSERT INTO ejemplares (libro_id, codigo, descripcion_estado) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$libro_id, $codigo, $descripcion_estado]);
    }

    // Actualizar el estado de un ejemplar
    public function actualizarEstado($id, $estado) {
        $sql = "UPDATE ejemplares SET descripcion_estado = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $id]);
    }
}
?>