-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2023 a las 17:59:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_restaurant`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `deuda` decimal(18,2) NOT NULL DEFAULT 0.00,
  `abono` decimal(18,2) NOT NULL DEFAULT 0.00,
  `saldo` decimal(18,2) NOT NULL DEFAULT 0.00,
  `anonimo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `telefono`, `deuda`, `abono`, `saldo`, `anonimo`, `created_at`, `updated_at`) VALUES
(1, 'Mesa 1', NULL, 0.00, 0.00, 0.00, 0, '2023-05-18 19:39:12', '2023-05-18 19:39:12'),
(2, 'Mesa 2', NULL, 0.00, 0.00, 0.00, 0, '2023-05-18 19:39:21', '2023-05-18 19:39:21'),
(3, 'Mesa 3', NULL, 0.00, 0.00, 0.00, 0, '2023-05-19 15:57:32', '2023-05-19 15:57:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` decimal(18,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `descripcion`, `costo`, `created_at`, `updated_at`) VALUES
(1, 'aaaaaaaa', 321.00, '2023-03-07 21:25:10', '2023-03-07 21:40:52'),
(3, 'SDADSADD\r\nASD', 23.00, '2023-03-23 21:15:18', '2023-03-23 21:15:18'),
(4, 'wrqrwqwr', 234.00, '2023-05-08 18:38:30', '2023-05-08 18:38:30'),
(5, 'desc', 1232.00, '2023-05-12 18:21:37', '2023-05-12 18:21:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Desayuno', '2023-02-22 23:21:55', '2023-02-22 23:21:55'),
(4, 'cena', '2023-03-23 21:10:26', '2023-03-23 21:10:26'),
(5, 'almuerzo', '2023-04-06 17:45:45', '2023-04-06 17:45:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu_item`
--

INSERT INTO `menu_item` (`id`, `id_menu`, `nombre`, `precio`, `stock`, `created_at`, `updated_at`) VALUES
(2, 1, 'adsd sdfgjsdfjfsdf sdffsddsfsfs sf', 9000.00, 44, '2023-02-23 00:12:36', '2023-06-28 17:55:47'),
(3, 1, 'jugos', 1000.00, 24, '2023-02-23 00:40:31', '2023-06-28 17:55:47'),
(4, 1, 'juego de naranja', 2000.00, 48, '2023-02-23 00:40:57', '2023-06-28 17:55:47'),
(5, 4, 'chaufa', 124000.00, 9, '2023-03-23 21:10:39', '2023-06-28 17:55:47'),
(6, 5, 'aji de gallina', 1500.00, 23, '2023-04-06 17:46:05', '2023-06-23 23:43:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'mesa 1', 0, '2023-06-23 18:15:59', '2023-06-23 21:17:13'),
(2, 'mesa 2', 0, '2023-06-23 18:16:06', '2023-06-28 17:55:47'),
(3, 'mesa 3', 0, '2023-06-23 18:16:13', '2023-06-28 17:50:33'),
(5, 'mesa 4', 0, '2023-06-23 18:16:37', '2023-06-23 18:16:48'),
(6, 'mesa 5', 0, '2023-06-28 17:49:29', '2023-06-28 17:49:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportar`
--

CREATE TABLE `reportar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `asunto` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `img` varchar(55) DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportar`
--

INSERT INTO `reportar` (`id`, `id_user`, `asunto`, `descripcion`, `img`, `respuesta`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 'aaaa', 'aaaaaaaa', '', NULL, 0, '2022-11-14 20:51:21', '2022-11-14 20:51:21'),
(2, 2, 'bbbbbb', 'bbbbb', 're_q6sDfuFetK.png', 'asdsadsad', 1, '2022-11-14 20:51:36', '2022-11-14 23:29:02'),
(3, 2, 'awfgdf', 'ssddsf', '', 'sdffjmsdfhgsdf', 1, '2022-11-14 21:20:50', '2022-11-14 21:20:50'),
(4, 2, 'asunto', 'descripcion', 're_VNq6bOjYZn.png', 'respuesta del admin', 1, '2022-11-16 21:30:55', '2022-11-16 21:31:58'),
(5, 2, 'asusnto', 'descricion', 're_ooPTmB8liw.png', 'respondidas', 1, '2022-11-22 23:00:23', '2022-11-22 23:01:05'),
(6, 18, 'sdffds', 'fsdfsdsdffsd', 're_JmPjlrAECO.png', NULL, 1, '2022-12-23 16:59:38', '2022-12-23 17:00:13'),
(7, 18, 'dfggdfgdf', 'edgfsdfgdf', 're_WL5I1hGvAu.png', 'fsdfsdfsdfsdf', 1, '2022-12-23 17:10:12', '2022-12-23 17:14:39'),
(8, 18, 'sasadsad', 'ssaddsasad', 're_JN9jaDd6dD.png', NULL, 0, '2022-12-23 21:53:22', '2022-12-23 21:53:22'),
(9, 18, 'vvvvvvvvvvvvvv', 'assadasd', '', 'adadssadsaddsa', 1, '2022-12-23 21:53:51', '2022-12-23 21:54:06'),
(10, 25, 'sfds', 'sdfsfdsdf', 're_2WnFUoc81p.png', NULL, 0, '2022-12-24 22:08:12', '2022-12-24 22:08:12'),
(11, 1, 'dsadsad', 'sadsad', 're_AypA62q9gg.png', 'fsdfsdf', 1, '2023-03-22 23:38:31', '2023-03-22 23:51:28'),
(12, 5, 'sasadsad', 'xcvxvxv', 're_YOfpuGL51z.png', 'fddgdfg', 1, '2023-03-22 23:53:54', '2023-03-22 23:54:40'),
(13, 5, 'fdgdf', 'gdfggdf', '', 'S', 1, '2023-03-22 23:59:15', '2023-03-23 21:20:47'),
(14, 4, 'esr', 'asdadsad', '', NULL, 0, '2023-03-23 21:29:11', '2023-03-23 21:29:11'),
(15, 4, 'reporto', 'llevar 3 \r\ndsad\r\nsad', '', NULL, 0, '2023-03-23 21:44:13', '2023-03-23 21:44:13'),
(16, 4, 'sdd', 'sdasdsad', '', 'dfdggdfgdf', 1, '2023-03-23 21:44:21', '2023-04-06 17:56:35'),
(17, 4, 'asdad', 'sabes tald \r\n2. ca takl\r\nas3\r\n32', '', NULL, 0, '2023-05-08 18:44:54', '2023-05-08 18:44:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `adelanto` decimal(18,2) NOT NULL DEFAULT 0.00,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_prestamo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `img`, `adelanto`, `estado`, `fecha_prestamo`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', NULL, '$2y$10$Hdz5cGU3IvcuXfaXeu37gOBo7.cf0B4E5UNJM0gBMw.fKb6Vnr2by', NULL, 'user_otunpH4xm9.png', 0.00, 1, NULL, '2023-02-21 20:32:11', '2023-02-22 03:46:18'),
(4, 2, 'luis', 'luis@gmail.com', NULL, '$2y$10$AkoRlsaDblEvBKZeDZ.2uu4fy7wd3sD41GhXoNcRQ3BMK3s8nG.Vu', NULL, 'user_WPEa84tysN.png', 123.00, 1, NULL, '2023-03-07 22:21:33', '2023-05-08 18:43:10'),
(5, 3, 'pedros', 'pedro@gmail.com', NULL, '$2y$10$B5/avnSTrVrlHYFKNe5qdOAmsMO1sXDOwYEYW1LP7ULJHf2JtjLMS', NULL, 'user_KFMBrI8t5e.png', 0.00, 1, NULL, '2023-03-07 22:23:17', '2023-06-16 04:48:22'),
(6, 4, 'alex', 'alex@gmail.com', NULL, '$2y$10$bUgGDQ/mxlSjZGdavQBTJOQ5tK6Fa5jHrQP8VWE.653RsWfAFrpQO', NULL, NULL, 0.00, 1, NULL, '2023-03-22 22:25:11', '2023-03-22 22:25:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `total` int(18) NOT NULL,
  `colaboracion` tinyint(1) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `id_user`, `id_cliente`, `tipo_pago`, `total`, `colaboracion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 3000, 0, 3, '2023-06-23 23:52:10', '2023-06-28 17:50:33'),
(2, 1, 2, 0, 3000, 0, 2, '2023-06-24 00:04:17', '2023-06-28 17:50:44'),
(3, 1, 2, 0, 138000, 0, 2, '2023-06-28 17:51:11', '2023-06-28 17:55:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta-detalle`
--

CREATE TABLE `venta-detalle` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(18) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(18) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta-detalle`
--

INSERT INTO `venta-detalle` (`id`, `id_venta`, `id_menu`, `descripcion`, `precio`, `cantidad`, `total`, `created_at`, `updated_at`) VALUES
(15, 1, 3, 'sdfsddfsfd', 1000, 1, 1000, '2023-06-23 23:58:43', '2023-06-23 23:58:43'),
(16, 1, 4, '', 2000, 1, 2000, '2023-06-23 23:58:43', '2023-06-23 23:58:43'),
(17, 2, 3, '', 1000, 1, 1000, '2023-06-24 00:04:17', '2023-06-24 00:04:17'),
(18, 2, 4, '', 2000, 1, 2000, '2023-06-24 00:04:17', '2023-06-24 00:04:17'),
(28, 3, 2, '', 9000, 1, 9000, '2023-06-28 17:54:11', '2023-06-28 17:54:11'),
(29, 3, 3, '', 1000, 1, 1000, '2023-06-28 17:54:11', '2023-06-28 17:54:11'),
(30, 3, 4, '', 2000, 2, 4000, '2023-06-28 17:54:11', '2023-06-28 17:54:11'),
(31, 3, 5, '', 124000, 1, 124000, '2023-06-28 17:54:11', '2023-06-28 17:54:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `reportar`
--
ALTER TABLE `reportar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta-detalle`
--
ALTER TABLE `venta-detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportar`
--
ALTER TABLE `reportar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta-detalle`
--
ALTER TABLE `venta-detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
