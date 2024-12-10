<!-- editarLibro.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h2>Editar libro</h2>
    <form method="POST" action="index.php?action=editar&id=<?php echo $libro->getId(); ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($libro->getTitulo()); ?>" required>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($libro->getAutor()); ?>" required>

    <label for="editorial">Editorial:</label>
    <input type="text" id="editorial" name="editorial" value="<?php echo htmlspecialchars($libro->getEditorial()); ?>" required>

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($libro->getIsbn()); ?>" required>

    <label for="fecha_publicacion">Fecha de Publicación:</label>
    <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo htmlspecialchars($libro->getFechaPublicacion()); ?>" required>

    <button type="submit">Guardar cambios</button>
</form>
</body>
</html>

