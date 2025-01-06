-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql112.infinityfree.com
-- Tiempo de generación: 06-01-2025 a las 18:16:17
-- Versión del servidor: 10.6.19-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_37935730_restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `descuento_porcentaje` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `descripcion`, `descuento_porcentaje`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Oferta disponible los jueves', 10, NULL, NULL),
(2, 'Oferta disponible para nuevos usuarios', 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_productos`
--

CREATE TABLE `ofertas_productos` (
  `id_oferta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `total`, `metodo_pago`, `fecha`) VALUES
(10, 7, '7.99', '3', '2024-01-23'),
(12, NULL, '11.97', '23', '2025-01-05'),
(18, NULL, '22.22', '23', '2003-03-03'),
(23, NULL, '8.99', '1', '2025-01-05'),
(28, NULL, '2.99', '2', '2025-01-05'),
(29, 7, '23.32', '22', '2023-02-02'),
(30, NULL, '20.96', '21', '2025-01-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_ofertas`
--

CREATE TABLE `pedidos_ofertas` (
  `id_pedido` int(11) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `image`, `categoria`) VALUES
(1, 'Nigiris Salmon Flameado', 'Nigiris Salmon Flameado con salsa', '2.99', 'view/images/productos/Nigiri Salmon Flameado.webp', 'Nigiri'),
(2, 'Gunkan Salmon Flameado', 'Gunkan salmon flameado con cebollino, salsa de anguila, salsa BBQ y sesamo', '3.99', 'view/images/productos/Gunkan Salmon Flameado.webp', 'gunkan'),
(3, 'Gunkan Aguacate', 'Gunkan aguacate', '2.99', 'poebnrg', 'gunkan'),
(4, 'Gunkan Atun', 'Gunkan atun picante', '3.99', 'view/images/productos/Gunkan atun.webp', 'gunkan'),
(5, 'Gunkan Salmon Aguacate', 'Gunkan salmon, aguacate,sesamo,salsa picante y salsa teriyaki', '3.99', 'view/images/productos/Gunkan salmon aguacate.webp', 'gunkan'),
(6, 'Maki Atun', 'Maki atun', '2.99', 'view/images/productos/Maki atun.webp', 'maki'),
(7, 'Maki Salmon Agucate', 'Maki salmon aguacate', '3.99', 'view/images/productos/Maki salmon aguacate.webp', 'maki'),
(8, 'Maki Salmon', 'Maki salmon', '2.99', 'view/images/productos/Maki salmon.webp', 'maki'),
(9, 'Maki Tempura Mango', 'Tempura de salmon, philadelphia, mango, salsa de mango', '3.99', 'view/images/productos/Maki tempura mango.webp', 'maki'),
(10, 'Maki Tempura Picante', 'Tempura de salmon, kataifi, salmon picante y salsa anguila', '4.99', 'view/images/productos/Maki tempura picante.webp', 'maki'),
(11, 'Nigiri Anguila', 'Nigiri anguila, cebollino, sesamo y salsa anguila', '3.99', 'view/images/productos/Nigiri anguila.webp', 'nigiri'),
(12, 'Nigiri atun', 'Nigiri atun', '2.99', 'view/images/productos/Nigiri atun.webp', 'nigiri'),
(13, 'Nigiri Salmon philadelphia', 'Nigiri arroz negro, salmon flameado, philadelphia, kataifi y salsa anguila', '3.99', 'view/images/productos/Nigiri salmon philadelphia.webp', 'nigiri'),
(14, 'Nigiri Salmon', 'Nigiri salmon', '2.99', 'view/images/productos/Nigiri salmon.webp', 'nigiri'),
(15, 'Tempura langostino', 'Tempura langostino', '3.99', 'view/images/productos/Tempura langostino.webp', 'fritos'),
(16, 'Tempura salmon', 'Tenpura de salmon, philadelphia, agaucate, cebolla crujiente, mayonesa japonesa y salsa teriyaki', '8.99', 'view/images/productos/Tempura salmon.webp', 'urumaki'),
(17, 'Urumaki King Roll', 'Uramaki philadelphia, aguacate, slamon flameado, sesamo, cebollimo y salsa anguila', '6.99', 'view/images/productos/Uramaki king roll.webp', 'urumaki'),
(18, 'Urumaki Atun Aguacate', 'Uramki atun, aguacate, sesamo', '5.99', 'view/images/productos/Urumaki atun aguacate.webp', 'urumaki'),
(19, 'Urumaki Platano', 'Uramki platano', '5.99', 'view/images/productos/Urumaki platano.webp', 'urumaki'),
(20, 'Urumaki Ebiten Cheese', 'Uramki tempura, de langostino, queso cheddar, salsa anguila', '6.99', 'view/images/productos/Urumaki ebiten cheese.webp', 'urumaki'),
(21, 'Urumaki Nueces Philadelphia', 'Uramki philadelphia, nueces, salmon flameado, almendra y salsa anguila', '6.99', 'view/images/productos/Urumaki nueces philadelphia.webp', 'urumaki'),
(22, 'Urumaki Salmon BBQ Picante', 'Uramki salmon frito, philadelphia, salmon flameado, almendra, salsa teriyaki y mayonesa picante', '7.99', 'view/images/productos/Urumaki salmon bbq picante.webp', 'urumaki'),
(23, 'Urumaki Salmon Mango', 'Uramki salmon, aguacate, mango laminado y salsa mango ', '6.99', 'view/images/productos/Urumaki salmon mango.webp', 'urumaki'),
(24, 'Urumaki Salmon Tobiko', 'Uramki salmon, aguacate i tobiko', '5.99', 'view/images/productos/Urumaki salmon tobiko.webp', 'urumaki'),
(25, 'Urumaki Spycy Roll', 'Uramaki philadelphia, aguacate, salmon picante, salmon flameado y pistacho', '7.99', 'view/images/productos/Urumaki spycy roll.webp', 'urumaki'),
(26, 'Urumaki Ebiten Crujiente ', 'Uramaki tempura de langostino, cebolla crujiente, salsa teriyaki y mayonesa japonesa', '6.99', 'view/images/productos/Urumaki ebiten crujiente .webp', 'urumaki');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `password`, `email`, `telefono`, `direccion`) VALUES
(7, 'Peter', 'Pettigrew', '$2y$10$IL97929eW1xIT30bLS/Bi.hVK0kEHPWjGaB4Okzi59cs.MBl4MeKC', 'peter@peter.com', 123456666, 'Passatge Josep Ros 7'),
(8, 'Victor', 'Montalvo Moro', '$2y$10$BMvBOtO0HRP212g3lUTeRuxgU0N.zjMP2oAGxL.0A1x4uDGE3HDnK', 'victor@victor.com', 4343, 'null'),
(10, 'admin', '', '$2y$10$DTcP/tVADzHppJm5nzKTsuFX25lmM2XnjTgFQrz72YNjFmTNFe1H6', 'admin@admin.com', NULL, NULL),
(11, 'test', 'test', '$2y$10$fQ/UrYfY6IPL4F6KPY9xheeDJgn6Dk4KRodFQlh.PzEM9keli.82K', 'lol@lol required', 1244, 'aqui'),
(26, 'Victor', 'Montalvo', '$2y$10$iI6wcvuK0iA0lrwmvcas8upzofgmRDNB1ZVDRTCJJ1ctFvx7qj8v6', 'prueba@prueba.com', 2121, 'dasd'),
(27, 'tset', '', '$2y$10$eFz5EnoHJMnT2XzwQ0X8ne.q48HUrrBmjG9E312Z9dZt7oOlK8wHm', 'test@test.com', NULL, NULL),
(28, 'prueba', '', '$2y$10$mhvd8y7QWa/UZw4ZshfI7eehPAlc1wcRa44w53f2kCsKI4mIyISHa', 'prueba@prueba.es', NULL, NULL),
(29, 'loca', '', '$2y$10$MItWorK/eN4VLiBZUFviZOVh5.MJLnomZXbqkkFdal/7XUcZk6wj2', 'loca@loca.com', NULL, NULL),
(30, 'lolo', '', '$2y$10$nmtOLMSRFDAfqzawaG6fKe/OLUHPLaTqEhWTvAUMeM8SVe3ZQKli2', 'lolo@lolo.es', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas_productos`
--
ALTER TABLE `ofertas_productos`
  ADD KEY `id_oferta` (`id_oferta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `pedidos_ofertas`
--
ALTER TABLE `pedidos_ofertas`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ofertas_productos`
--
ALTER TABLE `ofertas_productos`
  ADD CONSTRAINT `ofertas_productos_ibfk_1` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`),
  ADD CONSTRAINT `ofertas_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `pedidos_ofertas`
--
ALTER TABLE `pedidos_ofertas`
  ADD CONSTRAINT `pedidos_ofertas_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedidos_ofertas_ibfk_2` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`);

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
