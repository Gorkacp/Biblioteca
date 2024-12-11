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


INSERT INTO usuarios (dni, nombre_usuario, contrasena, nombre, apellido1, apellido2, direccion, email, telefono, rol) VALUES
('12345678A', 'usuario1', 'contrasena1', 'Juan', 'Pérez', 'García', 'Calle Falsa 123', 'juan.perez@example.com', '612345678', 'lector'),
('23456789B', 'usuario2', 'contrasena2', 'Ana', 'López', 'Martín', 'Avenida Libertad 456', 'ana.lopez@example.com', '623456789', 'bibliotecario'),
('34567890C', 'usuario3', 'contrasena3', 'Pedro', 'González', 'Sánchez', 'Calle del Sol 789', 'pedro.gonzalez@example.com', '634567890', 'lector'),
('45678901D', 'usuario4', 'contrasena4', 'María', 'Ruiz', 'Hernández', 'Calle Mayor 101', 'maria.ruiz@example.com', '645678901', 'lector'),
('56789012E', 'usuario5', 'contrasena5', 'Luis', 'García', 'Fernández', 'Calle del Río 202', 'luis.garcia@example.com', '656789012', 'bibliotecario'),
('67890123F', 'usuario6', 'contrasena6', 'Laura', 'Martínez', 'Pérez', 'Avenida de los Pinos 303', 'laura.martinez@example.com', '667890123', 'lector'),
('78901234G', 'usuario7', 'contrasena7', 'Carlos', 'Fernández', 'Gómez', 'Calle de la Luna 404', 'carlos.fernandez@example.com', '678901234', 'lector'),
('89012345H', 'usuario8', 'contrasena8', 'Sofia', 'Jiménez', 'Moreno', 'Calle del Mar 505', 'sofia.jimenez@example.com', '689012345', 'bibliotecario'),
('90123456I', 'usuario9', 'contrasena9', 'Javier', 'Sánchez', 'Alvarez', 'Calle de la Estrella 606', 'javier.sanchez@example.com', '690123456', 'lector'),
('11223344J', 'usuario10', 'contrasena10', 'Marta', 'Vázquez', 'Dominguez', 'Calle del Sol 707', 'marta.vazquez@example.com', '701234567', 'bibliotecario');


INSERT INTO libros (titulo, autor, editorial, isbn, fecha_publicacion) VALUES
('El Quijote', 'Miguel de Cervantes', 'Editorial A', '978-3-16-148410-0', '1605-01-01'),
('Cien años de soledad', 'Gabriel García Márquez', 'Editorial B', '978-3-16-148411-7', '1967-06-05'),
('La sombra del viento', 'Carlos Ruiz Zafón', 'Editorial C', '978-3-16-148412-4', '2001-10-23'),
('El código Da Vinci', 'Dan Brown', 'Editorial D', '978-3-16-148413-1', '2003-03-18'),
('Harry Potter y la piedra filosofal', 'J.K. Rowling', 'Editorial E', '978-3-16-148414-8', '1997-06-26'),
('1984', 'George Orwell', 'Editorial F', '978-3-16-148415-5', '1949-06-08'),
('El alquimista', 'Paulo Coelho', 'Editorial G', '978-3-16-148416-2', '1988-11-11'),
('La chica del tren', 'Paula Hawkins', 'Editorial H', '978-3-16-148417-9', '2015-01-13'),
('Los pilares de la tierra', 'Ken Follett', 'Editorial I', '978-3-16-148418-6', '1989-09-01'),
('El gran Gatsby', 'F. Scott Fitzgerald', 'Editorial J', '978-3-16-148419-3', '1925-04-10');


INSERT INTO ejemplares (libro_id, codigo, descripcion_estado) VALUES
(1, 'COD123', 'disponible'),
(2, 'COD124', 'prestado'),
(3, 'COD125', 'disponible'),
(4, 'COD126', 'reservado'),
(5, 'COD127', 'dañado'),
(6, 'COD128', 'disponible'),
(7, 'COD129', 'prestado'),
(8, 'COD130', 'reservado'),
(9, 'COD131', 'disponible'),
(10, 'COD132', 'dañado');


INSERT INTO prestamos (ejemplar_id, socio_id, fecha_prestamo, fecha_devolucion, estado) VALUES
(1, 1, '2024-12-01', '2024-12-21', 'activo'),
(2, 2, '2024-12-02', '2024-12-22', 'activo'),
(3, 3, '2024-12-03', '2024-12-23', 'devuelto'),
(4, 4, '2024-12-04', '2024-12-24', 'retrasado'),
(5, 5, '2024-12-05', '2024-12-25', 'activo'),
(6, 6, '2024-12-06', '2024-12-26', 'devuelto'),
(7, 7, '2024-12-07', '2024-12-27', 'retrasado'),
(8, 8, '2024-12-08', '2024-12-28', 'activo'),
(9, 9, '2024-12-09', '2024-12-29', 'penalizado'),
(10, 10, '2024-12-10', '2024-12-30', 'activo');


INSERT INTO socios (usuario_id, numero_socio, dni_confirmado, penalizado) VALUES
(1, 'S12345', TRUE, FALSE),
(2, 'S12346', FALSE, FALSE),
(3, 'S12347', TRUE, FALSE),
(4, 'S12348', TRUE, TRUE),
(5, 'S12349', FALSE, FALSE),
(6, 'S12350', TRUE, FALSE),
(7, 'S12351', TRUE, TRUE),
(8, 'S12352', FALSE, FALSE),
(9, 'S12353', TRUE, FALSE),
(10, 'S12354', TRUE, FALSE);


INSERT INTO devoluciones (prestamo_id, fecha_devolucion) VALUES
(1, '2024-12-21'),
(2, '2024-12-22'),
(3, '2024-12-23'),
(4, '2024-12-24'),
(5, '2024-12-25'),
(6, '2024-12-26'),
(7, '2024-12-27'),
(8, '2024-12-28'),
(9, '2024-12-29'),
(10, '2024-12-30');




-- Consultar los ejemplares disponibles
SELECT * FROM ejemplares WHERE descripcion_estado = 'disponible';

-- Consultar los préstamos activos
SELECT * FROM prestamos WHERE estado = 'activo';
SELECT * FROM usuarios;
DESCRIBE  usuarios;
SELECT * FROM prestamos WHERE estado = 'activo'