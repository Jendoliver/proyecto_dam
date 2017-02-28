-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Temps de generació: 28-02-2017 a les 00:09:36
-- Versió del servidor: 10.1.16-MariaDB
-- Versió de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `concierto`
--

CREATE TABLE `concierto` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(11) NOT NULL,
  `nom_local` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `concierto`
--

INSERT INTO `concierto` (`id`, `fecha`, `precio`, `nom_local`) VALUES
(1, '2011-12-24', 120, 'bovedamarina'),
(2, '2012-11-23', 10, 'bovedamarina'),
(3, '2014-10-20', 20, 'bovedamarina');

-- --------------------------------------------------------

--
-- Estructura de la taula `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nombre_genero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `genero`
--

INSERT INTO `genero` (`id`, `nombre_genero`) VALUES
(1, 'nu metal'),
(2, 'heavy metal'),
(3, 'thrash metal');

-- --------------------------------------------------------

--
-- Estructura de la taula `genero_concierto`
--

CREATE TABLE `genero_concierto` (
  `id_concierto` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `genero_user`
--

CREATE TABLE `genero_user` (
  `id_user` varchar(20) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `genero_user`
--

INSERT INTO `genero_user` (`id_user`, `id_genero`) VALUES
('bovedamarina', 2),
('fenixheavymetal', 2),
('lobo', 1),
('losdostolays', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `instrumento`
--

CREATE TABLE `instrumento` (
  `nombre_instrumento` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `multimedia`
--

CREATE TABLE `multimedia` (
  `filename` varchar(50) NOT NULL,
  `id_user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `musico`
--

CREATE TABLE `musico` (
  `id` int(11) NOT NULL,
  `nombre_musico` varchar(20) NOT NULL,
  `ape1` varchar(20) NOT NULL,
  `ape2` varchar(20) NOT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `musico`
--

INSERT INTO `musico` (`id`, `nombre_musico`, `ape1`, `ape2`, `edad`) VALUES
(1, 'Alejandro', 'Álvarez', 'Monllor', 20),
(2, 'Dídac', 'Serrano', 'Segarra', 21),
(3, 'Marco', 'Maceira', 'Rivera', 21),
(4, 'Eric', 'Palanques', 'Tost', 20),
(5, 'Poya', 'Jefaso', 'Meuemish', 50),
(6, 'Jefe', 'Jefito', 'Moustache', 60);

-- --------------------------------------------------------

--
-- Estructura de la taula `participa`
--

CREATE TABLE `participa` (
  `id_concierto` int(11) NOT NULL,
  `id_banda` varchar(20) NOT NULL,
  `aceptado` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `participa`
--

INSERT INTO `participa` (`id_concierto`, `id_banda`, `aceptado`) VALUES
(1, 'fenixheavymetal', 1),
(1, 'losdostolays', 1),
(2, 'fenixheavymetal', 1),
(3, 'losdostolays', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `pertenece`
--

CREATE TABLE `pertenece` (
  `id_music` int(11) NOT NULL,
  `id_banda` varchar(20) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `pertenece`
--

INSERT INTO `pertenece` (`id_music`, `id_banda`, `fecha_ini`, `fecha_fin`) VALUES
(1, 'fenixheavymetal', '2012-12-24', NULL),
(2, 'fenixheavymetal', '2014-09-15', NULL),
(3, 'fenixheavymetal', '2012-12-24', NULL),
(4, 'fenixheavymetal', '2012-12-24', NULL),
(5, 'losdostolays', '2014-11-25', NULL),
(6, 'losdostolays', '2000-10-23', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `poblacion`
--

CREATE TABLE `poblacion` (
  `id` int(11) NOT NULL,
  `nombre_poblacion` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `poblacion`
--

INSERT INTO `poblacion` (`id`, `nombre_poblacion`, `pais`) VALUES
(1, 'Barcelona', 'España'),
(2, 'Madrid', 'España'),
(3, 'Galicia', 'España');

-- --------------------------------------------------------

--
-- Estructura de la taula `usa`
--

CREATE TABLE `usa` (
  `id_music` int(11) NOT NULL,
  `id_inst` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `publicname` varchar(50) DEFAULT NULL,
  `tel` char(9) DEFAULT NULL,
  `web` varchar(150) DEFAULT NULL,
  `aforo` int(11) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `id_poblacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `usuario`
--

INSERT INTO `usuario` (`username`, `pass`, `email`, `img`, `publicname`, `tel`, `web`, `aforo`, `valoracion`, `direccion`, `id_poblacion`) VALUES
('bovedamarina', 'putoeduceferino', 'boveda@poyankre.es', NULL, 'Bóveda Marina', '932929381', 'www.boveda.com', 170, 0, NULL, 1),
('fenixheavymetal', '4v3d3fu3g0', 'fenixresurrecciondelmetal@hotmail.com', NULL, 'Fénix Oficial', '628530061', 'www.fenix.es', NULL, 100, NULL, 1),
('guimaso', 'eljodidoguim', 'guimauro@poya.es', NULL, 'Anuard', '628345671', NULL, NULL, NULL, NULL, 3),
('jendoliver', 'poyankre', 'jandol1234@hotmail.com', NULL, 'Jandol', '123456789', NULL, NULL, NULL, NULL, 1),
('lobo', 'putoos', 'lobo@poyankre.es', NULL, 'Senyor Lobo', '932929485', 'www.lobo.com', 150, 10, 'marina160', 1),
('losdostolays', 'tolay6969', 'tolay@tontopoya.com', NULL, 'Tolays Oficial', '654321098', 'www.tontopoya.com', NULL, 0, NULL, 2),
('smusi', 'elputoano', 'smusi@gmail.com', NULL, 'Smusiano', '932020321', NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `votos_bandas`
--

CREATE TABLE `votos_bandas` (
  `id_fan` varchar(20) NOT NULL,
  `id_banda` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `votos_bandas`
--

INSERT INTO `votos_bandas` (`id_fan`, `id_banda`) VALUES
('guimaso', 'losdostolays'),
('jendoliver', 'fenixheavymetal'),
('smusi', 'losdostolays');

-- --------------------------------------------------------

--
-- Estructura de la taula `votos_conciertos`
--

CREATE TABLE `votos_conciertos` (
  `id_concierto` int(11) NOT NULL,
  `id_fan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `votos_conciertos`
--

INSERT INTO `votos_conciertos` (`id_concierto`, `id_fan`) VALUES
(1, 'guimaso'),
(1, 'jendoliver'),
(1, 'smusi'),
(2, 'jendoliver'),
(2, 'smusi'),
(3, 'guimaso');

-- --------------------------------------------------------

--
-- Estructura de la taula `votos_locales`
--

CREATE TABLE `votos_locales` (
  `id_fan` varchar(20) NOT NULL,
  `id_local` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `concierto`
--
ALTER TABLE `concierto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_concierto_usuario` (`nom_local`);

--
-- Index de la taula `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `genero_concierto`
--
ALTER TABLE `genero_concierto`
  ADD PRIMARY KEY (`id_concierto`,`id_genero`),
  ADD KEY `fk_generoconcierto_genero` (`id_genero`);

--
-- Index de la taula `genero_user`
--
ALTER TABLE `genero_user`
  ADD PRIMARY KEY (`id_user`,`id_genero`),
  ADD KEY `fk_generouser_genero` (`id_genero`);

--
-- Index de la taula `instrumento`
--
ALTER TABLE `instrumento`
  ADD PRIMARY KEY (`nombre_instrumento`);

--
-- Index de la taula `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`filename`),
  ADD KEY `fk_multimedia_usuario` (`id_user`);

--
-- Index de la taula `musico`
--
ALTER TABLE `musico`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `participa`
--
ALTER TABLE `participa`
  ADD PRIMARY KEY (`id_concierto`,`id_banda`),
  ADD KEY `fk_participa_usuario` (`id_banda`);

--
-- Index de la taula `pertenece`
--
ALTER TABLE `pertenece`
  ADD PRIMARY KEY (`id_music`,`id_banda`,`fecha_ini`),
  ADD KEY `fk_pertenece_usuario` (`id_banda`);

--
-- Index de la taula `poblacion`
--
ALTER TABLE `poblacion`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `usa`
--
ALTER TABLE `usa`
  ADD PRIMARY KEY (`id_music`,`id_inst`),
  ADD KEY `fk_usa_instrumento` (`id_inst`);

--
-- Index de la taula `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_poblacion` (`id_poblacion`);

--
-- Index de la taula `votos_bandas`
--
ALTER TABLE `votos_bandas`
  ADD PRIMARY KEY (`id_fan`,`id_banda`),
  ADD KEY `fk_votosbandas_usuariobanda` (`id_banda`);

--
-- Index de la taula `votos_conciertos`
--
ALTER TABLE `votos_conciertos`
  ADD PRIMARY KEY (`id_concierto`,`id_fan`),
  ADD KEY `fk_votosconciertos_usuario` (`id_fan`);

--
-- Index de la taula `votos_locales`
--
ALTER TABLE `votos_locales`
  ADD PRIMARY KEY (`id_fan`,`id_local`),
  ADD KEY `fk_votoslocales_usuariolocal` (`id_local`);

--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `concierto`
--
ALTER TABLE `concierto`
  ADD CONSTRAINT `fk_concierto_usuario` FOREIGN KEY (`nom_local`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `genero_concierto`
--
ALTER TABLE `genero_concierto`
  ADD CONSTRAINT `fk_generoconcierto_concierto` FOREIGN KEY (`id_concierto`) REFERENCES `concierto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_generoconcierto_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `genero_user`
--
ALTER TABLE `genero_user`
  ADD CONSTRAINT `fk_generouser_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_generouser_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `fk_multimedia_usuario` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `participa`
--
ALTER TABLE `participa`
  ADD CONSTRAINT `fk_participa_concierto` FOREIGN KEY (`id_concierto`) REFERENCES `concierto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participa_usuario` FOREIGN KEY (`id_banda`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `pertenece`
--
ALTER TABLE `pertenece`
  ADD CONSTRAINT `fk_pertenece_musico` FOREIGN KEY (`id_music`) REFERENCES `musico` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pertenece_usuario` FOREIGN KEY (`id_banda`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `usa`
--
ALTER TABLE `usa`
  ADD CONSTRAINT `fk_usa_instrumento` FOREIGN KEY (`id_inst`) REFERENCES `instrumento` (`nombre_instrumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usa_musico` FOREIGN KEY (`id_music`) REFERENCES `musico` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_poblacion` FOREIGN KEY (`id_poblacion`) REFERENCES `poblacion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restriccions per la taula `votos_bandas`
--
ALTER TABLE `votos_bandas`
  ADD CONSTRAINT `fk_votosbandas_usuariobanda` FOREIGN KEY (`id_banda`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_votosbandas_usuariofan` FOREIGN KEY (`id_fan`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `votos_conciertos`
--
ALTER TABLE `votos_conciertos`
  ADD CONSTRAINT `fk_votosconciertos_concierto` FOREIGN KEY (`id_concierto`) REFERENCES `concierto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_votosconciertos_usuario` FOREIGN KEY (`id_fan`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `votos_locales`
--
ALTER TABLE `votos_locales`
  ADD CONSTRAINT `fk_votoslocales_usuariofan` FOREIGN KEY (`id_fan`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_votoslocales_usuariolocal` FOREIGN KEY (`id_local`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
