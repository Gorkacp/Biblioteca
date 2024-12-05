CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(20) NOT NULL UNIQUE,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    apellido1 VARCHAR(100),
    apellido2 VARCHAR(100),
    direccion VARCHAR(255),
    email VARCHAR(100),
    telefono VARCHAR(20),
    rol ENUM('lector', 'bibliotecario') NOT NULL, 
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    editorial VARCHAR(255),
    isbn VARCHAR(20) UNIQUE NOT NULL, -- ISBN único
    fecha_publicacion DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS ejemplares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    codigo VARCHAR(20) UNIQUE NOT NULL,
    descripcion_estado ENUM('disponible', 'prestado', 'reservado', 'dañado') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ejemplar_id INT NOT NULL,
    socio_id INT NOT NULL,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion DATE NOT NULL, -- Se calcula 20 días después de la fecha de préstamo
    estado ENUM('activo', 'devuelto', 'retrasado', 'penalizado') DEFAULT 'activo',
    FOREIGN KEY (ejemplar_id) REFERENCES ejemplares(id),
    FOREIGN KEY (socio_id) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS socios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    numero_socio VARCHAR(20) UNIQUE NOT NULL,
    dni_confirmado BOOLEAN DEFAULT FALSE, -- Para confirmar presencialmente el DNI
    penalizado BOOLEAN DEFAULT FALSE, -- Indica si el socio está penalizado
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS devoluciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prestamo_id INT NOT NULL,
    fecha_devolucion DATE NOT NULL,
    FOREIGN KEY (prestamo_id) REFERENCES prestamos(id)
);
-- Insertar en usuarios
INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol)
VALUES ('12345678A', 'jdoe', 'password_cifrada', 'Juan', 'Doe', 'Martinez', 'Calle Falsa 123', 'jdoe@mail.com', '123456789', 'lector');
-- Insertar en libros
INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion)
VALUES ('El Quijote', 'Miguel de Cervantes', 'Editorial XYZ', '978-3-16-148410-0', '1605-01-01');
-- Insertar en ejemplares
INSERT INTO ejemplares (libro_id, codigo, descripcion_estado)
VALUES (1, 'EQ12345', 'disponible');
-- Insertar en Prestamos
INSERT INTO prestamos (ejemplar_id, socio_id, fecha_prestamo, fecha_devolucion)
VALUES (1, 1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 20 DAY));
-- Insertar en Devoluciones
INSERT INTO devoluciones (prestamo_id, fecha_devolucion)
VALUES (1, CURDATE());


SELECT * FROM ejemplares WHERE descripcion_estado = 'disponible';
SELECT * FROM prestamos WHERE estado = 'activo';