-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2023 a las 03:46:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `serviapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` text NOT NULL,
  `reglas` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`, `descripcion_categoria`, `reglas`, `id_user`) VALUES
(1, 'Limpieza', 'Servicios de limpieza', '', 1),
(2, 'Mantenimiento', 'Servicios de mantenimiento', '', 1),
(3, 'Reparación', 'Servicios de reparación', '', 1),
(8, 'Mantenimiento', 'Limpieza', 'Limpieza', 1),
(9, 'Mantenimiento', 'Mantenimiento', 'Mantenimiento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intercambio`
--

CREATE TABLE `intercambio` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `descripcion_producto` varchar(500) NOT NULL,
  `contacto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intercambio`
--

INSERT INTO `intercambio` (`id`, `nombre_producto`, `precio_producto`, `descripcion_producto`, `contacto`, `id_user`) VALUES
(1, 'Televisor', 2000, 'Televisor led', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `categoria` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `contacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `categoria`, `valor`, `usuario`, `contacto`) VALUES
(13, 'Lavado de automoviles', 1, 2000, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo_servicio` varchar(100) NOT NULL,
  `proveedor` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(100) NOT NULL,
  `descripcion_servicio` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `name`, `email`, `tipo_servicio`, `proveedor`, `direccion`, `fecha`, `hora`, `descripcion_servicio`, `id_user`, `id_categoria`) VALUES
(2, 'admin', 'admin@admin.cl', 'Lavado de automóviles', 'Proveedor 2', 'Talca', '2023-05-26', '15:30', 'qweqweqe', 1, NULL),
(3, 'Eduardo', 'eduardo@eduardo.cl', 'Mantenimiento de bicicletas', 'Proveedor 2', 'Curepto', '2023-05-31', '15:20', 'DASDADS', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `nombre`, `telefono`, `tipo_usuario`) VALUES
(1, 'admin', 'admin@admin.cl', '827ccb0eea8a706c4c34a16891f84e7b ', 'Eduardo', 975135960, 1),
(2, 'proveedor', 'proveedor@proveedor.com', '827ccb0eea8a706c4c34a16891f84e7b ', 'Juan', 12345678, 3),
(3, 'cliente', 'cliente@cliente.com', '827ccb0eea8a706c4c34a16891f84e7b ', 'Pablo', 98765432, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `intercambio`
--
ALTER TABLE `intercambio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio` (`servicio`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `contacto` (`contacto`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `intercambio`
--
ALTER TABLE `intercambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `intercambio`
--
ALTER TABLE `intercambio`
  ADD CONSTRAINT `intercambio_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_4` FOREIGN KEY (`contacto`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_5` FOREIGN KEY (`usuario`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_6` FOREIGN KEY (`contacto`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_7` FOREIGN KEY (`usuario`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicios_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
