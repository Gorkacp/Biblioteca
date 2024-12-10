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
<form action="index.php?action=addPrestamo" method="POST">
    <label for="socio_id">ID del Socio:</label>
    <input type="text" id="socio_id" name="socio_id" required>

    <label for="ejemplar_id">ID del Ejemplar:</label>
    <input type="text" id="ejemplar_id" name="ejemplar_id" required>

    <label for="fecha_prestamo">Fecha de Préstamo:</label>
    <input type="date" id="fecha_prestamo" name="fecha_prestamo" required>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" id="fecha_devolucion" name="fecha_devolucion" required>

    <button type="submit">Agregar Préstamo</button>
</form>


</body>
</html>