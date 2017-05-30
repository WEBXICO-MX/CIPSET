-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-05-2017 a las 14:45:15
-- Versión del servidor: 5.6.35-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cipset`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarios_capacitaciones`
--

CREATE TABLE IF NOT EXISTS `calendarios_capacitaciones` (
  `ID` int(11) NOT NULL,
  `CAPACITACION_ID` int(11) DEFAULT NULL,
  `FECHA_INICIO` date DEFAULT NULL,
  `FECHA_FIN` date DEFAULT NULL,
  `USUARIO_REGISTRO` int(11) DEFAULT NULL,
  `USUARIO_MODIFICO` int(11) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_2` (`CAPACITACION_ID`),
  KEY `INDEX_1` (`ID`),
  KEY `FK_REFERENCE_11` (`USUARIO_REGISTRO`),
  KEY `FK_REFERENCE_12` (`USUARIO_MODIFICO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calendarios_capacitaciones`
--

INSERT INTO `calendarios_capacitaciones` (`ID`, `CAPACITACION_ID`, `FECHA_INICIO`, `FECHA_FIN`, `USUARIO_REGISTRO`, `USUARIO_MODIFICO`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 12, '2016-07-30', '2016-08-30', 1, 2, '2016-06-15 11:49:17', '2016-07-15 12:11:52', b'1'),
(2, 12, '2016-09-30', '2016-10-29', 2, 2, '2016-07-15 12:12:28', '2016-07-15 12:13:50', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE IF NOT EXISTS `capacitaciones` (
  `ID` int(11) NOT NULL,
  `CATEGORIA_CAPACITACION_ID` int(11) DEFAULT NULL,
  `TIPO_CAPACITACION_ID` int(11) DEFAULT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `DESCRIPCION` text,
  `IMG` varchar(50) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_3` (`TIPO_CAPACITACION_ID`),
  KEY `INDEX_2` (`CATEGORIA_CAPACITACION_ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `capacitaciones`
--

INSERT INTO `capacitaciones` (`ID`, `CATEGORIA_CAPACITACION_ID`, `TIPO_CAPACITACION_ID`, `NOMBRE`, `DESCRIPCION`, `IMG`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 1, 1, 'Negociación', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', '', '2016-06-10 14:58:42', NULL, b'1'),
(2, 1, 1, 'Productividad en Ventas con PNL', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', '', '2016-06-10 15:01:07', '2016-06-10 15:02:12', b'1'),
(3, 1, 1, 'Calidad en el Servicio', '', NULL, '2016-06-14 13:15:30', NULL, b'1'),
(4, 1, 1, 'Liderazgo', '', NULL, '2016-06-14 13:15:43', NULL, b'1'),
(5, 1, 1, 'Trabajo en Equipo', '', NULL, '2016-06-14 13:15:57', '2016-06-14 13:16:07', b'1'),
(6, 1, 1, 'Equipos de Alto Desempeño', '', NULL, '2016-06-14 13:16:19', NULL, b'1'),
(7, 1, 1, 'Círculos de Calidad', '', NULL, '2016-06-14 13:16:29', NULL, b'1'),
(8, 1, 1, 'Comunicación Efectiva', '', NULL, '2016-06-14 13:16:39', NULL, b'1'),
(9, 1, 1, 'Manejo de Conflictos', '', NULL, '2016-06-14 13:16:48', NULL, b'1'),
(10, 1, 1, 'Juntas Efectivas', '', NULL, '2016-06-14 13:16:58', NULL, b'1'),
(11, 1, 1, 'El Ciclo del Éxito', '', NULL, '2016-06-14 13:17:08', NULL, b'1'),
(12, 1, 1, 'Administración del Tiempo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'img/capacitaciones/12.jpg', '2016-06-14 13:17:17', '2016-06-15 12:03:27', b'1'),
(13, 1, 1, 'Programación Neurolingüística', '', NULL, '2016-06-14 13:17:34', NULL, b'1'),
(14, 1, 1, 'Coaching', '', NULL, '2016-06-14 13:17:45', NULL, b'1'),
(15, 1, 1, 'Certificación de Instructores', '', NULL, '2016-06-14 13:17:55', NULL, b'1'),
(16, 1, 3, 'Habilidades Gerenciales', '', NULL, '2016-06-14 13:18:07', NULL, b'1'),
(17, 1, 3, 'Mandos Medios', '', NULL, '2016-06-14 13:18:20', NULL, b'1'),
(18, 1, 3, 'Ventas', '', NULL, '2016-06-14 13:18:32', NULL, b'1'),
(19, 2, 1, '7 Herramientas Estadísticas Básicas', '', NULL, '2016-06-16 07:53:52', NULL, b'1'),
(20, 2, 1, '7 Nuevas Herramientas', '', NULL, '2016-06-16 07:54:06', NULL, b'1'),
(21, 2, 1, 'Análisis de Solución Problemas', '', NULL, '2016-06-16 07:54:18', NULL, b'1'),
(22, 2, 1, 'Ruta de Calidad (QC Story)', '', NULL, '2016-06-16 07:54:32', NULL, b'1'),
(23, 2, 1, '8 Disciplinas', '', NULL, '2016-06-16 07:54:45', NULL, b'1'),
(24, 2, 1, 'FMEA: Análisis del Modo y Efecto de la Falla', '', NULL, '2016-06-16 07:54:57', NULL, b'1'),
(25, 2, 1, 'SPC: Control Estadístico de Proceso', '', NULL, '2016-06-16 07:55:09', NULL, b'1'),
(26, 2, 1, 'APQP: Planeación Avanzada de la Calidad', '', NULL, '2016-06-16 07:55:20', NULL, b'1'),
(27, 2, 1, 'PPAP: Proceso de Aprobación de Partes', '', NULL, '2016-06-16 07:55:32', NULL, b'1'),
(28, 2, 1, 'MSA: Análisis del Sistema de Medición', '', NULL, '2016-06-16 07:55:43', NULL, b'1'),
(29, 2, 3, 'Core Tools', '', NULL, '2016-06-16 07:55:55', NULL, b'1'),
(30, 3, 1, 'Introducción a Lean Manufacturing', '', NULL, '2016-06-16 07:56:56', NULL, b'1'),
(31, 3, 1, 'Lean Accounting', '', NULL, '2016-06-16 07:57:08', NULL, b'1'),
(32, 3, 1, 'Lean Six Sigma', '', NULL, '2016-06-16 07:58:24', NULL, b'1'),
(33, 3, 1, 'Taller de 5 S´s y Control Visual', '', NULL, '2016-06-16 07:58:37', NULL, b'1'),
(34, 3, 1, 'Value Stream Mapping', '', NULL, '2016-06-16 07:58:49', NULL, b'1'),
(35, 3, 1, 'Kan Ban', '', NULL, '2016-06-16 07:59:01', NULL, b'1'),
(36, 3, 1, 'SMED', '', NULL, '2016-06-16 07:59:13', NULL, b'1'),
(37, 3, 1, 'Poka Yoke', '', NULL, '2016-06-16 07:59:25', NULL, b'1'),
(38, 3, 1, 'Mantenimiento Productivo Total (TPM)', '', NULL, '2016-06-16 07:59:36', NULL, b'1'),
(39, 3, 1, 'Metodología del Pensamiento Esbelto', '', NULL, '2016-06-16 07:59:49', NULL, b'1'),
(40, 3, 1, 'Identificación y Eliminación de Desperdicios', '', NULL, '2016-06-16 08:00:27', NULL, b'1'),
(41, 3, 1, 'Celdas de Manufactura', '', NULL, '2016-06-16 08:04:04', NULL, b'1'),
(42, 3, 1, 'Estandarización de Operaciones', '', NULL, '2016-06-16 08:04:23', NULL, b'1'),
(43, 3, 1, 'Tack Time y Balanceo de líneas', '', NULL, '2016-06-16 08:04:36', NULL, b'1'),
(44, 3, 1, 'Mejora Continua (Kaizen)', '', NULL, '2016-06-16 08:04:47', NULL, b'1'),
(45, 3, 1, 'Mejoras Rápidas (Short Kaizen)', '', NULL, '2016-06-16 08:04:59', NULL, b'1'),
(46, 3, 3, 'Lean Manufacturing', '', NULL, '2016-06-16 08:05:39', NULL, b'1'),
(47, 4, 1, 'Seguridad, Salud en el Trabajo y Protección Ambiental', '', NULL, '2016-06-16 08:13:12', NULL, b'1'),
(48, 4, 1, 'Introducción al Sistema PEMEX-SSPA', '', NULL, '2016-06-16 08:13:40', NULL, b'1'),
(49, 4, 1, 'Rig Pass', '', NULL, '2016-06-16 08:13:54', NULL, b'1'),
(50, 4, 1, 'Prevención, Protección y Combate de Incendios', '', NULL, '2016-06-16 08:14:37', NULL, b'1'),
(51, 4, 1, 'Formación de Brigadas Contra Incendios', '', NULL, '2016-06-16 08:14:50', NULL, b'1'),
(52, 4, 1, 'Trabajo en áreas contaminadas con H2s', '', NULL, '2016-06-16 08:17:53', NULL, b'1'),
(53, 4, 1, 'Anexo SSPA', '', NULL, '2016-06-16 08:18:14', NULL, b'1'),
(54, 4, 1, 'Estándar de Competencia ECO391 "Verificación de las condiciones de seguridad e higiene en los centro', '', NULL, '2016-06-16 08:19:08', NULL, b'1'),
(55, 4, 1, 'Procesos y Procedimientos Críticos de PEMEX', '', NULL, '2016-06-16 08:19:29', NULL, b'1'),
(56, 4, 1, 'Planes de Respuesta a Emergencias', '', NULL, '2016-06-16 08:20:20', NULL, b'1'),
(57, 4, 1, 'Primeros auxilios y RCP', '', NULL, '2016-06-16 08:20:32', NULL, b'1'),
(58, 4, 3, 'Diplomado Sistema PEMEX- SSPA', '', NULL, '2016-06-16 08:20:44', NULL, b'1'),
(59, 4, 2, 'Taller de disciplina operativa', '', NULL, '2016-06-16 08:20:57', NULL, b'1'),
(60, 4, 2, 'Taller de auditorias efectivas', '', NULL, '2016-06-16 08:21:10', NULL, b'1'),
(61, 4, 2, 'Taller básico de análisis de causa raíz', '', NULL, '2016-06-16 08:21:23', NULL, b'1'),
(62, 4, 2, 'Taller de análisis de seguridad del trabajo', '', NULL, '2016-06-16 08:21:33', NULL, b'1'),
(63, 4, 2, 'Taller de tecnología del proceso-integración del paquete tecnológico', '', NULL, '2016-06-16 08:21:56', NULL, b'1'),
(64, 4, 2, 'Taller básico de análisis de riesgos del proceso', '', NULL, '2016-06-16 08:22:07', NULL, b'1'),
(65, 4, 2, 'Taller de anexo SSPA', '', NULL, '2016-06-16 08:22:19', NULL, b'1'),
(66, 5, 1, 'Integridad mecánica de equipo estático y Dinámico', '', NULL, '2016-06-16 08:23:12', NULL, b'1'),
(67, 5, 1, 'Análisis de Elementos Finitos', '', NULL, '2016-06-16 08:23:24', NULL, b'1'),
(68, 5, 1, 'Análisis de flexibilidad', '', NULL, '2016-06-16 08:23:36', NULL, b'1'),
(69, 5, 1, 'Inspección Basada en Riesgos RBI', '', NULL, '2016-06-16 08:23:46', NULL, b'1'),
(70, 5, 1, 'Inspección de Plantas Industriales', '', NULL, '2016-06-16 08:23:56', NULL, b'1'),
(71, 5, 1, 'Exámenes No destructivos', '', NULL, '2016-06-16 08:24:08', NULL, b'1'),
(72, 5, 1, 'Verificación de Recipientes Sujetos a Presión', '', NULL, '2016-06-16 08:24:19', NULL, b'1'),
(73, 5, 1, 'Ingeniería de Plantas Industriales', '', NULL, '2016-06-16 08:24:31', NULL, b'1'),
(74, 5, 1, 'Maquetas Electrónicas (METI)', '', NULL, '2016-06-16 08:24:43', NULL, b'1'),
(75, 5, 1, 'Levantamiento con Scanner láser de última Generación', '', NULL, '2016-06-16 08:24:56', '2016-06-16 08:25:10', b'1'),
(76, 5, 1, 'Supervisión de Obra Mecánica', '', NULL, '2016-06-16 08:25:20', NULL, b'1'),
(77, 5, 3, 'Integridad mecánica y aseguramiento de calidad', '', NULL, '2016-06-16 08:25:33', NULL, b'1'),
(78, 6, 1, 'Formación de Perforador', '', NULL, '2016-06-16 08:26:13', NULL, b'1'),
(79, 6, 1, 'Conexiones superficiales de Control', '', NULL, '2016-06-16 08:26:24', NULL, b'1'),
(80, 6, 1, 'Operación con Sistemas de Elevación', '', NULL, '2016-06-16 08:26:37', NULL, b'1'),
(81, 6, 1, 'Operaciones de Perforación', '', NULL, '2016-06-16 08:26:57', NULL, b'1'),
(82, 6, 1, 'Operaciones de Perforación Direccional', '', NULL, '2016-06-16 08:27:07', NULL, b'1'),
(83, 6, 1, 'Sartas y Barrenas', '', NULL, '2016-06-16 08:27:18', NULL, b'1'),
(84, 6, 1, 'Seguridad de izaje y maniobras, Trabajos en altura', '', NULL, '2016-06-16 08:27:34', NULL, b'1'),
(85, 6, 1, 'Hidráulica básica aplicada a instrumentos', '', NULL, '2016-06-16 08:27:45', NULL, b'1'),
(86, 6, 1, 'Operaciones de Terminación y Reparación de Pozos (TRP)', '', NULL, '2016-06-16 08:27:57', '2016-06-16 08:28:27', b'1'),
(87, 7, 1, 'Actualización de Mantenimiento Mecánico', '', NULL, '2016-06-16 08:29:11', NULL, b'1'),
(88, 7, 1, 'Actualización de Mantenimiento Eléctrico', '', NULL, '2016-06-16 08:29:22', NULL, b'1'),
(89, 7, 1, 'Motores Cummins serie QST', '', NULL, '2016-06-16 08:29:37', NULL, b'1'),
(90, 7, 1, 'Motores EMD', '', NULL, '2016-06-16 08:30:23', NULL, b'1'),
(91, 7, 1, 'Operación de equipos auxiliares de perforación', '', NULL, '2016-06-16 08:31:15', NULL, b'1'),
(92, 7, 1, 'Mantenimiento a casetas PCR', '', NULL, '2016-06-16 08:32:51', NULL, b'1'),
(93, 7, 1, 'Mantenimiento a malacates principal y de sondeo', '', NULL, '2016-06-16 08:33:10', NULL, b'1'),
(94, 7, 1, 'Mantenimiento a bombas de lodos', '', NULL, '2016-06-16 08:33:22', NULL, b'1'),
(95, 7, 1, 'Técnicas de Supervisión del Mantenimiento', '', NULL, '2016-06-16 08:33:33', NULL, b'1'),
(96, 8, 1, 'Básico de soldadura con arco eléctrico', '', NULL, '2016-06-16 08:34:17', NULL, b'1'),
(97, 8, 1, 'Certificación de soldadores', '', NULL, '2016-06-16 08:34:29', NULL, b'1'),
(98, 8, 1, 'Supervisor de Línea de Acero', '', NULL, '2016-06-16 08:34:43', NULL, b'1'),
(99, 8, 1, 'Presiones y muestreo de fondo', '', 'img/capacitaciones/99.jpg', '2016-06-16 08:37:23', NULL, b'1'),
(100, 8, 1, 'Mantenimiento a Sistemas Neumático (silos y planta', '', 'img/capacitaciones/100.jpg', '2016-06-16 08:37:32', NULL, b'1'),
(101, 8, 1, 'Malacate de producción línea de acero', '', 'img/capacitaciones/101.jpg', '2016-06-16 08:38:26', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_capacitaciones`
--

CREATE TABLE IF NOT EXISTS `categorias_capacitaciones` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `DESCRIPCION` varchar(500) DEFAULT NULL,
  `IMG` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_capacitaciones`
--

INSERT INTO `categorias_capacitaciones` (`ID`, `NOMBRE`, `DESCRIPCION`, `IMG`, `ACTIVO`) VALUES
(1, 'Desarrollo Humano', '<p>En la actualidad la capacitaci&oacute;n es la respuesta a la necesidad que tienen las empresas o instituciones de contar con un personal calificado y productivo, es el desarrollo de tareas con el fin de mejorar el rendimiento productivo, al elevar la capacidad de los trabajadores mediante la mejora de las habilidades, actitudes y conocimientos.</p>\r\n', 'img/categorias/1.jpg', b'1'),
(2, 'Herramientas de Calidad', '<p>Si bien, no solo basta con tener un personal con iniciativa entregado al servicio; para el &eacute;xito de nuestros objetivos a corto, mediano y largo plazo; es necesario dotarlos del conocimiento en el uso de las herramientas de calidad para la medir y controlar nuestras operaciones; estas herramientas se caracterizan por dar informaci&oacute;n para poder incrementar el grado de acierto en la toma decisiones para la soluci&oacute;n de problemas y con ello incrementar la productividad con alt', 'img/categorias/2.jpg', b'1'),
(3, 'Lean manufacturing', '<p>Es una filosof&iacute;a que se apoya en varias t&eacute;cnicas, para lograr la reducci&oacute;n o eliminaci&oacute;n, de todo tipo de procesos o actividades que usan m&aacute;s recursos de los estrictamente necesarios. &iquest;En qu&eacute; se diferencia de otras estrategias? Quiz&aacute;s su filosof&iacute;a de &ldquo;analizar&rdquo;, &ldquo;pensar&rdquo; y &ldquo;actuar&rdquo;; en la experiencia y know how de aquellos trabajadores que est&aacute;n en contacto directo con el proceso y produc', 'img/categorias/3.jpg', b'1'),
(4, 'Seguridad industrial', '<p>Es un campo necesario y obligatorio que todas las empresas deben cumplir desde su inicio; si bien estas actividades revisten mayor riesgo porque van de la mano con el crecimiento de la empresa ya sea de producci&oacute;n o servicios, en donde se estudia, se aplican y renuevan constantemente los procesos para sus mejoras. Por lo que toda industria debe cumplir con una serie de normas y condiciones que minimicen los riesgos al personal. Instalaciones y medio ambiente.</p>\r\n', 'img/categorias/4.jpg', b'1'),
(5, 'Integridad Mecánica y Aseguramiento de Calidad', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'img/categorias/5.jpg', b'1'),
(6, 'Perforación', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'img/categorias/6.jpg', b'1'),
(7, 'Mantenimiento a equipos de perforación', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'img/categorias/7.jpg', b'1'),
(8, 'Servicio de apoyo a pozos', '<p>en construccion</p>\r\n', 'img/categorias/8.jpg', b'1'),
(9, 'Ingeniería en desarrollo de software', '<p>La Ingenier&iacute;a de Software es una disciplina que lidia con el dise&ntilde;o, desarrollo, operaci&oacute;n y mantenimiento de software. La gran diferencia entre un Ingeniero de software y un Programador, es que el Programador generalmente solamente se preocupa por depurar errores, implementar nuevas funcionalidades, y darle mantenimiento general a la aplicaci&oacute;n.</p>\r\n', 'img/categorias/9.jpg', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `ID` int(11) NOT NULL,
  `SECTOR_PRODUCTIVO_ID` int(11) DEFAULT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_2` (`SECTOR_PRODUCTIVO_ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`ID`, `SECTOR_PRODUCTIVO_ID`, `NOMBRE`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 19, 'Instituto Tecnológico de Villahermosa (ITVH)', '2016-06-19 09:12:20', NULL, b'1'),
(2, 22, 'cipsa', '2016-06-20 12:40:37', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`ID`, `NOMBRE`, `ACTIVO`) VALUES
(1, 'Nuevos', b'1'),
(2, 'Revisados', b'1'),
(3, 'Inscritos', b'1'),
(4, 'Históricos', b'1'),
(5, 'No inscritos', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_comunicacion`
--

CREATE TABLE IF NOT EXISTS `medios_comunicacion` (
  `ID` int(11) NOT NULL,
  `PERSONA_ID` int(11) DEFAULT NULL,
  `TIPO_MEDIO_COMUNICACION_ID` int(11) DEFAULT NULL,
  `VALOR` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_3` (`TIPO_MEDIO_COMUNICACION_ID`),
  KEY `INDEX_2` (`PERSONA_ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medios_comunicacion`
--

INSERT INTO `medios_comunicacion` (`ID`, `PERSONA_ID`, `TIPO_MEDIO_COMUNICACION_ID`, `VALOR`, `ACTIVO`) VALUES
(1, 1, 1, 'weiss.uttab@gmail.com', b'1'),
(2, 1, 2, '9931187882', b'1'),
(3, 2, 1, 'alberto19631206@hotmail.com', b'1'),
(4, 2, 2, '9932412468', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `AP_PATERNO` varchar(50) DEFAULT NULL,
  `AP_MATERNO` varchar(50) DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `SEXO` char(1) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID`, `NOMBRE`, `AP_PATERNO`, `AP_MATERNO`, `FECHA_NACIMIENTO`, `SEXO`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 'Roberto Eder', 'Weiss', 'Juárez', '1987-04-13', 'M', '2016-06-19 09:25:26', NULL, b'1'),
(2, 'Alberto', 'de la Cruz', 'Cruz', '1963-12-06', 'M', '2016-06-20 12:40:43', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_capacitaciones`
--

CREATE TABLE IF NOT EXISTS `registros_capacitaciones` (
  `ID` int(11) NOT NULL,
  `CALENDARIO_CAPACITACION_ID` int(11) DEFAULT NULL,
  `PERSONA_ID` int(11) DEFAULT NULL,
  `EMPRESA_ID` int(11) DEFAULT NULL,
  `ESTATUS_ID` int(11) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_5` (`ESTATUS_ID`),
  KEY `INDEX_4` (`EMPRESA_ID`),
  KEY `INDEX_3` (`PERSONA_ID`),
  KEY `INDEX_2` (`CALENDARIO_CAPACITACION_ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registros_capacitaciones`
--

INSERT INTO `registros_capacitaciones` (`ID`, `CALENDARIO_CAPACITACION_ID`, `PERSONA_ID`, `EMPRESA_ID`, `ESTATUS_ID`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 1, 1, 1, 2, '2016-06-19 09:25:26', '2016-07-01 15:09:59', b'1'),
(2, 1, 2, 2, 2, '2016-06-20 12:40:43', '2016-06-20 12:42:46', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores_productivos`
--

CREATE TABLE IF NOT EXISTS `sectores_productivos` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sectores_productivos`
--

INSERT INTO `sectores_productivos` (`ID`, `NOMBRE`, `ACTIVO`) VALUES
(1, 'Turismo', b'1'),
(2, 'Transporte', b'1'),
(3, 'Tecnologías de la Informació', b'1'),
(4, 'Sociedades Cooperativas', b'1'),
(5, 'Social', b'1'),
(6, 'Servicios Profesionales y Técnicos', b'1'),
(7, 'Seguridad Pública', b'1'),
(8, 'Químico', b'1'),
(9, 'Procesamiento de alimentos', b'1'),
(10, 'Prendas de Vestir, Textil, Cuero y Calzado', b'1'),
(11, 'Petróleo y Gas', b'1'),
(12, 'Minería', b'1'),
(13, 'Maquilas y Manufactura', b'1'),
(14, 'Logística', b'1'),
(15, 'Laboral', b'1'),
(16, 'Funciones del Sistema Nacional de Competencias', b'1'),
(17, 'Financiero', b'1'),
(18, 'Energía eléctrica', b'1'),
(19, 'Educación y Formación de Personas', b'1'),
(20, 'Deportivo', b'1'),
(21, 'Cultural', b'1'),
(22, 'Construcció', b'1'),
(23, 'Comercio Exterior', b'1'),
(24, 'Comercio', b'1'),
(25, 'Automotriz', b'1'),
(26, 'Agua', b'1'),
(27, 'Agrícola y Pecuario', b'1'),
(28, 'Administración Pública', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_capacitaciones`
--

CREATE TABLE IF NOT EXISTS `tipos_capacitaciones` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_capacitaciones`
--

INSERT INTO `tipos_capacitaciones` (`ID`, `NOMBRE`, `ACTIVO`) VALUES
(1, 'Curso', b'1'),
(2, 'Taller', b'1'),
(3, 'Diplomado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_medios_comunicacion`
--

CREATE TABLE IF NOT EXISTS `tipos_medios_comunicacion` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_medios_comunicacion`
--

INSERT INTO `tipos_medios_comunicacion` (`ID`, `NOMBRE`, `ACTIVO`) VALUES
(1, 'Email', b'1'),
(2, 'Celular', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `LOGIN` varchar(15) DEFAULT NULL,
  `PASSWORD` varchar(15) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `ACTIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX_2` (`LOGIN`,`PASSWORD`),
  KEY `INDEX_1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `LOGIN`, `PASSWORD`, `FECHA_REGISTRO`, `FECHA_MODIFICACION`, `ACTIVO`) VALUES
(1, 'Roberto Eder Weiss Juárez', 'eder.weiss87', 'marvel87', '2016-06-10 11:29:04', '2016-06-10 11:29:21', b'1'),
(2, 'Alberto de la Cruz Cruz', 'adlacru3', 'Nuncam25', '2016-06-15 10:55:03', NULL, b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendarios_capacitaciones`
--
ALTER TABLE `calendarios_capacitaciones`
  ADD CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`USUARIO_REGISTRO`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_12` FOREIGN KEY (`USUARIO_MODIFICO`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`CAPACITACION_ID`) REFERENCES `capacitaciones` (`ID`);

--
-- Filtros para la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD CONSTRAINT `FK_REFERENCE_2` FOREIGN KEY (`CATEGORIA_CAPACITACION_ID`) REFERENCES `categorias_capacitaciones` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_3` FOREIGN KEY (`TIPO_CAPACITACION_ID`) REFERENCES `tipos_capacitaciones` (`ID`);

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`SECTOR_PRODUCTIVO_ID`) REFERENCES `sectores_productivos` (`ID`);

--
-- Filtros para la tabla `medios_comunicacion`
--
ALTER TABLE `medios_comunicacion`
  ADD CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`PERSONA_ID`) REFERENCES `personas` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`TIPO_MEDIO_COMUNICACION_ID`) REFERENCES `tipos_medios_comunicacion` (`ID`);

--
-- Filtros para la tabla `registros_capacitaciones`
--
ALTER TABLE `registros_capacitaciones`
  ADD CONSTRAINT `FK_REFERENCE_10` FOREIGN KEY (`ESTATUS_ID`) REFERENCES `estatus` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`CALENDARIO_CAPACITACION_ID`) REFERENCES `calendarios_capacitaciones` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_8` FOREIGN KEY (`PERSONA_ID`) REFERENCES `personas` (`ID`),
  ADD CONSTRAINT `FK_REFERENCE_9` FOREIGN KEY (`EMPRESA_ID`) REFERENCES `empresas` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
