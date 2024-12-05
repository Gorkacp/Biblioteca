<?php 
// Configuracion para conectar con la BD
define("BD_HOST", "localhost");
define("BD_NAME", "biblioteca");
define("BD_USER", "root");
define("BD_PASS", "");

// Configuramos PDO
try {
    $pdo = new PDO("mysql:host=" . BD_HOST . ";dbname=" . BD_NAME . ";charset=utf8", BD_USER, BD_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Excepcion
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Obtener datos
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
