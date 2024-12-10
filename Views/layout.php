<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="/Biblioteca/public/css/style.css">
</head>
<body>

    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="/Biblioteca/index.php?action=libros">Libros</a></li>
            <li><a href="/Biblioteca/index.php?action=prestamos">Préstamos</a></li>
            <?php if ($_SESSION['rol'] == 'bibliotecario'): ?>
                <li><a href="/Biblioteca/index.php?action=usuarios">Usuarios</a></li>
            <?php endif; ?>
            <li><a href="/Biblioteca/index.php?action=logout">Cerrar sesión</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="contenido">
        <h1>Bienvenido <?php echo $_SESSION['rol'] == 'bibliotecario' ? 'bibliotecario' : 'lector'; ?></h1>
        <p>Bienvenido al sistema de biblioteca</p>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Biblioteca - Todos los derechos reservados.</p>
    </footer>

</body>
</html>



