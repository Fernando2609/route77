-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2022 a las 00:59:06
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_route`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id` bigint(20) NOT NULL,
  `idUsuario` bigint(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `textColor` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModificado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id`, `idUsuario`, `title`, `descripcion`, `start`, `end`, `color`, `textColor`, `dateCreated`, `dateModificado`) VALUES
(1, 1, 'Navidad', 'Navidad en el mundo', '2021-12-24 00:00:00', '2021-12-25 23:59:00', '#004cff', '#ffffff', '2021-12-30 20:43:05', '2022-01-01 23:53:48'),
(2, 3, 'Año Nuevo', 'Año nuevo en todos los paises', '2021-12-31 00:00:00', '0000-00-00 00:00:00', '#ff8686', '#000000', '2021-12-30 20:44:20', '0000-00-00 00:00:00'),
(4, 3, 'Inicio del Mes', 'Inicia del mes de diciembre', '2021-12-31 01:30:00', '2022-01-04 05:30:00', '#ff9999', '#000000', '2021-12-30 21:06:21', '2022-01-01 23:51:11'),
(5, 5, 'Partido', 'Partido de Hoy', '2021-12-31 10:00:00', '2021-12-31 12:00:00', '#000000', '#fffafa', '2021-12-30 21:33:22', '2022-01-01 23:38:22'),
(6, 2, 'Celebración', 'Celebración de año nuevo', '2021-12-31 00:00:00', '2021-12-31 01:00:00', '#0033ff', '#ff1414', '2021-12-30 22:47:47', '2021-12-30 22:50:27'),
(7, 1, 'Año Nuevo', 'Año Nuevo celebración', '2021-12-31 00:30:00', '2021-12-31 04:33:00', '#14ff67', '#ffffff', '2021-12-31 03:03:28', '2022-01-02 17:35:11'),
(8, 1, 'Cumpleaños', 'Cumpleaños de alguien', '2022-01-08 00:01:00', '2022-01-08 23:59:00', '#f92f2f', '#ffffff', '2022-01-01 16:06:09', '2022-01-03 07:22:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `status`) VALUES
(1, 'Lacteos', 'Lacteos', 'img_5cf5c4410b3681c84552351dc69a7a70.jpg', '2022-01-04 00:23:21', 1),
(2, 'Frutas', 'Frutas', 'img_3b1217d2569a617e4027f5af757bb016.jpg', '2022-01-04 00:24:02', 1),
(3, 'Jugos y Bebidas', 'Jugos y Bebidas de todo tipo', 'img_806a627028b9823a349e50b8b1b7e352.jpg', '2022-01-04 00:25:51', 1),
(4, 'Cerveza y Licores', 'Cerveza y Licores de todo tipo', 'img_99150f0159d99fd0cb574f9f5b89aa17.jpg', '2022-01-04 00:30:20', 1),
(5, 'Cuidado Personal', 'Cuidado Personal', 'img_28f73615daf125d81ac939d27bd3db10.jpg', '2022-01-04 00:32:13', 1),
(6, 'Mascotas', 'Mascotas', 'img_be38a8e7cbdd304c2b255f15533a6a3f.jpg', '2022-01-04 00:55:49', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` bigint(20) NOT NULL,
  `pedidoid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `nombreEmpresa` varchar(25) NOT NULL,
  `direccion` text NOT NULL,
  `razonSocial` text NOT NULL,
  `correo` varchar(50) NOT NULL,
  `gerenteGeneral` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `nombreEmpresa`, `direccion`, `razonSocial`, `correo`, `gerenteGeneral`) VALUES
(1, 'Estación Route 77', '', 'Somos un equipo de negocios lideres en los campos de acción que emprendemos , corriente de Bendición , de producción, formadora con el temor a Dios en primer lugar y nuestro socio principal ya que de él recibimos los talentos para multiplicar y generar riqueza en todo emprendimiento , comprometido con la expansión del reino de Dios en la Tierra , generando riqueza para los socios, directivos, empleados, comprometidos con pasión , lealtad y dinamismo , para ver y dejar a nuestras futuras generaciones en una posición de privilegio y sobre todo hijos para el reino de Dios ', 'estacionroute77hn@gmail.com', 'Saúl Armando Zepeda ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE `estadocivil` (
  `idEstado` int(5) NOT NULL,
  `descripcion` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `estadocivil`
--

INSERT INTO `estadocivil` (`idEstado`, `descripcion`) VALUES
(1, 'Soltero'),
(2, 'Casado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `idGenero` int(11) NOT NULL,
  `descripcion` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idGenero`, `descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios Administrativos del sistema', 1),
(3, 'Clientes ', 'Clientes de tienda', 1),
(4, 'Productos', 'Todos los Producto', 1),
(5, 'Pedidos', 'Pedidos de compra', 1),
(6, 'Categorías', 'Categorías productos', 1),
(7, 'Calendario', 'Calendario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `idNacionalidad` int(11) NOT NULL,
  `descripcion` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`idNacionalidad`, `descripcion`) VALUES
(1, 'Nacional'),
(2, 'Extranjera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(11,2) NOT NULL,
  `costoenvio` decimal(11,2) NOT NULL,
  `idTipoPago` bigint(20) NOT NULL,
  `direccion_Envio` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(315, 4, 1, 1, 0, 0, 0),
(316, 4, 2, 0, 0, 0, 0),
(317, 4, 3, 0, 0, 0, 0),
(318, 4, 4, 0, 0, 0, 0),
(319, 4, 5, 0, 0, 0, 0),
(320, 4, 6, 0, 0, 0, 0),
(321, 4, 7, 1, 0, 0, 0),
(322, 3, 1, 0, 0, 0, 0),
(323, 3, 2, 0, 0, 0, 0),
(324, 3, 3, 0, 0, 0, 0),
(325, 3, 4, 0, 0, 0, 0),
(326, 3, 5, 0, 0, 0, 0),
(327, 3, 6, 0, 0, 0, 0),
(328, 3, 7, 1, 0, 0, 0),
(329, 2, 1, 0, 0, 0, 0),
(330, 2, 2, 0, 0, 0, 0),
(331, 2, 3, 0, 0, 0, 0),
(332, 2, 4, 0, 0, 0, 0),
(333, 2, 5, 0, 0, 0, 0),
(334, 2, 6, 0, 0, 0, 0),
(335, 2, 7, 1, 0, 0, 0),
(357, 1, 1, 1, 0, 0, 0),
(358, 1, 2, 1, 1, 1, 1),
(359, 1, 3, 1, 0, 0, 0),
(360, 1, 4, 1, 0, 0, 0),
(361, 1, 5, 1, 0, 0, 0),
(362, 1, 6, 1, 1, 1, 1),
(363, 1, 7, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `categoriaid` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModificado` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redessociales`
--

CREATE TABLE `redessociales` (
  `idRedSocial` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `descripcion` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `enlace` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_Rol` bigint(20) NOT NULL,
  `nombreRol` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Rol`, `nombreRol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Administrador General de la Tienda', 1),
(2, 'Supervisor', 'Supervisor de la tienda y Productos', 1),
(3, 'Encargado', 'Encargado de la tienda', 1),
(4, 'Repartidor Moto', 'Repartidor de la tienda', 1),
(6, 'Asistente', 'Asistente de gerente', 0),
(7, 'saasdsasd', 'assadasasasaasdsasa', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `nombre` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `nombre`, `descripcion`) VALUES
(1, 'Las Hadas', 'Local Ubicado en las Hadas'),
(2, 'Los Laureles', 'Local ubicado en la colonia los laureles'),
(3, 'Santa Lucia', 'Local ubicado en Santa Lucia Frente al lago\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonoempresa`
--

CREATE TABLE `telefonoempresa` (
  `idTelefonoEmpresa` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `idTipoPago` bigint(20) NOT NULL,
  `tipoPago` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` bigint(20) NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(35) COLLATE utf8mb4_swedish_ci NOT NULL,
  `contraseña` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `idNacionalidad` int(5) NOT NULL,
  `idGenero` int(5) NOT NULL,
  `idEstadoCivil` int(5) NOT NULL,
  `idRol` bigint(20) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `fechaNacimiento` datetime NOT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `telefono` int(11) NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `datelogin` datetime NOT NULL,
  `datemodificado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `dni`, `nombres`, `apellidos`, `email`, `contraseña`, `idNacionalidad`, `idGenero`, `idEstadoCivil`, `idRol`, `idSucursal`, `fechaNacimiento`, `status`, `telefono`, `token`, `datecreated`, `datelogin`, `datemodificado`) VALUES
(1, '0801200018857', 'José Fernando', 'Ortiz Santos', 'josefortizsantos@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1, 1, 1, 1, '2000-09-20 00:00:00', 1, 94877564, '', '2021-12-20 02:34:44', '2022-01-03 06:46:18', '2022-01-02 23:15:01'),
(2, '0801200018313', 'Hugo Alejandro', 'Paz', 'hugo.paz@unah.hn', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1, 1, 2, 1, '2000-06-15 00:00:00', 1, 94142814, '', '2021-12-20 13:57:46', '0000-00-00 00:00:00', '2022-01-02 23:08:37'),
(3, '0801123989878', 'Leonela', 'Pineda', 'lypineda@unah.hn', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 2, 2, 1, 2, '2021-05-05 00:00:00', 1, 97737659, '', '2021-12-20 14:16:53', '2021-12-30 16:51:52', '2022-01-02 20:53:38'),
(5, '0908099', 'Gabriela', 'Maradiaga', 'ggmaradiaga@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 2, 2, 4, 3, '1999-12-16 00:00:00', 1, 97514274, '', '2021-12-20 19:41:19', '2022-01-02 18:06:13', '2021-12-24 15:20:09'),
(6, '080119990155', 'Reynaldo Jafet', 'Giron Tercero', 'reynaldo.giron31@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1, 1, 1, 2, '2000-12-31 00:00:00', 1, 87660249, '', '2021-12-26 22:11:45', '2021-12-28 21:37:24', '2022-01-01 21:19:51'),
(7, '0801199612345', 'Kevin', 'Zuniga', 'krodriguezz@unah.hn', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1, 2, 2, 1, '2000-07-06 00:00:00', 1, 32301533, '', '2022-01-01 21:19:17', '0000-00-00 00:00:00', '2022-01-02 23:02:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`idNacionalidad`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idTipoPago` (`idTipoPago`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indices de la tabla `redessociales`
--
ALTER TABLE `redessociales`
  ADD PRIMARY KEY (`idRedSocial`),
  ADD KEY `idEmpresa` (`idEmpresa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`);

--
-- Indices de la tabla `telefonoempresa`
--
ALTER TABLE `telefonoempresa`
  ADD PRIMARY KEY (`idTelefonoEmpresa`),
  ADD KEY `idEmpresa` (`idEmpresa`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`idTipoPago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idNacionalidad` (`idNacionalidad`,`idGenero`,`idEstadoCivil`,`idSucursal`),
  ADD KEY `idEstadoCivil` (`idEstadoCivil`),
  ADD KEY `idGenero` (`idGenero`),
  ADD KEY `idSucursal` (`idSucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `idEstado` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `idNacionalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redessociales`
--
ALTER TABLE `redessociales`
  MODIFY `idRedSocial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `telefonoempresa`
--
ALTER TABLE `telefonoempresa`
  MODIFY `idTelefonoEmpresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `idTipoPago` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idTipoPago`) REFERENCES `tipo_pago` (`idTipoPago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `roles` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `redessociales`
--
ALTER TABLE `redessociales`
  ADD CONSTRAINT `redessociales_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefonoempresa`
--
ALTER TABLE `telefonoempresa`
  ADD CONSTRAINT `telefonoempresa_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `telefonoempresa_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadocivil` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idGenero`) REFERENCES `genero` (`idGenero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`idNacionalidad`) REFERENCES `nacionalidad` (`idNacionalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_5` FOREIGN KEY (`idSucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
