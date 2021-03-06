SELECT * FROM usuario; -- 1

SELECT username, publicname, email, tel FROM usuario; -- 2

SELECT CONCAT(username,' ',email,' ',tel) AS 'Datos usuario' FROM usuario; -- 3

SELECT * FROM usuario WHERE id_poblacion = 1; -- 4

SELECT * FROM usuario WHERE id_poblacion != 1; -- 5

SELECT * FROM usuario WHERE aforo IS NULL AND valoracion IS NULL; -- 6, para reconocer a un fan

SELECT * FROM usuario WHERE aforo >= 150 AND aforo <= 300; -- 7, para reconocer a un local con aforo entre 150 y 300

SELECT id_banda AS 'Bandas con más de tres miembros' FROM (SELECT *, count(id_banda) as n_banda FROM Pertenece GROUP BY id_banda ) as info_bandas WHERE info_bandas.n_banda >= 3; -- 8, bandas con tres o más miembros

SELECT * FROM usuario WHERE valoracion IS NOT NULL; -- 9, para reconocer a un local o banda

SELECT * FROM usuario WHERE id_poblacion IN(1, 2); -- 10

-- select per tenir publicname a partir de username de local  - Funciona
SELECT publicname
FROM usuario
INNER JOIN Concierto on nom_local = username
WHERE nom_local = $_SESSION["username"];

-- els que posi ja fets son de la base de dades nova no vol dir que funcioni(si funciona posara fet i funciona)
-- SELECTS HOMEPAGE  
SELECT dia, idlocal, nombre_artistico
FROM usuario
INNER JOIN genero on genero = idgenero
INNER JOIN concierto on idgenero = genero
ORDER BY fecha ASC
LIMIT 10; -- select proximos conciertos bonitos  

SELECT nombre, genero, votosconcierto
FROM Usuario
SELECT COUNT(*) AS votosconcierto FROM voto_concierto WHERE 
INNER JOIN voto_concierto on Usuario.username = Genero_user.id_user
ORDER BY voto_concierto DESC -- select 5 MEJORES GARITOS(amb la nova base sera concerts) por valoracion  -  no hi ha votacio a garitos pero si a concerts
LIMIT 5;

SELECT publicname, nombre_genero, valoracion
FROM Usuario 
INNER JOIN Genero_user on Usuario.username = Genero_user.id_user
INNER JOIN Genero on Genero_user.id_genero = Genero.id
WHERE aforo IS NULL AND valoracion IS NOT NULL
ORDER BY valoracion DESC -- select 5 MEJORES bandas por valoracion  -  NO MUESTRA NADA
LIMIT 5;

SELECT publicname, nom_local, fecha, (SELECT COUNT(*) FROM votos_conciertos INNER JOIN Concierto on Votos_conciertos.id_concierto = Concierto.id GROUP BY Concierto.id) as valoracion_concierto -- valoracion_concierto
FROM Concierto
INNER JOIN Participa on Concierto.id = Participa.id_concierto
INNER JOIN Usuario on Participa.id_banda = Usuario.username
ORDER BY valoracion_concierto DESC -- mejores conciertos
LIMIT 5;

--SELECTS PÁGINA FAN
-- imagen perfil
SELECT img FROM Usuario WHERE username = $_SESSION["username"];

-- nombre publico
SELECT publicname FROM Usuario WHERE username = $_SESSION["username"];

-- conciertos valorados  -  NO MUESTRA NADA
SELECT fecha, publicname, nom_local
FROM Concierto
INNER JOIN Participa on Concierto.id = Participa.id_concierto
INNER JOIN Usuario on Participa.id_banda = Usuario.username
WHERE (SELECT  COUNT(*) FROM votos_conciertos WHERE id_fan = $_SESSION["username"]) = 1
ORDER BY fecha ASC
LIMIT 10;

-- proximos conciertos de las bandas a las que le has dado like  -  NO MUESTRA NADA
SELECT fecha, publicname, nom_local
FROM Concierto
INNER JOIN Participa on Concierto.id = Participa.id_concierto
INNER JOIN Usuario on Participa.id_banda = Usuario.username
WHERE (SELECT  COUNT(*) FROM votos_bandas WHERE id_fan = $_SESSION["username"]) = 1
ORDER BY fecha ASC
LIMIT 10;

-- conciertos a los que se ha apuntado la banda  -  FUNCIONA
SELECT id_concierto, nom_local, fecha, aceptado
FROM Participa
INNER JOIN Concierto on id_concierto = Concierto.id
WHERE id_banda = $_SESSION["username"]
ORDER BY fecha ASC
LIMIT 10;


-- conciertos en los que han aceptado a la banda  -  FUNCIONA
SELECT id_concierto, nom_local, fecha
FROM Participa
INNER JOIN Concierto on Participa.id_concierto = Concierto.id
WHERE aceptado = 1 AND id_banda = '$username'
ORDER BY fecha ASC
LIMIT 10;

-- grupos que se han apuntado a un concierto propuesto  - FUNCIONA
SELECT publicname, id, fecha
FROM Concierto
INNER JOIN Participa on Concierto.id = Participa.id_concierto
INNER JOIN Usuario on Participa.id_banda = Usuario.username
WHERE valoracion IS NOT NUlL AND direccion IS NULL AND nom_local = '$username'
ORDER BY fecha ASC
LIMIT 10;

-- seleccionar proximos conciertos propuestos por el local  -  FUNCIONA
SELECT id, fecha, precio
FROM Concierto
INNER JOIN Usuario on Usuario.username = Concierto.nom_local
WHERE username = '$username'
ORDER BY fecha ASC
LIMIT 10; 