<?php
// layout.php - Layout principal (cabecera, pie de página, etc.)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="/path/to/your/styles.css">
</head>
<body>
    <!-- Cabecera -->
    <header>
        <h1>Biblioteca</h1>
        <nav>
            <ul>
                <li><a href="/libros">Libros</a></li>
                <li><a href="/prestamos">Préstamos</a></li>
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main>
        <?php echo $contenido; ?>
    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Biblioteca - Todos los derechos reservados.</p>
    </footer>
</body>
</html>
