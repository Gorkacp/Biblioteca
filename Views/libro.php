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
                <td><?php echo $libro['titulo']; ?></td>
                <td><?php echo $libro['autor']; ?></td>
                <td><?php echo $libro['editorial']; ?></td>
                <td><?php echo $libro['isbn']; ?></td>
                <td>
                    <a href="index.php?action=ver&id=<?php echo $libro['id']; ?>">Ver</a>
                    <a href="index.php?action=editar&id=<?php echo $libro['id']; ?>">Editar</a>
                    <a href="index.php?action=eliminar&id=<?php echo $libro['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?action=agregar">Añadir nuevo libro</a>
