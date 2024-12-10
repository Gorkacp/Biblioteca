<!-- registro.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar cuenta</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="register-container">
        <h2>Registrar cuenta</h2>
        <form action="index.php?action=registrar" method="POST">
            <label for="nombre_usuario">Nombre de usuario</label>
            <input type="text" name="nombre_usuario" required>

            <label for="dni">DNI</label>
            <input type="text" name="dni" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" required>

            <!-- Campo para seleccionar el rol -->
            <label for="rol">Rol</label>
            <select name="rol" required>
                <option value="lector">Lector</option>
                <option value="bibliotecario">Bibliotecario</option>
            </select>

            <button type="submit">Registrar</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="index.php?action=login">Inicia sesión aquí</a></p>
    </div>
</body>
</html>


