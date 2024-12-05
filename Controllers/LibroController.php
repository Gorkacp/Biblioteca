<?php
// Controlador para gestionar los libros.
class LibroController {
    public function indexAction() {
        global $pdo;  // Usamos la conexión global de la base de datos

        // Llamamos al método obtenerTodos() pasando la conexión
        $libros = Libro::obtenerTodos($pdo);  // Aquí pasamos correctamente el parámetro $pdo

        // Incluir la vista y pasar los datos de los libros
        include 'views/libro.php';  // Ajusta la ruta de la vista según tu estructura
    }

    public function editarAction() {
        // Lógica para editar un libro
        echo "Editar un libro";
    }
}
?>
