-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2025 a las 21:00:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokedex pw2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
  `Identifcador` int(11) NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Imagen` varchar(1999) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Descripcion` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`Identifcador`, `Numero`, `Imagen`, `Nombre`, `Tipo`, `Descripcion`) VALUES
(19, 1, '/img/001.png', 'Bulbasaur', 4, 'Tras nacer, crece alimentándose durante un tiempo de los nutrientes que contiene el bulbo de su lomo.'),
(24, 2, '/img/002.png', 'Ivysaur', 4, 'Cuanta más luz solar recibe, más aumenta su fuerza y más se desarrolla el capullo que tiene en el lomo.'),
(25, 3, '/img/003.png', 'Venusaur', 4, 'Puede convertir la luz del sol en energía. Por esa razón, es más poderoso en verano.'),
(26, 4, '/img/004.png', 'Charmander', 2, 'La llama de su cola indica su fuerza vital. Si está débil, la llama arderá más tenue.'),
(27, 5, '/img/005.png', 'Charmeleon', 2, 'Al agitar su ardiente cola, eleva poco a poco la temperatura a su alrededor para sofocar a sus rivales.'),
(28, 6, '/img/006.png', 'Charizard', 2, 'uando se enfurece de verdad, la llama de la punta de su cola se vuelve de color azul claro.'),
(29, 7, '/img/007.png', 'Squirtle', 3, 'Tras nacer, se le hincha el lomo y se le forma un caparazón. Escupe poderosa espuma por la boca.'),
(30, 8, '/img/008.png', 'Wartortle', 3, 'Tiene una cola larga y peluda que simboliza la longevidad y lo hace popular entre los mayores.'),
(31, 9, '/img/009.png', 'Blastoise', 3, 'Aumenta de peso deliberadamente para contrarrestar la fuerza de los chorros de agua que dispara.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `Identificador` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`Identificador`, `Nombre`) VALUES
(1, 'Normal'),
(2, 'Fuego'),
(3, 'Agua'),
(4, 'Planta'),
(5, 'Eléctrico'),
(6, 'Hielo'),
(7, 'Lucha'),
(8, 'Veneno'),
(9, 'Tierra'),
(10, 'Volador'),
(11, 'Psíquico'),
(12, 'Bicho'),
(13, 'Roca'),
(14, 'Fantasma'),
(15, 'Dragón'),
(16, 'Siniestro'),
(17, 'Acero'),
(18, 'Hada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`Identifcador`),
  ADD KEY `POKEMON_FK` (`Tipo`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`Identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `Identifcador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `POKEMON_FK` FOREIGN KEY (`Tipo`) REFERENCES `tipo` (`Identificador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
