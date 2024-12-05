<?php
// prestamos.php - Vista para los préstamos
?>
<h2>Préstamos Actuales</h2>
<table>
    <thead>
        <tr>
            <th>Libro</th>
            <th>Socio</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Devolución</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prestamos as $prestamo): ?>
            <tr>
                <td><?php echo htmlspecialchars($prestamo['libro']); ?></td>
                <td><?php echo htmlspecialchars($prestamo['socio']); ?></td>
                <td><?php echo htmlspecialchars($prestamo['fecha_prestamo']); ?></td>
                <td><?php echo htmlspecialchars($prestamo['fecha_devolucion']); ?></td>
                <td><?php echo htmlspecialchars($prestamo['estado']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/prestamos/nuevo">Añadir nuevo préstamo</a>
