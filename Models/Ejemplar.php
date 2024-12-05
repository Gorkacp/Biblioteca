<?php
// Clase Ejemplar: Representa los ejemplares de los libros en la biblioteca
class Ejemplar {
    private $id;
    private $libro_id;
    private $codigo;
    private $descripcion_estado;

    public function __construct($libro_id, $codigo, $descripcion_estado, $id = null) {
        $this->id = $id;
        $this->libro_id = $libro_id;
        $this->codigo = $codigo;
        $this->descripcion_estado = $descripcion_estado;
    }

    // Método para obtener todos los ejemplares disponibles
    public static function obtenerEjemplaresDisponibles($pdo) {
        $sql = "SELECT * FROM ejemplares WHERE descripcion_estado = 'disponible'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Método para agregar un ejemplar
    public function agregarEjemplar($pdo) {
        $sql = "INSERT INTO ejemplares (libro_id, codigo, descripcion_estado) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->libro_id, $this->codigo, $this->descripcion_estado]);
    }

    // Método para actualizar el estado de un ejemplar
    public function actualizarEstado($pdo, $estado) {
        $sql = "UPDATE ejemplares SET descripcion_estado = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$estado, $this->id]);
    }

    // Método para obtener un ejemplar por su código
    public static function obtenerPorCodigo($pdo, $codigo) {
        $sql = "SELECT * FROM ejemplares WHERE codigo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getLibroId() {
        return $this->libro_id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescripcionEstado() {
        return $this->descripcion_estado;
    }
}
?>