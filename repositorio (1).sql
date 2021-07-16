-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2019 a las 19:08:28
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(190) DEFAULT NULL,
  `app` varchar(120) DEFAULT NULL,
  `apm` varchar(120) DEFAULT NULL,
  `usuario` varchar(120) DEFAULT NULL,
  `pass` text,
  `id_cuatrimestre` int(11) DEFAULT NULL,
  `id_tipoUsuario` int(11) DEFAULT NULL,
  `idCarrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idUsuario`, `nombre`, `app`, `apm`, `usuario`, `pass`, `id_cuatrimestre`, `id_tipoUsuario`, `idCarrera`) VALUES
(1, 'Roberto Carlos', 'Estevez', 'Castellanos', '16307017', '16307017', 10, 3, 4),
(2, 'Itza Nicole', 'Barrios', 'Sanchez', '17301084', '17301084', 7, 3, 7),
(3, 'Jose Antonio', 'Velez', 'Tilapa', '16309041', '16309041', 10, 3, 8),
(4, 'Suzana', 'Ayodoro', 'Salas', '18307017', '18307017', 4, 3, 4),
(5, 'Itzel', 'Castrejon', 'Arambula', '16307098', '16307098', 6, 3, 6),
(6, 'Ruben', 'Lezma', 'Adame', '16307026', '16307026', 7, 3, 6),
(7, 'Juan', 'emiliano', 'huizache', 'juan12', '1234', 9, 3, 4),
(8, 'Pruebsq', 'Prueba', 'Pruebs', 'aa', '2345', 10, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idCarrera` int(11) NOT NULL,
  `carrera` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idCarrera`, `carrera`) VALUES
(1, 'Procesos Alimentarios'),
(2, 'Mantenimiento Industrial'),
(3, 'Energias Renovables'),
(4, 'Tecnologias de la informacion'),
(5, 'Turismo'),
(6, 'Mecanica'),
(7, 'Administracion'),
(8, 'Gastronomia'),
(9, 'Logistica Internacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuatrimestre`
--

CREATE TABLE `cuatrimestre` (
  `idCuatrimestre` int(11) NOT NULL,
  `cuatrimestre` varchar(120) DEFAULT NULL,
  `nivel` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuatrimestre`
--

INSERT INTO `cuatrimestre` (`idCuatrimestre`, `cuatrimestre`, `nivel`) VALUES
(1, '1 Cuatrimestre', 'TSU'),
(2, '2 Cuatrimestre', 'TSU'),
(3, '3 Cuatrimestre', 'TSU'),
(4, '4 Cuatrimestre', 'TSU'),
(5, '5 Cuatrimestre', 'TSU'),
(6, '6 Cuatrimestre', 'TSU'),
(7, '7 Cuatrimestre', 'ING'),
(8, '8 Cuatrimestre', 'ING'),
(9, '9 Cuatrimestre', 'ING'),
(10, '10 Cuatrimestre', 'ING'),
(11, '11 Cuatrimestre', 'ING');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directorios`
--

CREATE TABLE `directorios` (
  `idDirectorio` int(11) NOT NULL,
  `directorio` text,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `directorios`
--

INSERT INTO `directorios` (`idDirectorio`, `directorio`, `id_usuario`) VALUES
(7, '../../repositorios/17301084', 2),
(8, '../../repositorios/16307017', 1),
(9, '../../repositorios/juan12', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idProyecto`, `tipo`) VALUES
(1, 'Integradora'),
(2, 'Estadias'),
(3, 'Especial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositoriochanges`
--

CREATE TABLE `repositoriochanges` (
  `idRepositorio` int(11) NOT NULL,
  `nombre` varchar(190) DEFAULT NULL,
  `descripcion` text,
  `filesystem` text,
  `mtecnico` text,
  `musuario` text,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `nvlproyecto` varchar(45) DEFAULT NULL,
  `timechange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usermodify` varchar(45) DEFAULT NULL,
  `comment` text,
  `integrantes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repositoriochanges`
--

INSERT INTO `repositoriochanges` (`idRepositorio`, `nombre`, `descripcion`, `filesystem`, `mtecnico`, `musuario`, `id_proyecto`, `id_usuario`, `version`, `nvlproyecto`, `timechange`, `usermodify`, `comment`, `integrantes`) VALUES
(10, 'eu', 'unooooo', '../repositorios/17301084/eu/version1/adobe photoshop cc 2019.rar', '../repositorios/17301084/eu/version1/documento topicos.docx', '../repositorios/17301084/eu/version1/progit_v2.1.19.pdf', 2, 2, '1', 'Ingenieria', '2019-12-10 01:59:10', '17301084', 'Commit Aleatorio 1', NULL),
(11, 'eu', 'unooooo', '../repositorios/17301084/eu/version2/dental - copia.rar', '../repositorios/17301084/eu/version2/f-50-01-1 protocolo 7.pdf', '../repositorios/17301084/eu/version2/scv  manual de usuario_cele.pdf', 2, 2, '2', 'Ingenieria', '2019-12-10 01:59:10', 'admin', 'Commit Aleatorio 2', NULL),
(12, 'eu', 'unooooo', '../repositorios/17301084/eu/version3/proyectos.rar', '../repositorios/17301084/eu/version3/f-50-01-1 protocolo 7.pdf', '../repositorios/17301084/eu/version3/scv  manual de usuario_cele.pdf', 2, 2, '3', 'Ingenieria', '2019-12-10 01:59:10', 'j_orozco', 'Commit Aleatorio 3', NULL),
(13, 'eu', 'unooooo', '../repositorios/17301084/eu/version3/proyectos.rar', '../repositorios/17301084/eu/version3/f-50-01-1 protocolo 7.pdf', '../repositorios/17301084/eu/version3/scv  manual de usuario_cele.pdf', 2, 2, '4', 'Ingenieria', '2019-12-10 01:59:10', 'j_orozco', 'Commit Aleatorio 4', NULL),
(14, 'eu', 'unooooo', '../repositorios/17301084/eu/version5/perlaapi.rar', '../repositorios/17301084/eu/version5/abstract_paulohimmer_adamebenitez_10-2.pdf', '../repositorios/17301084/eu/version5/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398.pdf', 2, 2, '5', 'Ingenieria', '2019-12-10 01:54:36', 'admin', 'Cambios de proyecto de bases de datos y diseÃ±os', NULL),
(15, 'eu', 'unooooo', '../repositorios/17301084/eu/version6/dental - copia.rar', '../repositorios/17301084/eu/version6/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398 (2).pdf', '../repositorios/17301084/eu/version6/f-50-01-1 protocolo 7 (3).pdf', 2, 2, '6', 'Ingenieria', '2019-12-10 03:30:32', 'admin', 'actualizacion de sistema y ampliacion de funciones\r\n', NULL),
(16, 'RepositorioPrueba', 'dscdscfswefcffffffffffffffffffffffff', '../repositorios/17301084/RepositorioPrueba/version1/perlaapi.rar', '../repositorios/17301084/RepositorioPrueba/version1/f-50-01-1 protocolo 7 (1).pdf', '../repositorios/17301084/RepositorioPrueba/version1/pmoinformatica plantilla estructura de desglose del trabajo (edt) (1).doc', 3, NULL, '1', 'TSU', '2019-12-10 04:51:11', 'admin', NULL, 'Roberto Carlos Estevez'),
(17, 'RepositorioPrueba', 'dscdscfswefcffffffffffffffffffffffff', '../repositorios/17301084/RepositorioPrueba/version1/perlaapi.rar', '../repositorios/17301084/RepositorioPrueba/version1/f-50-01-1 protocolo 7 (1).pdf', '../repositorios/17301084/RepositorioPrueba/version1/pmoinformatica plantilla estructura de desglose del trabajo (edt) (1).doc', 3, 2, '1', 'TSU', '2019-12-10 05:54:00', 'admin', NULL, 'Roberto Carlos Estevez'),
(18, 'Proyecto_almacenados', 'thrthrhrthrhr', '../repositorios/16307017/Proyecto_almacenados/version1/dental - copia.rar', '../repositorios/16307017/Proyecto_almacenados/version1/seminario de administraciÃ³n de rrhh (1).docx', '../repositorios/16307017/Proyecto_almacenados/version1/scv  manual de usuario_cele.pdf', 1, 1, '1', 'Ingenieria', '2019-12-10 05:57:18', 'j_orozco', NULL, 'Jose Antonio Cadena'),
(19, 'RepositorioPrueba', 'Es solo una prueba', '../repositorios/16307017/RepositorioPrueba/version1/perlaapi.rar', '../repositorios/16307017/RepositorioPrueba/version1/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398 (2).pdf', '../repositorios/16307017/RepositorioPrueba/version1/f-50-01-1 protocolo 7 (1).pdf', 3, 1, '1', 'TSU', '2019-12-10 06:15:25', '16307017', NULL, 'Jose Antonio Cadena,Roberto Carlos Estevez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositorios`
--

CREATE TABLE `repositorios` (
  `idRepositorio` int(11) NOT NULL,
  `nombre` varchar(190) DEFAULT NULL,
  `descripcion` text,
  `filesystem` text,
  `mtecnico` text,
  `musuario` text,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `nvlproyecto` varchar(45) DEFAULT NULL,
  `usermodify` varchar(45) DEFAULT NULL,
  `comment` text,
  `integrantes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repositorios`
--

INSERT INTO `repositorios` (`idRepositorio`, `nombre`, `descripcion`, `filesystem`, `mtecnico`, `musuario`, `id_proyecto`, `id_usuario`, `version`, `nvlproyecto`, `usermodify`, `comment`, `integrantes`) VALUES
(6, 'eu', 'unooooo', '../repositorios/17301084/eu/version7/dental - copia.rar', '../repositorios/17301084/eu/version7/documento topicos.docx', '../repositorios/17301084/eu/version7/f-50-01-1 protocolo 7 (1).pdf', 2, 2, '7', 'Ingenieria', 'j_orozco', 'efdwqdqdqd', NULL),
(13, 'RepositorioPrueba', 'dscdscfswefcffffffffffffffffffffffff', '../repositorios/17301084/RepositorioPrueba/version2/proyectos.rar', '../repositorios/17301084/RepositorioPrueba/version2/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398 (2).pdf', '../repositorios/17301084/RepositorioPrueba/version2/f-50-01-1 protocolo 7 (2).pdf', 3, 2, '2', 'TSU', 'j_orozco', 'prueba update', 'Roberto Carlos Estevez'),
(18, 'VentaTamales', 'aaaaaaaaaaaaaaaaaaaaaaaa', '../repositorios/17301084/VentaTamales/version1/perlaapi.rar', '../repositorios/17301084/VentaTamales/version1/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398.pdf', '../repositorios/17301084/VentaTamales/version1/f-50-01-1 protocolo 7 (2).pdf', 1, 2, '1', 'TSU', 'j_orozco', NULL, 'Roberto Carlos Estevez'),
(19, 'Proyecto_almacenados', 'thrthrhrthrhr', '../repositorios/16307017/Proyecto_almacenados/version2/perlaapi.rar', '../repositorios/16307017/Proyecto_almacenados/version2/seminario de administraciÃ³n de rrhh.docx', '../repositorios/16307017/Proyecto_almacenados/version2/f-50-01-1 protocolo 7 (3).pdf', 1, 1, '2', 'Ingenieria', 'j_orozco', 'PRueba dos almacenados', 'Jose Antonio Cadena'),
(20, 'RepositorioPrueba', 'Es solo una prueba', '../repositorios/16307017/RepositorioPrueba/version2/dental - copia.rar', '../repositorios/16307017/RepositorioPrueba/version2/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398.pdf', '../repositorios/16307017/RepositorioPrueba/version2/dialnet-sistemainformaticodegestiondecalidadparalasempresa-5833398.pdf', 3, 1, '2', 'TSU', '16307017', 'Carga de comentario de prueba', 'Jose Antonio Cadena,Roberto Carlos Estevez');

--
-- Disparadores `repositorios`
--
DELIMITER $$
CREATE TRIGGER `after_repositorio_update` AFTER UPDATE ON `repositorios` FOR EACH ROW BEGIN
    
        INSERT INTO repositoriochanges(nombre,descripcion,filesystem,mtecnico,musuario,id_proyecto,id_usuario,version,nvlproyecto,usermodify,
        comment,integrantes)
        VALUES(old.nombre,old.descripcion,old.filesystem,old.mtecnico,old.musuario,old.id_proyecto,old.id_usuario,old.version,old.nvlproyecto,
        old.usermodify,
        old.comment,old.integrantes);
    
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipoUsuario` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipoUsuario`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Docente'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `app` varchar(120) DEFAULT NULL,
  `apm` varchar(120) DEFAULT NULL,
  `usuario` varchar(120) DEFAULT NULL,
  `pass` text,
  `id_tipoUsuario` int(11) DEFAULT NULL,
  `idCarrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `app`, `apm`, `usuario`, `pass`, `id_tipoUsuario`, `idCarrera`) VALUES
(1, 'Administrador', 'Principal', 'Pagina', 'admin', 'admin123', 1, 4),
(2, 'David', 'Castrejon', 'Ortega', 'd_ortega', '1234', 1, 4),
(7, 'Gustavo', 'Orozco', 'Valero', 'j_orozco', '1234', 2, 4),
(8, 'Jose Denys', 'Hernandez', 'Espinosa', 'j_hernandez', '1234', 2, 4),
(9, 'Denisse', 'Castrejon', 'Ortega', 'd_castrejon', '1234', 2, 7),
(10, 'Ricardo Ulises', 'Pino', 'Orozco', 'r_orozco', '1234', 2, 4),
(15, 'Juan Manuel', 'CabaÃ±as ', 'Bibiano', 'j_bibiano', '1234', 2, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `id_cuatrimestre` (`id_cuatrimestre`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `id_tipoUsuario` (`id_tipoUsuario`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `cuatrimestre`
--
ALTER TABLE `cuatrimestre`
  ADD PRIMARY KEY (`idCuatrimestre`);

--
-- Indices de la tabla `directorios`
--
ALTER TABLE `directorios`
  ADD PRIMARY KEY (`idDirectorio`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idProyecto`);

--
-- Indices de la tabla `repositoriochanges`
--
ALTER TABLE `repositoriochanges`
  ADD PRIMARY KEY (`idRepositorio`);

--
-- Indices de la tabla `repositorios`
--
ALTER TABLE `repositorios`
  ADD PRIMARY KEY (`idRepositorio`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `id_tipoUsuario` (`id_tipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cuatrimestre`
--
ALTER TABLE `cuatrimestre`
  MODIFY `idCuatrimestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `directorios`
--
ALTER TABLE `directorios`
  MODIFY `idDirectorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `repositoriochanges`
--
ALTER TABLE `repositoriochanges`
  MODIFY `idRepositorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `repositorios`
--
ALTER TABLE `repositorios`
  MODIFY `idRepositorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_cuatrimestre`) REFERENCES `cuatrimestre` (`idCuatrimestre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`id_tipoUsuario`) REFERENCES `tipousuario` (`idtipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `directorios`
--
ALTER TABLE `directorios`
  ADD CONSTRAINT `directorios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `alumnos` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repositorios`
--
ALTER TABLE `repositorios`
  ADD CONSTRAINT `repositorios_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repositorios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `alumnos` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipoUsuario`) REFERENCES `tipousuario` (`idtipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_tipoUsuario`) REFERENCES `tipousuario` (`idtipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
