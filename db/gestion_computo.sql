Create database  proyectog;

use proyectog;
CREATE TABLE IF NOT EXISTS Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'contador', 'ayudante' , 'cliente') DEFAULT 'cliente',
    foto_perfil VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    puesto VARCHAR(255) NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    categoria_id INT,
    imagen VARCHAR(255),
    descripcion_larga TEXT,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS Clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion TEXT,                  
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    id_usuario INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES Clientes(id_cliente) ON DELETE SET NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (id_producto) REFERENCES Productos(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS Pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    venta_id INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'completado', 'cancelado') NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE SET NULL,
    FOREIGN KEY (venta_id) REFERENCES Ventas(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS Detalles_Pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Productos(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado ENUM('disponible', 'en uso', 'fuera de servicio') NOT NULL,
    Empleados_id INT,
    FOREIGN KEY (Empleados_id) REFERENCES Empleados(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,     
    metodo_pago ENUM('tarjeta', 'paypal') NOT NULL,  
    tipo_tarjeta VARCHAR(50),  
    numero_cuenta VARCHAR(100) NOT NULL, 
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    monto DECIMAL(10, 2) NOT NULL, 
    estado_pago ENUM('completado', 'pendiente', 'fallido') DEFAULT 'pendiente',
    FOREIGN KEY (id_venta) REFERENCES Ventas(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Entregas (
    id_entrega INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,             
    metodo_entrega VARCHAR(100) NOT NULL, 
    fecha_entrega DATE NOT NULL,       
    hora_entrega TIME NOT NULL,        
    tipo_envio VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES Ventas(id) ON DELETE CASCADE
);

INSERT INTO Categorias (nombre, descripcion, imagen) VALUES
('Laptops', 'Portátiles de última generación', 'laptops.jpg'),
('Smartphones', 'Teléfonos inteligentes de diversas marcas', 'smartphones.jpg'),
('Tablets', 'Tabletas de distintas marcas y tamaños', 'tablets.jpg'),
('Accesorios', 'Accesorios tecnológicos como teclados, ratones, etc.', 'accesorios.jpg'),
('Cámaras', 'Cámaras fotográficas y de video', 'camaras.jpg'),
('Audio', 'Auriculares, altavoces, y otros dispositivos de audio', 'audio.jpg');

INSERT INTO Usuarios (nombre, apellido, correo, contraseña, rol, foto_perfil) VALUES
('Ana', 'Lopez', 'ana.lopez@gmail.com', 'password123', 'admin', 'ana.jpg'),
('Carlos', 'Ramirez', 'carlos.ramirez@gmail.com', 'password456', 'contador', 'carlos.jpg'),
('Paola', 'Hernandez', 'paola.hernandez@gmail.com', 'password789', 'ayudante', 'paola.jpg'),
('Luis', 'Mendoza', 'luis.mendoza@gmail.com', 'pass123', 'admin', 'luis.jpg'),
('Elena', 'Garcia', 'elena.garcia@gmail.com', 'securepassword', 'contador', 'elena.jpg'),
('Javier', 'Diaz', 'javier.diaz@gmail.com', 'javier123', 'ayudante', 'javier.jpg');

INSERT INTO Empleados (nombre, apellido, puesto, usuario_id) VALUES
('Ricardo', 'Martínez', 'Gerente General', 1),
('Paola', 'Hernández', 'Contadora', 2),
('Fernando', 'Lopez', 'Soporte Técnico', 3),
('Gabriela', 'Sanchez', 'Vendedora', 4),
('Santiago', 'Ruiz', 'Contador', 5),
('Valeria', 'Gomez', 'Asistente Administrativa', 6);

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

INSERT INTO Pedidos (id_cliente, venta_id, estado, descripcion) VALUES
(1, 1, 'pendiente', 'Pedido en preparación'),
(2, 2, 'completado', 'Pedido entregado al cliente'),
(3, 3, 'pendiente', 'Esperando confirmación'),
(4, 4, 'completado', 'Pedido finalizado y entregado'),
(5, 5, 'cancelado', 'Pedido cancelado por el cliente'),
(6, 6, 'pendiente', 'Pedido pendiente de pago');

INSERT INTO Detalles_Pedido (id_pedido, id_producto, cantidad) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 5, 1),
(6, 6, 2);

INSERT INTO Equipos (nombre, descripcion, estado, Empleados_id) VALUES
('Equipo A', 'Equipo de soporte técnico', 'disponible', 1),
('Equipo B', 'Equipo de ventas', 'en uso', 2),
('Equipo C', 'Equipo de marketing', 'disponible', 3),
('Equipo D', 'Equipo de administración', 'fuera de servicio', 4),
('Equipo E', 'Equipo de desarrollo', 'en uso', 5),
('Equipo F', 'Equipo de logística', 'disponible', 6);

INSERT INTO pagos (id_venta, metodo_pago, tipo_tarjeta, numero_cuenta, monto, estado_pago) VALUES
(1, 'tarjeta', 'VISA', '1234-5678-9101', 1500.00, 'completado'),
(2, 'paypal', NULL, 'paypal_account@example.com', 1800.00, 'pendiente'),
(3, 'tarjeta', 'MasterCard', '2345-6789-1234', 400.00, 'completado'),
(4, 'tarjeta', 'VISA', '3456-7890-2345', 150.00, 'completado'),
(5, 'paypal', NULL, 'paypal_account2@example.com', 800.00, 'pendiente'),
(6, 'tarjeta', 'American Express', '4567-8901-3456', 240.00, 'fallido');

INSERT INTO Entregas (id_venta, metodo_entrega, fecha_entrega, hora_entrega, tipo_envio) VALUES
(1, 'Envío a domicilio', '2024-11-10', '14:30:00', 'express'),
(2, 'Recogida en tienda', '2024-11-11', '10:00:00', 'estándar'),
(3, 'Envío a domicilio', '2024-11-12', '16:00:00', 'express'),
(4, 'Recogida en tienda', '2024-11-13', '09:30:00', 'estándar'),
(5, 'Envío a domicilio', '2024-11-14', '11:00:00', 'standard'),
(6, 'Recogida en tienda', '2024-11-15', '13:00:00', 'express');