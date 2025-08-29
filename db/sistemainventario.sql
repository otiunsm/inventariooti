USE  sistemainventario;

SELECT * FROM tipo_equipo;
SELECT * FROM equipo;
SELECT * FROM estadoequipo;
SELECT * FROM modelo;
SELECT * FROM unidad_organica;
SELECT * FROM usuario;
SELECT * FROM equipo;
SELECT * FROM usuario;

SELECT 
	e.id_equipo,
    t.nombre AS tipo,
    s.estado AS estado,
    m.modelo AS modelo,
    u.nombre AS UnidadOrganica
FROM equipo e
JOIN tipo_equipo t ON e.id_tipoEquipo = t.id_tipo
JOIN estadoequipo s ON e.id_estadoEquipo = s.id_estado
JOIN modelo m ON e.id_modeloEquipo = m.id_modelo
JOIN unidad_organica u ON e.id_unidadOrganicaEquipo = u.id_unidadOrganica;

DESCRIBE usuario;
INSERT INTO usuario(nombre,apellido,edad,contacto,id_perfil,usuario,contrasena)
VALUES('juan','perez',23,'juan@unsm.edu.pe',1,'juan123','123juan');

UPDATE usuario 
SET contrasena = '$2y$10$c3Eqbls./O.hmKghHUieB.RS8Amd4Ju/iSdbf8nr8RvoVhArQl3Sy'
WHERE id_usuario = 4;