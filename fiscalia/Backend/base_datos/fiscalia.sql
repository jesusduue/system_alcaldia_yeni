CREATE DATABASE IF NOT EXISTS fiscalia;

USE fiscalia;


-- TABLA PERMISO: Gestiona los permisos de usuarios en el sistema

CREATE TABLE permiso (

  id_perm INT PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'Código principal e identificador de la tabla permiso',

  nom_perm VARCHAR(50) NOT NULL COMMENT 'Nombre del permiso para los usuarios',

  est_perm CHAR(1) NOT NULL COMMENT 'Estado para el permiso si está activo o inactivo'

) ENGINE=InnoDB COMMENT='Tabla para gestionar los permisos de los usuarios en el sistema';


-- TABLA USUARIO: Gestiona los usuarios que ingresan al sistema

CREATE TABLE usuario (

  id_usu INT PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'Código principal de la tabla usuario y llave primaria',

  nom_usu VARCHAR(100) NOT NULL COMMENT 'Nombre del usuario que está accediendo al sistema',

  cla_usu VARCHAR(255) NOT NULL COMMENT 'Clave de ingreso del usuario al sistema',

  fky_perm INT NOT NULL COMMENT 'Llave foranea que hace referencia a la tabla permisos, para indicar los permisos que tiene el usuario',

  est_usu CHAR(1) NOT NULL COMMENT 'Estado del usuario para indicar si está activo o inactivo',

  FOREIGN KEY (fky_perm) REFERENCES permiso(id_perm) ON DELETE RESTRICT ON UPDATE CASCADE

) ENGINE=InnoDB COMMENT='Tabla usuario para gestionar los usuarios que ingresan al sistema';


-- TABLA PERSONA: Registra información de personas en la fiscalía

CREATE TABLE persona (

  id_per INT PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'Código principal de la tabla y llave primaria',

  ced_per VARCHAR(15) NOT NULL UNIQUE COMMENT 'Cedula o rif de la persona',

  nom_per VARCHAR(155) NOT NULL COMMENT 'Primer y segundo nombre de la persona',

  ape_per VARCHAR(255) NOT NULL COMMENT 'Primer y segundo apellido de la persona',

  tel_per VARCHAR(20) NOT NULL COMMENT 'Campo para guardar la información del celular de la persona',

  ema_per VARCHAR(100) NOT NULL COMMENT 'Campo para guardar el correo del persona',

  dir_per VARCHAR(200) NOT NULL COMMENT 'campo para guardar la direccion de la persona',

  cat_per VARCHAR(50) NOT NULL COMMENT 'Campo para asignar la categoría de la persona si es Militar o Civil',

  fec_ing_per DATE NOT NULL COMMENT 'Campo para guardar la fecha de ingreso del personal a la fiscalia',

  fky_usu INT NOT NULL COMMENT 'Llaver foránea de la tabla usuario para indicar que usuario hizo el registro del personal',

  est_per CHAR(1) NOT NULL COMMENT 'Campo para indicar el estado de persona si está activo o inactivo',

  FOREIGN KEY (fky_usu) REFERENCES usuario(id_usu) ON DELETE RESTRICT ON UPDATE CASCADE

) ENGINE=InnoDB COMMENT='Tabla persona para registrar la información de las personas que ingresan a la fiscalía por alguna denuncia o caso';


-- TABLA CASOS: Gestiona casos judiciales

CREATE TABLE casos (

  id_cas INT PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del caso',

  fky_per INT NOT NULL COMMENT 'Llave foranea de personas para vincular los casos con las personas que los llevan',

  num_cas VARCHAR(255) NOT NULL COMMENT 'Número de control del informe de presentación',

  nom_cas VARCHAR(255) NOT NULL COMMENT 'Nombre del caso (denuncia/presentación)',

  cat_cas VARCHAR(255) NOT NULL COMMENT 'Categoría del caso (denuncia/presentación)',

  des_cas VARCHAR(255) NOT NULL COMMENT 'Descripción detallada del caso',

  est_cas CHAR(1) NOT NULL COMMENT 'Estado del caso: A=Abierto, P=Procesado, C=Cerrado',

  FOREIGN KEY (fky_per) REFERENCES persona(id_per) ON DELETE RESTRICT ON UPDATE CASCADE

) ENGINE=InnoDB COMMENT='Tabla para gestionar los casos judiciales que tienen las personas';