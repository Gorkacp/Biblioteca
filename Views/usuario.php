<?php
// usuario.php - Vista para gestionar los usuarios
?>
<h2>Gestión de Usuarios</h2>
<table>
    <thead>
        <tr>
            <th>Nombre de Usuario</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                <td>
                    <a href="/usuarios/ver/<?php echo $usuario['id']; ?>">Ver</a>
                    <a href="/usuarios/editar/<?php echo $usuario['id']; ?>">Editar</a>
                    <a href="/usuarios/eliminar/<?php echo $usuario['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/usuarios/nuevo">Añadir nuevo usuario</a>
