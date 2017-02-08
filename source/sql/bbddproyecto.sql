CREATE DATABASE IF NOT EXISTS proyecto;
USE proyecto;

-- TABLAS PRINCIPALES
CREATE TABLE IF NOT EXISTS Poblacion( -- poblaciones disponibles
id int PRIMARY KEY,
nombre_poblacion varchar(50),
pais varchar(50)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Usuario( -- usuarios registrados
username varchar(20) PRIMARY KEY,
pass varchar(20) NOT NULL,
email varchar(100) NOT NULL UNIQUE, -- si da por culo el unik a tomar por sakó
img varchar(50), -- NOMBRE DE LA IMAGEN
publicname varchar(50),
tel char(9),
web varchar(150),
aforo int,
valoracion int DEFAULT NULL,
direccion varchar(100), -- NO ESTÁ EN EL MODELO RELACIONAL
id_poblacion int,
CONSTRAINT fk_usuario_poblacion FOREIGN KEY(`id_poblacion`) REFERENCES Poblacion(`id`) ON DELETE SET NULL ON UPDATE CASCADE -- poblacion del usuario
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Multimedia( -- ruta de los archivos multimedia y fk del usuario propietario
filename varchar(50) PRIMARY KEY,
id_user varchar(20),
CONSTRAINT fk_multimedia_usuario FOREIGN KEY(`id_user`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Genero( -- generos disponibles
id int PRIMARY KEY,
nombre_genero varchar(20) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Concierto( -- conciertos creados
id int PRIMARY KEY,
fecha date NOT NULL,
precio int NOT NULL, -- NO ESTÁ EN EL MODELO RELACIONAL
nom_local varchar(20), -- NOMBRE DEL LOCAL QUE REALIZA EL CONCIERTO
CONSTRAINT fk_concierto_usuario FOREIGN KEY(`nom_local`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE --Hemos cambiado username por public name
) DEFAULT CHARSET=utf8; 

CREATE TABLE IF NOT EXISTS Musico( -- musicos que forman parte de bandas (no son usuarios singulares, varios forman parte de uno mismo)
id int PRIMARY KEY,
nombre_musico varchar(20) NOT NULL,
ape1 varchar(20) NOT NULL,
ape2 varchar(20) NOT NULL,
edad int
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Instrumento( -- instrumentos disponibles
nombre_instrumento varchar(20) PRIMARY KEY,
tipo varchar(20) NOT NULL
) DEFAULT CHARSET=utf8;

-- TABLAS INTERMEDIAS
CREATE TABLE IF NOT EXISTS Usa( -- instrumento/s que usa cada musico
id_music int,
id_inst varchar(20),
CONSTRAINT pk_usa PRIMARY KEY(`id_music`,`id_inst`),
CONSTRAINT fk_usa_musico FOREIGN KEY(`id_music`) REFERENCES Musico(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_usa_instrumento FOREIGN KEY(`id_inst`) REFERENCES Instrumento(`nombre_instrumento`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Pertenece( -- banda/s a la que pertenece cada musico
id_music int,
id_banda varchar(20),
fecha_ini date,
fecha_fin date,
CONSTRAINT pk_pertenece PRIMARY KEY(`id_music`,`id_banda`,`fecha_ini`),
CONSTRAINT fk_pertenece_musico FOREIGN KEY(`id_music`) REFERENCES Musico(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_pertenece_usuario FOREIGN KEY(`id_banda`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Genero_user( -- genero/s de un local o banda
id_user varchar(20),
id_genero int,
CONSTRAINT pk_generouser PRIMARY KEY(`id_user`,`id_genero`),
CONSTRAINT fk_generouser_usuarios FOREIGN KEY(`id_user`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_generouser_genero FOREIGN KEY(`id_genero`) REFERENCES Genero(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Genero_concierto( -- genero/s de un concierto
id_concierto int,
id_genero int,
CONSTRAINT pk_generoconcierto PRIMARY KEY(`id_concierto`,`id_genero`),
CONSTRAINT fk_generoconcierto_concierto FOREIGN KEY(`id_concierto`) REFERENCES Concierto(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_generoconcierto_genero FOREIGN KEY(`id_genero`) REFERENCES Genero(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Participa( -- banda/s que participan en cada concierto
id_concierto int,
id_banda varchar(20),
aceptado tinyint DEFAULT 0, -- 0: pendiente, 1: aceptado, 2: rechazado
CONSTRAINT pk_participa PRIMARY KEY(`id_concierto`,`id_banda`),
CONSTRAINT fk_participa_concierto FOREIGN KEY(`id_concierto`) REFERENCES Concierto(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_participa_usuario FOREIGN KEY(`id_banda`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Votos_conciertos( -- voto/s realizados por los fans sobre los conciertos
id_concierto int,
id_fan varchar(20),
CONSTRAINT pk_votosconciertos PRIMARY KEY(`id_concierto`,`id_fan`),
CONSTRAINT fk_votosconciertos_concierto FOREIGN KEY(`id_concierto`) REFERENCES Concierto(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_votosconciertos_usuario FOREIGN KEY(`id_fan`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

-- TABLAS REFLEXIVAS
CREATE TABLE IF NOT EXISTS Votos_bandas( -- voto/s realizados por los fans sobre las bandas
id_fan varchar(20),
id_banda varchar(20),
CONSTRAINT pk_votosbandas PRIMARY KEY(`id_fan`,`id_banda`),
CONSTRAINT fk_votosbandas_usuariofan FOREIGN KEY(`id_fan`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_votosbandas_usuariobanda FOREIGN KEY(`id_banda`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Votos_locales( -- voto/s realizados por los fans sobre los locales
id_fan varchar(20),
id_local varchar(20),
CONSTRAINT pk_votoslocales PRIMARY KEY(`id_fan`,`id_local`),
CONSTRAINT fk_votoslocales_usuariofan FOREIGN KEY(`id_fan`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_votoslocales_usuariolocal FOREIGN KEY(`id_local`) REFERENCES Usuario(`username`) ON DELETE CASCADE ON UPDATE CASCADE
) DEFAULT CHARSET=utf8;