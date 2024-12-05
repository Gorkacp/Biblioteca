<?php
// libro.php - Vista para mostrar los libros
?>
<h2>Libros en la Biblioteca</h2>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>ISBN</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                <td><?php echo htmlspecialchars($libro['editorial']); ?></td>
                <td><?php echo htmlspecialchars($libro['isbn']); ?></td>
                <td>
                    <a href="/libros/ver/<?php echo $libro['id']; ?>">Ver</a>
                    <a href="/libros/editar/<?php echo $libro['id']; ?>">Editar</a>
                    <a href="/libros/eliminar/<?php echo $libro['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/libros/nuevo">Añadir nuevo libro</a>
