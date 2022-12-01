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

USE tb_tech;

CREATE TABLE subcategorias(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    categoria_id INT NOT NULL,
    CONSTRAINT pk_subcategorias PRIMARY KEY(id),
    CONSTRAINT fk_categoria_subcategoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

USE tb_tech;

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

USE tb_tech;

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
