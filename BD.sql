CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;
DROP DATABASE IF  EXISTS biblioteca;
-- Crear tabla de usuarios
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

-- Crear tabla de libros
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    editorial VARCHAR(255),
    isbn VARCHAR(20) UNIQUE NOT NULL, -- ISBN único
    fecha_publicacion DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla de ejemplares
CREATE TABLE IF NOT EXISTS ejemplares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    codigo VARCHAR(20) UNIQUE NOT NULL,
    descripcion_estado ENUM('disponible', 'prestado', 'reservado', 'dañado') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE CASCADE
);

-- Eliminar tabla de prestamos si existe

-- Crear tabla de prestamos con ON DELETE CASCADE
CREATE TABLE IF NOT EXISTS prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ejemplar_id INT NOT NULL,
    socio_id INT NOT NULL,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion DATE NOT NULL, -- Se calcula 20 días después de la fecha de préstamo
    estado ENUM('activo', 'devuelto', 'retrasado', 'penalizado') DEFAULT 'activo',
    FOREIGN KEY (ejemplar_id) REFERENCES ejemplares(id) ON DELETE CASCADE,  -- Añadir ON DELETE CASCADE
    FOREIGN KEY (socio_id) REFERENCES usuarios(id)
);

-- Crear tabla de socios
CREATE TABLE IF NOT EXISTS socios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    numero_socio VARCHAR(20) UNIQUE NOT NULL,
    dni_confirmado BOOLEAN DEFAULT FALSE, -- Para confirmar presencialmente el DNI
    penalizado BOOLEAN DEFAULT FALSE, -- Indica si el socio está penalizado
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Crear tabla de devoluciones con ON DELETE CASCADE
CREATE TABLE IF NOT EXISTS devoluciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prestamo_id INT NOT NULL,
    fecha_devolucion DATE NOT NULL,
    FOREIGN KEY (prestamo_id) REFERENCES prestamos(id) ON DELETE CASCADE
);


-- Insertar un usuario
INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol)
VALUES ('12345678A', 'jdoe', 'password_cifrada', 'Juan', 'Doe', 'Martinez', 'Calle Falsa 123', 'jdoe@mail.com', '123456789', 'lector');

-- Insertar un libro
INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion)
VALUES ('El Quijote', 'Miguel de Cervantes', 'Editorial XYZ', '978-3-16-148410-0', '1605-01-01');

-- Insertar un ejemplar
INSERT INTO ejemplares (libro_id, codigo, descripcion_estado)
VALUES (1, 'EQ12345', 'disponible');

-- Insertar un préstamo
INSERT INTO prestamos (ejemplar_id, socio_id, fecha_prestamo, fecha_devolucion)
VALUES (1, 1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 20 DAY));

-- Insertar una devolución
INSERT INTO devoluciones (prestamo_id, fecha_devolucion)
VALUES (1, CURDATE());

INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol) 
VALUES ('12345478A', 'usuario_prueba', 'contraseña123', 'Gorka', 'Carmona', 'Pino', 'Calle Ficticia 123', 'gorka.carmona@example.com', '123456789', 'bibliotecario');

INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol) 
VALUES ('12345438A', 'Rober', 'Gato', 'Rober', 'Carmona', 'Pino', 'Calle Ficticia 23', 'rober.carmona@example.com', '123436789', 'bibliotecario');

-- Insertar libros de ejemplo
INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion) VALUES
('Cien Años de Soledad', 'Gabriel García Márquez', 'Editorial XYZ', '9780307474728', '1967-06-05'),
('1984', 'George Orwell', 'Editorial ABC', '9780451524935', '1949-06-08'),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 'Editorial DEF', '9780060934347', '1605-01-16'),
('La Sombra del Viento', 'Carlos Ruiz Zafón', 'Editorial GHI', '9788401331268', '2001-05-04'),
('Harry Potter y la Piedra Filosofal', 'J.K. Rowling', 'Editorial JKL', '9780747532699', '1997-06-26');

-- Insertar ejemplares de los libros anteriormente insertados
INSERT INTO ejemplares (libro_id, codigo, descripcion_estado) VALUES
-- Ejemplares de "Cien Años de Soledad"
(1, 'EA001', 'disponible'),
(1, 'EA002', 'prestado'),
(1, 'EA003', 'disponible'),
(1, 'EA004', 'dañado'),
-- Ejemplares de "1984"
(2, 'EB001', 'disponible'),
(2, 'EB002', 'prestado'),
(2, 'EB003', 'reservado'),
-- Ejemplares de "Don Quijote de la Mancha"
(3, 'EC001', 'disponible'),
(3, 'EC002', 'dañado'),
(3, 'EC003', 'disponible'),
-- Ejemplares de "La Sombra del Viento"
(4, 'ED001', 'prestado'),
(4, 'ED002', 'disponible'),
(4, 'ED003', 'disponible'),
-- Ejemplares de "Harry Potter y la Piedra Filosofal"
(5, 'EE001', 'reservado'),
(5, 'EE002', 'disponible'),
(5, 'EE003', 'prestado');




-- Consultar los ejemplares disponibles
SELECT * FROM ejemplares WHERE descripcion_estado = 'disponible';

-- Consultar los préstamos activos
SELECT * FROM prestamos WHERE estado = 'activo';
SELECT * FROM usuarios;
DESCRIBE  usuarios;
SELECT * FROM prestamos WHERE estado = 'activo'