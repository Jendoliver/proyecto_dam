SELECT * FROM usuario; -- 1

SELECT username, publicname, email, tel FROM usuario; -- 2

SELECT CONCAT(username,' ',email,' ',tel) AS 'Datos usuario' FROM usuario; -- 3

SELECT * FROM usuario WHERE id_poblacion = 1; -- 4

SELECT * FROM usuario WHERE id_poblacion != 1; -- 5

SELECT * FROM usuario WHERE aforo IS NULL AND valoracion IS NULL; -- 6, para reconocer a un fan

SELECT * FROM usuario WHERE aforo IS NOT NULL AND aforo >= 150 AND aforo <= 300; -- 7, para reconocer a un local con aforo entre 150 y 300

SELECT username FROM usuario WHERE (SELECT COUNT(*) FROM Pertenece) >= 3;

SELECT * FROM usuario WHERE valoracion IS NOT NULL; -- 9, para reconocer a un local o banda

SELECT * FROM usuario WHERE id_poblacion IN(1, 2); -- 10