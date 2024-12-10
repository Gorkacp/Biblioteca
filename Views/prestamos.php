<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos</title>
</head>
<body>
    <h2>Lista de Préstamos</h2>
    
    <!-- Botón para agregar un nuevo préstamo -->
    <a href="index.php?action=addPrestamo" class="btn">Agregar Préstamo</a>
    
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

                    <?php if ($usuario && $usuario['id'] == $prestamo['socio_id']): ?>
                        <!-- El usuario solo verá su propio préstamo -->
                        <td><a href="index.php?action=editPrestamo&id=<?php echo $prestamo['id']; ?>" class="btn">Editar</a></td>
                        <td><a href="index.php?action=deletePrestamo&id=<?php echo $prestamo['id']; ?>" class="btn">Eliminar</a></td>
                    <?php elseif ($usuario && $usuario['rol'] == 'bibliotecario'): ?>
                        <!-- El bibliotecario podrá ver todos los préstamos y editarlos -->
                        <td><a href="index.php?action=editPrestamo&id=<?php echo $prestamo['id']; ?>" class="btn">Editar</a></td>
                        <td><a href="index.php?action=deletePrestamo&id=<?php echo $prestamo['id']; ?>" class="btn">Eliminar</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
