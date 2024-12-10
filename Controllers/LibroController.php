<?php
// controllers/LibroController.php
require_once 'models/Libro.php';
require_once 'config/DataBase.php';

class LibroController {

    private $pdo;

    public function __construct() {
        $this->pdo = DataBase::getConnection();  // Obtener la conexión a la base de datos
    }

    public function indexAction() {
        $libros = Libro::obtenerTodos($this->pdo);  // Llamar al método con la conexión
        include 'views/libro.php';  // Incluir la vista para mostrar los libros
    }

    public function agregarAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
            
            $libro = new Libro($titulo, $autor, $editorial, $isbn, $fecha_publicacion);
            $libro->agregarLibro($this->pdo);  // Llamar al método de agregar libro
            header('Location: index.php');
            exit;
        }
        
        include 'views/agregarLibro.php';  // Incluir el formulario de agregar libro
    }

    public function verAction() {
        $id = $_GET['id'];  // Recuperar el parámetro 'id' de la URL
        $libro = Libro::obtenerPorId($this->pdo, $id);  // Obtener el libro por su ID
        include 'views/verLibro.php';  // Mostrar la vista de detalle
    }

    public function editarAction() {
        // Obtener el ID del libro desde la URL
        $id = isset($_GET['id']) ? $_GET['id'] : null;
    
        // Si no se proporciona un ID, redirigir a la lista de libros
        if (!$id) {
            header('Location: index.php?action=libros');
            exit;
        }
    
        // Obtener el libro desde la base de datos
        $libro = Libro::obtenerPorId($this->pdo, $id);
    
        // Si no se encuentra el libro, mostrar un error
        if (!$libro) {
            echo "El libro no fue encontrado.";
            exit;
        }
    
        // Si el formulario es enviado por POST, actualizar el libro
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los nuevos valores del formulario
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
    
            // Actualizar los datos del libro
            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setEditorial($editorial);
            $libro->setIsbn($isbn);
            $libro->setFechaPublicacion($fecha_publicacion);
    
            // Guardar los cambios en la base de datos
            $libro->actualizar($this->pdo);
    
            // Redirigir a la lista de libros después de actualizar
            header('Location: index.php?action=libros');
            exit;
        }
    
        // Incluir la vista de editar libro
        include 'views/editarLibro.php';
    }

    public function eliminarAction() {
        $id = $_GET['id'];
        Libro::eliminar($this->pdo, $id);  // Eliminar el libro
        header('Location: index.php');
        exit;
    }
}

?>
 