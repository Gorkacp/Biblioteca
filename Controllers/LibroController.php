<?php
class LibroController {

    public function indexAction() {
        global $pdo; // Acceder a la conexión PDO global

        try {
            // Llamamos al método obtenerTodos() pasando la conexión
            $libros = Libro::obtenerTodos($pdo);
        } catch (Exception $e) {
            echo "Error al obtener los libros: " . $e->getMessage();
            exit;
        }

        // Incluir la vista para mostrar los libros
        include 'views/libro.php';
    }

    public function agregarAction() {
        global $pdo; // Acceder a la conexión PDO global

        // Verificar si el usuario es bibliotecario
        if ($_SESSION['rol'] !== 'bibliotecario') {
            echo "Acceso denegado. Solo los bibliotecarios pueden agregar libros.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validación de datos
            if (empty($_POST['titulo']) || empty($_POST['autor']) || empty($_POST['isbn'])) {
                echo "Todos los campos son obligatorios.";
                exit;
            }

            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'] ?? null;
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'] ?? null;

            // Crear una nueva instancia del libro
            $libro = new Libro($titulo, $autor, $editorial, $isbn, $fecha_publicacion);

            try {
                if ($libro->agregarLibro($pdo)) { // Si la inserción es exitosa
                    header('Location: index.php'); // Redirigir después de agregar
                    exit;
                } else {
                    echo "Error al agregar el libro.";
                }
            } catch (Exception $e) {
                echo "Error al agregar el libro: " . $e->getMessage();
            }
        }

        // Mostrar el formulario de agregar libro
        include 'views/agregarLibro.php';
    }

    public function verAction() {
        global $pdo; // Acceder a la conexión PDO global

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID del libro no especificado.";
            exit;
        }

        try {
            $libro = Libro::obtenerPorId($pdo, $id);
            if (!$libro) {
                echo "El libro no existe.";
                exit;
            }
        } catch (Exception $e) {
            echo "Error al obtener el libro: " . $e->getMessage();
            exit;
        }

        include 'views/verLibro.php'; // Ver detalles del libro
    }

    public function editarAction() {
        global $pdo; // Acceder a la conexión PDO global

        // Verificar si el usuario es bibliotecario
        if ($_SESSION['rol'] !== 'bibliotecario') {
            echo "Acceso denegado. Solo los bibliotecarios pueden editar libros.";
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID del libro no especificado.";
            exit;
        }

        try {
            $libro = Libro::obtenerPorId($pdo, $id);
            if (!$libro) {
                echo "El libro no existe.";
                exit;
            }
        } catch (Exception $e) {
            echo "Error al obtener el libro: " . $e->getMessage();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validación de datos
            if (empty($_POST['titulo']) || empty($_POST['autor']) || empty($_POST['isbn'])) {
                echo "Todos los campos son obligatorios.";
                exit;
            }

            // Procesar formulario de edición
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'] ?? null;
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'] ?? null;

            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setEditorial($editorial);
            $libro->setIsbn($isbn);
            $libro->setFechaPublicacion($fecha_publicacion);

            try {
                if ($libro->actualizar($pdo)) {
                    header('Location: index.php');
                    exit;
                } else {
                    echo "Error al actualizar el libro.";
                }
            } catch (Exception $e) {
                echo "Error al actualizar el libro: " . $e->getMessage();
            }
        }

        // Mostrar formulario de edición
        include 'views/editarLibro.php';
    }

    public function eliminarAction() {
        global $pdo; // Acceder a la conexión PDO global

        // Verificar si el usuario es bibliotecario
        if ($_SESSION['rol'] !== 'bibliotecario') {
            echo "Acceso denegado. Solo los bibliotecarios pueden eliminar libros.";
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID del libro no especificado.";
            exit;
        }

        try {
            if (Libro::eliminar($pdo, $id)) { // Verificar si la eliminación fue exitosa
                header('Location: index.php');
                exit;
            } else {
                echo "Error al eliminar el libro.";
            }
        } catch (Exception $e) {
            echo "Error al eliminar el libro: " . $e->getMessage();
        }
    }
}
?>
