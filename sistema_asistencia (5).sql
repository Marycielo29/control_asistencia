-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 14:44:29
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_asistencia`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DASHBOARD` ()  SELECT 
    (SELECT COUNT(*) FROM grados LIMIT 1) as total_grados,
    (SELECT COUNT(*) FROM secciones LIMIT 1) as total_secciones,
    (SELECT COUNT(*) FROM alumnos LIMIT 1) as total_alumnos,
    (SELECT COUNT(*) FROM asistencia LIMIT 1) as total_asistencias,
    (SELECT COUNT(*) FROM usuarios LIMIT 1) as total_usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FiltrarAsistencias` (IN `p_dni` VARCHAR(15), IN `p_fecha_inicio` DATE, IN `p_fecha_fin` DATE)  BEGIN
    SELECT
        asistencia.id_asistencia,
        asistencia.dni,
        asistencia.fecha,
        asistencia.hora,
        alumnos.nombre_alumno,
        grados.nombre_grado,
        secciones.nombre_seccion,
        bimestres.nombre_bimestre,
        CASE
            WHEN asistencia.hora BETWEEN '07:00:00' AND '08:00:00' THEN 'ASISTIO'
            WHEN asistencia.hora BETWEEN '08:01:00' AND '09:00:00' THEN 'TARDE'
            ELSE 'NO ASISTIO'
        END AS estado_asistencia
    FROM
        asistencia
    INNER JOIN
        alumnos ON asistencia.dni = alumnos.dni
    INNER JOIN
        grados ON alumnos.id_grado = grados.id_grado
    INNER JOIN
        secciones ON alumnos.id_seccion = secciones.id_seccion
    INNER JOIN
        bimestres ON alumnos.id_bimestre = bimestres.id_bimestre
    WHERE
        asistencia.dni = p_dni
        AND asistencia.fecha BETWEEN p_fecha_inicio AND p_fecha_fin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_asistencia` (IN `dni_param` VARCHAR(20))  BEGIN
    -- Insertar el DNI y la fecha y hora actuales en la tabla de asistencia
    INSERT INTO asistencia (dni, fecha, hora)
    VALUES (dni_param, CURDATE(), CURTIME());
    
    -- Retornar 1 para indicar que la inserción fue exitosa
    SELECT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CARGAR_SELECT_BIMESTRE` ()  SELECT
	bimestres.id_bimestre, 
	bimestres.nombre_bimestre
FROM
	bimestres$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CARGAR_SELECT_GRADO` ()  SELECT
	grados.id_grado, 
	grados.nombre_grado
FROM
	grados$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CARGAR_SELECT_SECCIONES` ()  SELECT
	secciones.id_seccion, 
	secciones.nombre_seccion
FROM
	secciones$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_ALUMNO` (IN `ID` INT)  BEGIN
    DELETE FROM alumnos WHERE id_alumno = ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_BIMESTRE` (IN `ID` INT)  BEGIN
    DELETE FROM bimestres WHERE id_bimestre = ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_GRADO` (IN `ID` INT)  BEGIN
    DELETE FROM grados WHERE id_grado = ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_SECCION` (IN `ID` INT)  BEGIN
    DELETE FROM secciones WHERE id_seccion = ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_USUARIO` (IN `p_id_usuario` INT)  BEGIN
    DELETE FROM usuarios WHERE id_usuario = p_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ALUMNO` ()  SELECT
	alumnos.id_alumno, 
	alumnos.dni, 
	alumnos.nombre_alumno, 
	alumnos.id_grado, 
	alumnos.id_seccion, 
	alumnos.id_bimestre, 
	grados.nombre_grado, 
	bimestres.nombre_bimestre, 
	secciones.nombre_seccion
FROM
	alumnos
	INNER JOIN
	bimestres
	ON 
		alumnos.id_bimestre = bimestres.id_bimestre
	INNER JOIN
	grados
	ON 
		alumnos.id_grado = grados.id_grado
	INNER JOIN
	secciones
	ON 
		alumnos.id_seccion = secciones.id_seccion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ASISTENCIAS` ()  SELECT
    asistencia.id_asistencia,
    asistencia.dni,
    asistencia.fecha,
    asistencia.hora,
    alumnos.nombre_alumno,
    grados.nombre_grado,
    secciones.nombre_seccion,
    bimestres.nombre_bimestre,
    CASE
        WHEN asistencia.hora BETWEEN '07:00:00' AND '08:00:00' THEN 'ASISTIO'
        WHEN asistencia.hora BETWEEN '08:01:00' AND '09:00:00' THEN 'TARDE'
        ELSE 'NO ASISTIO'
    END AS estado_asistencia
FROM
    asistencia
INNER JOIN
    alumnos ON asistencia.dni = alumnos.dni
INNER JOIN
    grados ON alumnos.id_grado = grados.id_grado
INNER JOIN
    secciones ON alumnos.id_seccion = secciones.id_seccion
INNER JOIN
    bimestres ON alumnos.id_bimestre = bimestres.id_bimestre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_BIMESTRES` ()  SELECT
	bimestres.id_bimestre, 
	bimestres.nombre_bimestre
FROM
	bimestres$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_GRADO` ()  SELECT
	grados.id_grado, 
	grados.nombre_grado
FROM
	grados$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ROL` ()  SELECT 'ADMINISTRADOR' AS usu_rol UNION
    SELECT 'USUARIO'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SECCIONES` ()  SELECT
	secciones.id_seccion, 
	secciones.nombre_seccion
FROM
	secciones$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_USUARIOS` ()  SELECT
	usuarios.id_usuario, 
	usuarios.nombre_usuario, 
	usuarios.usuario, 
	usuarios.contrasena_usuario, 
	usuarios.usu_rol
FROM
	usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ALUMNO` (IN `DNI_ALUMNO` INT(15), IN `NOMBRE_ALUMNO` VARCHAR(100), IN `ID_GRADO` VARCHAR(100), IN `ID_SECCION` VARCHAR(100), IN `ID_BIMESTRE` VARCHAR(100))  BEGIN
    DECLARE CANTIDAD INT;

    -- Verificamos si el alumno con el DNI especificado existe
    SELECT COUNT(*) INTO CANTIDAD FROM alumnos WHERE dni = DNI_ALUMNO;

    -- Si existe el alumno, lo modificamos
    IF CANTIDAD > 0 THEN
        UPDATE alumnos
        SET nombre_alumno = NOMBRE_ALUMNO, 
            id_grado = ID_GRADO, 
            id_seccion = ID_SECCION, 
            id_bimestre = ID_BIMESTRE
        WHERE dni = DNI_ALUMNO;
        -- Retorna 1 si la modificación fue exitosa
        SELECT 1;
    ELSE
        -- Retorna 2 si no existe un alumno con ese DNI
        SELECT 2;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_BIMESTRE` (IN `ID` INT, IN `NBIMESTRE` VARCHAR(50))  BEGIN
    DECLARE BIMESTRE_ACTUAL VARCHAR(50);
    DECLARE CANTIDAD INT;

    -- Obtener el nombre actual del bimestre basado en el ID
    SET BIMESTRE_ACTUAL := (SELECT nombre_bimestre FROM bimestres WHERE id_bimestre = ID);

    -- Verificar si el nombre actual es igual al nuevo nombre
    IF BIMESTRE_ACTUAL = NBIMESTRE THEN
        -- Si el nombre es igual, no se necesita realizar ninguna acción
        SELECT 1; -- No hay cambios, pero operación exitosa
    ELSE
        -- Contamos cuántos bimestres existen con el nuevo nombre propuesto
        SET CANTIDAD := (SELECT COUNT(*) FROM bimestres WHERE nombre_bimestre = NBIMESTRE);
        
        -- Si no existe ningún bimestre con ese nombre, actualizamos el bimestre
        IF CANTIDAD = 0 THEN
            UPDATE bimestres SET
                nombre_bimestre = NBIMESTRE
            WHERE id_bimestre = ID;
            SELECT 1; -- Operación exitosa
        ELSE
            -- Si ya existe un bimestre con ese nombre, retornamos 2 como advertencia
            SELECT 2; -- Ya existe un bimestre con ese nombre
        END IF;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_GRADO` (IN `p_id_grado` INT, IN `p_nombre_grado_nuevo` VARCHAR(50))  BEGIN
    DECLARE NOMBRE_ACTUAL VARCHAR(50);
    DECLARE CANTIDAD INT;

    -- Obtener el nombre actual del grado basado en el ID
    SET NOMBRE_ACTUAL := (SELECT nombre_grado FROM grados WHERE id_grado = p_id_grado);

    -- Verificar si el nombre actual es igual al nuevo nombre
    IF NOMBRE_ACTUAL = p_nombre_grado_nuevo THEN
        -- Si el nombre es igual, no se necesita realizar ninguna acción
        SELECT 1; -- No hay cambios, pero operación exitosa
    ELSE
        -- Contamos cuántos grados existen con el nuevo nombre propuesto
        SET CANTIDAD := (SELECT COUNT(*) FROM grados WHERE nombre_grado = p_nombre_grado_nuevo);

        -- Si no existe ningún grado con ese nombre, actualizamos el grado
        IF CANTIDAD = 0 THEN
            UPDATE grados SET
                nombre_grado = p_nombre_grado_nuevo
            WHERE id_grado = p_id_grado;
            SELECT 1; -- Operación exitosa
        ELSE
            -- Si ya existe un grado con ese nombre, retornamos 2 como advertencia
            SELECT 2; -- Ya existe un grado con ese nombre
        END IF;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_SECCION` (IN `ID` INT, IN `NSECCION` VARCHAR(50))  BEGIN
    DECLARE SECCION_ACTUAL VARCHAR(50);
    DECLARE CANTIDAD INT;

    -- Obtener el nombre actual de la sección basado en el ID
    SET @SECCION_ACTUAL := (SELECT nombre_seccion FROM secciones WHERE id_seccion = ID);

    -- Verificar si el nombre actual es igual al nuevo nombre
    IF @SECCION_ACTUAL = NSECCION THEN
        -- Si el nombre es igual, no se necesita realizar ninguna acción
        SELECT 1; -- No hay cambios, pero operación exitosa
    ELSE
        -- Contamos cuántas secciones existen con el nuevo nombre propuesto
        SET @CANTIDAD := (SELECT COUNT(*) FROM secciones WHERE nombre_seccion = NSECCION);
        
        -- Si no existe ninguna sección con ese nombre, actualizamos la sección
        IF @CANTIDAD = 0 THEN
            UPDATE secciones SET
                nombre_seccion = NSECCION
            WHERE id_seccion = ID;
            SELECT 1; -- Operación exitosa
        ELSE
            -- Si ya existe una sección con ese nombre, retornamos 2 como advertencia
            SELECT 2; -- Ya existe una sección con ese nombre
        END IF;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ALUMNO` (IN `DNI_ALUMNO` VARCHAR(15), IN `NOMBRE_ALUMNO` VARCHAR(100), IN `ID_GRADO` INT, IN `ID_SECCION` INT, IN `ID_BIMESTRE` INT)  BEGIN
    DECLARE CANTIDAD INT;

    -- Contamos cuántos alumnos existen con el mismo DNI
    SELECT COUNT(*) INTO CANTIDAD FROM alumnos WHERE dni = DNI_ALUMNO;

    -- Si no existe ningún alumno con ese DNI, insertamos el nuevo alumno
    IF CANTIDAD = 0 THEN
        INSERT INTO alumnos(dni, nombre_alumno, id_grado, id_seccion, id_bimestre) 
        VALUES (DNI_ALUMNO, NOMBRE_ALUMNO, ID_GRADO, ID_SECCION, ID_BIMESTRE);
        -- Retorna 1 si la inserción fue exitosa
        SELECT 1;
    ELSE
        -- Retorna 2 si ya existe un alumno con ese DNI
        SELECT 2;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ASISTENCIA` (IN `dni_param` VARCHAR(20))  BEGIN
    DECLARE hora_registro TIME;
    DECLARE estado_asistencia VARCHAR(20);

    -- Verificar si ya se registró la asistencia del DNI en el día de hoy
    IF EXISTS (SELECT 1 FROM asistencia WHERE dni = dni_param AND fecha = CURDATE()) THEN
        -- Si ya se registró, devolver 2 (Ya registrado)
        SELECT 2 AS respuesta;
    ELSE
        -- Insertar el DNI y la fecha y hora actuales en la tabla de asistencia
        INSERT INTO asistencia (dni, fecha, hora)
        VALUES (dni_param, CURDATE(), CURTIME());

        -- Obtener la hora de registro para determinar el estado de la asistencia
        SET hora_registro = CURTIME();

        -- Verificar el estado según la hora de registro
        IF hora_registro BETWEEN '07:00:00' AND '08:00:00' THEN
            SET estado_asistencia = 'Asistió';
        ELSEIF hora_registro BETWEEN '08:01:00' AND '08:10:00' THEN
            SET estado_asistencia = 'Tarde';
        ELSE
            SET estado_asistencia = 'No asistió';
        END IF;

        -- Devolver el estado de la asistencia con respuesta 1 (Insertado correctamente)
        SELECT 1 AS respuesta, estado_asistencia;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_BIMESTRE` (IN `NBIMESTRE` VARCHAR(50))  BEGIN
    DECLARE CANTIDAD INT;

    -- Contamos cuántos bimestres existen con el mismo nombre
    SELECT COUNT(*) INTO CANTIDAD FROM bimestres WHERE nombre_bimestre = NBIMESTRE;

    -- Si no existe ningún bimestre con ese nombre, insertamos el nuevo bimestre
    IF CANTIDAD = 0 THEN
        INSERT INTO bimestres(nombre_bimestre) VALUES (NBIMESTRE);
        -- Retorna 1 si la inserción fue exitosa
        SELECT 1;
    ELSE
        -- Retorna 2 si ya existe un bimestre con ese nombre
        SELECT 2;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_GRADO` (IN `p_nombre_grado` VARCHAR(50))  BEGIN
    DECLARE CANTIDAD INT;

    -- Contamos cuántos grados existen con el mismo nombre
    SELECT COUNT(*) INTO CANTIDAD
    FROM grados
    WHERE nombre_grado = p_nombre_grado;

    -- Si no existe ningún grado con ese nombre, insertamos el nuevo grado
    IF CANTIDAD = 0 THEN
        INSERT INTO grados(nombre_grado)
        VALUES (p_nombre_grado);
        
        -- Retorna 1 si la inserción fue exitosa
        SELECT 1 AS estado;
    ELSE
        -- Retorna 2 si ya existe un grado con ese nombre
        SELECT 2 AS estado;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_SECCION` (IN `NSECCION` VARCHAR(50))  BEGIN
    DECLARE CANTIDAD INT;

    -- Contamos cuántas secciones existen con el mismo nombre
    SELECT COUNT(*) INTO CANTIDAD FROM secciones WHERE nombre_seccion = NSECCION;

    -- Si no existe ninguna seccion con ese nombre, insertamos la nueva seccion
    IF CANTIDAD = 0 THEN
        INSERT INTO secciones(nombre_seccion) VALUES (NSECCION);
        -- Retorna 1 si la inserción fue exitosa
        SELECT 1;
    ELSE
        -- Retorna 2 si ya existe una seccion con ese nombre
        SELECT 2;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIOS` (IN `nombre_usuario` VARCHAR(255), IN `nuevo_usuario` VARCHAR(255), IN `contrasena_usuario` VARCHAR(255), IN `usu_rol` VARCHAR(50))  BEGIN
    DECLARE CANTIDAD INT;

    -- Contar cuántos usuarios tienen el mismo 'usuario' que el parámetro de entrada 'nuevo_usuario'
    SELECT COUNT(*) INTO CANTIDAD FROM usuarios WHERE usuario = nuevo_usuario;

    -- Verificar si el usuario ya existe
    IF CANTIDAD = 0 THEN
        -- Insertar nuevo usuario
        INSERT INTO usuarios(nombre_usuario, usuario, contrasena_usuario, usu_rol) 
        VALUES (nombre_usuario, nuevo_usuario, contrasena_usuario, usu_rol);

        -- Retornar éxito
        SELECT 1 AS resultado;
    ELSE
        -- Retornar que el usuario ya existe y mostrar el usuario existente
        SELECT 2 AS resultado, nuevo_usuario AS usuario_existente;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USU` VARCHAR(50))  BEGIN
    SELECT
        usuarios.id_usuario, 
        usuarios.nombre_usuario, 
        usuarios.usuario, 
        usuarios.contrasena_usuario,
        usuarios.usu_rol
    FROM
        usuarios
    WHERE 
        usuario = BINARY USU; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_bimestre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `dni`, `nombre_alumno`, `id_grado`, `id_seccion`, `id_bimestre`) VALUES
(1, '73984214', 'BRUNEXITO TU CHERITOA', 1, 1, 1),
(4, '10203040', 'PRUEBA2', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `dni`, `fecha`, `hora`) VALUES
(19, '73984214', '2024-11-14', '12:47:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bimestres`
--

CREATE TABLE `bimestres` (
  `id_bimestre` int(11) NOT NULL,
  `nombre_bimestre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bimestres`
--

INSERT INTO `bimestres` (`id_bimestre`, `nombre_bimestre`) VALUES
(1, 'PRUEBA123A'),
(2, 'dataopen'),
(3, 'PRUEBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, 'PRIMEROABCA'),
(7, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL,
  `nombre_seccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre_seccion`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contrasena_usuario` varchar(255) NOT NULL,
  `usu_rol` enum('ADMINISTRADOR','USUARIO') NOT NULL DEFAULT 'USUARIO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `usuario`, `contrasena_usuario`, `usu_rol`) VALUES
(1, 'MARY TU XIKITA', 'admin', '$2y$12$C.1yXkkqqs45tHKfUJC4UuOfpRhB5aEQjQkYNVlnbIH/GXCUbeawi', 'ADMINISTRADOR'),
(2, 'BRUNO', 'BRUNO', '$2y$12$r39UAl/oljwznClk2feiGuaPzea8zTRXRIi.gEcM.Ij9Gt7Jwui0K', 'ADMINISTRADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_bimestre` (`id_bimestre`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `bimestres`
--
ALTER TABLE `bimestres`
  ADD PRIMARY KEY (`id_bimestre`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `bimestres`
--
ALTER TABLE `bimestres`
  MODIFY `id_bimestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`),
  ADD CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`id_bimestre`) REFERENCES `bimestres` (`id_bimestre`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `alumnos` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
