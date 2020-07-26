-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2018 a las 11:36:08
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dsiproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `nie` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` enum('F','M') COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `municipio_id`, `nie`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `direccion`, `telefono`, `responsable`, `estado`, `created_at`, `updated_at`) VALUES
(1, 181, '111111', 'Bertha María', 'Beltrán Aguilar', '1995-10-20', 'F', 'Una casa', '11111111', 'Responsable', 1, '2018-09-23 00:18:54', '2018-12-07 03:31:42'),
(2, 95, '222222', 'Robin Alcides', 'Toloza Faustino', '2011-11-11', 'M', 'una casa', '11111111', 'res', 1, '2018-09-23 00:27:32', '2018-12-07 03:32:21'),
(3, 17, '123455', 'Juana Carolina', 'Hernández Márquez', '1999-11-11', 'F', 'Una casa', '12345572', 'Su mamá', 1, '2018-12-01 04:20:02', '2018-12-01 04:20:02'),
(4, 57, '999999', 'Peter', 'Parker', '2000-09-09', 'M', NULL, '54205729', 'Mamá', 1, '2018-12-28 06:57:57', '2018-12-28 06:57:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_evaluacion`
--

CREATE TABLE `alumno_evaluacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `alumno_id` int(10) UNSIGNED NOT NULL,
  `evaluacion_id` int(10) UNSIGNED NOT NULL,
  `nota` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_evaluacion`
--

INSERT INTO `alumno_evaluacion` (`id`, `alumno_id`, `evaluacion_id`, `nota`, `created_at`, `updated_at`) VALUES
(4, 2, 9, 10.00, '2018-09-28 12:33:06', '2018-10-13 07:42:06'),
(7, 2, 10, 0.00, '2018-09-28 16:52:09', '2018-10-13 07:42:06'),
(9, 2, 3, 0.00, '2018-09-28 16:59:37', '2018-09-28 16:59:37'),
(10, 2, 11, 0.00, '2018-09-28 16:59:37', '2018-09-28 16:59:37'),
(13, 2, 12, 0.00, '2018-09-28 16:59:53', '2018-09-28 23:49:01'),
(23, 2, 14, 3.20, '2018-09-28 23:48:31', '2018-09-28 23:49:00'),
(25, 2, 17, 0.00, '2018-09-29 00:59:46', '2018-09-29 00:59:46'),
(27, 2, 19, 0.00, '2018-09-29 01:00:43', '2018-09-29 01:00:43'),
(29, 2, 20, 0.00, '2018-09-29 01:20:47', '2018-09-29 01:20:47'),
(31, 2, 21, 0.00, '2018-09-29 01:21:02', '2018-09-29 01:21:02'),
(33, 2, 22, 0.00, '2018-09-29 01:21:24', '2018-09-29 01:21:24'),
(35, 2, 23, 0.00, '2018-09-29 01:21:38', '2018-09-29 01:21:38'),
(38, 2, 24, 0.00, '2018-09-29 01:37:46', '2018-09-29 01:37:46'),
(48, 1, 25, 0.00, '2018-10-13 08:31:42', '2018-12-14 09:22:02'),
(49, 1, 30, 4.00, '2018-10-13 08:31:52', '2018-12-14 09:22:01'),
(50, 3, 30, 6.70, '2018-12-14 09:14:58', '2018-12-14 09:22:01'),
(51, 3, 25, 0.00, '2018-12-14 09:14:59', '2018-12-14 09:22:02'),
(52, 2, 30, 3.00, '2018-12-14 09:14:59', '2018-12-14 09:22:02'),
(53, 2, 25, 2.00, '2018-12-14 09:14:59', '2018-12-14 09:22:02'),
(54, 1, 32, 0.00, '2018-12-14 09:15:10', '2018-12-14 09:21:09'),
(55, 3, 32, 0.00, '2018-12-14 09:15:10', '2018-12-14 09:21:09'),
(56, 2, 32, 0.00, '2018-12-14 09:15:10', '2018-12-14 09:21:09'),
(57, 1, 34, 7.00, '2018-12-14 09:15:39', '2018-12-14 09:22:01'),
(58, 3, 34, 8.00, '2018-12-14 09:15:39', '2018-12-14 09:22:02'),
(59, 2, 34, 8.00, '2018-12-14 09:15:39', '2018-12-14 09:22:02'),
(60, 1, 35, 9.00, '2018-12-14 09:16:00', '2018-12-14 09:22:01'),
(61, 3, 35, 6.00, '2018-12-14 09:16:01', '2018-12-14 09:22:02'),
(62, 2, 35, 3.00, '2018-12-14 09:16:01', '2018-12-14 09:22:02'),
(63, 1, 33, 9.00, '2018-12-14 09:16:22', '2018-12-14 09:21:08'),
(64, 3, 33, 7.40, '2018-12-14 09:16:22', '2018-12-14 09:21:08'),
(65, 2, 33, 5.00, '2018-12-14 09:16:22', '2018-12-14 09:21:09'),
(66, 1, 36, 7.00, '2018-12-14 09:17:02', '2018-12-14 09:21:08'),
(67, 1, 37, 6.00, '2018-12-14 09:17:03', '2018-12-14 09:21:08'),
(68, 3, 36, 8.00, '2018-12-14 09:17:03', '2018-12-14 09:21:08'),
(69, 3, 37, 6.70, '2018-12-14 09:17:03', '2018-12-14 09:21:08'),
(70, 2, 36, 10.00, '2018-12-14 09:17:03', '2018-12-14 09:21:09'),
(71, 2, 37, 8.00, '2018-12-14 09:17:03', '2018-12-14 09:21:09'),
(72, 1, 38, 0.00, '2018-12-14 09:17:10', '2018-12-14 09:20:13'),
(73, 3, 38, 0.00, '2018-12-14 09:17:10', '2018-12-14 09:20:14'),
(74, 2, 38, 0.00, '2018-12-14 09:17:10', '2018-12-14 09:20:14'),
(75, 1, 39, 10.00, '2018-12-14 09:18:19', '2018-12-14 09:20:13'),
(76, 1, 40, 8.40, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(77, 1, 41, 2.00, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(78, 3, 39, 8.00, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(79, 3, 40, 5.00, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(80, 3, 41, 4.00, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(81, 2, 39, 9.00, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(82, 2, 40, 6.70, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(83, 2, 41, 5.60, '2018-12-14 09:18:20', '2018-12-14 09:20:13'),
(84, 1, 28, 0.00, '2018-12-15 02:57:21', '2018-12-15 02:57:21'),
(85, 3, 28, 0.00, '2018-12-15 02:57:21', '2018-12-15 02:57:21'),
(86, 2, 28, 0.00, '2018-12-15 02:57:21', '2018-12-15 02:57:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_pago`
--

CREATE TABLE `alumno_pago` (
  `id` int(10) UNSIGNED NOT NULL,
  `alumno_id` int(10) UNSIGNED NOT NULL,
  `pago_id` int(10) UNSIGNED NOT NULL,
  `pago` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_pago`
--

INSERT INTO `alumno_pago` (`id`, `alumno_id`, `pago_id`, `pago`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 1.50, '2018-12-06 09:01:39', '2018-12-06 09:01:39'),
(4, 2, 1, 3.45, '2018-12-06 09:12:40', '2018-12-06 09:12:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_valor`
--

CREATE TABLE `alumno_valor` (
  `id` int(10) UNSIGNED NOT NULL,
  `alumno_id` int(10) UNSIGNED NOT NULL,
  `valor_id` int(10) UNSIGNED NOT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL,
  `trimestre` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_valor`
--

INSERT INTO `alumno_valor` (`id`, `alumno_id`, `valor_id`, `grado_id`, `trimestre`, `nota`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 3, '1', 'E', '2018-11-25 02:47:10', '2018-11-25 02:49:39'),
(13, 1, 2, 3, '1', 'E', '2018-11-25 02:47:10', '2018-11-25 02:49:39'),
(14, 2, 1, 3, '1', 'E', '2018-11-25 02:47:10', '2018-11-25 02:49:39'),
(15, 2, 2, 3, '1', 'E', '2018-11-25 02:47:10', '2018-11-25 02:49:39'),
(16, 1, 1, 3, '2', 'MB', '2018-11-25 02:49:29', '2018-11-25 02:49:39'),
(17, 1, 2, 3, '2', 'E', '2018-11-25 02:49:29', '2018-11-25 02:49:39'),
(18, 2, 1, 3, '2', 'E', '2018-11-25 02:49:30', '2018-11-25 02:49:39'),
(19, 2, 2, 3, '2', 'MB', '2018-11-25 02:49:30', '2018-11-25 02:49:39'),
(20, 1, 1, 3, '3', 'E', '2018-11-25 05:18:42', '2018-11-25 05:18:42'),
(21, 1, 2, 3, '3', 'R', '2018-11-25 05:18:42', '2018-11-25 05:18:42'),
(22, 2, 1, 3, '3', 'B', '2018-11-25 05:18:42', '2018-11-25 05:18:42'),
(23, 2, 2, 3, '3', 'E', '2018-11-25 05:18:42', '2018-11-25 05:18:42'),
(24, 2, 1, 2, '1', NULL, '2018-11-25 05:37:32', '2018-11-25 05:37:32'),
(25, 2, 2, 2, '1', NULL, '2018-11-25 05:37:33', '2018-11-25 05:37:33'),
(26, 3, 1, 3, '1', 'MB', '2018-12-14 09:22:39', '2018-12-14 09:22:39'),
(27, 3, 2, 3, '1', 'MB', '2018-12-14 09:22:39', '2018-12-14 09:22:39'),
(28, 1, 3, 3, '1', 'B', '2018-12-14 09:27:03', '2018-12-14 09:27:03'),
(29, 1, 4, 3, '1', 'MB', '2018-12-14 09:27:03', '2018-12-14 09:27:03'),
(30, 1, 5, 3, '1', 'R', '2018-12-14 09:27:03', '2018-12-14 09:27:03'),
(31, 3, 3, 3, '1', 'B', '2018-12-14 09:27:03', '2018-12-14 09:27:03'),
(32, 3, 4, 3, '1', 'E', '2018-12-14 09:27:04', '2018-12-14 09:27:04'),
(33, 3, 5, 3, '1', 'B', '2018-12-14 09:27:04', '2018-12-14 09:27:04'),
(34, 2, 3, 3, '1', 'R', '2018-12-14 09:27:04', '2018-12-14 09:27:04'),
(35, 2, 4, 3, '1', 'E', '2018-12-14 09:27:04', '2018-12-14 09:27:04'),
(36, 2, 5, 3, '1', 'M', '2018-12-14 09:27:04', '2018-12-14 09:27:04'),
(37, 1, 3, 3, '2', 'B', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(38, 1, 4, 3, '2', 'E', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(39, 1, 5, 3, '2', 'R', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(40, 3, 1, 3, '2', 'MB', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(41, 3, 2, 3, '2', 'E', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(42, 3, 3, 3, '2', 'R', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(43, 3, 4, 3, '2', 'MB', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(44, 3, 5, 3, '2', 'M', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(45, 2, 3, 3, '2', 'M', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(46, 2, 4, 3, '2', 'B', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(47, 2, 5, 3, '2', 'E', '2018-12-14 09:27:59', '2018-12-14 09:27:59'),
(48, 1, 3, 3, '3', 'MB', '2018-12-14 09:28:36', '2018-12-14 09:28:36'),
(49, 1, 4, 3, '3', 'M', '2018-12-14 09:28:36', '2018-12-14 09:28:36'),
(50, 1, 5, 3, '3', 'B', '2018-12-14 09:28:36', '2018-12-14 09:28:36'),
(51, 3, 1, 3, '3', 'MB', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(52, 3, 2, 3, '3', 'M', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(53, 3, 3, 3, '3', 'B', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(54, 3, 4, 3, '3', 'E', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(55, 3, 5, 3, '3', 'R', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(56, 2, 3, 3, '3', 'R', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(57, 2, 4, 3, '3', 'MB', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(58, 2, 5, 3, '3', 'M', '2018-12-14 09:28:37', '2018-12-14 09:28:37'),
(59, 2, 3, 2, '1', NULL, '2018-12-27 06:03:25', '2018-12-27 06:03:25'),
(60, 2, 4, 2, '1', NULL, '2018-12-27 06:03:25', '2018-12-27 06:03:25'),
(61, 2, 5, 2, '1', NULL, '2018-12-27 06:03:25', '2018-12-27 06:03:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anios`
--

CREATE TABLE `anios` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `anios`
--

INSERT INTO `anios` (`id`, `numero`, `activo`, `editable`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2018, 0, 1, 1, '2018-06-30 08:10:46', '2018-11-30 08:10:43'),
(2, 2019, 1, 1, 1, '2018-09-25 08:38:58', '2018-12-14 01:21:32'),
(3, 2021, 0, 1, 1, '2018-11-30 08:10:43', '2018-12-14 01:21:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Ahuachapán', NULL, NULL),
(2, 'Cabañas', NULL, NULL),
(3, 'Chalatenango', NULL, NULL),
(4, 'Cuscatlán', NULL, NULL),
(5, 'La Libertad', NULL, NULL),
(6, 'La Paz', NULL, NULL),
(7, 'La Unión', NULL, NULL),
(8, 'Morazán', NULL, NULL),
(9, 'San Miguel', NULL, NULL),
(10, 'San Salvador', NULL, NULL),
(11, 'San Vicente', NULL, NULL),
(12, 'Santa Ana', NULL, NULL),
(13, 'Sonsonate', NULL, NULL),
(14, 'Usulután', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especialidad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'docente_default.jpg',
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nit` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nup` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isss` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` char(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estudios` text COLLATE utf8mb4_unicode_ci,
  `experiencia` text COLLATE utf8mb4_unicode_ci,
  `referencias` text COLLATE utf8mb4_unicode_ci,
  `idiomas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `user_id`, `nip`, `especialidad`, `imagen`, `estado`, `created_at`, `updated_at`, `nit`, `nup`, `isss`, `fecha_nacimiento`, `direccion`, `telefono`, `estudios`, `experiencia`, `referencias`, `idiomas`) VALUES
(1, 3, '1111111111', 'Matemática', 'docente_default.jpg', 1, '2018-06-30 08:20:14', '2018-12-28 02:02:46', NULL, NULL, NULL, '1990-11-23', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 4, '7777777777', NULL, 'docente_default.jpg', 1, '2018-12-28 01:50:32', '2018-12-29 09:55:18', NULL, NULL, NULL, '1995-10-20', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL,
  `materia_id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('EXA','ACT','REC') COLLATE utf8mb4_unicode_ci NOT NULL,
  `porcentaje` double(8,2) NOT NULL,
  `trimestre` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `grado_id`, `materia_id`, `tipo`, `porcentaje`, `trimestre`, `posicion`, `created_at`, `updated_at`) VALUES
(3, 2, 4, 'EXA', 0.30, '2', 1, '2018-09-28 06:27:45', '2018-09-28 06:27:45'),
(9, 2, 4, 'EXA', 0.30, '1', 1, '2018-09-28 11:07:58', '2018-09-28 17:00:41'),
(10, 2, 4, 'REC', 1.00, '1', 0, '2018-09-28 16:33:35', '2018-09-28 16:33:35'),
(11, 2, 4, 'REC', 1.00, '2', 0, '2018-09-28 16:59:37', '2018-09-28 16:59:37'),
(12, 2, 4, 'REC', 1.00, '3', 0, '2018-09-28 16:59:53', '2018-09-28 16:59:53'),
(14, 2, 4, 'ACT', 0.20, '3', 1, '2018-09-28 23:48:23', '2018-09-28 23:55:50'),
(15, 1, 3, 'REC', 1.00, '1', 0, '2018-09-29 00:05:57', '2018-09-29 00:05:57'),
(16, 1, 3, 'REC', 1.00, '2', 0, '2018-09-29 00:06:03', '2018-09-29 00:06:03'),
(17, 2, 3, 'REC', 1.00, '1', 0, '2018-09-29 00:59:46', '2018-09-29 00:59:46'),
(18, 1, 2, 'REC', 1.00, '1', 0, '2018-09-29 00:59:57', '2018-09-29 00:59:57'),
(19, 2, 1, 'REC', 1.00, '1', 0, '2018-09-29 01:00:43', '2018-09-29 01:00:43'),
(20, 2, 1, 'REC', 1.00, '2', 0, '2018-09-29 01:20:47', '2018-09-29 01:20:47'),
(21, 2, 1, 'ACT', 0.35, '1', 2, '2018-09-29 01:21:01', '2018-09-29 01:21:55'),
(22, 2, 1, 'ACT', 0.35, '1', 3, '2018-09-29 01:21:24', '2018-09-29 01:21:51'),
(23, 2, 1, 'EXA', 0.30, '1', 1, '2018-09-29 01:21:37', '2018-09-29 01:21:55'),
(24, 2, 6, 'REC', 1.00, '1', 0, '2018-09-29 01:37:46', '2018-09-29 01:37:46'),
(25, 3, 3, 'REC', 1.00, '1', 0, '2018-10-13 07:57:47', '2018-10-13 07:57:47'),
(26, 3, 4, 'REC', 1.00, '1', 0, '2018-10-13 07:57:52', '2018-10-13 07:57:52'),
(27, 3, 1, 'REC', 1.00, '1', 0, '2018-10-13 07:57:58', '2018-10-13 07:57:58'),
(28, 3, 2, 'REC', 1.00, '1', 0, '2018-10-13 07:58:03', '2018-10-13 07:58:03'),
(29, 1, 3, 'ACT', 0.30, '1', 1, '2018-10-13 08:30:20', '2018-10-13 08:30:20'),
(30, 3, 3, 'EXA', 0.30, '1', 1, '2018-10-13 08:31:51', '2018-10-13 08:31:51'),
(31, 1, 4, 'REC', 1.00, '1', 0, '2018-11-24 22:54:47', '2018-11-24 22:54:47'),
(32, 3, 3, 'REC', 1.00, '2', 0, '2018-12-14 09:15:10', '2018-12-14 09:15:10'),
(33, 3, 3, 'ACT', 0.35, '2', 2, '2018-12-14 09:15:25', '2018-12-27 05:31:22'),
(34, 3, 3, 'ACT', 0.35, '1', 2, '2018-12-14 09:15:39', '2018-12-14 09:15:39'),
(35, 3, 3, 'ACT', 0.35, '1', 3, '2018-12-14 09:16:00', '2018-12-14 09:16:00'),
(36, 3, 3, 'ACT', 0.35, '2', 1, '2018-12-14 09:16:34', '2018-12-27 05:29:42'),
(37, 3, 3, 'EXA', 0.30, '2', 3, '2018-12-14 09:16:51', '2018-12-27 05:31:22'),
(38, 3, 3, 'REC', 1.00, '3', 0, '2018-12-14 09:17:10', '2018-12-14 09:17:10'),
(39, 3, 3, 'EXA', 0.30, '3', 1, '2018-12-14 09:17:21', '2018-12-14 09:17:21'),
(40, 3, 3, 'ACT', 0.35, '3', 2, '2018-12-14 09:17:45', '2018-12-14 09:17:45'),
(41, 3, 3, 'ACT', 0.35, '3', 3, '2018-12-14 09:18:09', '2018-12-14 09:18:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nivel_id` int(10) UNSIGNED NOT NULL,
  `anio_id` int(10) UNSIGNED NOT NULL,
  `docente_id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seccion` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `nivel_id`, `anio_id`, `docente_id`, `codigo`, `seccion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2-A-2018', 'A', 1, '2018-06-30 08:21:26', '2018-06-30 08:21:26'),
(2, 10, 1, 1, '1BG-B-2018', 'B', 1, '2018-06-30 08:21:46', '2018-06-30 08:21:46'),
(3, 9, 2, 1, '9-B-2019', 'B', 1, '2018-09-25 08:41:16', '2018-09-25 08:41:16'),
(4, 6, 1, 1, '6-A-2018', 'A', 1, '2018-12-01 04:20:30', '2018-12-01 04:20:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_materia`
--

CREATE TABLE `grado_materia` (
  `id` int(10) UNSIGNED NOT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL,
  `materia_id` int(10) UNSIGNED NOT NULL,
  `docente_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grado_materia`
--

INSERT INTO `grado_materia` (`id`, `grado_id`, `materia_id`, `docente_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2018-06-30 08:21:26', '2018-12-15 01:47:13'),
(2, 1, 4, 1, '2018-06-30 08:21:26', '2018-12-15 01:47:13'),
(3, 1, 1, 1, '2018-06-30 08:21:26', '2018-12-15 01:47:13'),
(4, 1, 2, 1, '2018-06-30 08:21:26', '2018-12-15 01:47:13'),
(5, 2, 3, NULL, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(6, 2, 6, NULL, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(7, 2, 5, NULL, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(8, 2, 4, NULL, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(9, 2, 1, 1, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(10, 2, 2, NULL, '2018-06-30 08:21:46', '2018-06-30 08:21:55'),
(11, 3, 3, NULL, '2018-09-25 08:41:16', '2018-09-25 08:41:28'),
(12, 3, 4, NULL, '2018-09-25 08:41:16', '2018-09-25 08:41:29'),
(13, 3, 1, NULL, '2018-09-25 08:41:16', '2018-09-25 08:41:28'),
(14, 3, 2, NULL, '2018-09-25 08:41:16', '2018-09-25 08:41:28'),
(15, 4, 3, NULL, '2018-12-01 04:20:30', '2018-12-01 04:20:30'),
(16, 4, 4, NULL, '2018-12-01 04:20:30', '2018-12-01 04:20:30'),
(17, 4, 1, NULL, '2018-12-01 04:20:30', '2018-12-01 04:20:30'),
(18, 4, 2, NULL, '2018-12-01 04:20:30', '2018-12-01 04:20:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `fecha`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2018-12-24 00:00:00', 1, '2018-12-24 05:46:25', '2018-12-25 06:05:54'),
(2, '2018-12-27 00:00:00', 1, '2018-12-27 06:19:54', '2018-12-27 06:19:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_recurso`
--

CREATE TABLE `inventario_recurso` (
  `id` int(10) UNSIGNED NOT NULL,
  `recurso_id` int(10) UNSIGNED NOT NULL,
  `inventario_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventario_recurso`
--

INSERT INTO `inventario_recurso` (`id`, `recurso_id`, `inventario_id`, `cantidad`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 10, '2018-12-27 06:10:46', '2018-12-27 06:10:46'),
(3, 1, 2, 10, '2018-12-28 02:33:04', '2018-12-28 02:33:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `docente_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jornadas`
--

INSERT INTO `jornadas` (`id`, `docente_id`, `fecha`, `hora_entrada`, `hora_salida`, `created_at`, `updated_at`) VALUES
(3, 1, '2018-11-28', '07:00:37', '12:30:45', '2018-11-29 05:39:26', '2018-11-29 05:39:26'),
(4, 1, '2018-11-29', '07:09:31', '12:59:21', '2018-11-29 05:40:19', '2018-11-29 05:40:19'),
(5, 1, '2018-12-27', '00:06:49', NULL, '2018-12-27 06:07:04', '2018-12-27 06:07:04'),
(6, 2, '2018-12-27', '20:10:06', NULL, '2018-12-28 02:10:28', '2018-12-28 02:10:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `codigo`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'MAT2', 'Matemática', 1, '2018-06-30 08:11:19', '2018-12-15 06:21:22'),
(2, 'SOC', 'Sociales', 1, '2018-06-30 08:11:28', '2018-12-15 06:21:29'),
(3, 'CIE', 'Ciencias', 1, '2018-06-30 08:11:39', '2018-06-30 08:11:39'),
(4, 'LEN', 'Lenguaje', 1, '2018-06-30 08:12:12', '2018-06-30 08:12:12'),
(5, 'ING', 'Inglés', 1, '2018-06-30 08:12:26', '2018-06-30 08:12:26'),
(6, 'INF', 'Informática', 1, '2018-06-30 08:12:36', '2018-06-30 08:12:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_nivel`
--

CREATE TABLE `materia_nivel` (
  `id` int(10) UNSIGNED NOT NULL,
  `materia_id` int(10) UNSIGNED NOT NULL,
  `nivel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materia_nivel`
--

INSERT INTO `materia_nivel` (`id`, `materia_id`, `nivel_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2018-06-30 08:14:23', '2018-06-30 08:14:23'),
(2, 4, 1, '2018-06-30 08:14:23', '2018-06-30 08:14:23'),
(3, 1, 1, '2018-06-30 08:14:23', '2018-06-30 08:14:23'),
(4, 2, 1, '2018-06-30 08:14:23', '2018-06-30 08:14:23'),
(5, 3, 2, '2018-06-30 08:15:02', '2018-06-30 08:15:02'),
(6, 4, 2, '2018-06-30 08:15:02', '2018-06-30 08:15:02'),
(7, 1, 2, '2018-06-30 08:15:02', '2018-06-30 08:15:02'),
(8, 2, 2, '2018-06-30 08:15:02', '2018-06-30 08:15:02'),
(9, 3, 3, '2018-06-30 08:15:33', '2018-06-30 08:15:33'),
(10, 4, 3, '2018-06-30 08:15:33', '2018-06-30 08:15:33'),
(11, 1, 3, '2018-06-30 08:15:33', '2018-06-30 08:15:33'),
(12, 2, 3, '2018-06-30 08:15:33', '2018-06-30 08:15:33'),
(13, 3, 4, '2018-06-30 08:15:55', '2018-06-30 08:15:55'),
(14, 4, 4, '2018-06-30 08:15:55', '2018-06-30 08:15:55'),
(15, 1, 4, '2018-06-30 08:15:55', '2018-06-30 08:15:55'),
(16, 2, 4, '2018-06-30 08:15:55', '2018-06-30 08:15:55'),
(17, 3, 5, '2018-06-30 08:16:18', '2018-06-30 08:16:18'),
(18, 4, 5, '2018-06-30 08:16:18', '2018-06-30 08:16:18'),
(19, 1, 5, '2018-06-30 08:16:18', '2018-06-30 08:16:18'),
(20, 2, 5, '2018-06-30 08:16:18', '2018-06-30 08:16:18'),
(21, 3, 6, '2018-06-30 08:16:41', '2018-06-30 08:16:41'),
(22, 4, 6, '2018-06-30 08:16:41', '2018-06-30 08:16:41'),
(23, 1, 6, '2018-06-30 08:16:41', '2018-06-30 08:16:41'),
(24, 2, 6, '2018-06-30 08:16:41', '2018-06-30 08:16:41'),
(25, 3, 7, '2018-06-30 08:17:02', '2018-06-30 08:17:02'),
(26, 4, 7, '2018-06-30 08:17:03', '2018-06-30 08:17:03'),
(27, 1, 7, '2018-06-30 08:17:03', '2018-06-30 08:17:03'),
(28, 2, 7, '2018-06-30 08:17:03', '2018-06-30 08:17:03'),
(29, 3, 8, '2018-06-30 08:17:23', '2018-06-30 08:17:23'),
(30, 4, 8, '2018-06-30 08:17:23', '2018-06-30 08:17:23'),
(31, 1, 8, '2018-06-30 08:17:23', '2018-06-30 08:17:23'),
(32, 2, 8, '2018-06-30 08:17:23', '2018-06-30 08:17:23'),
(33, 3, 9, '2018-06-30 08:17:42', '2018-06-30 08:17:42'),
(34, 4, 9, '2018-06-30 08:17:42', '2018-06-30 08:17:42'),
(35, 1, 9, '2018-06-30 08:17:42', '2018-06-30 08:17:42'),
(36, 2, 9, '2018-06-30 08:17:43', '2018-06-30 08:17:43'),
(37, 3, 10, '2018-06-30 08:19:11', '2018-06-30 08:19:11'),
(38, 6, 10, '2018-06-30 08:19:11', '2018-06-30 08:19:11'),
(39, 5, 10, '2018-06-30 08:19:11', '2018-06-30 08:19:11'),
(40, 4, 10, '2018-06-30 08:19:12', '2018-06-30 08:19:12'),
(41, 1, 10, '2018-06-30 08:19:12', '2018-06-30 08:19:12'),
(42, 2, 10, '2018-06-30 08:19:12', '2018-06-30 08:19:12'),
(43, 3, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(44, 6, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(45, 5, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(46, 4, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(47, 1, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(48, 2, 11, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(49, 3, 12, '2018-11-28 10:21:28', '2018-11-28 10:21:28'),
(50, 6, 12, '2018-11-28 10:21:29', '2018-11-28 10:21:29'),
(51, 5, 12, '2018-11-28 10:21:29', '2018-11-28 10:21:29'),
(52, 4, 12, '2018-11-28 10:21:29', '2018-11-28 10:21:29'),
(53, 1, 12, '2018-11-28 10:21:29', '2018-11-28 10:21:29'),
(54, 2, 12, '2018-11-28 10:21:29', '2018-11-28 10:21:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(10) UNSIGNED NOT NULL,
  `alumno_id` int(10) UNSIGNED NOT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL,
  `desercion` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id`, `alumno_id`, `grado_id`, `desercion`, `created_at`, `updated_at`) VALUES
(3, 2, 2, NULL, '2018-09-26 00:01:55', '2018-09-26 00:47:57'),
(4, 1, 3, '2018-12-15', '2018-10-13 08:31:27', '2018-12-15 09:56:59'),
(5, 2, 3, NULL, '2018-11-25 02:24:51', '2018-11-25 02:24:51'),
(6, 3, 3, NULL, '2018-12-14 09:14:15', '2018-12-14 09:14:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_06_25_211113_create_roles_table', 1),
(2, '2018_06_25_211114_create_users_table', 1),
(3, '2018_06_25_211115_create_password_resets_table', 1),
(4, '2018_06_25_211929_create_docentes_table', 1),
(5, '2018_06_25_212553_create_jornadas_table', 1),
(6, '2018_06_25_212808_create_anios_table', 1),
(7, '2018_06_25_224228_create_materias_table', 1),
(8, '2018_06_25_225059_create_niveles_table', 1),
(9, '2018_06_25_225808_create_materia_nivel_table', 1),
(10, '2018_06_25_230226_create_grados_table', 1),
(11, '2018_06_25_230626_create_grado_materia_table', 1),
(12, '2018_09_21_003847_create_departamentos_table', 2),
(13, '2018_09_21_003952_create_municipios_table', 2),
(14, '2018_09_21_005037_create_valores_table', 2),
(15, '2018_09_21_005953_create_evaluaciones_table', 3),
(16, '2018_09_21_011737_create_alumnos_table', 3),
(17, '2018_09_21_011831_create_matriculas_table', 3),
(18, '2018_09_21_011922_create_alumno_evaluacion_table', 3),
(22, '2018_09_21_011955_create_alumno_valor_table', 4),
(23, '2018_12_05_125626_create_pagos_table', 5),
(24, '2018_12_05_130251_create_alumno_pago_table', 5),
(25, '2018_12_05_093727_create_recursos_table', 6),
(28, '2018_12_06_043935_create_inventarios_table', 7),
(29, '2018_12_06_044544_create_inventario_recurso_table', 7),
(30, '2018_12_29_012133_add_curriculum_fields_to_docentes', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `departamento_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ahuachapán', NULL, NULL),
(2, 1, 'Apaneca', NULL, NULL),
(3, 1, 'Atiquizaya', NULL, NULL),
(4, 1, 'Concepción de Ataco', NULL, NULL),
(5, 1, 'El Refugio', NULL, NULL),
(6, 1, 'Guaymango', NULL, NULL),
(7, 1, 'Jujutla', NULL, NULL),
(8, 1, 'San Francisco Menéndez', NULL, NULL),
(9, 1, 'San Lorenzo', NULL, NULL),
(10, 1, 'San Pedro Puxtla', NULL, NULL),
(11, 1, 'Tacuba', NULL, NULL),
(12, 1, 'Turín', NULL, NULL),
(13, 2, 'Sensuntepeque', NULL, NULL),
(14, 2, 'Cinquera', NULL, NULL),
(15, 2, 'Dolores', NULL, NULL),
(16, 2, 'Guacotetic', NULL, NULL),
(17, 2, 'Ilobasco', NULL, NULL),
(18, 2, 'Jutiapa', NULL, NULL),
(19, 2, 'San Isidro', NULL, NULL),
(20, 2, 'Tejutepeque', NULL, NULL),
(21, 2, 'Victoria', NULL, NULL),
(22, 3, 'Chalatenango', NULL, NULL),
(23, 3, 'Agua Caliente', NULL, NULL),
(24, 3, 'Arcatao', NULL, NULL),
(25, 3, 'Azacualpa', NULL, NULL),
(26, 3, 'Cancasque', NULL, NULL),
(27, 3, 'Citalá', NULL, NULL),
(28, 3, 'Comalapa', NULL, NULL),
(29, 3, 'Concepción Quezaltepeque', NULL, NULL),
(30, 3, 'Dulce Nombre de María', NULL, NULL),
(31, 3, 'El Carrizal', NULL, NULL),
(32, 3, 'El Paraíso', NULL, NULL),
(33, 3, 'La Laguna', NULL, NULL),
(34, 3, 'La Palma', NULL, NULL),
(35, 3, 'La Reina', NULL, NULL),
(36, 3, 'Las Flores', NULL, NULL),
(37, 3, 'Las Vueltas', NULL, NULL),
(38, 3, 'Nombre de Jesús', NULL, NULL),
(39, 3, 'Nueva Concepción', NULL, NULL),
(40, 3, 'Nueva Trinidad', NULL, NULL),
(41, 3, 'Ojos de Agua', NULL, NULL),
(42, 3, 'Potonico', NULL, NULL),
(43, 3, 'San Antonio de la Cruz', NULL, NULL),
(44, 3, 'San Antonio Los Ranchos', NULL, NULL),
(45, 3, 'San Fernando', NULL, NULL),
(46, 3, 'San Francisco Lempa', NULL, NULL),
(47, 3, 'San Francisco Morazán', NULL, NULL),
(48, 3, 'San Ignacio', NULL, NULL),
(49, 3, 'San Isidro Labrador', NULL, NULL),
(50, 3, 'San Luis del Carmen', NULL, NULL),
(51, 3, 'San Miguel de Mercedes', NULL, NULL),
(52, 3, 'San Rafael', NULL, NULL),
(53, 3, 'Santa Rita', NULL, NULL),
(54, 3, 'Tejutla', NULL, NULL),
(55, 4, 'Cojutepeque', NULL, NULL),
(56, 4, 'Candelaria', NULL, NULL),
(57, 4, 'El Carmen', NULL, NULL),
(58, 4, 'El Rosario', NULL, NULL),
(59, 4, 'Monte San Juan', NULL, NULL),
(60, 4, 'Oratorio de Concepción', NULL, NULL),
(61, 4, 'San Bartolomé Perulapía', NULL, NULL),
(62, 4, 'San Cristóbal', NULL, NULL),
(63, 4, 'San José Guayabal', NULL, NULL),
(64, 4, 'San Pedro Perulapán', NULL, NULL),
(65, 4, 'San Rafael Cedros', NULL, NULL),
(66, 4, 'San Ramón', NULL, NULL),
(67, 4, 'Santa Cruz Analquito', NULL, NULL),
(68, 4, 'Santa Cruz Michapa', NULL, NULL),
(69, 4, 'Suchitoto', NULL, NULL),
(70, 4, 'Tenancingo', NULL, NULL),
(71, 5, 'Santa Tecla', NULL, NULL),
(72, 5, 'Antiguo Cuscatlán', NULL, NULL),
(73, 5, 'Chiltiupán', NULL, NULL),
(74, 5, 'Ciudad Arce', NULL, NULL),
(75, 5, 'Colón', NULL, NULL),
(76, 5, 'Comasagua', NULL, NULL),
(77, 5, 'Huizúcar', NULL, NULL),
(78, 5, 'Jayaque', NULL, NULL),
(79, 5, 'Jicalapa', NULL, NULL),
(80, 5, 'La Libertad', NULL, NULL),
(81, 5, 'Nuevo Cuscatlán', NULL, NULL),
(82, 5, 'Quezaltepeque', NULL, NULL),
(83, 5, 'San Juan Opico', NULL, NULL),
(84, 5, 'Sacacoyo', NULL, NULL),
(85, 5, 'San José Villanueva', NULL, NULL),
(86, 5, 'San Matías', NULL, NULL),
(87, 5, 'San Pablo Tacachico', NULL, NULL),
(88, 5, 'Talnique', NULL, NULL),
(89, 5, 'Tamanique', NULL, NULL),
(90, 5, 'Teotepeque', NULL, NULL),
(91, 5, 'Tepecoyo', NULL, NULL),
(92, 5, 'Zaragoza', NULL, NULL),
(93, 6, 'Zacatecoluca', NULL, NULL),
(94, 6, 'Cuyultitán', NULL, NULL),
(95, 6, 'El Rosario', NULL, NULL),
(96, 6, 'Jerusalén', NULL, NULL),
(97, 6, 'Mercedes La Ceiba', NULL, NULL),
(98, 6, 'Olocuilta', NULL, NULL),
(99, 6, 'Paraíso de Osorio', NULL, NULL),
(100, 6, 'San Antonio Masahuat', NULL, NULL),
(101, 6, 'San Emigdio', NULL, NULL),
(102, 6, 'San Francisco Chinameca', NULL, NULL),
(103, 6, 'San Pedro Masahuat', NULL, NULL),
(104, 6, 'San Juan Nonualco', NULL, NULL),
(105, 6, 'San Juan Talpa', NULL, NULL),
(106, 6, 'San Juan Tepezontes', NULL, NULL),
(107, 6, 'San Luis La Herradura', NULL, NULL),
(108, 6, 'San Luis Talpa', NULL, NULL),
(109, 6, 'San Miguel Tepezontes', NULL, NULL),
(110, 6, 'San Pedro Nonualco', NULL, NULL),
(111, 6, 'San Rafael Obrajuelo', NULL, NULL),
(112, 6, 'Santa María Ostuma', NULL, NULL),
(113, 6, 'Santiago Nonualco', NULL, NULL),
(114, 6, 'Tapalhuaca', NULL, NULL),
(115, 7, 'La Unión', NULL, NULL),
(116, 7, 'Anamorós', NULL, NULL),
(117, 7, 'Bolívar', NULL, NULL),
(118, 7, 'Concepción de Oriente', NULL, NULL),
(119, 7, 'Conchagua', NULL, NULL),
(120, 7, 'El Carmen', NULL, NULL),
(121, 7, 'El Sauce', NULL, NULL),
(122, 7, 'Intipucá', NULL, NULL),
(123, 7, 'Lislique', NULL, NULL),
(124, 7, 'Meanguera del Golfo', NULL, NULL),
(125, 7, 'Nueva Esparta', NULL, NULL),
(126, 7, 'Pasaquina', NULL, NULL),
(127, 7, 'Polorós', NULL, NULL),
(128, 7, 'San Alejo', NULL, NULL),
(129, 7, 'San José', NULL, NULL),
(130, 7, 'Santa Rosa de Lima', NULL, NULL),
(131, 7, 'Yayantique', NULL, NULL),
(132, 7, 'Yucuaiquín', NULL, NULL),
(133, 8, 'San Francisco Gotera', NULL, NULL),
(134, 8, 'Arambala', NULL, NULL),
(135, 8, 'Cacaopera', NULL, NULL),
(136, 8, 'Chilanga', NULL, NULL),
(137, 8, 'Corinto', NULL, NULL),
(138, 8, 'Delicias de Concepción', NULL, NULL),
(139, 8, 'El Divisadero', NULL, NULL),
(140, 8, 'El Rosario', NULL, NULL),
(141, 8, 'Gualococti', NULL, NULL),
(142, 8, 'Guatajiagua', NULL, NULL),
(143, 8, 'Joateca', NULL, NULL),
(144, 8, 'Jocoaitique', NULL, NULL),
(145, 8, 'Jocoro', NULL, NULL),
(146, 8, 'Lolotiquillo', NULL, NULL),
(147, 8, 'Meanguera', NULL, NULL),
(148, 8, 'Osicala', NULL, NULL),
(149, 8, 'Perquín', NULL, NULL),
(150, 8, 'San Carlos', NULL, NULL),
(151, 8, 'San Fernando', NULL, NULL),
(152, 8, 'San Isidro', NULL, NULL),
(153, 8, 'San Simón', NULL, NULL),
(154, 8, 'Sensembra', NULL, NULL),
(155, 8, 'Sociedad', NULL, NULL),
(156, 8, 'Torola', NULL, NULL),
(157, 8, 'Yamabal', NULL, NULL),
(158, 8, 'Yoloaiquín', NULL, NULL),
(159, 9, 'San Miguel', NULL, NULL),
(160, 9, 'Carolina', NULL, NULL),
(161, 9, 'Chapeltique', NULL, NULL),
(162, 9, 'Chinameca', NULL, NULL),
(163, 9, 'Chirilagua', NULL, NULL),
(164, 9, 'Ciudad Barrios', NULL, NULL),
(165, 9, 'Comacarán', NULL, NULL),
(166, 9, 'El Tránsito', NULL, NULL),
(167, 9, 'Lolotique', NULL, NULL),
(168, 9, 'Moncagua', NULL, NULL),
(169, 9, 'Nueva Guadalupe', NULL, NULL),
(170, 9, 'Nuevo Edén de San Juan', NULL, NULL),
(171, 9, 'Quelepa', NULL, NULL),
(172, 9, 'San Antonio', NULL, NULL),
(173, 9, 'San Gerardo', NULL, NULL),
(174, 9, 'San Jorge', NULL, NULL),
(175, 9, 'San Luis de la Reina', NULL, NULL),
(176, 9, 'San Rafael Oriente', NULL, NULL),
(177, 9, 'Sesori', NULL, NULL),
(178, 9, 'Uluazapa', NULL, NULL),
(179, 10, 'San Salvador', NULL, NULL),
(180, 10, 'Aguilares', NULL, NULL),
(181, 10, 'Apopa', NULL, NULL),
(182, 10, 'Ayutuxtepeque', NULL, NULL),
(183, 10, 'Cuscatancingo', NULL, NULL),
(184, 10, 'Delgado', NULL, NULL),
(185, 10, 'El Paisnal', NULL, NULL),
(186, 10, 'Guazapa', NULL, NULL),
(187, 10, 'Ilopango', NULL, NULL),
(188, 10, 'Mejicanos', NULL, NULL),
(189, 10, 'Nejapa', NULL, NULL),
(190, 10, 'Panchimalco', NULL, NULL),
(191, 10, 'Rosario de Mora', NULL, NULL),
(192, 10, 'San Marcos', NULL, NULL),
(193, 10, 'San Martín', NULL, NULL),
(194, 10, 'Santiago Texacuangos', NULL, NULL),
(195, 10, 'Santo Tomás', NULL, NULL),
(196, 10, 'Soyapango', NULL, NULL),
(197, 10, 'Tonacatepeque', NULL, NULL),
(198, 11, 'San Vicente', NULL, NULL),
(199, 11, 'Apastepeque', NULL, NULL),
(200, 11, 'Guadalupe', NULL, NULL),
(201, 11, 'San Cayetano Istepeque', NULL, NULL),
(202, 11, 'San Esteban Catarina', NULL, NULL),
(203, 11, 'San Ildefonso', NULL, NULL),
(204, 11, 'San Lorenzo', NULL, NULL),
(205, 11, 'San Sebastián', NULL, NULL),
(206, 11, 'Santa Clara', NULL, NULL),
(207, 11, 'Santo Domingo', NULL, NULL),
(208, 11, 'Tecoluca', NULL, NULL),
(209, 11, 'Tepetitán', NULL, NULL),
(210, 11, 'Verapaz', NULL, NULL),
(211, 12, 'Santa Ana', NULL, NULL),
(212, 12, 'Candelaria de la Frontera', NULL, NULL),
(213, 12, 'Chalchuapa', NULL, NULL),
(214, 12, 'Coatepeque', NULL, NULL),
(215, 12, ' El Congo', NULL, NULL),
(216, 12, 'El Porvenir', NULL, NULL),
(217, 12, 'Masahuat', NULL, NULL),
(218, 12, 'Metapán', NULL, NULL),
(219, 12, 'San Antonio Pajonal', NULL, NULL),
(220, 12, 'San Sebastián Salitrillo', NULL, NULL),
(221, 12, 'Santa Rosa Guachipilín', NULL, NULL),
(222, 12, 'Santiago de la Frontera', NULL, NULL),
(223, 12, 'Texistepeque', NULL, NULL),
(224, 13, 'Sonsonate', NULL, NULL),
(225, 13, 'Acajutla', NULL, NULL),
(226, 13, 'Armenia', NULL, NULL),
(227, 13, 'Caluco', NULL, NULL),
(228, 13, 'Cuisnahuat', NULL, NULL),
(229, 13, 'Izalco', NULL, NULL),
(230, 13, 'Juayúa', NULL, NULL),
(231, 13, 'Nahuizalco', NULL, NULL),
(232, 13, 'Nahulingo', NULL, NULL),
(233, 13, 'Salcoatitán', NULL, NULL),
(234, 13, 'San Antonio del Monte', NULL, NULL),
(235, 13, 'San Julián', NULL, NULL),
(236, 13, 'Santa Catarina Masahuat', NULL, NULL),
(237, 13, 'Santa Isabel Ishuatán', NULL, NULL),
(238, 13, 'Santo Domingo de Guzmán', NULL, NULL),
(239, 13, 'Sonzacate', NULL, NULL),
(240, 14, 'Usulután', NULL, NULL),
(241, 14, 'Alegría', NULL, NULL),
(242, 14, 'Berlín', NULL, NULL),
(243, 14, 'California', NULL, NULL),
(244, 14, 'Concepción Batres', NULL, NULL),
(245, 14, 'El Triunfo', NULL, NULL),
(246, 14, 'Ereguayquín', NULL, NULL),
(247, 14, 'Estanzuelas', NULL, NULL),
(248, 14, 'Jiquilisco', NULL, NULL),
(249, 14, 'Jucuapa', NULL, NULL),
(250, 14, 'Jucuarán', NULL, NULL),
(251, 14, 'Mercedes Umaña', NULL, NULL),
(252, 14, 'Nueva Granada', NULL, NULL),
(253, 14, 'Ozatlán', NULL, NULL),
(254, 14, 'Puerto El Triunfo', NULL, NULL),
(255, 14, 'San Agustín', NULL, NULL),
(256, 14, 'San Buenaventura', NULL, NULL),
(257, 14, 'San Dionisio', NULL, NULL),
(258, 14, 'San Francisco Javier', NULL, NULL),
(259, 14, 'Santa Elena', NULL, NULL),
(260, 14, 'Santa María', NULL, NULL),
(261, 14, 'Santiago de María', NULL, NULL),
(262, 14, 'Tecapán', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orientador_materia` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `codigo`, `nombre`, `orientador_materia`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1', 'Primer Grado', 1, 1, '2018-06-30 08:14:23', '2018-06-30 08:14:23'),
(2, '2', 'Segundo Grado', 1, 1, '2018-06-30 08:15:02', '2018-06-30 08:15:10'),
(3, '3', 'Tercer Grado', 1, 1, '2018-06-30 08:15:32', '2018-06-30 08:15:32'),
(4, '4', 'Cuarto Grado', 1, 1, '2018-06-30 08:15:55', '2018-06-30 08:15:55'),
(5, '5', 'Quinto Grado', 1, 1, '2018-06-30 08:16:18', '2018-06-30 08:16:18'),
(6, '6', 'Sexto Grado', 0, 1, '2018-06-30 08:16:40', '2018-06-30 08:16:40'),
(7, '7', 'Septimo Grado', 0, 1, '2018-06-30 08:17:02', '2018-06-30 08:17:02'),
(8, '8', 'Octavo Grado', 0, 1, '2018-06-30 08:17:23', '2018-06-30 08:17:23'),
(9, '9', 'Noveno Grado', 0, 1, '2018-06-30 08:17:42', '2018-06-30 08:17:42'),
(10, '1BG', 'Primer Año de Bachillerato General', 0, 1, '2018-06-30 08:19:11', '2018-06-30 08:19:11'),
(11, '2BG', 'Segundo Año de Bachillerato General', 0, 1, '2018-06-30 08:19:42', '2018-06-30 08:19:42'),
(12, '1BC', 'Primer Año de Bachillerato Opción Contador', 0, 0, '2018-11-28 10:21:28', '2018-11-29 05:33:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `anio_id` int(10) UNSIGNED NOT NULL,
  `mes` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `anio_id`, `mes`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2018-12-06 05:48:03', '2018-12-06 05:54:56'),
(2, 2, 1, 1, '2018-12-06 05:53:53', '2018-12-06 05:53:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('docente@mail.com', '$2y$10$m9outTP0G.9gbyH38UxJFOEpVlJm6NRlu68lhAX8QRPIYqkpxHQKC', '2018-12-28 07:22:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Lempita', 'Laptop', '2018-12-07 04:00:43', '2018-12-07 04:00:43'),
(2, 'Pupitre', NULL, '2018-12-28 02:39:11', '2018-12-28 02:39:11'),
(3, 'Pizarra', NULL, '2018-12-28 02:42:26', '2018-12-28 02:42:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `codigo`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'direc', 'Director', 1, '2018-06-30 08:06:10', '2018-06-30 08:06:10'),
(2, 'secre', 'Secretaria', 1, '2018-06-30 08:06:22', '2018-06-30 08:06:22'),
(3, 'docen', 'Docente', 1, '2018-06-30 08:06:34', '2018-06-30 08:06:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dui` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user_default.jpg',
  `estado` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_id`, `nombre`, `apellido`, `email`, `password`, `dui`, `imagen`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Usuario', 'Director', 'director@mail.com', '$2y$10$V/wAeovi3AkI79B36b7no.YtzxR9Qy.Kdb/SDgcNfF7UXID6r4LL6', '11111111-1', 'user_default.jpg', 1, '5LekByC0rGD1hqLQlJhDOegX56FgzeHoWSED4Ta5inrrJ43xewJlua3d8ROd', '2018-06-30 08:07:28', '2018-06-30 08:07:28'),
(2, 2, 'Usuario', 'Secretaria', 'secretaria@mail.com', '$2y$10$LM.GcDpO3hm3qCLHmr7jjueMMASw2yE7bL/T4HoMmNpB19INqyngG', '22222222-2', 'user_default.jpg', 1, '85MTvn3Tn6NbwtV8wEXrjDnvt76lAWwdN9w05Qe3Dg3ljJQSqQsf7YcUsm19', '2018-06-30 08:08:03', '2018-06-30 08:08:03'),
(3, 3, 'Usuario', 'Docente', 'docente@mail.com', '$2y$10$8HgDoab2Rui1xk1UNIaCRO0WJr2GbB6haTbq1O0kRmIQbELFw0kfS', '33333333-3', 'user_default.jpg', 1, 'Mmch8u6Lg5UhLuEGsKpJ8atzoQwDg3YQd1hDWyfMA2SRE82G7UGoTbY6QrY5', '2018-06-30 08:08:33', '2018-06-30 08:08:33'),
(4, 1, 'William Antonio', 'Coto Olmedo', 'william@mail.com', '$2y$10$xeQzK21PCzUA9c88qaHWs.ayha6I/exi36xT.hTCna4DyMN5NIPym', '77777777-7', 'user_default.jpg', 1, NULL, '2018-12-28 01:48:45', '2018-12-28 01:48:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `id` int(10) UNSIGNED NOT NULL,
  `valor` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`id`, `valor`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Respeto', 1, '2018-09-29 03:49:24', '2018-12-15 06:17:40'),
(2, 'Convivencia', 1, '2018-11-25 01:21:27', '2018-12-15 06:17:58'),
(3, 'Responsabilidad', 1, '2018-12-14 09:24:40', '2018-12-15 06:18:09'),
(4, 'Hace deberes', 1, '2018-12-14 09:26:15', '2018-12-15 06:18:43'),
(5, 'Practica valores', 1, '2018-12-14 09:26:34', '2018-12-15 06:19:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumnos_nie_unique` (`nie`),
  ADD KEY `alumnos_municipio_id_foreign` (`municipio_id`);

--
-- Indices de la tabla `alumno_evaluacion`
--
ALTER TABLE `alumno_evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_evaluacion_alumno_id_foreign` (`alumno_id`),
  ADD KEY `alumno_evaluacion_evaluacion_id_foreign` (`evaluacion_id`);

--
-- Indices de la tabla `alumno_pago`
--
ALTER TABLE `alumno_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_pago_alumno_id_foreign` (`alumno_id`),
  ADD KEY `alumno_pago_pago_id_foreign` (`pago_id`);

--
-- Indices de la tabla `alumno_valor`
--
ALTER TABLE `alumno_valor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_valor_alumno_id_foreign` (`alumno_id`),
  ADD KEY `alumno_valor_valor_id_foreign` (`valor_id`),
  ADD KEY `alumno_valor_grado_id_foreign` (`grado_id`);

--
-- Indices de la tabla `anios`
--
ALTER TABLE `anios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anios_numero_unique` (`numero`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `docentes_nip_unique` (`nip`),
  ADD KEY `docentes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluaciones_grado_id_foreign` (`grado_id`),
  ADD KEY `evaluaciones_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grados_codigo_unique` (`codigo`),
  ADD KEY `grados_anio_id_foreign` (`anio_id`),
  ADD KEY `grados_docente_id_foreign` (`docente_id`),
  ADD KEY `grados_nivel_id_anio_id_seccion_index` (`nivel_id`,`anio_id`,`seccion`);

--
-- Indices de la tabla `grado_materia`
--
ALTER TABLE `grado_materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grado_materia_materia_id_foreign` (`materia_id`),
  ADD KEY `grado_materia_docente_id_foreign` (`docente_id`),
  ADD KEY `grado_materia_grado_id_materia_id_index` (`grado_id`,`materia_id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_recurso`
--
ALTER TABLE `inventario_recurso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventario_recurso_inventario_id_foreign` (`inventario_id`),
  ADD KEY `inventario_recurso_recurso_id_inventario_id_cantidad_index` (`recurso_id`,`inventario_id`,`cantidad`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jornadas_docente_id_fecha_index` (`docente_id`,`fecha`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `materias_codigo_unique` (`codigo`);

--
-- Indices de la tabla `materia_nivel`
--
ALTER TABLE `materia_nivel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_nivel_nivel_id_foreign` (`nivel_id`),
  ADD KEY `materia_nivel_materia_id_nivel_id_index` (`materia_id`,`nivel_id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculas_alumno_id_foreign` (`alumno_id`),
  ADD KEY `matriculas_grado_id_foreign` (`grado_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_departamento_id_foreign` (`departamento_id`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `niveles_codigo_unique` (`codigo`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_anio_id_foreign` (`anio_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_codigo_unique` (`codigo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_dui_unique` (`dui`),
  ADD KEY `users_rol_id_foreign` (`rol_id`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alumno_evaluacion`
--
ALTER TABLE `alumno_evaluacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `alumno_pago`
--
ALTER TABLE `alumno_pago`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alumno_valor`
--
ALTER TABLE `alumno_valor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `anios`
--
ALTER TABLE `anios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grado_materia`
--
ALTER TABLE `grado_materia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario_recurso`
--
ALTER TABLE `inventario_recurso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materia_nivel`
--
ALTER TABLE `materia_nivel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`);

--
-- Filtros para la tabla `alumno_evaluacion`
--
ALTER TABLE `alumno_evaluacion`
  ADD CONSTRAINT `alumno_evaluacion_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `alumno_evaluacion_evaluacion_id_foreign` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluaciones` (`id`);

--
-- Filtros para la tabla `alumno_pago`
--
ALTER TABLE `alumno_pago`
  ADD CONSTRAINT `alumno_pago_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `alumno_pago_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`);

--
-- Filtros para la tabla `alumno_valor`
--
ALTER TABLE `alumno_valor`
  ADD CONSTRAINT `alumno_valor_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `alumno_valor_grado_id_foreign` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
  ADD CONSTRAINT `alumno_valor_valor_id_foreign` FOREIGN KEY (`valor_id`) REFERENCES `valores` (`id`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_grado_id_foreign` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
  ADD CONSTRAINT `evaluaciones_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `grados_anio_id_foreign` FOREIGN KEY (`anio_id`) REFERENCES `anios` (`id`),
  ADD CONSTRAINT `grados_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `grados_nivel_id_foreign` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`);

--
-- Filtros para la tabla `grado_materia`
--
ALTER TABLE `grado_materia`
  ADD CONSTRAINT `grado_materia_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `grado_materia_grado_id_foreign` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
  ADD CONSTRAINT `grado_materia_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

--
-- Filtros para la tabla `inventario_recurso`
--
ALTER TABLE `inventario_recurso`
  ADD CONSTRAINT `inventario_recurso_inventario_id_foreign` FOREIGN KEY (`inventario_id`) REFERENCES `inventarios` (`id`),
  ADD CONSTRAINT `inventario_recurso_recurso_id_foreign` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `jornadas_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`);

--
-- Filtros para la tabla `materia_nivel`
--
ALTER TABLE `materia_nivel`
  ADD CONSTRAINT `materia_nivel_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `materia_nivel_nivel_id_foreign` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `matriculas_grado_id_foreign` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_anio_id_foreign` FOREIGN KEY (`anio_id`) REFERENCES `anios` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
