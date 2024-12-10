<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
</head>
<body>
<h2>Lista de Préstamos</h2>
<table>
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Libro</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Devolución</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prestamos as $prestamo): ?>
            <tr>
                <!-- Mostrar el nombre del usuario (nombre_usuario) -->
                <td><?php echo htmlspecialchars($prestamo['nombre_usuario']); ?></td>
                
                <!-- Mostrar el título del libro (titulo) -->
                <td><?php echo htmlspecialchars($prestamo['titulo']); ?></td>
                
                <!-- Mostrar las fechas del préstamo y devolución -->
                <td><?php echo htmlspecialchars($prestamo['fecha_prestamo']); ?></td>
                <td><?php echo htmlspecialchars($prestamo['fecha_devolucion']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    
</body>
</html>



