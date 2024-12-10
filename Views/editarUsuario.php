<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
<h2>Editar Usuario</h2>
<form action="/usuarios/editar/<?php echo $usuario['id']; ?>" method="POST">
    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($usuario['dni']); ?>" required><br>

    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>

    <label for="rol">Rol:</label>
    <select id="rol" name="rol">
        <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="usuario" <?php echo ($usuario['rol'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
    </select><br>

    <input type="submit" value="Actualizar Usuario">
</form>
    
</body>
</html>