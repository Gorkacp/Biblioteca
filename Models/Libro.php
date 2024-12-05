<?php
// Clase Libro: Representa los libros en la biblioteca
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $editorial;
    private $isbn;
    private $fecha_publicacion;

    // Constructor de la clase
    public function __construct($titulo, $autor, $editorial, $isbn, $fecha_publicacion, $id = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->isbn = $isbn;
        $this->fecha_publicacion = $fecha_publicacion;
    }

    // Método para obtener todos los libros
    public static function obtenerTodos($pdo) {
        $sql = "SELECT * FROM libros";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Método para obtener un libro por ID
    public static function obtenerPorId($pdo, $id) {
        $sql = "SELECT * FROM libros WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Método para agregar un libro
    public function agregarLibro($pdo) {
        $sql = "INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->titulo, $this->autor, $this->editorial, $this->isbn, $this->fecha_publicacion]);
    }

    // Método para eliminar un libro
    public static function eliminar($pdo, $id) {
        $sql = "DELETE FROM libros WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Método para buscar libros por título o autor
    public static function buscar($pdo, $buscar) {
        $sql = "SELECT * FROM libros WHERE titulo LIKE ? OR autor LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['%' . $buscar . '%', '%' . $buscar . '%']);
        return $stmt->fetchAll();
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getEditorial() {
        return $this->editorial;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }
}
?>
