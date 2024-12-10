<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Prestamo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Agregar Préstamo</h2>
<form method="POST" action="index.php?action=addPrestamo">
    <label for="usuario_id">ID Usuario:</label>
    <input type="text" id="usuario_id" name="usuario_id">
    <br>
    <label for="libro_id">ID Libro:</label>
    <input type="text" id="libro_id" name="libro_id">
    <br>
    <label for="fecha_prestamo">Fecha de Préstamo:</label>
    <input type="date" id="fecha_prestamo" name="fecha_prestamo">
    <br>
    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" id="fecha_devolucion" name="fecha_devolucion">
    <br>
    <button type="submit">Agregar Préstamo</button>
</form>

</body>
</html>