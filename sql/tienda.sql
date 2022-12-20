CREATE DATABASE IF NOT EXISTS tb_tech CHARACTER SET utf8;
USE tb_tech;

DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS subcategorias;
DROP TABLE IF EXISTS marcas;
DROP TABLE IF EXISTS permisos;
DROP TABLE IF EXISTS regiones;
DROP TABLE IF EXISTS estados;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS lineas_pedidos;
DROP TABLE IF EXISTS valoraciones;

CREATE TABLE categorias(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE subcategorias(
    id INT NOT NULL auto_increment,
    categoria_id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_subcategorias PRIMARY KEY(id),
    CONSTRAINT fk_categoria_subcategoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

CREATE TABLE marcas(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_marcas PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE permisos(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(15) NOT NULL,
    CONSTRAINT pk_permisos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE regiones(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_regiones PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE estados(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(15) NOT NULL,
    CONSTRAINT pk_estados PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE usuarios(
    id INT NOT NULL auto_increment,
    permiso_id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    image VARCHAR(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email),
    CONSTRAINT fk_permiso FOREIGN KEY(permiso_id) REFERENCES permisos(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

CREATE TABLE productos(
    id INT NOT NULL auto_increment,
    categoria_id INT NOT NULL,
    subcategoria_id INT NOT NULL,
    marca_id INT NOT NULL,
    nombre VARCHAR(40) NOT NULL,
    descripcion TEXT,
    precio INT NOT NULL,
    stock INT NOT NULL, 
    oferta VARCHAR(10),
    fecha DATETIME NOT NULL,
    image VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_subcategoria FOREIGN KEY(subcategoria_id) REFERENCES subcategorias(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_marca FOREIGN KEY(marca_id) REFERENCES marcas(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

CREATE TABLE pedidos(
    id INT NOT NULL auto_increment,
    usuario_id INT NOT NULL,
    region_id INT NOT NULL,
    estado_id INT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    monto INT NOT NULL,
    fecha DATETIME NOT NULL,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_region FOREIGN KEY(region_id) REFERENCES regiones(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_estado FOREIGN KEY(estado_id) REFERENCES estados(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
    id INT NOT NULL auto_increment,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    unidades INT NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id);
    CONSTRAINT fk_pedidos FOREIGN KEY(pedido_id) REFERENCES pedidos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_productos FOREIGN KEY(producto_id) REFERENCES productos(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

CREATE TABLE valoraciones(
    id INT NOT NULL auto_increment,
    producto_id INT NOT NULL,
    usuario_id INT NOT NULL,
    nivel INT NOT NULL,
    comentario TEXT,
    fecha DATETIME NOT NULL,
    CONSTRAINT pk_valoraciones PRIMARY KEY(id),
    CONSTRAINT fk_valoracion_producto FOREIGN KEY(producto_id) REFERENCES productos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_valoracion_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDb;

INSERT INTO categorias VALUES(null, 'Computadores');
INSERT INTO categorias VALUES(null, 'Procesadores');
INSERT INTO categorias VALUES(null, 'Placas Madres');
INSERT INTO categorias VALUES(null, 'Memorias RAM');
INSERT INTO categorias VALUES(null, 'Almacenamiento');
INSERT INTO categorias VALUES(null, 'Tarjetas Graficas');
INSERT INTO categorias VALUES(null, 'Fuentes de Poder');
INSERT INTO categorias VALUES(null, 'Gabinetes');
INSERT INTO categorias VALUES(null, 'Refrigeracion');
INSERT INTO categorias VALUES(null, 'Perifericos');


INSERT INTO subcategorias VALUES(null, 'Escritorio', 1);
INSERT INTO subcategorias VALUES(null, 'Notebooks', 1);
INSERT INTO subcategorias VALUES(null, 'Tablets', 1);
INSERT INTO subcategorias VALUES(null, 'Celulares', 1);

INSERT INTO subcategorias VALUES(null, 'Procesadores Intel', 2);
INSERT INTO subcategorias VALUES(null, 'Procesadores AMD', 2);

INSERT INTO subcategorias VALUES(null, 'Placas Madres Intel', 3);
INSERT INTO subcategorias VALUES(null, 'Placas Madres AMD', 3);

INSERT INTO subcategorias VALUES(null, 'Memorias PC', 4);
INSERT INTO subcategorias VALUES(null, 'Memorias Notebook', 4);

INSERT INTO subcategorias VALUES(null, 'Discos duros', 5);
INSERT INTO subcategorias VALUES(null, 'SSD', 5);
INSERT INTO subcategorias VALUES(null, 'Discos Externos', 5);
INSERT INTO subcategorias VALUES(null, 'SSD Externos', 5);
INSERT INTO subcategorias VALUES(null, 'Pendrives', 5);

INSERT INTO subcategorias VALUES(null, 'Tarjetas Graficas Nvidia', 6);
INSERT INTO subcategorias VALUES(null, 'Tarjetas Graficas AMD', 6);

INSERT INTO subcategorias VALUES(null, 'Genericas', 7);
INSERT INTO subcategorias VALUES(null, 'Certificadas', 7);

INSERT INTO subcategorias VALUES(null, 'Sin Fuente', 8);
INSERT INTO subcategorias VALUES(null, 'Con Fuente', 8);

INSERT INTO subcategorias VALUES(null, 'Disipadores', 9);
INSERT INTO subcategorias VALUES(null, 'Refrigeraciones Liquidas', 9);
INSERT INTO subcategorias VALUES(null, 'Ventiladores', 9);
INSERT INTO subcategorias VALUES(null, 'Insumos Refrigeracion', 9);

INSERT INTO subcategorias VALUES(null, 'Teclados', 10);
INSERT INTO subcategorias VALUES(null, 'Mouse', 10);
INSERT INTO subcategorias VALUES(null, 'Monitores', 10);
INSERT INTO subcategorias VALUES(null, 'Mouse Pads', 10);
INSERT INTO subcategorias VALUES(null, 'Audifonos', 10);

INSERT INTO marcas VALUES(null, 'Asus');
INSERT INTO marcas VALUES(null, 'Galax');
INSERT INTO marcas VALUES(null, 'Gigabyte');
INSERT INTO marcas VALUES(null, 'MSI');
INSERT INTO marcas VALUES(null, 'Zotac');
INSERT INTO marcas VALUES(null, 'Intel');
INSERT INTO marcas VALUES(null, 'Logitech');
INSERT INTO marcas VALUES(null, 'CoolerMaster');
INSERT INTO marcas VALUES(null, 'EVGA');
INSERT INTO marcas VALUES(null, 'AMD');
INSERT INTO marcas VALUES(null, 'Corsair');
INSERT INTO marcas VALUES(null, 'Samsung');
INSERT INTO marcas VALUES(null, 'NZXT');

INSERT INTO permisos VALUES(null, 'user');
INSERT INTO permisos VALUES(null, 'admin');

INSERT INTO regiones VALUES(null, 'XV Región de Arica y Parinacota');
INSERT INTO regiones VALUES(null, 'I Región de Tarapacá');
INSERT INTO regiones VALUES(null, 'II Región de Antofagasta');
INSERT INTO regiones VALUES(null, 'III Región de Calama');
INSERT INTO regiones VALUES(null, 'IV Región de Coquimbo');
INSERT INTO regiones VALUES(null, 'V Región de Valparaíso');
INSERT INTO regiones VALUES(null, 'VI Región del Libertador General Bernardo O’Higgins');
INSERT INTO regiones VALUES(null, 'VII Región del Maule');
INSERT INTO regiones VALUES(null, 'XVI Región de Ñuble');
INSERT INTO regiones VALUES(null, 'VII Región del Bio-Bío');
INSERT INTO regiones VALUES(null, 'IX Región de La Araucanía');
INSERT INTO regiones VALUES(null, 'X Región de Los Lagos');
INSERT INTO regiones VALUES(null, 'XIV Región de Los Ríos');
INSERT INTO regiones VALUES(null, 'XI Región de Aysén del General Carlos Ibáñez del Campo');
INSERT INTO regiones VALUES(null, 'XII Región de Magallanes y Antártica Chilena');
INSERT INTO regiones VALUES(null, 'Región Metropolitana de Santiago');

INSERT INTO estados VALUES(null, 'Confirmado');
INSERT INTO estados VALUES(null, 'Pagado');
INSERT INTO estados VALUES(null, 'Eliminado');

INSERT INTO usuarios VALUES(null, 2, 'Admin', 'Admin', 'admin@thebasement.cl', '123456', '0000', null);