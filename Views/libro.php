<?php
$isBibliotecario = isset($_SESSION['rol']) && $_SESSION['rol'] === 'bibliotecario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Bienvenido a la Biblioteca</h1>

    <!-- Mostrar el enlace para añadir libro, solo si es bibliotecario -->
    <?php if ($isBibliotecario): ?>
        <p><a href="index.php?action=addLibro" class="btn">Añadir Libro</a></p>
    <?php endif; ?>

    <!-- Mostrar los libros -->
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>ISBN</th>
                <th>Fecha Publicación</th>
                <?php if ($isBibliotecario): ?>
                    <th>Acciones</th> <!-- Solo si es bibliotecario -->
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Aquí deberías obtener los libros desde la base de datos
            // Por ejemplo, si tienes un array $libros
            foreach ($libros as $libro) {
                echo "<tr>
                        <td>{$libro['titulo']}</td>
                        <td>{$libro['autor']}</td>
                        <td>{$libro['editorial']}</td>
                        <td>{$libro['isbn']}</td>
                        <td>{$libro['fecha_publicacion']}</td>";
                
                if ($isBibliotecario) {
                    // Solo si es bibliotecario, mostrar las acciones de editar y eliminar
                    echo "<td>
                            <a href='index.php?action=editLibro&id={$libro['id']}' class='btn'>Editar</a>
                            <a href='index.php?action=deleteLibro&id={$libro['id']}' class='btn'>Eliminar</a>
                          </td>";
                }

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
