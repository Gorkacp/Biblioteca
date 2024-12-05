<?php
// Repositorio para gestionar los libros
class LibroRepository {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los libros
    public function obtenerTodos() {
        $sql = "SELECT * FROM libros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Buscar libros por título o autor
    public function buscar($buscar) {
        $sql = "SELECT * FROM libros WHERE titulo LIKE ? OR autor LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $buscar . '%', '%' . $buscar . '%']);
        return $stmt->fetchAll();
    }

    // Agregar un nuevo libro
    public function agregarLibro($titulo, $autor, $editorial, $isbn, $fecha_publicacion) {
        $sql = "INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titulo, $autor, $editorial, $isbn, $fecha_publicacion]);
    }

    // Obtener un libro por ISBN
    public function obtenerPorIsbn($isbn) {
        $sql = "SELECT * FROM libros WHERE isbn = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$isbn]);
        return $stmt->fetch();
    }
}
?>