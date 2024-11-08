Create database  proyectog;

use proyectog;

CREATE TABLE Categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255)  
);

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'contador', 'ayudante') NOT NULL, 
    foto_perfil VARCHAR(255)  
);

CREATE TABLE Empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    puesto VARCHAR(100) NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE SET NULL
);

CREATE TABLE Productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    categoria_id INT,
    activo INT,
    imagen VARCHAR(255),  
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id_categoria) ON DELETE CASCADE
);


CREATE TABLE Pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'completado', 'cancelado'),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id) ON DELETE CASCADE
);

CREATE TABLE Detalles_Pedido (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto) ON DELETE CASCADE
);

CREATE TABLE Equipos (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    imagen VARCHAR(255) 
);

CREATE TABLE  Ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id),
    FOREIGN KEY (id_producto) REFERENCES Productos(id)
);


id 
clavedepago VARCHAR(300)
paydate TEXT
fecha DATETIME
correo VARCHAR(500)
total DECIMAL(60.2)
status VARCHAR 

INSERT INTO Categorias (nombre, descripcion, imagen) VALUES
('Laptops', 'Computadoras portátiles de alto rendimiento.', 'imagenes/laptops.jpg'),
('Escritorios', 'Computadoras de escritorio para uso en oficina.', 'imagenes/escritorios.jpg'),
('Periféricos', 'Dispositivos adicionales como teclados y ratones.', 'imagenes/perifericos.jpg'),
('Software', 'Aplicaciones para distintas necesidades.', 'imagenes/software.jpg'),
('Servidores', 'Equipos para gestionar redes y servicios.', 'imagenes/servidores.jpg'),
('Monitores', 'Pantallas de alta definición.', 'imagenes/monitores.jpg'),
('Componentes', 'Partes para ensamblar computadoras.', 'imagenes/componentes.jpg'),
('Redes', 'Equipos y software para redes.', 'imagenes/redes.jpg'),
('Accesorios', 'Complementos para dispositivos electrónicos.', 'imagenes/accesorios.jpg'),
('Gaming', 'Equipos y accesorios para videojuegos.', 'imagenes/gaming.jpg');

INSERT INTO Usuarios (nombre, apellido, correo, contraseña, rol, foto_perfil) VALUES
('Juan', 'Pérez', 'juan.perez@gmail.com', 'hashed_password_1', 'admin', 'imagenes/juan.jpg'),
('María', 'Gómez', 'maria.gomez@gmail.com', 'hashed_password_2', 'contador', 'imagenes/maria.jpg'),
('Carlos', 'López', 'carlos.lopez@gmail.com', 'hashed_password_3', 'ayudante', 'imagenes/carlos.jpg'),
('Ana', 'Martínez', 'ana.martinez@gmail.com', 'hashed_password_4', 'admin', 'imagenes/ana.jpg'),
('Luis', 'Rodríguez', 'luis.rodriguez@gmail.com', 'hashed_password_5', 'contador', 'imagenes/luis.jpg'),
('Sofía', 'Fernández', 'sofia.fernandez@gmail.com', 'hashed_password_6', 'ayudante', 'imagenes/sofia.jpg'),
('Diego', 'Hernández', 'diego.hernandez@gmail.com', 'hashed_password_7', 'admin', 'imagenes/diego.jpg'),
('Lucía', 'Torres', 'lucia.torres@gmail.com', 'hashed_password_8', 'contador', 'imagenes/lucia.jpg'),
('Andrés', 'Ramírez', 'andres.ramirez@gmail.com', 'hashed_password_9', 'ayudante', 'imagenes/andres.jpg'),
('Isabel', 'Díaz', 'isabel.diaz@gmail.com', 'hashed_password_10', 'admin', 'imagenes/isabel.jpg');

INSERT INTO Empleados (nombre, apellido, puesto, usuario_id) VALUES
('Juan', 'Pérez', 'Gerente', 1),
('María', 'Gómez', 'Contadora', 2),
('Carlos', 'López', 'Soporte Técnico', 3),
('Ana', 'Martínez', 'Jefa de Ventas', 4),
('Luis', 'Rodríguez', 'Analista Financiero', 5),
('Sofía', 'Fernández', 'Asistente Administrativa', 6),
('Diego', 'Hernández', 'Gerente de IT', 7),
('Lucía', 'Torres', 'Contadora', 8),
('Andrés', 'Ramírez', 'Técnico de Soporte', 9),
('Isabel', 'Díaz', 'Gerente de Marketing', 10);

INSERT INTO Productos (nombre, descripcion, precio, stock, categoria_id, imagen) VALUES
('Laptop Dell XPS 13', 'Laptop ultradelgada con pantalla 4K.', 1200.00, 10, 1, 'imagenes/dell_xps_13.jpg'),
('Escritorio HP', 'Escritorio de oficina con diseño ergonómico.', 300.00, 5, 2, 'imagenes/escritorios.jpg'),
('Teclado Mecánico', 'Teclado mecánico retroiluminado.', 100.00, 20, 3, 'imagenes/teclado_mecanico.jpg'),
('Windows 10', 'Sistema operativo para computadoras.', 150.00, 50, 4, 'imagenes/windows_10.jpg'),
('Servidor Dell PowerEdge', 'Servidor para empresas de alto rendimiento.', 2500.00, 2, 5, 'imagenes/server_dell.png'),
('Monitor Samsung 27"', 'Monitor Full HD de 27 pulgadas.', 400.00, 15, 6, 'imagenes/monitores.png'),
('Tarjeta Madre ASUS', 'Tarjeta madre para gaming.', 200.00, 30, 7, 'imagenes/tarjeta_madre_asus.png'),
('Router TP-Link', 'Router inalámbrico de alto rendimiento.', 80.00, 25, 8, 'imagenes/router_tp_link.jpg'),
('Mouse Gaming Razer', 'Mouse ergonómico para gamers.', 70.00, 18, 9, 'imagenes/mouse_razer.jpg'),
('Auriculares Bose', 'Auriculares inalámbricos con cancelación de ruido.', 300.00, 12, 10, 'imagenes/auriculares_bose.jpg');

INSERT INTO Pedidos (id_usuario, estado) VALUES
(1, 'pendiente'),
(2, 'completado'),
(3, 'cancelado'),
(4, 'pendiente'),
(5, 'completado'),
(6, 'pendiente'),
(7, 'cancelado'),
(8, 'completado'),
(9, 'pendiente'),
(10, 'completado');

INSERT INTO Equipos (nombre, descripcion, precio, stock, imagen) VALUES
('Laptop Lenovo ThinkPad', 'Laptop robusta y confiable.', 1100.00, 8, 'imagenes/lenovo_thinkpad.jpg'),
('PC Gaming Alienware', 'Computadora de escritorio para gamers.', 2500.00, 3, 'imagenes/alienware_pc.jpg'),
('Impresora HP LaserJet', 'Impresora láser para oficina.', 200.00, 10, 'imagenes/hp_laserjet.jpg'),
('Proyector Epson', 'Proyector de alta definición.', 500.00, 4, 'imagenes/proyector_epson.jpg'),
('Tablet Samsung Galaxy', 'Tablet versátil y potente.', 600.00, 15, 'imagenes/tablet_samsung.jpg'),
('Mochila para Laptop', 'Mochila con compartimentos para laptops.', 50.00, 20, 'imagenes/mochila_laptop.jpg'),
('Almacenamiento Externo Seagate', 'Disco duro externo de 2TB.', 100.00, 30, 'imagenes/disco_externo_seagate.jpg'),
('Webcam Logitech', 'Webcam HD para videoconferencias.', 80.00, 18, 'imagenes/webcam_logitech.jpg'),
('Altavoces JBL', 'Altavoces Bluetooth portátiles.', 120.00, 12, 'imagenes/altavoces_jbl.jpg'),
('Silla Ergonómica', 'Silla para oficina con soporte lumbar.', 150.00, 5, 'imagenes/silla_ergonomica.jpg');