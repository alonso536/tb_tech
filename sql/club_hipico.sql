CREATE DATABASE club_hipico CHARACTER SET utf8;
USE club_hipico;

CREATE TABLE ciudades(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_ciudades PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE recintos(
    id INT NOT NULL AUTO_INCREMENT,
    ciudad_id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    CONSTRAINT pk_recintos PRIMARY KEY(id),
    CONSTRAINT fk_recinto_ciudad FOREIGN KEY(ciudad_id) REFERENCES ciudades(id)
)ENGINE=InnoDb;

CREATE TABLE jinetes(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    CONSTRAINT pk_jinetes PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE cuidadores(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    CONSTRAINT pk_cuidadores PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE propietarios(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    CONSTRAINT pk_propietarios PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE preparadores(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    CONSTRAINT pk_preparadores PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE carreras(
    id INT NOT NULL AUTO_INCREMENT,
    recinto_id INT NOT NULL,
    fecha DATE NOT NULL,
    CONSTRAINT pk_carreras PRIMARY KEY(id),
    CONSTRAINT fk_carrera_recinto FOREIGN KEY(recinto_id) REFERENCES recintos(id)
)ENGINE=InnoDb;

CREATE TABLE caballos(
    id INT NOT NULL AUTO_INCREMENT,
    jinete_id INT NOT NULL,
    cuidador_id INT NOT NULL,
    propietario_id INT NOT NULL,
    preparador_id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    peso FLOAT(5, 2) NOT NULL,
    CONSTRAINT pk_caballos PRIMARY KEY(id),
    CONSTRAINT fk_jinete_caballo FOREIGN KEY(jinete_id) REFERENCES jinetes(id),
    CONSTRAINT fk_cuidador_caballo FOREIGN KEY(cuidador_id) REFERENCES cuidadores(id),
    CONSTRAINT fk_propietario_caballo FOREIGN KEY(propietario_id) REFERENCES propietarios(id),
    CONSTRAINT fk_preparador_caballo FOREIGN KEY(preparador_id) REFERENCES preparadores(id)
)ENGINE=InnoDb;

CREATE TABLE registros_carreras(
    id INT NOT NULL AUTO_INCREMENT,
    carrera_id INT NOT NULL,
    caballo_id INT NOT NULL,
    CONSTRAINT pk_registros_carreras PRIMARY KEY(id),
    CONSTRAINT fk_registro_carrera FOREIGN KEY(carrera_id) REFERENCES carreras(id),
    CONSTRAINT fk_registro_caballo FOREIGN KEY(caballo_id) REFERENCES caballos(id)
)ENGINE=InnoDb;

CREATE TABLE apostadores(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL,
    fono VARCHAR(15) NOT NULL,
    CONSTRAINT pk_apostadores PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE apuestas(
    id INT NOT NULL AUTO_INCREMENT,
    registro_carrera_id INT NOT NULL,
    apostador_id INT NOT NULL,
    monto INT NOT NULL,
    CONSTRAINT pk_apostadores PRIMARY KEY(id),
    CONSTRAINT fk_apuesta_registro FOREIGN KEY(registro_carrera_id) REFERENCES registros_carreras(id),
    CONSTRAINT fk_apostador FOREIGN KEY(apostador_id) REFERENCES apostadores(id)
)ENGINE=InnoDb;