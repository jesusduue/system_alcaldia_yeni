create database if not exists alcaldia_patente;
use alcaldia_patente;

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

-- TABLA patNTE: Registra comercios con su informacion legal
CREATE TABLE patente(
  id_pat int PRIMARY KEY NOT NULL AUTO_INCREMENT,  -- Identificador unico de patnte
  fec_pat date NOT NULL,                           -- Fecha de registro de la patnte
  num_pat int NOT NULL,                            -- Numero oficial de patnte (podria ser unico)
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
  fky_pat int NOT NULL,                            -- patnte asociada (debe ser id_pat)
  fec_ven date NOT NULL,                           -- Fecha de vencimiento de la licencia
  est_lic varchar(1) NOT NULL,                     -- Estado (V=Vigente, C=Caducada, P=Pendiente)
  FOREIGN KEY (fky_pat) REFERENCES patente(id_pat) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- TABLA SOLVENCIA: Gestiona certificados de cumplimiento tributario
CREATE TABLE solvencia(
  id_sol int PRIMARY KEY NOT NULL AUTO_INCREMENT,   -- Identificador unico de solvencia
  fky_pat int NOT NULL,                            -- patnte asociada (debe ser id_pat)
  fec_ven date NOT NULL,                           -- Fecha hasta cuando es valida la solvencia
  est_sol varchar(1) NOT NULL,                     -- Estado (V=Valida, C=Caducada, R=Rechazada)
  FOREIGN KEY (fky_pat) REFERENCES patente(id_pat) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
-- TABLA PREGUNTA_SEGURIDAD: Almacena las posibles preguntas de seguridad
CREATE TABLE pregunta_seguridad (
  id_pregunta int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pregunta text NOT NULL,
  est_pregunta varchar(1) NOT NULL DEFAULT 'a'
) ENGINE=InnoDB;

-- TABLA USUARIO_PREGUNTA: Relaciona usuarios con sus preguntas de seguridad
CREATE TABLE usuario_pregunta (
  id_usuario_pregunta int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fky_usu int NOT NULL,
  fky_pregunta int NOT NULL,
  respuesta varchar(255) NOT NULL, -- Respuesta cifrada
  FOREIGN KEY (fky_usu) REFERENCES usuario(id_usu) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (fky_pregunta) REFERENCES pregunta_seguridad(id_pregunta) ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY (fky_usu, fky_pregunta)
) ENGINE=InnoDB;

-- Modificar tabla USUARIO para contraseñas más largas
ALTER TABLE usuario MODIFY cla_usu varchar(255) NOT NULL;

-- Insertar preguntas de seguridad básicas
INSERT INTO pregunta_seguridad (pregunta) VALUES
('¿Cuál es el nombre de tu primera mascota?'),
('¿Cuál es tu color favorito?'),
('¿En qué ciudad naciste?'),
('¿Cómo se llamaba tu primer colegio?'),
('¿Cuál es el nombre de tu madre?');

-- TABLA LOGS_ACCESO: Registra eventos de acceso y acciones de usuarios
CREATE TABLE logs_acceso (
  id_log int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_usuario int NOT NULL,
  nombre_usuario varchar(100) NOT NULL,
  rol_usuario varchar(50) NOT NULL,
  tipo_evento varchar(50) NOT NULL,
  fecha_hora datetime NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usu) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;