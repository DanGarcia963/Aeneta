-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2024 a las 13:15:06
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
-- Base de datos: `aeneta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ID_Alumno` INT AUTO_INCREMENT PRIMARY KEY,
  `Nombres` varchar(40) NOT NULL,
  `Apellido_Paterno` varchar(30) NOT NULL,
  `Apellido_Materno` varchar(30) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `boleta` varchar(10) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `ID_TT` int(11) NOT NULL,
  `Contrasena` varchar(15) NOT NULL,
  `Estado_Cuenta` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `ID_Area` int(11) NOT NULL,
  `Nombre_Area` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID_Cargo` int(11) NOT NULL,
  `Nombre_Cargo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID_Comentario` int(11) NOT NULL,
  `Descripción` varchar(200) NOT NULL,
  `ID_Alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `ID_Director` int(11) NOT NULL,
  `Nombre_Director` varchar(27) NOT NULL,
  `Apellido_Paterno` varchar(30) NOT NULL,
  `Apellido_Materno` varchar(30) NOT NULL,
  `RFC` varchar(18) NOT NULL,
  `Boleta` varchar(10) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `ID_Area` int(11) NOT NULL,
  `Contrasena` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_titulacion`
--

CREATE TABLE `estado_titulacion` (
  `ID_Estado` int(11) NOT NULL,
  `Nombre_Estado` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_director`
--

CREATE TABLE `metodo_director` (
  `ID_MD` int(11) NOT NULL,
  `ID_Director` int(11) NOT NULL,
  `ID_TT` int(11) NOT NULL,
  `ID_Cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_titulacion`
--

CREATE TABLE `metodo_titulacion` (
  `ID_TT` int(11) NOT NULL,
  `Nombre_TT` varchar(50) NOT NULL,
  `Descripción` varchar(200) NOT NULL,
  `ID_Estado` int(11) NOT NULL,
  `ID_Area` int(11) NOT NULL,
  `ID_Tipo_Titulacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_titulacion`
--

CREATE TABLE `tipo_titulacion` (
  `ID_Tipo_Titulacion` int(11) NOT NULL,
  `Nombre_Tipo_Titulacion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ID_Alumno`),
  ADD UNIQUE KEY `CURP` (`CURP`),
  ADD KEY `ID_TT` (`ID_TT`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`ID_Area`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_Cargo`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `ID_Alumno` (`ID_Alumno`);

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`ID_Director`),
  ADD UNIQUE KEY `RFC` (`RFC`),
  ADD KEY `ID_Area` (`ID_Area`);

--
-- Indices de la tabla `estado_titulacion`
--
ALTER TABLE `estado_titulacion`
  ADD PRIMARY KEY (`ID_Estado`);

--
-- Indices de la tabla `metodo_director`
--
ALTER TABLE `metodo_director`
  ADD PRIMARY KEY (`ID_MD`),
  ADD KEY `ID_TT` (`ID_TT`),
  ADD KEY `ID_Director` (`ID_Director`),
  ADD KEY `ID_Cargo` (`ID_Cargo`);

--
-- Indices de la tabla `metodo_titulacion`
--
ALTER TABLE `metodo_titulacion`
  ADD PRIMARY KEY (`ID_TT`),
  ADD KEY `ID_Tipo_Titulacion` (`ID_Tipo_Titulacion`),
  ADD KEY `ID_Area` (`ID_Area`),
  ADD KEY `ID_Estado` (`ID_Estado`);

--
-- Indices de la tabla `tipo_titulacion`
--
ALTER TABLE `tipo_titulacion`
  ADD PRIMARY KEY (`ID_Tipo_Titulacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ID_Alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `ID_Area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID_Cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID_Comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `ID_Director` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_titulacion`
--
ALTER TABLE `estado_titulacion`
  MODIFY `ID_Estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_director`
--
ALTER TABLE `metodo_director`
  MODIFY `ID_MD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_titulacion`
--
ALTER TABLE `metodo_titulacion`
  MODIFY `ID_TT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_titulacion`
--
ALTER TABLE `tipo_titulacion`
  MODIFY `ID_Tipo_Titulacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`ID_TT`) REFERENCES `metodo_titulacion` (`ID_TT`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumno` (`ID_Alumno`);

--
-- Filtros para la tabla `director`
--
ALTER TABLE `director`
  ADD CONSTRAINT `director_ibfk_1` FOREIGN KEY (`ID_Area`) REFERENCES `area` (`ID_Area`);

--
-- Filtros para la tabla `metodo_director`
--
ALTER TABLE `metodo_director`
  ADD CONSTRAINT `metodo_director_ibfk_1` FOREIGN KEY (`ID_TT`) REFERENCES `metodo_titulacion` (`ID_TT`),
  ADD CONSTRAINT `metodo_director_ibfk_2` FOREIGN KEY (`ID_Director`) REFERENCES `director` (`ID_Director`),
  ADD CONSTRAINT `metodo_director_ibfk_3` FOREIGN KEY (`ID_Cargo`) REFERENCES `cargo` (`ID_Cargo`);

--
-- Filtros para la tabla `metodo_titulacion`
--
ALTER TABLE `metodo_titulacion`
  ADD CONSTRAINT `metodo_titulacion_ibfk_1` FOREIGN KEY (`ID_Tipo_Titulacion`) REFERENCES `tipo_titulacion` (`ID_Tipo_Titulacion`),
  ADD CONSTRAINT `metodo_titulacion_ibfk_2` FOREIGN KEY (`ID_Area`) REFERENCES `area` (`ID_Area`),
  ADD CONSTRAINT `metodo_titulacion_ibfk_3` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_titulacion` (`ID_Estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
