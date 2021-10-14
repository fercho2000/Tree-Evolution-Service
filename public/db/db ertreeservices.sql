-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2019 a las 02:32:00
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(11) NOT NULL,
  `fechaAbono` varchar(10) NOT NULL,
  `totalAbonar` int(11) NOT NULL,
  `abonoRestante` int(11) NOT NULL,
  `ordenServicio_idOrdenServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `fechaAbono`, `totalAbonar`, `abonoRestante`, `ordenServicio_idOrdenServicio`) VALUES
(20, '12/06/2019', 500, 100, 17),
(21, '12/06/2019', 100, 0, 17),
(22, '12/06/2019', 750, 50, 18),
(23, '12/06/2019', 50, 0, 18),
(24, '12/06/2019', 200, 300, 19),
(25, '18/06/2019', 400, 400, 20),
(26, '18/06/2019', 400, 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `titulo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `color` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '#4FC1E9'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `programacion_id` int(11) NOT NULL,
  `estados_id` int(11) NOT NULL DEFAULT '3',
  `empleado_id` int(11) NOT NULL,
  `color` varchar(11) NOT NULL DEFAULT '#FFb65f'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `fecha`, `horaInicio`, `horaFin`, `descripcion`, `programacion_id`, `estados_id`, `empleado_id`, `color`) VALUES
(15, '2019-06-12', '09:22:00', '09:22:00', NULL, 13, 1, 19, '#FFb65f'),
(16, '2019-06-12', '09:31:00', '10:31:00', NULL, 13, 1, 19, '#FFb65f'),
(17, '2019-06-12', '09:41:00', '09:41:00', NULL, 14, 1, 19, '#FFb65f'),
(18, '2019-06-13', '09:41:00', '09:41:00', NULL, 14, 1, 15, '#FFb65f'),
(19, '2019-06-12', '07:52:00', '09:47:00', NULL, 12, 3, 21, '#FFb65f'),
(20, '2019-06-08', '09:51:00', '10:51:00', NULL, 12, 3, 15, '#FFb65f'),
(21, '2019-06-12', '11:39:00', '11:39:00', NULL, 15, 1, 20, '#FFb65f'),
(22, '2019-06-17', '17:53:00', '20:53:00', NULL, 16, 1, 23, '#FFb65f'),
(23, '2019-06-18', '17:57:00', '20:57:00', NULL, 16, 1, 22, '#FFb65f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre_cargo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre_cargo`) VALUES
(1, 'Arbolista2'),
(2, 'Jardinero'),
(3, 'Podadores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`) VALUES
(2, 'Implementos para cabar'),
(3, 'Implementos de podaje'),
(4, 'Implementos para corte'),
(5, 'Implementos para limpieza'),
(6, 'Implementos de altura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombreCiudad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombreCiudad`) VALUES
(1, 'Chicago'),
(2, 'Corna'),
(3, 'San Petesburg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `NumeroDeIdentificacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `NumeroDeContacto` int(11) NOT NULL,
  `CorreoElectronico` varchar(45) DEFAULT NULL,
  `ciudad_idCiudad` int(11) NOT NULL,
  `Genero_idGenero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `NumeroDeIdentificacion`, `nombre`, `apellidos`, `direccion`, `NumeroDeContacto`, `CorreoElectronico`, `ciudad_idCiudad`, `Genero_idGenero`) VALUES
(9, 1000203100, 'jose fernando', 'usuga', 'cra 45 d', 2147483647, 'jfusuga0@misena.edu.co', 1, 1),
(10, 1000203100, 'Andrés', 'Gonzales', 'cra 78 d', 2147483647, 'andres@gmail.com', 2, 2),
(11, 1000205478, 'Fernando', 'florez', 'cra 56d', 45687, 'josef@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `numero_identificacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `numero_contacto` int(11) NOT NULL,
  `correo_electronico` varchar(45) NOT NULL,
  `fotoPersonal` varchar(200) DEFAULT 'uploads/user.png',
  `cargo_id` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `social_security` varchar(20) NOT NULL,
  `genero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `numero_identificacion`, `nombre`, `apellido`, `direccion`, `numero_contacto`, `correo_electronico`, `fotoPersonal`, `cargo_id`, `ciudad_id`, `estado`, `social_security`, `genero_id`) VALUES
(15, 1000203100, 'Jose Fernando', 'Usuga', 'calle68#152-85', 5445555, 'fernando@gmail.com', 'uploads/qJ4XK976c1DjdavGWXBVAL348UWpLwIr4qZvUVZJ.jpeg', 1, 1, 0, '12345678', 1),
(19, 1000099443, 'Andres', 'Orozco Muñoz', 'Cra 141 #43-45', 2147483647, 'andresorozco@gmail.com', 'uploads/iC0sXIbbUxPQ5iSs3F8B3ZG7smYGLpB8ctJcMMsB.jpeg', 1, 1, 1, '1234567', 1),
(20, 1007286993, 'Jesús Stiven', 'Ortiz Ortiz', 'crr 139 #62 A03', 2147483647, 'jesusstivenortiz@gmail.com', 'uploads/LEiwMhxDZJIxweUGr5HEEk9rZsVNJqxF0Y7YYK7N.jpeg', 2, 1, 1, '123456789', 1),
(21, 1216728728, 'Juan Esteban', 'Zapata Cano', 'cll 68 #125-46', 2147483647, 'juanes0202@gmail.com', 'uploads/4lmf49lbGYdzQUjdfi8IBZbOHvn1GsIZ9tOpaYBg.jpeg', 1, 1, 1, '123456', 1),
(22, 1067890000, 'Hector', 'Maya', 'calle98#125-65', 2147483647, 'hector@gmail.com', 'uploads/atBAffjzWjk1vVH28L1j3n7IFZqpFZexJCKGSO1C.jpeg', 1, 1, 1, '2304523', 1),
(23, 5558855, 'Jorge', 'Grande', 'calle98#125-65', 48888000, 'jhonsmith@gmail.com', 'uploads/QFBg07mNm9BB072xje9BvWATSzvLAm9p4AQNYhjv.jpeg', 1, 1, 1, '855585555', 1),
(24, 844558855, 'Will', 'Smith', 'San petesburg 125-45', 800365558, 'jhonsmith@gmail.com', 'uploads/user.png', 2, 1, 1, '448899666', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_programacion`
--

CREATE TABLE `empleados_has_programacion` (
  `empleado_id` int(11) NOT NULL,
  `bitacora_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados_has_programacion`
--

INSERT INTO `empleados_has_programacion` (`empleado_id`, `bitacora_id`) VALUES
(15, 16),
(19, 16),
(15, 15),
(19, 17),
(15, 17),
(15, 18),
(19, 18),
(15, 19),
(19, 19),
(15, 20),
(19, 20),
(19, 21),
(20, 21),
(21, 21),
(19, 22),
(21, 22),
(19, 23),
(21, 23),
(22, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_servicio`
--

CREATE TABLE `empleados_has_servicio` (
  `Empleados_idEmpleado` int(11) NOT NULL,
  `servicio_idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_has_visita`
--

CREATE TABLE `empleados_has_visita` (
  `Empleados_idEmpleado` int(11) NOT NULL,
  `visita_idVisita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombreEstado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombreEstado`) VALUES
(1, 'Completed work'),
(2, 'In process'),
(3, 'Pending'),
(4, 'Service order completed '),
(5, 'Voided');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `NombreGenero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `NombreGenero`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `implemento`
--

CREATE TABLE `implemento` (
  `id` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL DEFAULT 'ImplementoDefecto.png',
  `codigo_implemento` varchar(20) NOT NULL,
  `nombre_implemento` varchar(45) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `implemento`
--

INSERT INTO `implemento` (`id`, `imagen`, `codigo_implemento`, `nombre_implemento`, `categoria_id`, `estado`) VALUES
(12, '1560348489descarga (1).jpg', 'PA212', 'Pala Xmaster', 3, b'0'),
(13, '15603485630005681_tijera-poda-dos-manos-corona-sl3264.jpeg', 'PD001', 'Tijera Altura', 3, b'1'),
(14, '1560348604bellG_134.jpg', 'SO001', 'Soplador Hojas', 5, b'0'),
(15, '15603486392-palustres-gavilan-colora-mango-madera-no6-D_NQ_NP_785987-MCO27935633564_082018-Q.jpg', 'PA002', 'Palustre', 2, b'0'),
(16, '1560348670descarga (3).jpg', 'PA003', 'Palustre', 2, b'0'),
(17, '1560353281motosierra-435ii.jpg', 'MT001', 'Motosierra', 4, b'0'),
(18, '15608208362017-12-08 02.27.46 1665120320959708478_6234151101.jpg', 'Mt005', 'Motosierra X45', 4, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `implementostrabajo_has_kit`
--

CREATE TABLE `implementostrabajo_has_kit` (
  `implemento_id` int(11) NOT NULL,
  `kit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `implementostrabajo_has_kit`
--

INSERT INTO `implementostrabajo_has_kit` (`implemento_id`, `kit_id`) VALUES
(12, 8),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(16, 8),
(16, 7),
(15, 8),
(12, 7),
(12, 10),
(14, 10),
(15, 10),
(16, 10),
(17, 10),
(17, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kit`
--

CREATE TABLE `kit` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `nombre_kit` varchar(45) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `kit`
--

INSERT INTO `kit` (`id`, `servicio_id`, `nombre_kit`, `estado`) VALUES
(7, 1, 'Kit para limpieza de tierra', b'0'),
(8, 3, 'Kit para corte de arbol', b'0'),
(9, 3, 'Kit para podaje', b'0'),
(10, 2, 'Kit cambio de gravilla', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2015_01_20_084450_create_roles_table', 1),
(12, '2015_01_20_084525_create_role_user_table', 1),
(13, '2015_01_24_080208_create_permissions_table', 1),
(14, '2015_01_24_080433_create_permission_role_table', 1),
(15, '2015_12_04_003040_add_special_role_column', 1),
(16, '2017_10_17_170735_create_permission_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedadesordenesservicio`
--

CREATE TABLE `novedadesordenesservicio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fechaNovedad` varchar(45) NOT NULL,
  `ordenServicio_idOrdenServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `novedadesordenesservicio`
--

INSERT INTO `novedadesordenesservicio` (`id`, `descripcion`, `fechaNovedad`, `ordenServicio_idOrdenServicio`) VALUES
(5, 'EL dia no se presto para la realizacion del servicio', '2019-6-12', 17),
(6, 'No se ha podido generar el servicio', '2019-6-17', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedadimplemento`
--

CREATE TABLE `novedadimplemento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_novedad` varchar(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `empleado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `novedadimplemento`
--

INSERT INTO `novedadimplemento` (`id`, `descripcion`, `fecha_novedad`, `implemento_id`, `estado`, `empleado_id`) VALUES
(9, NULL, '12/06/2019', 12, b'0', NULL),
(10, NULL, '12/06/2019', 13, b'0', 15),
(11, 'Se extravio el implemento', '17/06/2019', 18, b'0', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenservicio`
--

CREATE TABLE `ordenservicio` (
  `id` int(11) NOT NULL,
  `descripcionServicio` varchar(200) DEFAULT NULL,
  `contratoAdjunto` varchar(200) NOT NULL,
  `permisoCorteArbolAdjunto` varchar(200) DEFAULT NULL,
  `cotizacionAdjunta` varchar(200) DEFAULT NULL,
  `fechaInicio` varchar(10) NOT NULL,
  `fechaFin` varchar(10) NOT NULL,
  `Precio` int(11) NOT NULL,
  `tipoServicio_idTipoServicio` int(11) NOT NULL,
  `estados_idEstado` int(11) NOT NULL DEFAULT '3',
  `Cliente_idCliente` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenservicio`
--

INSERT INTO `ordenservicio` (`id`, `descripcionServicio`, `contratoAdjunto`, `permisoCorteArbolAdjunto`, `cotizacionAdjunta`, `fechaInicio`, `fechaFin`, `Precio`, `tipoServicio_idTipoServicio`, `estados_idEstado`, `Cliente_idCliente`, `created_at`, `updated_at`) VALUES
(16, 'mmm', '721560347286ECONOMATO.pdf', '', '971560347286ECONOMATO.pdf', '2019-06-12', '2019-06-12', 600, 2, 2, 9, '2019-06-12 18:48:06', '2019-06-12 19:06:54'),
(17, 'hla', '781560347444ECONOMATO.pdf', NULL, '511560347444ECONOMATO.pdf', '2019-06-12', '2019-06-12', 600, 2, 4, 9, '2019-06-12 18:50:44', '2019-06-12 19:36:23'),
(18, 'test4', '771560350469Convocatoria 09 Mayo 2019.pdf', '391560350469ECONOMATO.pdf', '481560350469la_ternura.pdf', '2019-06-12', '2019-06-12', 800, 1, 4, 10, '2019-06-12 19:41:09', '2019-06-12 19:42:37'),
(19, 'podar jardin', '711560357439la_hermana_san_sulpicio.pdf', '', '981560357439la_hermana_san_sulpicio.pdf', '2019-06-12', '2019-06-12', 500, 2, 4, 10, '2019-06-12 21:37:19', '2019-06-12 21:42:20'),
(20, 'registro orden', '731560822525Captura de pantalla (24).png', '711560822525Captura de pantalla (29).png', '271560822525Captura de pantalla (25).png', '2019-06-17', '2019-06-17', 800, 1, 4, 10, '2019-06-18 06:48:45', '2019-06-18 07:00:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenservicio_has_servicio`
--

CREATE TABLE `ordenservicio_has_servicio` (
  `ordenServicio_idOrdenServicio` int(11) NOT NULL,
  `servicio_idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenservicio_has_servicio`
--

INSERT INTO `ordenservicio_has_servicio` (`ordenServicio_idOrdenServicio`, `servicio_idServicio`) VALUES
(17, 3),
(18, 1),
(18, 2),
(19, 4),
(20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Navegar Usuarios', 'users.index', 'usuarios del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(2, 'Ver detalle Usuarios', 'users.show', 'Ver usuarios del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(3, 'Editar Usuarios', 'users.edit', 'Editar usuarios del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(4, 'Eliminar Usuarios', 'users.destroy', 'Eliminar usuarios del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(5, 'Navegar roles', 'roles.index', 'roles del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(6, 'Ver detalle roles', 'roles.show', 'Ver roles del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(7, 'Editar roles', 'roles.edit', 'Editar roles del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(8, 'Crear roles', 'roles.create', 'Crear roles del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(9, 'Navegar cliente', 'cliente.index', 'cliente del sistema', '2019-04-10 11:15:08', '2019-04-10 11:15:08'),
(10, 'Ver detalle cliente', 'cliente.show', 'Ver cliente del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(11, 'Editar cliente', 'cliente.edit', 'Editar cliente del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(12, 'Crear cliente', 'cliente.create', 'Crear cliente del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(13, 'Navegar empleados', 'empleados.index', 'empleados del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(14, 'Ver detalle empleados', 'empleados.show', 'Ver empleados del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(15, 'Editar empleados', 'empleados.edit', 'Editar empleados del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(16, 'Cambiar estado empleados', 'empleados.cambiarestado', 'cambiar el estado de empleados del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(17, 'Crear empleados', 'empleados.create', 'Crear empleados del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(18, 'Navegar cargos', 'cargos.index', 'cargos del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(19, 'Ver detalle cargos', 'cargos.show', 'Ver cargos del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(20, 'Editar cargos', 'cargos.edit', 'Editar cargos del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(21, 'Crear cargos', 'cargos.create', 'Crear cargos del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(22, 'Navegar ciudad', 'ciudad.index', 'ciudad del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(23, 'Ver detalle ciudad', 'ciudad.show', 'Ver ciudad del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(24, 'Editar ciudad', 'ciudad.edit', 'Editar ciudad del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(25, 'Crear ciudad', 'ciudad.create', 'Crear ciudad del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(26, 'Navegar genero', 'genero.index', 'genero del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(27, 'Ver detalle genero', 'genero.show', 'Ver genero del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(28, 'Editar genero', 'genero.edit', 'Editar genero del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(29, 'Crear genero', 'genero.create', 'Crear genero del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(30, 'Navegar Tipo de servicio', 'Tiposervicio.index', 'Tipo de servicio del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(31, 'Ver detalle Tipo de servicio', 'Tiposervicio.show', 'Ver Tipo de servicio del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(32, 'Editar Tipo de servicio', 'Tiposervicio.edit', 'Editar Tipo de servicio del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(33, 'Crear Tipo de servicio', 'Tiposervicio.create', 'Crear Tipo de servicio del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(34, 'Navegar servicios', 'servicios.index', 'servicios del sistema', '2019-04-10 11:15:09', '2019-04-10 11:15:09'),
(35, 'Ver detalle servicios', 'servicios.show', 'Ver servicios del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(36, 'Editar servicios', 'servicios.edit', 'Editar servicios del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(37, 'Crear servicios', 'servicios.create', 'Crear servicios del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(38, 'Navegar implementos', 'implementos.index', 'implementos del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(39, 'Ver detalle implementos', 'implementos.show', 'Ver implementos del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(40, 'Editar implementos', 'implementos.edit', 'Editar implementos del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(41, 'Crear implementos', 'implementos.create', 'Crear implementos del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(42, 'Cambiar estado implementos', 'implementos.cambiarestado', 'cambiar el estado de implementos del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(43, 'Navegar categorias', 'categorias.index', 'categorias del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(44, 'Ver detalle categorias', 'categorias.show', 'Ver categorias del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(45, 'Editar categorias', 'categorias.edit', 'Editar categorias del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(46, 'Crear categorias', 'categorias.create', 'Crear categorias del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(47, 'Navegar novedades', 'novedades.index', 'novedades del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(48, 'Ver detalle novedades', 'novedades.show', 'Ver novedades del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(49, 'Editar novedades', 'novedades.edit', 'Editar novedades del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(50, 'Crear novedades', 'novedades.create', 'Crear novedades del sistema', '2019-04-10 11:15:10', '2019-04-10 11:15:10'),
(51, 'Cambiar estado novedades', 'novedades.cambiarestado', 'cambiar el estado de novedades del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(52, 'Navegar visitas', 'visitas.index', 'visitas del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(53, 'Ver detalle visitas', 'visitas.show', 'Ver visitas del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(54, 'Editar visitas', 'visitas.edit', 'Editar visitas del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(55, 'Crear visitas', 'visitas.create', 'Crear visitas del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(56, 'Cambiar estado visitas', 'visitas.cambiarestado', 'cambiar el estado de visitas del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(57, 'Navegar kits', 'kits.index', 'kits del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(58, 'Ver detalle kits', 'kits.show', 'Ver kits del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(59, 'Editar kits', 'kits.edit', 'Editar kits del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(60, 'Crear kits', 'kits.create', 'Crear kits del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(61, 'Cambiar estado kits', 'kits.cambiarestado', 'cambiar el estado de kits del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(62, 'Navegar orden de servicio', 'ordenservicios.index', 'orden de servicio del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(63, 'Ver detalle orden de servicio', 'ordenservicios.show', 'Ver orden de servicio del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(64, 'Editar orden de servicio', 'ordenservicios.edit', 'Editar orden de servicio del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(65, 'Crear orden de servicio', 'ordenservicios.create', 'Crear orden de servicio del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(66, 'Cambiar estado orden de servicio', 'ordenservicios.cambiarestado', 'cambiar el estado de orden de servicio del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(67, 'Navegar estados', 'estados.index', 'estados del sistema', '2019-04-10 11:15:11', '2019-04-10 11:15:11'),
(68, 'Ver detalle estados', 'estados.show', 'Ver estados del sistema', '2019-04-10 11:15:12', '2019-04-10 11:15:12'),
(69, 'Editar estados', 'estados.edit', 'Editar estados del sistema', '2019-04-10 11:15:12', '2019-04-10 11:15:12'),
(70, 'Crear estados', 'estados.create', 'Crear estados del sistema', '2019-04-10 11:15:12', '2019-04-10 11:15:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2019-06-12 21:31:15', '2019-06-12 21:31:15'),
(2, 2, 5, '2019-06-12 21:31:15', '2019-06-12 21:31:15'),
(3, 5, 5, '2019-06-12 21:31:15', '2019-06-12 21:31:15'),
(4, 6, 5, '2019-06-12 21:31:15', '2019-06-12 21:31:15'),
(5, 7, 5, '2019-06-12 21:31:15', '2019-06-12 21:31:15'),
(6, 13, 5, '2019-06-12 21:31:46', '2019-06-12 21:31:46'),
(7, 14, 5, '2019-06-12 21:31:46', '2019-06-12 21:31:46'),
(8, 15, 5, '2019-06-12 21:31:46', '2019-06-12 21:31:46'),
(9, 16, 5, '2019-06-12 21:31:46', '2019-06-12 21:31:46'),
(10, 17, 5, '2019-06-12 21:31:46', '2019-06-12 21:31:46'),
(11, 1, 6, '2019-06-18 06:02:53', '2019-06-18 06:02:53'),
(12, 2, 6, '2019-06-18 06:02:53', '2019-06-18 06:02:53'),
(13, 3, 6, '2019-06-18 06:02:53', '2019-06-18 06:02:53'),
(14, 4, 6, '2019-06-18 06:02:53', '2019-06-18 06:02:53'),
(15, 38, 6, '2019-06-18 06:02:53', '2019-06-18 06:02:53'),
(16, 39, 6, '2019-06-18 06:02:54', '2019-06-18 06:02:54'),
(17, 40, 6, '2019-06-18 06:02:54', '2019-06-18 06:02:54'),
(18, 41, 6, '2019-06-18 06:02:54', '2019-06-18 06:02:54'),
(19, 42, 6, '2019-06-18 06:02:54', '2019-06-18 06:02:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `id` int(11) NOT NULL,
  `ordenservicio_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `programacion`
--

INSERT INTO `programacion` (`id`, `ordenservicio_id`, `estado`) VALUES
(12, 16, 0),
(13, 17, 0),
(14, 18, 0),
(15, 19, 0),
(16, 20, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_has_kit`
--

CREATE TABLE `programacion_has_kit` (
  `kit_id` int(11) NOT NULL,
  `bitacora_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programacion_has_kit`
--

INSERT INTO `programacion_has_kit` (`kit_id`, `bitacora_id`) VALUES
(7, 16),
(8, 16),
(7, 15),
(8, 17),
(7, 17),
(8, 18),
(9, 18),
(7, 19),
(8, 19),
(7, 20),
(8, 20),
(9, 19),
(7, 21),
(8, 21),
(7, 22),
(10, 22),
(7, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombreRol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `special`) VALUES
(1, 'Administrador', 'Admin', 'Este indica al administrador', NULL, NULL, 'all-access'),
(2, 'Secretario', 'Secre', 'Este indica al secretario', NULL, '2019-05-22 19:05:25', NULL),
(4, 'administrador herrainetas', 'herra admin', 'todo', '2019-04-10 16:38:26', '2019-04-10 16:38:26', NULL),
(5, 'Administrador empleados', 'Empleados', NULL, '2019-06-12 21:31:15', '2019-06-12 21:31:15', NULL),
(6, 'administrador de herramientas', 'admin hr', NULL, '2019-06-18 06:02:53', '2019-06-18 06:02:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, '2019-06-12 20:21:39', '2019-06-12 20:21:39'),
(4, 5, 3, '2019-06-12 21:32:31', '2019-06-12 21:32:31'),
(6, 6, 4, '2019-06-18 06:05:30', '2019-06-18 06:05:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombreServicio` varchar(30) NOT NULL,
  `tipoServicio_idTipoServicio` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombreServicio`, `tipoServicio_idTipoServicio`, `estado`) VALUES
(1, 'Remocion arboles', 1, b'1'),
(2, 'Limpieza de tierras', 1, b'1'),
(3, 'Cambio de gravilla', 2, b'1'),
(4, 'Poda de jardines', 2, b'1'),
(5, 'Tree remove', 1, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio`
--

CREATE TABLE `tiposervicio` (
  `id` int(11) NOT NULL,
  `nombreTipoServicio` varchar(40) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposervicio`
--

INSERT INTO `tiposervicio` (`id`, `nombreTipoServicio`, `estado`) VALUES
(1, 'Trees', b'1'),
(2, 'Gardening', b'1'),
(3, 'Plantings', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `empleado_id`, `remember_token`, `created_at`, `updated_at`, `estado`) VALUES
(1, 'Fernando Usuga Florez', 'fernando@gmail.com', '$2y$10$6ljJ8433kCRqC8LvN2gNpemzRsSETlutep0s4K5iLiCHAaHMg.Se.', 15, 'Q6GOHpOIdnBhfXpSCzsoLrQYvso2mCJRYddyvxsMcL75hPdtq3nGSDHM1o7K', NULL, '2019-06-18 07:18:07', 1),
(2, 'Jesús Stiven Ortiz Ortiz', 'jesusstivenortiz@gmail.com', '$2y$10$zf4SAN/8OQ94TQ.yhtA4IOOb1vMludCyQkWjeNN2T31lItifraQmK', 20, 'wE1qInTVXcYOd0MSU3uAiCDmmkGCjvzbn3joG6YIW9beDTGprtLwYUz7SrtD', '2019-06-12 20:21:38', '2019-06-18 07:33:03', 0),
(3, 'Andres Orozco', 'andresorozco@gmail.com', '$2y$10$IqsEksLPEfb5vpS9QyxRE.3RWdeTSoizZxOmy9U707LIQ7X5Je8Pu', 19, 't5Z9LCupzzuNUv7M1FZqvkwT5ya5T4JcVviJ7fIyqALRNLyRKqya61XC7LCM', '2019-06-12 21:27:51', '2019-06-12 21:32:41', 1),
(4, 'Andres Orozco Muñoz', 'andres@gmail.com', '$2y$10$yjFg0IofXdAbKMvESZD5bO4y0UGeseNjCUGM1RsA6E.40War/hlw2', 19, 'D6hGpvuNyFVOSUb128x9NZgAHOyOBkEAPktYNqvwKTkSaYzZ0csOQBUg0VXX', '2019-06-18 05:54:29', '2019-06-18 05:54:29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id` int(11) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` datetime NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` int(2) DEFAULT '0',
  `cliente_id` int(11) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT '#22d69d'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visita`
--

INSERT INTO `visita` (`id`, `fecha_visita`, `hora_inicio`, `hora_fin`, `descripcion`, `estado`, `cliente_id`, `color`) VALUES
(9, '2019-06-12 07:06:00', '07:35:00', '2019-06-12 09:06:00', NULL, 0, 9, '#22d69d'),
(10, '2019-06-17 18:06:00', '18:10:00', '2019-06-17 21:06:00', 'revisaremos el terrerno', 0, 10, '#22d69d');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`,`ordenServicio_idOrdenServicio`),
  ADD KEY `fk_abonos_ordenServicio1_idx` (`ordenServicio_idOrdenServicio`);

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_programacion_ordenServicio1_idx` (`programacion_id`),
  ADD KEY `fk_programacion_estadoServicios1_idx` (`estados_id`),
  ADD KEY `fk_programacion_Empleados1_idx` (`empleado_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`,`ciudad_idCiudad`,`Genero_idGenero`),
  ADD KEY `fk_Cliente_ciudad1_idx` (`ciudad_idCiudad`),
  ADD KEY `fk_Cliente_Genero1_idx` (`Genero_idGenero`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`,`cargo_id`,`ciudad_id`,`genero_id`),
  ADD KEY `fk_persona_ciudad1_idx` (`ciudad_id`),
  ADD KEY `fk_Empleados_Genero1_idx` (`genero_id`),
  ADD KEY `fk_cargoid_empleado` (`cargo_id`);

--
-- Indices de la tabla `empleados_has_programacion`
--
ALTER TABLE `empleados_has_programacion`
  ADD KEY `empleado_id` (`empleado_id`),
  ADD KEY `bitacora_id` (`bitacora_id`);

--
-- Indices de la tabla `empleados_has_servicio`
--
ALTER TABLE `empleados_has_servicio`
  ADD PRIMARY KEY (`Empleados_idEmpleado`,`servicio_idServicio`),
  ADD KEY `fk_Empleados_has_servicio_servicio1_idx` (`servicio_idServicio`),
  ADD KEY `fk_Empleados_has_servicio_Empleados1_idx` (`Empleados_idEmpleado`);

--
-- Indices de la tabla `empleados_has_visita`
--
ALTER TABLE `empleados_has_visita`
  ADD PRIMARY KEY (`Empleados_idEmpleado`,`visita_idVisita`),
  ADD KEY `fk_Empleados_has_visita_Empleados1_idx` (`Empleados_idEmpleado`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `implemento`
--
ALTER TABLE `implemento`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `implementostrabajo_has_kit`
--
ALTER TABLE `implementostrabajo_has_kit`
  ADD KEY `implemento_id` (`implemento_id`),
  ADD KEY `kit_id` (`kit_id`);

--
-- Indices de la tabla `kit`
--
ALTER TABLE `kit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `novedadesordenesservicio`
--
ALTER TABLE `novedadesordenesservicio`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_noedadesOrdenesServicio_ordenServicio1_idx` (`ordenServicio_idOrdenServicio`);

--
-- Indices de la tabla `novedadimplemento`
--
ALTER TABLE `novedadimplemento`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `Fk_implemento_empleado` (`implemento_id`),
  ADD KEY `Fk_novedad_empleado` (`empleado_id`) USING BTREE;

--
-- Indices de la tabla `ordenservicio`
--
ALTER TABLE `ordenservicio`
  ADD PRIMARY KEY (`id`,`estados_idEstado`,`tipoServicio_idTipoServicio`,`Cliente_idCliente`),
  ADD KEY `fk_ordenServicio_tipoServicio1_idx` (`tipoServicio_idTipoServicio`),
  ADD KEY `fk_ordenServicio_estadoServicios1_idx` (`estados_idEstado`),
  ADD KEY `fk_ordenServicio_Cliente1_idx` (`Cliente_idCliente`);

--
-- Indices de la tabla `ordenservicio_has_servicio`
--
ALTER TABLE `ordenservicio_has_servicio`
  ADD PRIMARY KEY (`ordenServicio_idOrdenServicio`,`servicio_idServicio`),
  ADD KEY `fk_ordenServicio_has_servicio_servicio1_idx` (`servicio_idServicio`),
  ADD KEY `fk_ordenServicio_has_servicio_ordenServicio1_idx` (`ordenServicio_idOrdenServicio`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programacion_orden` (`ordenservicio_id`);

--
-- Indices de la tabla `programacion_has_kit`
--
ALTER TABLE `programacion_has_kit`
  ADD KEY `kit_id` (`kit_id`),
  ADD KEY `bitacora_id` (`bitacora_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`,`tipoServicio_idTipoServicio`),
  ADD KEY `fk_servicio_tipoServicio1_idx` (`tipoServicio_idTipoServicio`);

--
-- Indices de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `implemento`
--
ALTER TABLE `implemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `kit`
--
ALTER TABLE `kit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `novedadesordenesservicio`
--
ALTER TABLE `novedadesordenesservicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `novedadimplemento`
--
ALTER TABLE `novedadimplemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ordenservicio`
--
ALTER TABLE `ordenservicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `fk_abonos_ordenservicio` FOREIGN KEY (`ordenServicio_idOrdenServicio`) REFERENCES `ordenservicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_bitacora_estados` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bitacora_idempleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bitacora_programacion` FOREIGN KEY (`programacion_id`) REFERENCES `programacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_idciudad` FOREIGN KEY (`ciudad_idCiudad`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cliente_idgenero` FOREIGN KEY (`Genero_idGenero`) REFERENCES `genero` (`id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_cargoid_empleado` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ciudad_id` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_generoID` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados_has_programacion`
--
ALTER TABLE `empleados_has_programacion`
  ADD CONSTRAINT `Fk_Bitacora_empleados` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_Empleados_bitacora` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados_has_visita`
--
ALTER TABLE `empleados_has_visita`
  ADD CONSTRAINT `empleadofk` FOREIGN KEY (`Empleados_idEmpleado`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `implemento`
--
ALTER TABLE `implemento`
  ADD CONSTRAINT `Fk_implemento_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `implementostrabajo_has_kit`
--
ALTER TABLE `implementostrabajo_has_kit`
  ADD CONSTRAINT `Fk_implemento_has_kit` FOREIGN KEY (`implemento_id`) REFERENCES `implemento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_kit_has_implemento` FOREIGN KEY (`kit_id`) REFERENCES `kit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kit`
--
ALTER TABLE `kit`
  ADD CONSTRAINT `kit_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `novedadesordenesservicio`
--
ALTER TABLE `novedadesordenesservicio`
  ADD CONSTRAINT `Fk_Novedad_OrdenServicio` FOREIGN KEY (`ordenServicio_idOrdenServicio`) REFERENCES `ordenservicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `novedadimplemento`
--
ALTER TABLE `novedadimplemento`
  ADD CONSTRAINT `Fk_Novedad_Implemento` FOREIGN KEY (`implemento_id`) REFERENCES `implemento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_novedad_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenservicio`
--
ALTER TABLE `ordenservicio`
  ADD CONSTRAINT `fk_idTipoSrvicio_ordenServicio` FOREIGN KEY (`tipoServicio_idTipoServicio`) REFERENCES `tiposervicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenservicio_has_servicio`
--
ALTER TABLE `ordenservicio_has_servicio`
  ADD CONSTRAINT `fk_IdOrdenServicio` FOREIGN KEY (`ordenServicio_idOrdenServicio`) REFERENCES `ordenservicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servicio_ordenservicio` FOREIGN KEY (`servicio_idServicio`) REFERENCES `servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD CONSTRAINT `fk_programacion_orden` FOREIGN KEY (`ordenservicio_id`) REFERENCES `ordenservicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programacion_has_kit`
--
ALTER TABLE `programacion_has_kit`
  ADD CONSTRAINT `Fk_Bitacora_kit` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_Kit_bitacora` FOREIGN KEY (`kit_id`) REFERENCES `kit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_TipoServicio_Servicio` FOREIGN KEY (`tipoServicio_idTipoServicio`) REFERENCES `tiposervicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
