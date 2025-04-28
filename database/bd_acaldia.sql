create database if not exists alcaldia;
use alcaldia;

-- TABLA ROL: Almacena los tipos de permisos de usuarios
CREATE TABLE rol (
  id_rol int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- Identificador unico autoincremental de roles
  rol varchar(50) NOT NULL ,                       -- Nombre del rol (Ej: Administrador, Inspector, Ciudadano)
  est_rol varchar(1) NOT NULL                      -- Estado del rol: A activo I inactivo
) ENGINE=InnoDB;

-- TABLA USUARIO: Registra usuarios del sistema con sus credenciales
CREATE TABLE usuario (
  id_usu int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- ID unico del usuario
  nom_usu varchar(50) NOT NULL,                    -- Nombre de usuario para login
  cla_usu varchar(50) NOT NULL,                    -- Clave de acceso (deberia ser campo cifrado en produccion)
  fky_rol int NOT NULL,                            -- Rol asignado (relacion con tabla rol)
  est_usu varchar(1) NOT NULL,                     -- Estado usuario: A activo, I inactivo
  FOREIGN KEY (fky_rol) REFERENCES rol(id_rol) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA PATENTE: Registra comercios con su informacion legal
CREATE TABLE patente(
  id_pate int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- Identificador unico de patente
  num_pat int DEFAULT NULL,                        -- Numero oficial de patente (podria ser unico)
  nom_pat varchar(100) NOT NULL,                   -- Nombre legal del comercio
  rep_pat varchar(100) NOT NULL,                   -- Nombre del representante legal
  rif_pat varchar(50) NOT NULL,                    -- RIF del comercio (Ej: J-12345678-9)
  ubi_pat varchar(200) NOT NULL,                   -- Direccion fisica del establecimiento
  rub_pat varchar(200) NOT NULL,                   -- Rubro o actividad economica principal
  fky_usu int NOT NULL,                            -- Usuario que realizo el registro
  est_pat varchar(1) NOT NULL,                     -- Estado (A=Activo, I=Inactivo, E=En proceso)
  FOREIGN KEY (fky_usu) REFERENCES usuario(id_usu) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA LICENCIA: Controla vigencia de permisos comerciales
CREATE TABLE licencia(
  id_lic int PRIMARY KEY NOT NULL AUTO_INCREMENT,   -- Identificador unico de licencia
  fky_pat int NOT NULL,                            -- Patente asociada (debe ser id_pate)
  fec_ven date NOT NULL,                           -- Fecha de vencimiento de la licencia
  est_lic varchar(1) NOT NULL,                     -- Estado (V=Vigente, C=Caducada, P=Pendiente)
  FOREIGN KEY (fky_pat) REFERENCES patente(id_pate) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA SOLVENCIA: Gestiona certificados de cumplimiento tributario
CREATE TABLE solvencia(
  id_sol int PRIMARY KEY NOT NULL AUTO_INCREMENT,   -- Identificador unico de solvencia
  fky_pat int NOT NULL,                            -- Patente asociada (debe ser id_pate)
  fec_ven date NOT NULL,                           -- Fecha hasta cuando es valida la solvencia
  est_sol varchar(1) NOT NULL,                     -- Estado (V=Valida, C=Caducada, R=Rechazada)
  FOREIGN KEY (fky_pat) REFERENCES patente(id_pate) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;