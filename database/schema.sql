
DROP DATABASE IF EXISTS adiasoft2025;
CREATE DATABASE adiasoft2025;
USE adiasoft2025;

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    documento VARCHAR(20),
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(120),
    telefono VARCHAR(20),
    estado TINYINT DEFAULT 1,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios_roles (
    id_usuario INT NOT NULL,
    id_rol INT NOT NULL,
    PRIMARY KEY (id_usuario, id_rol)
);

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(20),
    nombres VARCHAR(120) NOT NULL,
    apellidos VARCHAR(120) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(120),
    direccion VARCHAR(255)
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
	id_categoria INT NOT NULL,
	nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255),
    precio DECIMAL(10,2) NOT NULL,
    estado TINYINT DEFAULT 1
);

CREATE TABLE proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    ruc VARCHAR(20),
    telefono VARCHAR(20),
    email VARCHAR(120),
    direccion VARCHAR(255)
);

CREATE TABLE inventario (
    id_inventario INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    stock_actual INT DEFAULT 0
);

CREATE TABLE movimiento_inventario (
    id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
	id_usuario INT NOT NULL,
    tipo ENUM('entrada','salida','ajuste') NOT NULL,
    cantidad INT NOT NULL,
    motivo VARCHAR(255),
    referencia VARCHAR(100),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT NOT NULL,
	id_usuario INT NOT NULL,
    fecha_compra DATETIME DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10,2) DEFAULT 0,
    igv DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) DEFAULT 0
);

CREATE TABLE detalle_compra (
    id_detalle_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_compra INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2)
);

CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
	id_usuario INT NOT NULL,
    fecha_venta DATETIME DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10,2) DEFAULT 0,
    igv DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) DEFAULT 0,
    estado ENUM('ACTIVA', 'ANULADA') DEFAULT 'ACTIVA'
);

CREATE TABLE detalle_venta (
    id_detalle_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2)
);

CREATE TABLE metodo_pago (
    id_metodo_pago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE pago_venta (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_metodo_pago INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL
);

CREATE TABLE log_sistema (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    tabla VARCHAR(100),
    operacion VARCHAR(20),
    descripcion TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);


-- RELACIONES DE TABLAS
USE adiasoft2025;

ALTER TABLE usuarios_roles
ADD CONSTRAINT fk_ur_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario),
ADD CONSTRAINT fk_ur_rol FOREIGN KEY (id_rol)
    REFERENCES roles(id_rol);

ALTER TABLE productos
ADD CONSTRAINT fk_producto_categoria FOREIGN KEY (id_categoria)
    REFERENCES categorias(id_categoria);

ALTER TABLE inventario
ADD CONSTRAINT fk_inventario_producto FOREIGN KEY (id_producto)
    REFERENCES productos(id_producto);

ALTER TABLE movimiento_inventario
ADD CONSTRAINT fk_mov_producto FOREIGN KEY (id_producto)
    REFERENCES productos(id_producto),
ADD CONSTRAINT fk_mov_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario);

ALTER TABLE compras
ADD CONSTRAINT fk_compra_proveedor FOREIGN KEY (id_proveedor)
    REFERENCES proveedores(id_proveedor),
ADD CONSTRAINT fk_compra_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario);

ALTER TABLE detalle_compra
ADD CONSTRAINT fk_dcompra_compra FOREIGN KEY (id_compra)
    REFERENCES compras(id_compra),
ADD CONSTRAINT fk_dcompra_producto FOREIGN KEY (id_producto)
    REFERENCES productos(id_producto);

ALTER TABLE ventas
ADD CONSTRAINT fk_venta_cliente FOREIGN KEY (id_cliente)
    REFERENCES clientes(id_cliente),
ADD CONSTRAINT fk_venta_usuario FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario);

ALTER TABLE detalle_venta
ADD CONSTRAINT fk_dventa_venta FOREIGN KEY (id_venta)
    REFERENCES ventas(id_venta),
ADD CONSTRAINT fk_dventa_producto FOREIGN KEY (id_producto)
    REFERENCES productos(id_producto);

ALTER TABLE pago_venta
ADD CONSTRAINT fk_pago_venta FOREIGN KEY (id_venta)
    REFERENCES ventas(id_venta),
ADD CONSTRAINT fk_pago_metodo FOREIGN KEY (id_metodo_pago)
    REFERENCES metodo_pago(id_metodo_pago);

USE adiasoft2025;
CREATE TABLE configuracion (
    id_config INT PRIMARY KEY AUTO_INCREMENT,
    moneda VARCHAR(10) NOT NULL,
    simbolo VARCHAR(5) NOT NULL,
    igv DECIMAL(5,2) NOT NULL,
    incluye_igv TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ON UPDATE CURRENT_TIMESTAMP
);
