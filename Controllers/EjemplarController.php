<?php
require_once 'models/Ejemplar.php'; // Asegúrate de que la clase Ejemplar esté incluida
require_once 'config/DataBase.php';

class EjemplarController {

    // Método para mostrar los ejemplares disponibles
    public function listarEjemplares() {
        // Verificar si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();  // Iniciar la sesión si no está activa
        }

        // Obtener el rol del usuario (asumimos que está en la sesión o puedes modificarlo según tu lógica)
        $rol = isset($_SESSION['usuario']['rol']) ? $_SESSION['usuario']['rol'] : 'lector';

        // Crear la conexión a la base de datos
        $pdo = DataBase::getConnection();  // Asegúrate de que DataBase::getConnection() devuelve el objeto PDO correctamente

        // Obtener los ejemplares dependiendo del rol (lector o bibliotecario)
        $ejemplares = Ejemplar::obtenerEjemplaresPorRol($pdo, $rol);

        // Incluir la vista donde se mostrarán los ejemplares
        include 'views/AñadirPrestamo.php'; 
    }
}
?>
