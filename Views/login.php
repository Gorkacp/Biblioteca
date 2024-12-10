<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Asegúrate de que la ruta al CSS sea correcta -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <!-- Asegúrate de que la acción esté correctamente configurada -->
        <form action="index.php?action=login" method="POST">
            <label for="nombre_usuario">Nombre de usuario</label>
            <input type="text" name="nombre_usuario" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Iniciar sesión</button>
        </form>

        <p>¿No tienes cuenta? <a href="index.php?action=registrar">Regístrate aquí</a></p>
    </div>
</body>
</html>
