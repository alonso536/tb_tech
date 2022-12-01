CREATE DATABASE tb_tech;
USE tb_tech;

CREATE TABLE usuarios(
    id INT NOT NULL auto_increment ,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    rol VARCHAR(25),
    image VARCHAR(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE categorias(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE productos(
    id INT NOT NULL auto_increment,
    categoria_id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    descripcion TEXT,
    precio FLOAT(100, 2) NOT NULL,
    stock INT NOT NULL, 
    oferta VARCHAR(10),
    fecha DATETIME NOT NULL,
    image VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE regiones(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_regiones PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE pedidos(
    id INT NOT NULL auto_increment,
    usuario_id INT NOT NULL,
    region_id INT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    monto FLOAT(200, 2) NOT NULL,
    estado VARCHAR(25) NOT NULL
    fecha DATETIME NOT NULL,
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_regiones FOREIGN KEY(region_id) REFERENCES regiones(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
    id INT NOT NULL auto_increment,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    unidades INT NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id);
    CONSTRAINT fk_pedidos FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_productos FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;

drop database tb_tech;