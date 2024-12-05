<?php
class LibroController {
    public function indexAction() {
        global $pdo; // Acceder a la conexión PDO global

        // Llamamos al método obtenerTodos() pasando la conexión
        $libros = Libro::obtenerTodos($pdo);

        // Incluir la vista para mostrar los libros
        include 'views/libro.php';
    }

    public function agregarAction() {
        global $pdo; // Acceder a la conexión PDO global

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar formulario para agregar libro
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
            
            // Crear una nueva instancia del libro
            $libro = new Libro($titulo, $autor, $editorial, $isbn, $fecha_publicacion);
            $libro->agregarLibro($pdo); // Agregar el libro a la base de datos
            header('Location: index.php'); // Redirigir después de agregar
            exit;
        }
        
        // Mostrar el formulario de agregar libro
        include 'views/agregarLibro.php';
    }

    public function verAction() {
        global $pdo; // Acceder a la conexión PDO global
        $id = $_GET['id'];
        $libro = Libro::obtenerPorId($pdo, $id);
        include 'views/verLibro.php'; // Ver detalles del libro
    }

    public function editarAction() {
        global $pdo; // Acceder a la conexión PDO global
        $id = $_GET['id'];
        $libro = Libro::obtenerPorId($pdo, $id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar formulario de edición
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
            
            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setEditorial($editorial);
            $libro->setIsbn($isbn);
            $libro->setFechaPublicacion($fecha_publicacion);
            $libro->actualizar($pdo); // Actualizar el libro en la base de datos
            
            header('Location: index.php');
            exit;
        }
        
        // Mostrar formulario de edición
        include 'views/editarLibro.php';
    }

    public function eliminarAction() {
        global $pdo; // Acceder a la conexión PDO global
        $id = $_GET['id'];
        Libro::eliminar($pdo, $id); // Eliminar el libro
        header('Location: index.php');
        exit;
    }

    
}


?>
