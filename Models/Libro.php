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

    public static function obtenerTodos($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM libros");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $resultados;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener todos los libros: " . $e->getMessage());
        }
    }

    // Obtener un libro por su ID
    public static function obtenerPorId($pdo, $id) {
        try {
            $sql = "SELECT * FROM libros WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                // Crear un objeto Libro con los datos obtenidos
                return new Libro($resultado['titulo'], $resultado['autor'], $resultado['editorial'], $resultado['isbn'], $resultado['fecha_publicacion'], $resultado['id']);
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el libro: " . $e->getMessage(), $e->getCode());
        }
    }
    

    // Agregar un libro a la base de datos
    public function agregarLibro($pdo) {
        try {
            $sql = "INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$this->titulo, $this->autor, $this->editorial, $this->isbn, $this->fecha_publicacion]);
        } catch (PDOException $e) {
            throw new Exception("Error al agregar el libro: " . $e->getMessage(), $e->getCode());
        }
    }

    // Eliminar un libro por su ID
    public static function eliminar($pdo, $id) {
        try {
            $sql = "DELETE FROM libros WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el libro: " . $e->getMessage(), $e->getCode());
        }
    }

    // Buscar libros por título o autor
    public static function buscar($pdo, $buscar) {
        try {
            $sql = "SELECT * FROM libros WHERE titulo LIKE ? OR autor LIKE ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['%' . $buscar . '%', '%' . $buscar . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar libros: " . $e->getMessage(), $e->getCode());
        }
    }

    public function actualizar($pdo) {
        $sql = "UPDATE libros SET titulo = :titulo, autor = :autor, editorial = :editorial, isbn = :isbn, fecha_publicacion = :fecha_publicacion WHERE id = :id";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':editorial', $this->editorial);
        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':fecha_publicacion', $this->fecha_publicacion);
        $stmt->bindParam(':id', $this->id);
    
        return $stmt->execute();  // Devuelve true si la actualización fue exitosa
    }

    // Getters
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

    // Setters
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setEditorial($editorial) {
        $this->editorial = $editorial;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setFechaPublicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }
}
?>
