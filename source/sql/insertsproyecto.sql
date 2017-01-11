USE proyecto;

INSERT INTO Poblacion VALUES
(1, 'Barcelona', 'España'),
(2, 'Madrid', 'España'),
(3, 'Galicia', 'España');

INSERT INTO Usuario VALUES -- username, pass, mail, img, publicname, teleponer, web, aforo, valoracion, poblacion
('jendoliver', 'poyankre', 'jandol1234@hotmail.com', NULL, 'Jandol', '123456789', NULL, NULL, NULL, 1), 
('smusi', 'elputoano', 'smusi@gmail.com', NULL,  'Smusiano', '932020321', NULL, NULL, NULL, 2),
('guimaso', 'eljodidoguim', 'guimauro@poya.es', NULL, 'Anuard', '628345671', NULL, NULL, NULL, 3), -- fans
('bovedamarina', 'putoeduceferino', 'boveda@poyankre.es', NULL, 'Bóveda Marina', '932929381', 'www.boveda.com', 170, 0, 1), -- garito
('fenixheavymetal', '4v3d3fu3g0', 'fenixresurrecciondelmetal@hotmail.com', NULL, 'Fénix Oficial', '628530061', 'www.fenix.es', NULL, 100, 1), -- banda
('losdostolays', 'tolay6969', 'tolay@tontopoya.com', NULL, 'Tolays Oficial', '654321098', 'www.tontopoya.com', NULL, 0, 2);

INSERT INTO Musico VALUES -- id, nombre, ape1, ape2, edad
(1, 'Alejandro', 'Álvarez', 'Monllor', 20),
(2, 'Dídac', 'Serrano', 'Segarra', 21),
(3, 'Marco', 'Maceira', 'Rivera', 21),
(4, 'Eric', 'Palanques', 'Tost', 20),
(5, 'Poya', 'Jefaso', 'Meuemish', 50),
(6, 'Jefe', 'Jefito', 'Moustache', 60);

INSERT INTO Pertenece VALUES -- id_music, id_banda, fecha_ini, fecha_fin
(1, 'fenixheavymetal', '2012-12-24', NULL),
(2, 'fenixheavymetal', '2014-09-15', NULL),
(3, 'fenixheavymetal', '2012-12-24', NULL),
(4, 'fenixheavymetal', '2012-12-24', NULL),
(5, 'losdostolays', '2014-11-25', NULL),
(6, 'losdostolays', '2000-10-23', NULL);