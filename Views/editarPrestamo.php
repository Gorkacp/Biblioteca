<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prestamo</title>
</head>
<body>
<form method="POST" action="index.php?action=editPrestamo">
    <input type="hidden" name="id" value="<?php echo $prestamo['id']; ?>">

    <label for="socio_id">ID del socio:</label>
    <input type="text" id="socio_id" name="socio_id" value="<?php echo $prestamo['socio_id']; ?>" required>

    <label for="ejemplar_id">ID del ejemplar:</label>
    <input type="text" id="ejemplar_id" name="ejemplar_id" value="<?php echo $prestamo['ejemplar_id']; ?>" required>

    <label for="fecha_prestamo">Fecha de préstamo:</label>
    <input type="date" id="fecha_prestamo" name="fecha_prestamo" value="<?php echo $prestamo['fecha_prestamo']; ?>" required>

    <label for="fecha_devolucion">Fecha de devolución:</label>
    <input type="date" id="fecha_devolucion" name="fecha_devolucion" value="<?php echo $prestamo['fecha_devolucion']; ?>" required>

    <button type="submit">Guardar cambios</button>
</form>


    
</body>
</html>