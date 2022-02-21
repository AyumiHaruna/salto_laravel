-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2018 a las 17:46:02
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saltum_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audios`
--

CREATE TABLE `audios` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=off/1=on',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=off/1=on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `audios`
--

INSERT INTO `audios` (`id`, `category`, `title`, `description`, `url`, `thumbnail`, `position`, `lock`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 'CLASE 1', 'Introducción al universo', '201809201884dogbark.mp3', '201809203945thumbnail_prueba.png', 1, 0, 1, '2018-09-20 17:43:34', '2018-09-20 08:21:30'),
(2, 2, 'CLASE 2', 'Las estrellas', '201809209462dogbark.mp3', '201809205171thumbnail_prueba_2.png', 2, 0, 1, '2018-09-20 17:50:42', '2018-09-20 08:21:53'),
(3, 2, 'CLASE 3', 'Los planetas', '201809203795dogbark.mp3', '201809208406thumbnail_prueba.png', 3, 0, 1, '2018-09-20 17:51:31', '2018-09-20 08:22:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audios_category`
--

CREATE TABLE `audios_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=off/1=on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `audios_category`
--

INSERT INTO `audios_category` (`id`, `category`, `display_name`, `description`, `thumbnail`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Salud Física', 'saludfisica', 'Temas de salud', '201809208294miniatura_ejemplo.png', 1, '2018-09-18 10:14:56', '2018-09-20 08:11:01'),
(2, 'Cosmos', 'cosmos', 'Temas del universo', '201809181571space-wallpaper-27.jpg', 1, '2018-09-18 10:15:13', '2018-09-20 08:12:37'),
(3, 'Nature', 'nature', 'algo sobre naturalezaaaaaa.', '201809189466Captura.PNG', 1, '2018-09-18 10:32:32', '2018-09-18 10:32:32'),
(4, 'Autos', 'autos', 'temas sobre autos', '201809187863autos.PNG', 1, '2018-09-18 10:34:15', '2018-09-18 10:34:15'),
(5, 'Vacaciones', 'vacaciones', 'temas sobre vacaciones', '201809188155peces.PNG', 1, '2018-09-18 10:34:37', '2018-09-18 10:34:37'),
(6, 'Mascotas', 'mascotas', 'temas sobre cuidado de mascotas', '201809187120mascotas.PNG', 1, '2018-09-18 10:35:01', '2018-09-18 10:35:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audios_score`
--

CREATE TABLE `audios_score` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_audio` int(11) NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloglike`
--

CREATE TABLE `bloglike` (
  `id` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogpost`
--

CREATE TABLE `blogpost` (
  `id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metatag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mensaje` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `publiDate` date NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `blogpost`
--

INSERT INTO `blogpost` (`id`, `foto`, `titulo`, `display_url`, `metatag`, `mensaje`, `id_usuario`, `created_at`, `updated_at`, `publiDate`, `visible`, `likes`) VALUES
(1, '201808035628Los-3-fantasmas.jpg', 'Los 3 fantasmas que te impiden cambiar tu vida', 'los_3_fantasmas_que_te_impiden_cambiar_tu_vida', 'Descubre una herramienta útil que te ayudará a definir y alcanzar tu propósito de vida', '<div><span style=\"font-size: 33.792px;\"><br></span></div><div><span style=\"font-size: 33.792px;\">&nbsp; &nbsp; &nbsp;Durante el año 2005, el escritor y explorador estadounidense Dan Buettner, se encontraba trabajando en un proyecto para la revista National Geographic. La misión: “descubrir las zonas del planeta con mayor esperanza de vida”.</span></div><div><span style=\"font-size: 33.792px;\">&nbsp; &nbsp; &nbsp;Se dedicó a visitar por meses las zonas del mundo con el registro más alto de centenarios, recopilando información acerca de los hábitos que podrían estar favoreciendo a su estado de salud física y mental.</span></div><div><span style=\"font-size: 33.792px;\">&nbsp; &nbsp; &nbsp;Uno de los sitios más relevantes dentro de la investigación, resultó ser la isla de Okinawa. Buettner encontró que este es el sitio donde la gente tiene la esperanza de vida, sin discapacidades, más larga en todo el mundo y el equipo de investigación, se dio a la tarea de identificar las razones por las que estas personas gozan de tan favorable calidad de vida: una dieta basada en el consumo de plantas, actividad física diaria, mantener sus relaciones sociales unidas y, lo más asombroso… cada uno de los habitantes tiene muy claro su propósito de vida.</span></div><div><br></div>  ', 14, '2018-08-04 00:56:48', '2018-08-04 01:00:10', '2018-08-03', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogtemas`
--

CREATE TABLE `blogtemas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `display_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `blogtemas`
--

INSERT INTO `blogtemas` (`id`, `descripcion`, `display_url`, `foto`, `activo`) VALUES
(1, 'salud', 'salud', '201808034903Los-3-fantasmas.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogtemasxpost`
--

CREATE TABLE `blogtemasxpost` (
  `id` int(11) NOT NULL,
  `id_Tema` int(11) NOT NULL,
  `id_Post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `blogtemasxpost`
--

INSERT INTO `blogtemasxpost` (`id`, `id_Tema`, `id_Post`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_coachee` int(11) NOT NULL,
  `id_support` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending/2=attended/3closed',
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `attended_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `id_coachee`, `id_support`, `status`, `file`, `created_at`, `updated_at`, `attended_at`, `closed_at`) VALUES
(1, 3, 4, 3, 'msgl_3.json', '2018-09-14 04:34:13', '2018-09-14 05:38:28', '2018-09-14 04:34:39', '2018-09-14 05:38:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coach_config`
--

CREATE TABLE `coach_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `coach_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `w_days` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coach_config`
--

INSERT INTO `coach_config` (`id`, `coach_id`, `start_date`, `end_date`, `start_time`, `end_time`, `w_days`) VALUES
(1, 4, '2018-08-30', '2018-09-21', '13:00:00', '15:00:00', '0010101'),
(2, 13, '2018-07-01', '2018-08-22', '13:00:00', '18:00:00', '0111100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'na', 'No aplica', '2018-06-14 21:55:55', '2018-06-14 21:55:55'),
(2, 'saltum', 'Saltum SA de CV', NULL, '2018-06-28 04:20:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `correo`, `telefono`, `schedule`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Luis serna', 'mail@mail.com', '5555 5555', '', '', '2018-07-05 03:04:06', '2018-07-05 03:04:06'),
(2, 'Luis Serna', 'mail1@mail.com', '5555 5555', '', '', '2018-07-05 04:32:36', '2018-07-05 04:32:36'),
(3, 'Luis Serna', 'mail4@mail.com', '5555 5555', '', '', '2018-07-05 04:33:09', '2018-07-05 04:33:09'),
(4, 'Luis Serna', 'mail2@mail.com', '5555 5555', '', '', '2018-07-06 03:28:01', '2018-07-06 03:28:01'),
(5, 'luisin', 'mail5@mail5.com', '5555 5555', '', '', '2018-07-10 23:05:38', '2018-07-10 23:05:38'),
(6, 'Soy un nuevo Usuario', 'mail@mailtest.com', '5555 5555', '', '', '2018-07-19 20:53:34', '2018-07-19 20:53:34'),
(7, 'Luis Serna', 'mail@mailllll.com', '5555 5555', '15:00 - 18:00', 'comentarios de prueba', '2018-08-02 01:23:28', '2018-08-02 01:23:28'),
(8, 'Luis Serna', 'mailkljñlkj@mail.com', '5555 5555', '16:00 - 18:00', '', '2018-08-02 02:18:37', '2018-08-02 02:18:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `first_payment`
--

CREATE TABLE `first_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `fp_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `first_payment`
--

INSERT INTO `first_payment` (`id`, `fp_description`, `created_at`, `updated_at`) VALUES
(1, 'Recompra', '2018-09-19 23:21:48', '2018-09-19 23:21:48'),
(2, 'Nuevo ingreso', '2018-09-19 23:21:48', '2018-09-19 23:21:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listasuscripcion`
--

CREATE TABLE `listasuscripcion` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `listasuscripcion`
--

INSERT INTO `listasuscripcion` (`id`, `nombre`, `correo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'luis@mail.com', '2018-06-28 21:25:59', '2018-06-28 21:25:59'),
(2, NULL, 'soy_otroMail@yo.com', '2018-06-28 21:27:39', '2018-06-28 21:27:39'),
(3, NULL, 'mail@mail.com', '2018-07-03 03:33:29', '2018-07-03 03:33:29'),
(4, NULL, 'mail@mail.com', '2018-07-03 03:57:04', '2018-07-03 03:57:04'),
(5, NULL, 'mail@mail.com', '2018-07-03 04:26:34', '2018-07-03 04:26:34'),
(6, NULL, 'mail1@mail.com', '2018-07-04 22:04:59', '2018-07-04 22:04:59'),
(7, NULL, 'yomail@mail.com', '2018-07-04 22:27:27', '2018-07-04 22:27:27'),
(8, NULL, 'otromail@mail.com', '2018-07-04 22:28:27', '2018-07-04 22:28:27'),
(9, NULL, 'mail3@mail.com', '2018-07-05 01:16:53', '2018-07-05 01:16:53'),
(10, NULL, 'Yomimail@mail.com', '2018-07-07 00:14:41', '2018-07-07 00:14:41'),
(11, NULL, 'mail@mail5.com', '2018-07-10 23:06:03', '2018-07-10 23:06:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_05_08_214344_create_listaSuscripcion_table', 1),
('2018_05_21_223008_create_blogTemas', 1),
('2018_05_21_223601_create_blogPost', 1),
('2018_06_04_214106_create_contacto', 1),
('2018_06_06_214857_roles', 1),
('2018_06_06_215300_role_user', 1),
('2018_06_06_215315_permissions', 1),
('2018_06_06_215326_permission_role', 1),
('2018_06_12_181004_create_blogTemasXPost', 1),
('2018_06_14_195224_create_blogLike', 1),
('2018_06_14_215150_company', 1),
('2018_06_15_212413_create_resources', 1),
('2018_06_19_224415_create_usersXcoaches', 1),
('2018_06_19_224502_create_chat', 1),
('2016_06_01_000001_create_oauth_auth_codes_table', 2),
('2016_06_01_000002_create_oauth_access_tokens_table', 2),
('2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
('2016_06_01_000004_create_oauth_clients_table', 2),
('2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
('2018_06_28_175229_permission_groups', 2),
('2018_07_02_172405_create_tasks_table', 3),
('2018_07_13_204436_create_coach_config', 3),
('2018_07_18_173152_user_vision', 4),
('2018_07_18_173237_user_goals', 4),
('2018_08_01_200935_create_contacto', 5),
('2018_08_03_233451_create_tokens_table', 6),
('2018_09_17_105418_create_audios', 7),
('2018_09_17_125650_create_audios_category', 7),
('2018_09_17_130337_create_audios_score', 7),
('2018_09_19_204950_payments', 8),
('2018_09_19_231639_plans', 8),
('2018_09_19_231653_first_payment', 8),
('2018_09_21_140249_create_videos', 8),
('2018_09_21_140259_create_videos_score', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('07cc580b79d177b3fe3abe627360030fb0c11c82cc15e80adf08d4c54e5e899237728338cc95fae0', 4, 1, 'MyApp', '[]', 0, '2018-08-16 22:57:53', '2018-08-16 22:57:53', '2019-08-16 17:57:53'),
('0988b45ba90ab9cc4d592a59c66d98ddf34c4f1d578816b0f841f39959f4598fb0ee460ab8b0296f', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:40:52', '2018-08-13 21:40:52', '2019-08-13 16:40:52'),
('0a175763d7cb461bb9db638658887bc40675d67e649623aee8850ee5fa2d0c427dee2d5bb6650961', 3, 1, 'MyApp', '[]', 0, '2018-08-23 22:42:05', '2018-08-23 22:42:05', '2019-08-23 17:42:05'),
('0cbbb9ed098e28719b8fd0a06bcb446af942bdabdfb497fa512ac31e329dedff1163c39628bf314e', 4, 1, 'MyApp', '[]', 0, '2018-08-21 20:57:54', '2018-08-21 20:57:54', '2019-08-21 15:57:54'),
('100d60ed47b6a473bdcc64d1f276308c3a030fcebb542ecfbbb77c210440d4e10d650e2224beaa47', 3, 1, 'MyApp', '[]', 0, '2018-08-18 03:10:34', '2018-08-18 03:10:34', '2019-08-17 22:10:34'),
('1465e9d11bb635128e7671b16aaaedc0acfca8d5a11f79161593f6f0339dc2de2eeb15d3703c1458', 1, 1, 'MyApp', '[]', 0, '2018-08-10 23:09:28', '2018-08-10 23:09:28', '2019-08-10 18:09:28'),
('1cd3f66405770dae08c034f87534c20d36bd58f3327d6fb08ff32ac01ccd26f6ae1025b1fe433c18', 4, 1, 'MyApp', '[]', 0, '2018-08-21 02:58:42', '2018-08-21 02:58:42', '2019-08-20 21:58:42'),
('1fc78c961515febdedf0f27ac32c81d82afe5b2d6afdffb66b6682164e24f9069db614a9f9acd0f7', 4, 1, 'MyApp', '[]', 0, '2018-08-14 04:01:09', '2018-08-14 04:01:09', '2019-08-13 23:01:09'),
('2178638e9744314f73f8d6d110b0f4e6efbfdcd5f022642e7cd4b9eb5709138ae0d6595c2825f8d1', 1, 1, 'MyApp', '[]', 0, '2018-08-10 23:09:28', '2018-08-10 23:09:28', '2019-08-10 18:09:28'),
('2484b67484bb9abe4cd41546279923a51760935e8db7d2c4b5e1cf3bd5edba19a548479ce934c3f0', 3, 1, 'MyApp', '[]', 0, '2018-08-23 23:07:31', '2018-08-23 23:07:31', '2019-08-23 18:07:31'),
('27e0c63a747a8126a67a21316389e2cb5641f9037e1e961f2aa1369365e95349af43cc52332c84ed', 3, 1, 'MyApp', '[]', 0, '2018-08-23 23:08:01', '2018-08-23 23:08:01', '2019-08-23 18:08:01'),
('2a4ebe24e9994ed4e48279f7ca81905c02c76d7f6bb76bda7d672051a03539e819d81cadaf1e9012', 3, 1, 'MyApp', '[]', 0, '2018-09-24 21:06:56', '2018-09-24 21:06:56', '2019-09-24 16:06:56'),
('2ded3abddf487f8510f9bba0aa007700c200529c497c11e00071c2019a97596f63cabc20e933936f', 4, 1, 'MyApp', '[]', 0, '2018-08-16 01:08:53', '2018-08-16 01:08:53', '2019-08-15 20:08:53'),
('2f7ae23b375665aaa5bcc0ac4ea0d3e96ee7f8bc9481d43655646f1ec20f08cfbec9f12b9f53ecf2', 3, 1, 'MyApp', '[]', 0, '2018-08-23 21:22:12', '2018-08-23 21:22:12', '2019-08-23 16:22:12'),
('31d48bbfae916961de4e7b6c9979bcb43bf035a1e30252f1f8727060b27d1f756e7bf961ce8ea49e', 3, 1, 'MyApp', '[]', 0, '2018-08-14 03:25:26', '2018-08-14 03:25:26', '2019-08-13 22:25:26'),
('340239859d8d0ee3cf593c2a970897e30ce7f433cdd15d6217406a5903437bd5917bda876563b266', 1, 1, 'MyApp', '[]', 0, '2018-08-14 01:16:40', '2018-08-14 01:16:40', '2019-08-13 20:16:40'),
('34ef312eb3045fe293fa7b0bb61cdaaf652563628ad944745241d0b22d8bd79785996d9026360cb7', 1, 1, 'MyApp', '[]', 0, '2018-08-14 01:16:13', '2018-08-14 01:16:13', '2019-08-13 20:16:13'),
('3dcb026dc2965b86cd4f68ddc8602591c694f955f3481d3a79a01d7f1160e9cd8b81e985c727a1cf', 3, 1, 'MyApp', '[]', 0, '2018-08-17 03:23:58', '2018-08-17 03:23:58', '2019-08-16 22:23:58'),
('46f580cd09db711421f76a5fccd2062f6c272d55a67b8e47b4e35aabd918aa478cbb27a2470280ca', 3, 1, 'MyApp', '[]', 0, '2018-08-22 03:23:04', '2018-08-22 03:23:04', '2019-08-21 22:23:04'),
('47ab46b62d078706db7007588e4155673c6b09ebf6439be6a1402f381dc67200e20ecef95b5cce5b', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:17:33', '2018-09-24 22:17:33', '2019-09-24 17:17:33'),
('50171d7c4e57ae2a9638658e791fc4ceb7ba2395507a5134727f6574773f8d423b3482138de69282', 3, 1, 'MyApp', '[]', 0, '2018-08-09 02:59:08', '2018-08-09 02:59:08', '2019-08-08 21:59:08'),
('54f206a29a69670a024c3f91f200da0efef3477bb0f19415e885265e1fc83a2337d7559ba09a996e', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:16:15', '2018-09-24 22:16:15', '2019-09-24 17:16:15'),
('55631a9f309c53ac88856487e1069a630b7bee6913f6663f03c1825349b7137e0b464ff96319d825', 1, 1, 'MyApp', '[]', 0, '2018-08-14 21:16:38', '2018-08-14 21:16:38', '2019-08-14 16:16:38'),
('5826418d46126e00369da397d810168016ebb574de16bef03fa3b11f5f4c2ecaf2872f8d94d255ba', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:04:10', '2018-09-24 22:04:10', '2019-09-24 17:04:10'),
('59993540c731cadaec0e73c2157b805ae423e780aad6e67c6e2e41ab25a3bd7450946ba0baa071fb', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:07:43', '2018-08-13 21:07:43', '2019-08-13 16:07:43'),
('5c852d7ec81e45f447a3e73d43b5211d7c17f12c56855e4656f4fda11d3a199007784e09b323b7c2', 4, 1, 'MyApp', '[]', 0, '2018-08-17 21:39:45', '2018-08-17 21:39:45', '2019-08-17 16:39:45'),
('5db608fb2dec3197122026d188824ac40c1f17b62b9d20725c8f84897cd4ee4517d51f06f207bc05', 4, 1, 'MyApp', '[]', 0, '2018-08-14 04:33:50', '2018-08-14 04:33:50', '2019-08-13 23:33:50'),
('629cf8a17a9e176a260d0f08a9f1a002e03bac46912cc8c357089f97a255518a77870ea41f5bbf7e', 4, 1, 'MyApp', '[]', 0, '2018-08-09 03:41:48', '2018-08-09 03:41:48', '2019-08-08 22:41:48'),
('681efb6ff86f44fa93c5c0fc3d5b399aae045422f9c5ca5d87b69d56bb5fe3f677a61dd821358e49', 1, 1, 'MyApp', '[]', 0, '2018-08-14 01:20:57', '2018-08-14 01:20:57', '2019-08-13 20:20:57'),
('68286aadf5de473c0ba72f1fe47c5ec7ab8d38f696ce65bcd217a39eb349425bafc2482d82a82b74', 1, 1, 'MyApp', '[]', 0, '2018-08-14 01:23:31', '2018-08-14 01:23:31', '2019-08-13 20:23:31'),
('7554a834f855c68ebdd9e677bbfc1e3eeeb8752a405374358f1a46d3fa8c0b441b732c9e4a5ae636', 3, 1, 'MyApp', '[]', 0, '2018-08-17 03:26:25', '2018-08-17 03:26:25', '2019-08-16 22:26:25'),
('76bc5f2dfa68ce90f2f5d39fd29524e078941da7c9729841dd176322740daf2d7881fe7e52c3a000', 3, 1, 'MyApp', '[]', 0, '2018-08-23 23:08:20', '2018-08-23 23:08:20', '2019-08-23 18:08:20'),
('78bb7c68787def072eb3ceeb27c4325dc4f036193c35c0f961c8461599beb0023a4db0c9ce67156e', 3, 1, 'MyApp', '[]', 0, '2018-08-09 03:51:40', '2018-08-09 03:51:40', '2019-08-08 22:51:40'),
('792806535fff48ee31bd963de30aabdb439e1f0c8bbcc57290629406e0594e42d6c94e34bf178002', 1, 1, 'MyApp', '[]', 0, '2018-08-14 01:16:05', '2018-08-14 01:16:05', '2019-08-13 20:16:05'),
('796d332c658a7a43f3bc6fcc0757d9357d48748b14be54568dda792ca7f72d33a1831b133ddf07e6', 4, 1, 'MyApp', '[]', 0, '2018-08-14 21:21:55', '2018-08-14 21:21:55', '2019-08-14 16:21:55'),
('7ac9ce235c16c65676b81d1a1f182ec31e85919107a1447481e67820d870285d40441a0899db797d', 3, 1, 'MyApp', '[]', 0, '2018-08-23 23:08:26', '2018-08-23 23:08:26', '2019-08-23 18:08:26'),
('7aea8b4b35b4555f77a50387d599d833975cf39aed44eea0a4162351b6c50f08dd6f7bb12905f736', 4, 1, 'MyApp', '[]', 0, '2018-08-14 01:24:36', '2018-08-14 01:24:36', '2019-08-13 20:24:36'),
('7af301ab8ecd8a9f94dc1e6ae0186f09cfa050763d71e962850da657092f5cd0e59908e6260c66ea', 1, 1, 'MyApp', '[]', 0, '2018-08-10 23:09:28', '2018-08-10 23:09:28', '2019-08-10 18:09:28'),
('7c16098ca0a222c2a5b211bf4dc5de4c6c495870117b599daa60535ba897f43952676213a11b5e80', 4, 1, 'MyApp', '[]', 0, '2018-08-14 04:08:41', '2018-08-14 04:08:41', '2019-08-13 23:08:41'),
('7e13b4ee4d8f9f96b709ad10ee8b0484e15e3aa65e4d08f5ba397fd8de6883948ab1b62fa7aeaf3c', 4, 1, 'MyApp', '[]', 0, '2018-08-22 21:22:52', '2018-08-22 21:22:52', '2019-08-22 16:22:52'),
('7e1a56374946329f83c3676db0641a26bdbba95eb93f4367e69c89ab1e90f036df6936c87d58e891', 4, 1, 'MyApp', '[]', 0, '2018-08-21 21:37:38', '2018-08-21 21:37:38', '2019-08-21 16:37:38'),
('829f8e4dc05154270902f3c73984126856eb214937c227c925ed9230273c3c1666d675b3928456e1', 4, 1, 'MyApp', '[]', 0, '2018-08-16 01:32:12', '2018-08-16 01:32:12', '2019-08-15 20:32:12'),
('832a80c61e01087b63943ee964cf8a5d93bcdcf8eb9c54a30e1c30c1349a8a83b0a038fa98d5a54c', 4, 1, 'MyApp', '[]', 0, '2018-08-17 03:25:37', '2018-08-17 03:25:37', '2019-08-16 22:25:37'),
('83c340fede1b2948d2308a741205ae8e53e7c79fcf46598f819ba821afa687abe949111a0856b85a', 3, 1, 'MyApp', '[]', 0, '2018-08-18 03:13:35', '2018-08-18 03:13:35', '2019-08-17 22:13:35'),
('84885c2948cef6af5ce59191e79aa2c8042436e4e024ce86829ce68e258c533b804304999ae5eda7', 3, 1, 'MyApp', '[]', 0, '2018-08-11 03:56:26', '2018-08-11 03:56:26', '2019-08-10 22:56:26'),
('867e89e772f1e8c0cc3db4aef3b53f8f65334f1817fb4e36f586c9d16d61769b0d34167a72e06585', 3, 1, 'MyApp', '[]', 0, '2018-08-17 21:23:52', '2018-08-17 21:23:52', '2019-08-17 16:23:52'),
('868095e7f744bce1acdfaa717d7a51dafe183f4890f0919136a9ba09cc6e999dea450fe7abdb1db0', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:14:45', '2018-09-24 22:14:45', '2019-09-24 17:14:45'),
('916b0db596b992ab04f07a75456f84ec108a32ff70b5f26a6f98e15b898b29266b2b85c8e02f9606', 3, 1, 'MyApp', '[]', 0, '2018-08-14 02:32:33', '2018-08-14 02:32:33', '2019-08-13 21:32:33'),
('925c71cec2cf818f4a98803052119673281198edafd5c078ea836a13661adcf9d53853f3e0d965be', 4, 1, 'MyApp', '[]', 0, '2018-08-20 20:45:11', '2018-08-20 20:45:11', '2019-08-20 15:45:11'),
('93618752ba13f49177ce702d20d4081b1bb694b240b9b85ac584a08d25985e238910545b8dbecfea', 4, 1, 'MyApp', '[]', 0, '2018-08-13 20:58:48', '2018-08-13 20:58:48', '2019-08-13 15:58:48'),
('97e37c1fb0dd2cb7216790a9fe811a221870ef6c4f2707acab29a9b073fc819debbe4d4031cd95f8', 4, 1, 'MyApp', '[]', 0, '2018-08-11 04:03:56', '2018-08-11 04:03:56', '2019-08-10 23:03:56'),
('9944812dffd45c421cd8cb0ff49eb722c8f8e5f42168079515bb5dc122f0ea51bd298666e44da41e', 4, 1, 'MyApp', '[]', 0, '2018-08-14 04:00:21', '2018-08-14 04:00:21', '2019-08-13 23:00:21'),
('9dc686435f6038b058ba3e4be729cca24459aa00a9f9746c6ec96f0a2a728c0697e521f34720a5b3', 4, 1, 'MyApp', '[]', 0, '2018-08-20 23:50:52', '2018-08-20 23:50:52', '2019-08-20 18:50:52'),
('a1aa5387a261a715ebcacb448613b00e31654b3cd84eefade4b9840a1d8aa5d12d3a1f574ccf7ced', 3, 1, 'MyApp', '[]', 0, '2018-08-18 03:03:31', '2018-08-18 03:03:31', '2019-08-17 22:03:31'),
('a7d4e4a2a91ee22ca4d7d078a15a5c0afcecae1f8af7160325e99fcaa35cffb8f97903781e537e92', 4, 1, 'MyApp', '[]', 0, '2018-08-23 20:25:00', '2018-08-23 20:25:00', '2019-08-23 15:25:00'),
('a995313955e1523df19e245d55fcfd1bcb8be5e43b0d401e61b479fd9d2aea63d1ed166837bb6e29', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:14:34', '2018-08-13 21:14:34', '2019-08-13 16:14:34'),
('ad5a78df3e62348cac6bd475ddb5d020a1b50357483ef5873959f0a1de58dce38a57046c4e23c3fd', 4, 1, 'MyApp', '[]', 0, '2018-08-10 21:35:24', '2018-08-10 21:35:24', '2019-08-10 16:35:24'),
('b666dc804ffea4967f4c3f2d75095ce95c8680de34f59bf9d92278ac1eb347898e74b5c86f9257ae', 12, 1, 'MyApp', '[]', 0, '2018-08-13 20:59:23', '2018-08-13 20:59:23', '2019-08-13 15:59:23'),
('b71d28683563920d431ba6139549441c9d7a4550aa52301cbb3d7ef2f975ab851047fd5956897d9f', 4, 1, 'MyApp', '[]', 0, '2018-08-16 01:08:31', '2018-08-16 01:08:31', '2019-08-15 20:08:31'),
('b8c88c90ee68429bf221f10b5b9979d8448c81ddb13268af9d527b660597649e65a6bde1eca50166', 4, 1, 'MyApp', '[]', 0, '2018-08-09 02:18:29', '2018-08-09 02:18:29', '2019-08-08 21:18:29'),
('baa9b047b15d907655bee908f7de9b73a737ac38645c1fa7eb4d8fe08b26df4526fdb4a82f66bbfe', 3, 1, 'MyApp', '[]', 0, '2018-08-16 23:27:30', '2018-08-16 23:27:30', '2019-08-16 18:27:30'),
('bb2c2b632e745b4018d851409151c1efc22f18129bdc01db15f199d43bd129a7cd4385120a842ffa', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:13:17', '2018-09-24 22:13:17', '2019-09-24 17:13:17'),
('bc471d7cd994d5e897b9744515ac92b552188034a2371e8e6f80ff9a3dd196de2c405f1ed45f3b53', 4, 1, 'MyApp', '[]', 0, '2018-08-23 20:34:50', '2018-08-23 20:34:50', '2019-08-23 15:34:50'),
('c07dc0ae966b5e98ab584079a7e4ebeb69ee858c49ef388d116d7e5759e8b295556140b919be26e4', 4, 1, 'MyApp', '[]', 0, '2018-08-09 04:21:55', '2018-08-09 04:21:55', '2019-08-08 23:21:55'),
('c6dbb66abe8f58ac92764f7369da848051ab48f67873148cdc0b7c10073c14c38d48300b6cf4adb2', 4, 1, 'MyApp', '[]', 0, '2018-08-10 22:29:44', '2018-08-10 22:29:44', '2019-08-10 17:29:44'),
('c8673f9249062da299548c4adced2060d80d0cc00f0751e68fc751a95fb439a66e905497edcfc9e3', 1, 1, 'MyApp', '[]', 0, '2018-08-13 20:58:12', '2018-08-13 20:58:12', '2019-08-13 15:58:12'),
('cb04aa4efe72f444ce707f95a4315262994d7a1675452064ba252203d46c4a0724b8e63d8093456e', 3, 1, 'MyApp', '[]', 0, '2018-08-23 23:08:10', '2018-08-23 23:08:10', '2019-08-23 18:08:10'),
('d0c404a21290ff86c52bfc7d04eeaccdbca895b82f5057ef5d130aca3f8ab116cbac0451c91d1a4a', 3, 1, 'MyApp', '[]', 0, '2018-09-24 20:55:55', '2018-09-24 20:55:55', '2019-09-24 15:55:55'),
('d2c2f5792c78b6bd6cdd3b49673007517248195f3c91bbc855beaa48e8092a35770dc780639fb4bc', 1, 1, 'MyApp', '[]', 0, '2018-08-14 03:45:01', '2018-08-14 03:45:01', '2019-08-13 22:45:01'),
('d81d8159472e77dfba4df89410d6c955d03e121dc9cb8476a630ac64a95fb63b91740f56fd185dda', 4, 1, 'MyApp', '[]', 0, '2018-08-18 03:08:24', '2018-08-18 03:08:24', '2019-08-17 22:08:24'),
('dc789cdec79628c19a448d17f34c4852397a17a0ec152c9558029af255c93f4ee9794253ebb75530', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:28:59', '2018-08-13 21:28:59', '2019-08-13 16:28:59'),
('dedc47217adca1281aa5186314771d223cfbd26657bd33c5b362a7c61c52b86cdf3a46c87d527dfa', 3, 1, 'MyApp', '[]', 0, '2018-08-14 04:01:35', '2018-08-14 04:01:35', '2019-08-13 23:01:35'),
('e07b5078178904e9b0146470c1d364004a857789ca541aa8489bfd409f1ce1b32295fc8915b2bed4', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:10:51', '2018-09-24 22:10:51', '2019-09-24 17:10:51'),
('ea6bded1e7cd8ca49cafb3d4637f6042c24a608f4bd5c02f0926487a03116407fff778256fdcdaf4', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:11:50', '2018-09-24 22:11:50', '2019-09-24 17:11:50'),
('ea78f09bf0abf507a290284c4b9712d6be06f2742cd177de7c63f8ef0d14f5646b87c28e6527afb0', 4, 1, 'MyApp', '[]', 0, '2018-08-16 23:19:00', '2018-08-16 23:19:00', '2019-08-16 18:19:00'),
('ead61562d202705f8c7ab799265494483d03641baa8fb383083f0281b37dc4546a4cc9943fea1f30', 4, 1, 'MyApp', '[]', 0, '2018-08-11 00:55:00', '2018-08-11 00:55:00', '2019-08-10 19:55:00'),
('f2a007db0d9de62d565cc321b22de1e6958e8ab265a0a740cb1c42bade284da594516ea8142bf1d4', 4, 1, 'MyApp', '[]', 0, '2018-08-20 23:42:35', '2018-08-20 23:42:35', '2019-08-20 18:42:35'),
('f4115c03337b5beca48671ca7d84c29f313bfa133b3b3f69160d61ee8e2a49691895db78cf4b87cb', 4, 1, 'MyApp', '[]', 0, '2018-08-09 03:41:37', '2018-08-09 03:41:37', '2019-08-08 22:41:37'),
('f7ea54f0901017ae5746bd7a4ff5eb08f1aafa9c38c069aee9df76df332b45c954f9a914b6d8c995', 1, 1, 'MyApp', '[]', 0, '2018-08-10 22:25:25', '2018-08-10 22:25:25', '2019-08-10 17:25:25'),
('fa5f984bcb75a12e8c1fba1ee454201777585ab2b7b08d9476bf72e7b07182a879ab81dee5b1ae0e', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:29:13', '2018-08-13 21:29:13', '2019-08-13 16:29:13'),
('fad7bc888bd6d0aa84710acb22d9afa7e2f47250f76b276f4af8522e1868e23d9516b7cf1cab85a5', 4, 1, 'MyApp', '[]', 0, '2018-08-13 21:27:07', '2018-08-13 21:27:07', '2019-08-13 16:27:07'),
('fd3015b28bbd0729fd51081a2a94e181e318923cd2596da0c207ddecd422887c36c5f9b0d921a9bd', 3, 1, 'MyApp', '[]', 0, '2018-08-23 20:38:00', '2018-08-23 20:38:00', '2019-08-23 15:38:00'),
('fefae1e4cc833bb4e1ab2b5a7869111af00dbb2fa405075a1a7f5042f1ebdd9f2aa364ff1df34548', 3, 1, 'MyApp', '[]', 0, '2018-09-24 22:05:21', '2018-09-24 22:05:21', '2019-09-24 17:05:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Saltum Personal Access Client', '2ahXdGqJnbwyQzusnln7QtSYehaQRD107WiU9H6b', 'http://localhost', 1, 0, 0, '2018-07-02 21:51:59', '2018-07-02 21:51:59'),
(2, NULL, 'Saltum Password Grant Client', 'EZw45FjwNNbrWGlMTvxhul6ybEJqC4NQSwm9DqLp', 'http://localhost', 0, 1, 0, '2018-07-02 21:51:59', '2018-07-02 21:51:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-07-02 21:51:59', '2018-07-02 21:51:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@mail.com', '63d141fe6ae81d16bb8236a3bb6e13c5f7fe8dbba85811a9dd6c4d510aeda951', '2018-06-21 21:26:44'),
('luis_sern@outlook.com', '$2y$10$yVhkkFM9xTwT0GP7HDNn/.OnANtdfmF8BfYljQGWm6kDVFWkOpu8W', '2018-07-11 23:24:08'),
('cliente2@mail.com', '$2y$10$M6aQi1QN88MKLzoG7sdyGOa.8aVXUw5WQHl0R6BDMr25zjC06txsC', '2018-09-21 18:10:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `amount` double(5,2) NOT NULL,
  `payment_datetime` datetime NOT NULL,
  `invoice` int(11) NOT NULL,
  `invoice_rfc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_payment` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `plan`, `amount`, `payment_datetime`, `invoice`, `invoice_rfc`, `invoice_email`, `invoice_address`, `invoice_name`, `first_payment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 45.36, '2018-09-18 10:21:16', 1, 'AAAA895498SDF', 'algo@mail.com', 'Calle 3, Col. Colonia, Del. Delegación, Ciudad, Estado, 00000', 'Empresa SA de CV', 2, NULL, NULL),
(2, 7, 4, 12.12, '2018-09-19 17:06:09', 0, '', '', '', '', 2, NULL, NULL),
(3, 8, 3, 36.45, '2018-09-04 07:31:32', 1, 'BBBB111111AAA', 'algo@otromail.com', 'Calle M, Col. Otra Colonia, Del. Delegación, Ciudad Dos, Estado de Estado, 11111', 'Nombre Apellido', 1, '2018-09-20 03:10:07', '2018-09-20 03:10:07'),
(4, 8, 3, 36.45, '2018-09-18 07:31:32', 1, 'BBBB111111AAA', 'algo@otromail.com', 'Calle M, Col. Otra Colonia, Del. Delegación, Ciudad Dos, Estado de Estado, 11111', 'Nombre Apellido', 2, '2018-09-20 03:10:07', '2018-09-20 03:10:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 6, 'Perfil', 'Perfil de Usuario', 'Visualizar y editar información personal.', '2018-06-07 22:06:17', '2018-06-07 22:06:17'),
(2, 5, 'Calendario', 'Calendario', 'Ver y administrar el calendario.', '2018-06-07 22:06:17', '2018-06-07 22:06:17'),
(3, 5, 'Seguimiento', 'Seguimiento', 'Ver y administrar el seguimiento de un coachee.', '2018-06-07 22:07:41', '2018-06-07 22:07:41'),
(4, 5, 'Sesiones', 'Sesiones de Coaching', 'Participar en una sesión de Coaching.', '2018-06-07 22:07:41', '2018-06-07 22:07:41'),
(5, 5, 'Pago', 'Pago de Sesiones', 'Pagar sesiones de Coaching.', '2018-06-07 22:09:31', '2018-06-07 22:09:31'),
(6, 5, 'Chat', 'Chat', 'Conversación en línea entre Coach y Coachee.', '2018-06-07 22:09:31', '2018-06-07 22:09:31'),
(7, 5, 'Clientes', 'Mis Clientes', 'Ver información de los clientes de un Coach.', '2018-06-07 22:11:08', '2018-06-07 22:11:08'),
(8, 4, 'Contrato', 'Contrato', 'Ver los términos del contrato de un Coach con Saltum.', '2018-06-07 22:11:08', '2018-06-07 22:11:08'),
(9, 1, 'Permisos', 'Administración de Permisos', 'Administrar los permisos del sitio.', '2018-06-07 22:12:39', '2018-06-07 22:12:39'),
(10, 1, 'Roles', 'Administración de Roles', 'Administrar los Roles del sitio.', '2018-06-07 22:12:39', '2018-06-07 22:12:39'),
(11, 1, 'Usuarios', 'Administración de Usuarios', 'Administrar los clientes del sitio.', '2018-06-07 22:14:44', '2018-06-07 22:14:44'),
(12, 4, 'Finanzas', 'Finanzas', 'Administrar las finanzas de Saltum.', '2018-06-07 22:14:44', '2018-06-07 22:14:44'),
(13, 3, 'Historial', 'Descarga de Sesiones', 'Descargar las sesiones almacenadas.', '2018-06-07 22:16:39', '2018-06-07 22:16:39'),
(14, 2, 'Blog', 'Blog', 'Ver el Blog del sitio.', '2018-06-07 22:16:39', '2018-06-07 22:16:39'),
(15, 2, 'Admin_Blog', 'Administración del Blog', 'Administrar el contenido del Blog.', '2018-06-07 22:17:54', '2018-06-07 22:17:54'),
(16, 3, 'Recursos', 'Recursos para Coaching', 'Ver los recursos disponibles de Coaching.', '2018-06-07 22:17:54', '2018-06-07 22:17:54'),
(17, 3, 'Admin_Recursos', 'Administración de Recursos', 'Administrar los recursos de Coaching.', '2018-06-07 22:18:21', '2018-06-07 22:18:21'),
(20, 1, 'Empresa', 'Administración de Empresas', 'Sección de administración de empresas.', '2018-06-22 04:18:21', '2018-06-22 04:18:21'),
(21, 3, 'Audios', 'Audios', 'Lista de audios disponibles', '2018-09-17 05:00:00', '2018-09-17 05:00:00'),
(22, 3, 'Videos', 'Videos', 'Lista de videos disponibles', '2018-09-17 05:00:00', '2018-09-17 05:00:00'),
(23, 3, 'Admin_Audios', 'Administrador de audios', 'Administrador de recursos de audio', '2018-09-17 18:52:58', '2018-09-17 18:52:58'),
(24, 3, 'Admin_Videos', 'Administrador de Videos', 'Administrador de recursos de video', '2018-09-21 18:52:52', '2018-09-21 18:52:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_group`
--

CREATE TABLE `permission_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_group`
--

INSERT INTO `permission_group` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'Administracion', 'Administración', '2018-06-28 18:07:03', '2018-06-28 18:07:03'),
(2, 'Blog', 'Blog', '2018-06-28 18:07:03', '2018-06-28 18:07:03'),
(3, 'Recursos', 'Recursos', '2018-06-28 18:07:25', '2018-06-28 18:07:25'),
(4, 'Finanzas', 'Finanzas', '2018-06-28 18:08:09', '2018-06-28 18:08:09'),
(5, 'Sesiones', 'Sesiones', '2018-06-28 18:08:09', '2018-06-28 18:08:09'),
(6, 'Perfil', 'Perfil', '2018-06-28 18:08:25', '2018-06-28 18:08:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 6, '2018-06-28 05:00:00', '2018-06-28 05:00:00'),
(1, 2, '2018-06-28 05:00:00', '2018-06-28 05:00:00'),
(1, 3, '2018-08-02 05:00:00', '2018-08-02 05:00:00'),
(14, 3, '2018-08-02 05:00:00', '2018-08-02 05:00:00'),
(15, 3, '2018-08-02 05:00:00', '2018-08-02 05:00:00'),
(1, 5, '2018-08-06 05:00:00', '2018-08-06 05:00:00'),
(2, 5, '2018-08-06 05:00:00', '2018-08-06 05:00:00'),
(3, 5, '2018-08-06 05:00:00', '2018-08-06 05:00:00'),
(4, 5, '2018-08-06 05:00:00', '2018-08-06 05:00:00'),
(5, 5, '2018-08-06 05:00:00', '2018-08-06 05:00:00'),
(1, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(2, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(4, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(7, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(16, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(17, 4, '2018-08-28 05:00:00', '2018-08-28 05:00:00'),
(1, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(2, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(9, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(10, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(11, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(14, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(15, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(16, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(17, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(20, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(23, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00'),
(24, 1, '2018-09-21 05:00:00', '2018-09-21 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `created_at`, `updated_at`) VALUES
(1, 'Gratuito', '2018-09-19 23:20:31', '2018-09-19 23:20:31'),
(2, 'Sesión individual', '2018-09-19 23:20:31', '2018-09-19 23:20:31'),
(3, 'Premium', '2018-09-19 23:20:53', '2018-09-19 23:20:53'),
(4, 'Premium plus', '2018-09-19 23:20:53', '2018-09-19 23:20:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE `resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `downloads` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `descripcion`, `url`, `downloads`, `created_at`, `updated_at`) VALUES
(1, 'Archivo de autoayuda 1', '201808137377new 3.txt', 4, '2018-08-14 04:29:02', '2018-09-05 00:45:11'),
(2, 'Recurso dos', '201809048792archivoPrueba.txt', 1, '2018-09-05 00:45:22', '2018-09-05 03:22:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador general del sistema.', '2018-06-08 00:13:52', '2018-06-08 00:13:52'),
(2, 'Financiero', 'Financiero', 'Usuario encargado de los asuntos financieros de Saltum.', '2018-06-08 00:13:52', '2018-06-08 00:13:52'),
(3, 'Blogger', 'Blogger', 'Usuario encargado de los contenidos del sitio Saltum.', '2018-06-08 00:26:23', '2018-06-08 00:26:23'),
(4, 'Coach', 'Coach', 'Usuario que imparte sesiones de Coaching.', '2018-06-08 00:26:23', '2018-06-08 00:26:23'),
(5, 'Cliente_Individual', 'Cliente', 'Usuario que recibe sesiones de Coaching.', '2018-06-08 00:28:29', '2018-06-08 00:28:29'),
(6, 'Cliente_Empresa', 'Cliente Empresarial', 'Usuario perteneciente a una empresa que recibe sesiones de Coaching.', '2018-06-08 00:28:29', '2018-06-08 00:28:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-06-08 00:14:43', '2018-06-08 00:14:43'),
(3, 5, '2018-06-22 03:36:52', '2018-06-22 03:36:52'),
(12, 5, '2018-07-12 02:37:57', '2018-07-12 02:37:57'),
(4, 4, '2018-07-11 05:00:00', '2018-07-11 05:00:00'),
(13, 4, '2018-07-12 04:18:00', '2018-07-12 04:18:00'),
(14, 3, '2018-08-02 05:00:00', '2018-08-02 05:00:00'),
(2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `coach_id` int(11) NOT NULL,
  `coachee_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0/Agendado, 1/confirmado, 2/cancelado, 3/Atendido, 4/noAtendido, 5/Disponible, 6/oculto, 9/roomCreat, 8/clientConnect',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `origin_type` tinyint(4) NOT NULL COMMENT '1/coach_config, 2/single_create',
  `first_session` tinyint(4) NOT NULL DEFAULT '0',
  `eval` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `description`, `coach_id`, `coachee_id`, `status`, `start_datetime`, `end_datetime`, `origin_type`, `first_session`, `eval`, `created_at`, `updated_at`) VALUES
(149, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 0, '2018-07-03 14:00:00', '2018-07-03 15:30:00', 1, 0, NULL, '2018-07-27 03:47:58', '2018-07-27 03:56:34'),
(150, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-03 14:30:00', '2018-07-03 16:00:00', 1, 0, NULL, '2018-07-27 03:47:58', '2018-07-27 03:50:34'),
(159, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-04 13:00:00', '2018-07-04 14:00:00', 1, 0, NULL, '2018-07-27 03:47:59', '2018-07-27 03:50:28'),
(160, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-04 13:30:00', '2018-07-04 15:00:00', 1, 0, NULL, '2018-07-27 03:47:59', '2018-07-27 03:56:57'),
(169, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-05 12:00:00', '2018-07-05 13:00:00', 1, 0, NULL, '2018-07-27 03:47:59', '2018-07-27 03:50:18'),
(192, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-10 17:30:00', '2018-07-10 18:30:00', 1, 0, NULL, '2018-07-27 03:48:00', '2018-07-27 03:50:11'),
(197, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-11 14:00:00', '2018-07-11 15:30:00', 1, 0, NULL, '2018-07-27 03:48:00', '2018-07-27 03:59:25'),
(243, 'Sesiones  gratis', ' llevele sesiones gratis ', 4, 3, 2, '2018-07-19 13:00:00', '2018-07-19 14:30:00', 1, 0, NULL, '2018-07-27 03:48:01', '2018-07-27 03:54:08'),
(465, 'Sesiones del coach 1', 'sesion xxxxxxxx', 4, 3, 1, '2018-07-30 14:00:00', '2018-07-30 15:30:00', 5, 1, NULL, '2018-07-27 22:10:47', '2018-07-27 22:47:07'),
(660, 'Nueva lista de sesiones', 'sesiones de prueba   -- Sesión cancelada por el cliente cliente1 -- último status: Agendado por el cliente', 4, 3, 2, '2018-08-02 12:00:00', '2018-08-02 13:00:00', 1, 0, NULL, '2018-07-27 22:17:57', '2018-07-30 20:52:34'),
(661, 'Nueva lista de sesiones', 'sesiones de prueba -- Sesión cancelada por el cliente cliente1 -- último status: Agendado por el cliente', 4, 3, 2, '2018-08-02 12:30:00', '2018-08-02 13:30:00', 1, 0, NULL, '2018-07-27 22:17:57', '2018-07-30 20:51:02'),
(665, 'Nueva lista de sesiones', 'sesiones de prueba  -- Sesión cancelada por el cliente cliente1 -- último status: Disponible', 4, 0, 2, '2018-08-02 14:30:00', '2018-08-02 15:00:00', 1, 0, NULL, '2018-07-27 22:17:57', '2018-07-30 20:44:24'),
(667, 'Nueva lista de sesiones', 'sesiones de prueba   -- Sesión cancelada por el cliente cliente1 -- último status: Agendado por el cliente', 4, 3, 2, '2018-08-06 12:30:00', '2018-08-06 13:30:00', 1, 0, NULL, '2018-07-27 22:17:57', '2018-07-30 20:53:35'),
(672, 'Nueva lista de sesiones', 'sesiones de prueba  ', 4, 3, 1, '2018-08-07 12:00:00', '2018-08-07 13:00:00', 1, 0, NULL, '2018-07-27 22:17:58', '2018-07-30 20:55:29'),
(673, 'Nueva lista de sesiones', 'sesiones de prueba  ', 4, 0, 6, '2018-08-07 12:30:00', '2018-08-07 13:00:00', 1, 0, NULL, '2018-07-27 22:17:58', '2018-07-30 20:55:22'),
(679, 'Nueva lista de sesiones', 'sesiones de prueba   -- Sesión cancelada por el coach Coach 1 -- último status: Agendado por el cliente', 4, 3, 2, '2018-08-08 12:30:00', '2018-08-08 13:30:00', 1, 0, NULL, '2018-07-27 22:17:58', '2018-07-30 20:54:41'),
(864, 'Sesiones de prueba', 'sesiones de prueba x  ', 4, 3, 1, '2018-08-09 12:00:00', '2018-08-09 13:00:00', 1, 0, NULL, '2018-07-30 22:12:40', '2018-08-06 22:14:33'),
(865, 'Sesiones de prueba', 'sesiones de prueba x  ', 4, 0, 6, '2018-08-09 12:30:00', '2018-08-09 13:00:00', 1, 0, NULL, '2018-07-30 22:12:40', '2018-07-30 23:03:24'),
(869, 'Sesiones de prueba', 'sesiones de prueba x  ', 4, 0, 6, '2018-08-09 14:30:00', '2018-08-09 15:00:00', 1, 0, NULL, '2018-07-30 22:12:40', '2018-07-31 01:40:28'),
(870, 'Sesiones de prueba', 'sesiones de prueba x  ', 4, 0, 6, '2018-08-10 12:00:00', '2018-08-10 12:30:00', 1, 0, NULL, '2018-07-30 22:12:40', '2018-07-31 01:40:21'),
(1025, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 0, 6, '2018-08-08 10:30:00', '2018-08-08 11:00:00', 1, 0, NULL, '2018-08-01 01:46:19', '2018-08-06 22:13:59'),
(1026, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 3, 1, '2018-08-08 11:00:00', '2018-08-08 12:00:00', 1, 0, NULL, '2018-08-01 01:46:19', '2018-08-06 22:14:28'),
(1027, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 0, 6, '2018-08-08 11:30:00', '2018-08-08 12:00:00', 1, 0, NULL, '2018-08-01 01:46:19', '2018-08-06 22:13:59'),
(1073, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 0, 6, '2018-08-20 10:30:00', '2018-08-20 11:00:00', 1, 0, NULL, '2018-08-01 01:46:20', '2018-08-06 22:14:14'),
(1074, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 3, 8, '2018-08-20 11:00:00', '2018-08-20 12:00:00', 1, 0, 3, '2018-08-01 01:46:20', '2018-08-29 01:08:37'),
(1075, 'Coach 1 sesiones', 'sesiones clases de prueba  ', 4, 0, 6, '2018-08-20 11:30:00', '2018-08-20 12:00:00', 1, 0, NULL, '2018-08-01 01:46:20', '2018-08-06 22:14:14'),
(1136, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 13:00:00', '2018-07-02 13:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1137, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 13:30:00', '2018-07-02 14:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1138, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 14:00:00', '2018-07-02 14:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1139, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 14:30:00', '2018-07-02 15:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1140, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 15:00:00', '2018-07-02 15:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1141, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 15:30:00', '2018-07-02 16:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1142, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 16:00:00', '2018-07-02 16:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1143, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 16:30:00', '2018-07-02 17:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1144, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 17:00:00', '2018-07-02 17:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1145, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-02 17:30:00', '2018-07-02 18:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1146, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 13:00:00', '2018-07-03 13:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1147, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 13:30:00', '2018-07-03 14:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1148, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 14:00:00', '2018-07-03 14:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1149, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 14:30:00', '2018-07-03 15:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1150, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 15:00:00', '2018-07-03 15:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1151, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 15:30:00', '2018-07-03 16:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1152, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 16:00:00', '2018-07-03 16:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1153, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 16:30:00', '2018-07-03 17:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1154, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 17:00:00', '2018-07-03 17:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1155, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-03 17:30:00', '2018-07-03 18:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1156, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 13:00:00', '2018-07-04 13:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1157, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 13:30:00', '2018-07-04 14:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1158, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 14:00:00', '2018-07-04 14:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1159, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 14:30:00', '2018-07-04 15:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1160, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 15:00:00', '2018-07-04 15:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1161, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 15:30:00', '2018-07-04 16:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1162, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 16:00:00', '2018-07-04 16:30:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1163, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 16:30:00', '2018-07-04 17:00:00', 1, 0, NULL, '2018-08-01 01:52:05', '2018-08-01 01:52:05'),
(1164, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 17:00:00', '2018-07-04 17:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1165, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-04 17:30:00', '2018-07-04 18:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1166, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 13:00:00', '2018-07-05 13:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1167, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 13:30:00', '2018-07-05 14:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1168, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 14:00:00', '2018-07-05 14:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1169, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 14:30:00', '2018-07-05 15:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1170, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 15:00:00', '2018-07-05 15:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1171, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 15:30:00', '2018-07-05 16:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1172, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 16:00:00', '2018-07-05 16:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1173, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 16:30:00', '2018-07-05 17:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1174, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 17:00:00', '2018-07-05 17:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1175, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-05 17:30:00', '2018-07-05 18:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1176, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 13:00:00', '2018-07-09 13:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1177, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 13:30:00', '2018-07-09 14:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1178, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 14:00:00', '2018-07-09 14:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1179, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 14:30:00', '2018-07-09 15:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1180, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 15:00:00', '2018-07-09 15:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1181, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 15:30:00', '2018-07-09 16:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1182, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 16:00:00', '2018-07-09 16:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1183, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 16:30:00', '2018-07-09 17:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1184, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 17:00:00', '2018-07-09 17:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1185, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-09 17:30:00', '2018-07-09 18:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1186, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 13:00:00', '2018-07-10 13:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1187, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 13:30:00', '2018-07-10 14:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1188, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 14:00:00', '2018-07-10 14:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1189, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 14:30:00', '2018-07-10 15:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1190, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 15:00:00', '2018-07-10 15:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1191, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 15:30:00', '2018-07-10 16:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1192, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 16:00:00', '2018-07-10 16:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1193, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 16:30:00', '2018-07-10 17:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1194, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 17:00:00', '2018-07-10 17:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1195, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-10 17:30:00', '2018-07-10 18:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1196, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 13:00:00', '2018-07-11 13:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1197, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 13:30:00', '2018-07-11 14:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1198, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 14:00:00', '2018-07-11 14:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1199, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 14:30:00', '2018-07-11 15:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1200, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 15:00:00', '2018-07-11 15:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1201, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 15:30:00', '2018-07-11 16:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1202, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 16:00:00', '2018-07-11 16:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1203, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 16:30:00', '2018-07-11 17:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1204, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 17:00:00', '2018-07-11 17:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1205, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-11 17:30:00', '2018-07-11 18:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1206, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 13:00:00', '2018-07-12 13:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1207, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 13:30:00', '2018-07-12 14:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1208, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 14:00:00', '2018-07-12 14:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1209, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 14:30:00', '2018-07-12 15:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1210, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 15:00:00', '2018-07-12 15:30:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1211, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 15:30:00', '2018-07-12 16:00:00', 1, 0, NULL, '2018-08-01 01:52:06', '2018-08-01 01:52:06'),
(1212, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 16:00:00', '2018-07-12 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1213, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 16:30:00', '2018-07-12 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1214, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 17:00:00', '2018-07-12 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1215, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-12 17:30:00', '2018-07-12 18:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1216, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 13:00:00', '2018-07-16 13:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1217, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 13:30:00', '2018-07-16 14:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1218, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 14:00:00', '2018-07-16 14:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1219, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 14:30:00', '2018-07-16 15:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1220, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 15:00:00', '2018-07-16 15:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1221, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 15:30:00', '2018-07-16 16:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1222, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 16:00:00', '2018-07-16 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1223, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 16:30:00', '2018-07-16 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1224, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 17:00:00', '2018-07-16 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1225, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-16 17:30:00', '2018-07-16 18:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1226, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 13:00:00', '2018-07-17 13:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1227, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 13:30:00', '2018-07-17 14:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1228, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 14:00:00', '2018-07-17 14:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1229, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 14:30:00', '2018-07-17 15:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1230, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 15:00:00', '2018-07-17 15:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1231, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 15:30:00', '2018-07-17 16:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1232, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 16:00:00', '2018-07-17 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1233, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 16:30:00', '2018-07-17 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1234, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 17:00:00', '2018-07-17 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1235, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-17 17:30:00', '2018-07-17 18:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1236, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 13:00:00', '2018-07-18 13:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1237, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 13:30:00', '2018-07-18 14:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1238, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 14:00:00', '2018-07-18 14:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1239, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 14:30:00', '2018-07-18 15:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1240, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 15:00:00', '2018-07-18 15:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1241, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 15:30:00', '2018-07-18 16:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1242, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 16:00:00', '2018-07-18 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1243, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 16:30:00', '2018-07-18 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1244, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 17:00:00', '2018-07-18 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1245, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-18 17:30:00', '2018-07-18 18:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1246, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 13:00:00', '2018-07-19 13:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1247, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 13:30:00', '2018-07-19 14:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1248, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 14:00:00', '2018-07-19 14:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1249, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 14:30:00', '2018-07-19 15:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1250, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 15:00:00', '2018-07-19 15:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1251, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 15:30:00', '2018-07-19 16:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1252, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 16:00:00', '2018-07-19 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1253, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 16:30:00', '2018-07-19 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1254, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 17:00:00', '2018-07-19 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1255, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-19 17:30:00', '2018-07-19 18:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1256, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 13:00:00', '2018-07-23 13:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1257, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 13:30:00', '2018-07-23 14:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1258, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 14:00:00', '2018-07-23 14:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1259, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 14:30:00', '2018-07-23 15:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1260, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 15:00:00', '2018-07-23 15:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1261, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 15:30:00', '2018-07-23 16:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1262, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 16:00:00', '2018-07-23 16:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1263, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 16:30:00', '2018-07-23 17:00:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1264, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 17:00:00', '2018-07-23 17:30:00', 1, 0, NULL, '2018-08-01 01:52:07', '2018-08-01 01:52:07'),
(1265, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-23 17:30:00', '2018-07-23 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1266, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 13:00:00', '2018-07-24 13:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1267, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 13:30:00', '2018-07-24 14:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1268, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 14:00:00', '2018-07-24 14:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1269, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 14:30:00', '2018-07-24 15:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1270, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 15:00:00', '2018-07-24 15:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1271, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 15:30:00', '2018-07-24 16:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1272, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 16:00:00', '2018-07-24 16:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1273, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 16:30:00', '2018-07-24 17:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1274, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 17:00:00', '2018-07-24 17:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1275, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-24 17:30:00', '2018-07-24 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1276, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 13:00:00', '2018-07-25 13:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1277, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 13:30:00', '2018-07-25 14:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1278, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 14:00:00', '2018-07-25 14:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1279, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 14:30:00', '2018-07-25 15:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1280, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 15:00:00', '2018-07-25 15:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1281, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 15:30:00', '2018-07-25 16:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1282, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 16:00:00', '2018-07-25 16:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1283, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 16:30:00', '2018-07-25 17:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1284, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 17:00:00', '2018-07-25 17:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1285, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-25 17:30:00', '2018-07-25 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1286, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 13:00:00', '2018-07-26 13:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1287, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 13:30:00', '2018-07-26 14:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1288, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 14:00:00', '2018-07-26 14:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1289, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 14:30:00', '2018-07-26 15:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1290, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 15:00:00', '2018-07-26 15:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1291, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 15:30:00', '2018-07-26 16:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1292, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 16:00:00', '2018-07-26 16:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1293, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 16:30:00', '2018-07-26 17:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1294, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 17:00:00', '2018-07-26 17:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1295, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-26 17:30:00', '2018-07-26 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1296, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 13:00:00', '2018-07-30 13:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1297, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 13:30:00', '2018-07-30 14:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1298, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 14:00:00', '2018-07-30 14:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1299, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 14:30:00', '2018-07-30 15:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1300, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 15:00:00', '2018-07-30 15:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1301, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 15:30:00', '2018-07-30 16:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1302, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 16:00:00', '2018-07-30 16:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1303, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 16:30:00', '2018-07-30 17:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1304, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 17:00:00', '2018-07-30 17:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1305, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-30 17:30:00', '2018-07-30 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1306, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 13:00:00', '2018-07-31 13:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1307, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 13:30:00', '2018-07-31 14:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1308, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 14:00:00', '2018-07-31 14:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1309, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 14:30:00', '2018-07-31 15:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1310, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 15:00:00', '2018-07-31 15:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1311, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 15:30:00', '2018-07-31 16:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1312, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 16:00:00', '2018-07-31 16:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1313, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 16:30:00', '2018-07-31 17:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1314, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 17:00:00', '2018-07-31 17:30:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1315, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-07-31 17:30:00', '2018-07-31 18:00:00', 1, 0, NULL, '2018-08-01 01:52:08', '2018-08-01 01:52:08'),
(1316, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 13:00:00', '2018-08-01 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1317, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 13:30:00', '2018-08-01 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1318, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 14:00:00', '2018-08-01 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1319, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 14:30:00', '2018-08-01 15:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1320, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 15:00:00', '2018-08-01 15:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1321, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 15:30:00', '2018-08-01 16:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1322, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 16:00:00', '2018-08-01 16:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1323, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 16:30:00', '2018-08-01 17:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1324, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 17:00:00', '2018-08-01 17:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1325, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-01 17:30:00', '2018-08-01 18:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1326, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 13:00:00', '2018-08-02 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1327, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 13:30:00', '2018-08-02 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1328, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 14:00:00', '2018-08-02 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1329, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 14:30:00', '2018-08-02 15:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1330, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 15:00:00', '2018-08-02 15:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1331, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 15:30:00', '2018-08-02 16:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1332, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 16:00:00', '2018-08-02 16:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1333, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 16:30:00', '2018-08-02 17:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1334, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 17:00:00', '2018-08-02 17:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1335, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-02 17:30:00', '2018-08-02 18:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1336, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 13:00:00', '2018-08-06 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1337, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 13:30:00', '2018-08-06 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1338, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 14:00:00', '2018-08-06 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1339, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 14:30:00', '2018-08-06 15:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1340, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 15:00:00', '2018-08-06 15:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1341, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 15:30:00', '2018-08-06 16:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1342, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 16:00:00', '2018-08-06 16:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1343, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 16:30:00', '2018-08-06 17:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1344, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 17:00:00', '2018-08-06 17:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1345, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-06 17:30:00', '2018-08-06 18:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1346, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 13:00:00', '2018-08-07 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1347, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 13:30:00', '2018-08-07 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1348, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 14:00:00', '2018-08-07 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1349, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 14:30:00', '2018-08-07 15:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1350, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 15:00:00', '2018-08-07 15:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1351, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 15:30:00', '2018-08-07 16:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1352, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 16:00:00', '2018-08-07 16:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1353, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 16:30:00', '2018-08-07 17:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1354, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 17:00:00', '2018-08-07 17:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1355, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-07 17:30:00', '2018-08-07 18:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1356, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 13:00:00', '2018-08-08 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1357, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 13:30:00', '2018-08-08 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1358, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 14:00:00', '2018-08-08 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1359, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 14:30:00', '2018-08-08 15:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1360, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 15:00:00', '2018-08-08 15:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1361, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 15:30:00', '2018-08-08 16:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1362, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 16:00:00', '2018-08-08 16:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1363, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 16:30:00', '2018-08-08 17:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1364, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 17:00:00', '2018-08-08 17:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1365, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-08 17:30:00', '2018-08-08 18:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1366, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 13:00:00', '2018-08-09 13:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1367, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 13:30:00', '2018-08-09 14:00:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1368, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 14:00:00', '2018-08-09 14:30:00', 1, 0, NULL, '2018-08-01 01:52:09', '2018-08-01 01:52:09'),
(1369, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 14:30:00', '2018-08-09 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1370, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 15:00:00', '2018-08-09 15:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1371, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 15:30:00', '2018-08-09 16:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1372, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 16:00:00', '2018-08-09 16:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1373, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 16:30:00', '2018-08-09 17:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1374, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 17:00:00', '2018-08-09 17:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1375, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-09 17:30:00', '2018-08-09 18:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1376, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 13:00:00', '2018-08-13 13:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1377, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 13:30:00', '2018-08-13 14:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1378, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 14:00:00', '2018-08-13 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1379, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 14:30:00', '2018-08-13 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1380, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 15:00:00', '2018-08-13 15:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1381, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 15:30:00', '2018-08-13 16:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1382, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 16:00:00', '2018-08-13 16:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1383, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 16:30:00', '2018-08-13 17:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1384, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 17:00:00', '2018-08-13 17:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1385, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-13 17:30:00', '2018-08-13 18:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1386, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 13:00:00', '2018-08-14 13:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1387, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 13:30:00', '2018-08-14 14:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1388, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 14:00:00', '2018-08-14 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1389, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 14:30:00', '2018-08-14 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1390, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 15:00:00', '2018-08-14 15:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1391, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 15:30:00', '2018-08-14 16:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1392, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 16:00:00', '2018-08-14 16:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1393, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 16:30:00', '2018-08-14 17:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1394, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 17:00:00', '2018-08-14 17:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1395, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-14 17:30:00', '2018-08-14 18:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1396, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 13:00:00', '2018-08-15 13:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1397, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 13:30:00', '2018-08-15 14:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1398, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 14:00:00', '2018-08-15 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1399, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 14:30:00', '2018-08-15 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1400, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 15:00:00', '2018-08-15 15:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1401, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 15:30:00', '2018-08-15 16:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1402, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 16:00:00', '2018-08-15 16:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1403, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 16:30:00', '2018-08-15 17:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1404, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 17:00:00', '2018-08-15 17:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1405, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-15 17:30:00', '2018-08-15 18:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1406, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 13:00:00', '2018-08-16 13:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-07 02:09:53'),
(1407, 'coach 2 mis sesiones', '  clases de canto -- Sesión cancelada por el coach Coach 2 -- último status: Agendado por el cliente', 13, 3, 2, '2018-08-16 13:30:00', '2018-08-16 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-07 02:09:53');
INSERT INTO `sessions` (`id`, `name`, `description`, `coach_id`, `coachee_id`, `status`, `start_datetime`, `end_datetime`, `origin_type`, `first_session`, `eval`, `created_at`, `updated_at`) VALUES
(1408, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 14:00:00', '2018-08-16 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-07 02:09:53'),
(1409, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 14:30:00', '2018-08-16 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1410, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 15:00:00', '2018-08-16 15:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1411, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 15:30:00', '2018-08-16 16:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1412, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 16:00:00', '2018-08-16 16:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1413, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 16:30:00', '2018-08-16 17:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1414, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 17:00:00', '2018-08-16 17:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1415, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-16 17:30:00', '2018-08-16 18:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1416, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 13:00:00', '2018-08-20 13:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1417, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 13:30:00', '2018-08-20 14:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1418, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 14:00:00', '2018-08-20 14:30:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1419, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 14:30:00', '2018-08-20 15:00:00', 1, 0, NULL, '2018-08-01 01:52:10', '2018-08-01 01:52:10'),
(1420, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 15:00:00', '2018-08-20 15:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1421, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 15:30:00', '2018-08-20 16:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1422, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 16:00:00', '2018-08-20 16:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1423, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 16:30:00', '2018-08-20 17:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1424, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 17:00:00', '2018-08-20 17:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1425, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-20 17:30:00', '2018-08-20 18:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1426, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 13:00:00', '2018-08-21 13:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1427, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 13:30:00', '2018-08-21 14:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1428, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 14:00:00', '2018-08-21 14:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1429, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 14:30:00', '2018-08-21 15:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1430, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 15:00:00', '2018-08-21 15:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1431, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 15:30:00', '2018-08-21 16:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1432, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 16:00:00', '2018-08-21 16:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1433, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 16:30:00', '2018-08-21 17:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1434, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 17:00:00', '2018-08-21 17:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1435, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-21 17:30:00', '2018-08-21 18:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1436, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 13:00:00', '2018-08-22 13:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1437, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 13:30:00', '2018-08-22 14:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1438, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 14:00:00', '2018-08-22 14:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1439, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 14:30:00', '2018-08-22 15:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1440, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 15:00:00', '2018-08-22 15:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1441, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 15:30:00', '2018-08-22 16:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1442, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 16:00:00', '2018-08-22 16:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1443, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 16:30:00', '2018-08-22 17:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1444, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 17:00:00', '2018-08-22 17:30:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(1445, 'coach 2 mis sesiones', '  clases de canto', 13, 0, 5, '2018-08-22 17:30:00', '2018-08-22 18:00:00', 1, 0, NULL, '2018-08-01 01:52:11', '2018-08-01 01:52:11'),
(2208, 'Sesions programada de prueba', 'sesion para probar videocchat -- Sesión cancelada por el cliente cliente1  -- último status: Aceptado por el coach', 4, 3, 9, '2018-08-23 17:02:00', '2018-08-23 17:30:00', 5, 0, 3, '2018-08-24 02:24:53', '2018-09-04 21:33:54'),
(2269, 'pruebaaas', ' teeees ', 4, 0, 6, '2018-08-28 20:00:00', '2018-08-28 20:30:00', 1, 0, NULL, '2018-08-24 23:51:05', '2018-08-29 01:20:14'),
(2270, 'pruebaaas', ' teeees ', 4, 12, 3, '2018-08-28 20:30:00', '2018-08-28 22:00:00', 1, 1, NULL, '2018-08-24 23:51:05', '2018-08-29 01:20:14'),
(2271, 'pruebaaas', ' teeees ', 4, 0, 6, '2018-08-28 21:00:00', '2018-08-28 21:30:00', 1, 0, NULL, '2018-08-24 23:51:05', '2018-08-29 01:20:14'),
(2272, 'pruebaaas', ' teeees ', 4, 0, 10, '2018-08-28 21:30:00', '2018-08-28 22:00:00', 1, 0, NULL, '2018-08-24 23:51:05', '2018-08-29 02:22:16'),
(2273, 'prueba', 'test', 4, 3, 9, '2018-08-27 11:50:00', '2018-08-27 12:50:00', 5, 0, NULL, '2018-08-27 21:46:45', '2018-08-29 02:23:12'),
(2274, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-08-30 13:00:00', '2018-08-30 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2275, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-08-30 13:30:00', '2018-08-30 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2276, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-08-30 14:00:00', '2018-08-30 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2277, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-08-30 14:30:00', '2018-08-30 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2278, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-01 13:00:00', '2018-09-01 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2279, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-01 13:30:00', '2018-09-01 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2280, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-01 14:00:00', '2018-09-01 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2281, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-01 14:30:00', '2018-09-01 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2282, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-04 13:00:00', '2018-09-04 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2283, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-04 13:30:00', '2018-09-04 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2284, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-04 14:00:00', '2018-09-04 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2285, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-04 14:30:00', '2018-09-04 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2286, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-06 13:00:00', '2018-09-06 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2287, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 6, '2018-09-06 13:30:00', '2018-09-06 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:08:11'),
(2288, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 3, 1, '2018-09-06 14:00:00', '2018-09-06 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:46:57'),
(2289, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 6, '2018-09-06 14:30:00', '2018-09-06 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:08:11'),
(2290, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-08 13:00:00', '2018-09-08 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2291, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-08 13:30:00', '2018-09-08 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2292, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-08 14:00:00', '2018-09-08 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2293, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-08 14:30:00', '2018-09-08 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2294, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-11 13:00:00', '2018-09-11 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2295, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-11 13:30:00', '2018-09-11 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2296, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-11 14:00:00', '2018-09-11 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2297, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-11 14:30:00', '2018-09-11 15:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2298, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-13 13:00:00', '2018-09-13 13:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2299, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-13 13:30:00', '2018-09-13 14:00:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2300, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-13 14:00:00', '2018-09-13 14:30:00', 1, 0, NULL, '2018-09-04 02:06:03', '2018-09-04 02:06:03'),
(2301, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-13 14:30:00', '2018-09-13 15:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2302, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 3, 0, '2018-09-15 13:00:00', '2018-09-15 14:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 04:10:47'),
(2303, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 6, '2018-09-15 13:30:00', '2018-09-15 14:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 04:10:47'),
(2304, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-15 14:00:00', '2018-09-15 14:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2305, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-15 14:30:00', '2018-09-15 15:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2306, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-18 13:00:00', '2018-09-18 13:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2307, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-18 13:30:00', '2018-09-18 14:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2308, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-18 14:00:00', '2018-09-18 14:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2309, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-18 14:30:00', '2018-09-18 15:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04'),
(2310, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-20 13:00:00', '2018-09-20 13:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 04:11:52'),
(2311, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa   -- Sesión cancelada por el coach Coach 1  -- último status: Agendado por el cliente', 4, 3, 2, '2018-09-20 13:30:00', '2018-09-20 14:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 04:11:52'),
(2312, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-20 14:00:00', '2018-09-20 14:30:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 04:11:52'),
(2313, 'Sesiones del coach 1', 'abcde descripcion pruebaaaa  ', 4, 0, 5, '2018-09-20 14:30:00', '2018-09-20 15:00:00', 1, 0, NULL, '2018-09-04 02:06:04', '2018-09-04 02:06:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `use_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0/Sin usar, 1/Usado, 2/Expiró'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '1',
  `birthdate` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `company_id`, `birthdate`, `photo`, `cv`, `description`, `active`, `remember_token`, `created_at`, `updated_at`, `confirmation_code`) VALUES
(1, 'Admin', 'Adminnnnn', 'admin@mail.com', '$2y$10$a2HLRmWapbARtfH6vvNiQeueIGb8Ep7xBkxVNGquN/kwyh17B92NK', 1, '1988-04-24', '201809175912Developer-coder-programmer-man-avatar-computer-512.png', '201808139704new 3.txt', 'Programador, Web, PHP', 1, NULL, '2018-06-21 04:28:42', '2018-09-17 17:22:43', 'OdqDATCDqX0rUS6fxKT4'),
(2, 'Luis', 'Serna', 'luis_sern@outlook.com', '$2y$10$a2HLRmWapbARtfH6vvNiQeueIGb8Ep7xBkxVNGquN/kwyh17B92NK', 1, NULL, NULL, NULL, NULL, 1, NULL, '2018-06-21 21:19:06', '2018-06-21 21:19:06', 'zl4VKxbvdFpQ3mveOnaI'),
(3, 'cliente1', NULL, 'cliente@mail.com', '$2y$10$0hXKkdWXvEG.mS.8xLkwU.jWsLT/GWEUhja1SsJq1uQDmNuAT3x4q', 1, '1987-07-17', NULL, NULL, NULL, 0, 'vv2NFMq0Cj2QXjgDY5uKr4XahOvVHBmZhg5jYJKVlFyYqRmdLUzuppL5AvJP', '2018-06-22 03:36:52', '2018-08-09 03:51:40', 'otnFFoMcFgmAHrDSMjZw'),
(4, 'Coach 1', '', 'coach@mail.com', '$2y$10$yxnP8cI1t9Xqh33SI57ldOequ9PJgrWyVN96sfeGTadJXDU0LpdYO', 1, NULL, NULL, NULL, NULL, 1, 'b8c88c90ee68429bf221f10b5b9979d8448c81ddb13268af9d527b660597649e65a6bde1eca50166', '2018-07-12 01:37:46', '2018-07-12 03:53:45', 'Qvz76NmwlQlWGcg4ZZXb'),
(12, 'cliente2', NULL, 'cliente2@mail.com', '$2y$10$ieigk/yjQNztsdJwCnEsZOXKyUhwPUPGh4cGov3X8MRPZF2GBv1Fq', 2, NULL, '20180830441250b4ea7f8e1acs98447.jpg', NULL, NULL, 1, 'oID0fJJOn5TWbOudXNvUs05wL9YRA41uCTUciGKS0jhcmVuwhaQI0zd8P5Zh', '2018-07-12 02:37:57', '2018-08-30 22:23:38', '337dfEgsYf9lMyRfMWkS'),
(13, 'Coach 2', '', 'coach2@mail.com', '$2y$10$jWZF6oP1FxLLJxOOahb9BuNn.OKuK6rcCRk7ZUYxwrNSwLDiXTnNG', 1, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-12 04:18:00', '2018-07-12 04:19:35', '5sUvX4eK2TQeu89ymrcd'),
(14, 'Blogger', 'Saltum', 'blogger@mail.com', '$2y$10$00Xv5X9k9mrtT9WJcZo4GeKSYKG25c5l7XOrdGQ9k8W75rJQx0BQC', 1, NULL, NULL, NULL, NULL, 1, 'MqvcOheeHnUyl3AoFzHiYEgkUJTcsnSEpALg6BL6BcoqOjBuvPdPp0Du5d38', '2018-08-02 23:24:35', '2018-08-02 23:30:45', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersxcoaches`
--

CREATE TABLE `usersxcoaches` (
  `id_user` int(11) NOT NULL,
  `id_coach` int(11) NOT NULL,
  `perfilCliente` text COLLATE utf8_unicode_ci,
  `seguimientoCliente` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usersxcoaches`
--

INSERT INTO `usersxcoaches` (`id_user`, `id_coach`, `perfilCliente`, `seguimientoCliente`, `active`) VALUES
(3, 4, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_goals`
--

CREATE TABLE `user_goals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_goals`
--

INSERT INTO `user_goals` (`id`, `user_id`, `type`, `description`, `completed`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'teeeeeeest', 0, '2018-09-02', '2018-08-29 03:50:26', '2018-08-29 22:15:43'),
(2, 3, 0, 'probando', 1, '2018-09-30', '2018-08-29 22:08:28', '2018-08-29 22:11:24'),
(3, 3, 0, 'probando 2', 1, '2018-09-30', '2018-08-29 22:11:37', '2018-08-29 22:11:51'),
(4, 3, 0, 'probando', 1, '2018-09-30', '2018-08-29 22:16:48', '2018-08-29 22:16:48'),
(5, 3, 0, 'sdfsdafdsa', 1, '2018-09-30', '2018-08-29 22:35:55', '2018-08-29 22:36:17'),
(6, 3, 0, 'Meta prueba', 1, '2018-09-30', '2018-08-30 00:57:29', '2018-08-30 00:57:29'),
(7, 3, 0, 'Meta prueba', 1, '2018-09-30', '2018-08-30 00:57:29', '2018-08-30 00:57:29'),
(8, 3, 0, 'teeest', 1, '2018-09-30', '2018-08-30 00:59:39', '2018-08-30 00:59:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_vision`
--

CREATE TABLE `user_vision` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `vision` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_vision`
--

INSERT INTO `user_vision` (`id`, `user_id`, `vision`, `created_at`, `updated_at`) VALUES
(1, 3, 'probando visiónnprueba test', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lock` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=off/1=on',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=off/1=on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `url`, `thumbnail`, `lock`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Dejando de fumar', 'un video sobre dejarde fumar', '201809248909shortvideoclipnaturemp4.mp4', '201809245674thumbnail_prueba.png', 0, 1, '2018-09-24 17:17:32', '2018-09-24 09:52:50'),
(2, 'Dejando de fumar (segunda parte)', 'Deja de fumar ya', '201809241886naturebeautifulshortvideo720phd1.mp4', '201809247780thumbnail_prueba_2.png', 1, 1, '2018-09-24 17:19:50', '2018-09-24 09:39:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_score`
--

CREATE TABLE `videos_score` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `audios_category`
--
ALTER TABLE `audios_category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `audios_score`
--
ALTER TABLE `audios_score`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bloglike`
--
ALTER TABLE `bloglike`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `display_url` (`display_url`);

--
-- Indices de la tabla `blogtemas`
--
ALTER TABLE `blogtemas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD UNIQUE KEY `display_url` (`display_url`);

--
-- Indices de la tabla `blogtemasxpost`
--
ALTER TABLE `blogtemasxpost`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coach_config`
--
ALTER TABLE `coach_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coach_config_coach_id_unique` (`coach_id`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name_unique` (`name`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `first_payment`
--
ALTER TABLE `first_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `listasuscripcion`
--
ALTER TABLE `listasuscripcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_group`
--
ALTER TABLE `permission_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_group_name_unique` (`name`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_goals`
--
ALTER TABLE `user_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_vision`
--
ALTER TABLE `user_vision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videos_score`
--
ALTER TABLE `videos_score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `audios_category`
--
ALTER TABLE `audios_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `audios_score`
--
ALTER TABLE `audios_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bloglike`
--
ALTER TABLE `bloglike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `blogtemas`
--
ALTER TABLE `blogtemas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `blogtemasxpost`
--
ALTER TABLE `blogtemasxpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `coach_config`
--
ALTER TABLE `coach_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `first_payment`
--
ALTER TABLE `first_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `listasuscripcion`
--
ALTER TABLE `listasuscripcion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2314;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user_goals`
--
ALTER TABLE `user_goals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `user_vision`
--
ALTER TABLE `user_vision`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videos_score`
--
ALTER TABLE `videos_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
