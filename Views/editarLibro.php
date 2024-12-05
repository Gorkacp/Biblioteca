<h2>Editar libro</h2>
<form method="POST" action="index.php?action=editar&id=<?php echo $libro['id']; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>" required>
    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" value="<?php echo $libro['autor']; ?>" required>
    <label for="editorial">Editorial:</label>
    <input type="text" id="editorial" name="editorial" value="<?php echo $libro['editorial']; ?>" required>
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="<?php echo $libro['isbn']; ?>" required>
    <label for="fecha_publicacion">Fecha de Publicación:</label>
    <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo $libro['fecha_publicacion']; ?>" required>
    <button type="submit">Guardar cambios</button>
</form>
