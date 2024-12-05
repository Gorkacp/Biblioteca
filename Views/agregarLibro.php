<h2>Añadir nuevo libro</h2>
<form method="POST" action="index.php?action=agregar">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>
    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" required>
    <label for="editorial">Editorial:</label>
    <input type="text" id="editorial" name="editorial" required>
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" required>
    <label for="fecha_publicacion">Fecha de Publicación:</label>
    <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>
    <button type="submit">Añadir libro</button>
</form>
