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

USE tb_tech;

CREATE TABLE marcas(
    id INT NOT NULL auto_increment,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_marcas PRIMARY KEY(id)
)ENGINE=InnoDb;

USE tb_tech;
select * from categorias;
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

USE tb_tech;
select * from productos;
ALTER TABLE productos ADD subcategoria_id INT NOT NULL;
ALTER TABLE productos ADD marca_id INT NOT NULL;
ALTER TABLE productos ADD CONSTRAINT fk_subcategoria_producto FOREIGN KEY(subcategoria_id) REFERENCES subcategorias(id);
ALTER TABLE productos ADD CONSTRAINT fk_marca_producto FOREIGN KEY(marca_id) REFERENCES marcas(id);

USE tb_tech;

INSERT INTO productos VALUES(null, 2, "I9-12900k", null, 599990, 20, null, NOW(), null, 5, 6);
INSERT INTO productos VALUES(null, 2, "Ryzen 9 7900x", null, 699990, 20, null, NOW(), null, 6, 10);
INSERT INTO productos VALUES(null, 2, "I7-12700k", null, 399990, 30, null, NOW(), null, 5, 6);
INSERT INTO productos VALUES(null, 2, "Ryzen 7 7700x", null, 499990, 20, null, NOW(), null, 6, 10);
INSERT INTO productos VALUES(null, 2, "Ryzen 5 7600x", null, 599990, 15, null, NOW(), null, 6, 10);
INSERT INTO productos VALUES(null, 2, "I5-12600k", null, 249990, 40, null, NOW(), null, 5, 6);
INSERT INTO productos VALUES(null, 2, "Ryzen 9 7950x", null, 899990, 18, null, NOW(), null, 6, 10);

INSERT INTO productos VALUES(null, 6, "Asus Nvidia RTX-3090", null, 1599990, 7, null, NOW(), null, 16, 1);
INSERT INTO productos VALUES(null, 6, "Galax RX-6800XT", null, 1299990, 21, null, NOW(), null, 17, 2);
INSERT INTO productos VALUES(null, 6, "Gigabyte RX-6900XT", null, 1499990, 14, null, NOW(), null, 17, 3);
INSERT INTO productos VALUES(null, 6, "MSI RX-6800XT", null, 1099990, 23, null, NOW(), null, 17, 4);
INSERT INTO productos VALUES(null, 6, "Zotac Nvidia RTX-3070ti", null, 799990, 15, null, NOW(), null, 16, 5);
INSERT INTO productos VALUES(null, 6, "EVGA Nvidia RTX-3060", null, 549990, 21, null, NOW(), null, 16, 9);
INSERT INTO productos VALUES(null, 6, "ASUS Nvidia RTX-4080", null, 1549990, 18, null, NOW(), null, 16, 1);