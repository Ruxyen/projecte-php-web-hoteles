-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2023 a las 20:07:27
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_Client=@@CHARACTER_SET_Client */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_reservas_hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Client`
--

CREATE TABLE `Client` (
  `id_client` varchar(5) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `cognoms` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenya` varchar(25) NOT NULL,
  `dni` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Client`
--

INSERT INTO `Client` (`id_client`, `nom_client`, `cognoms`, `email`, `contrasenya`, `dni`) VALUES
('1', 'Rubén ', 'Teruel Rosales', 'rubenteruel2004@gmail.com', '12345', '48277944R'),
('2', 'Olga', 'Rosales Luque', 'ruxyengamesnft@gmail.com', '1234', '999999'),
('3', 'oipo', 'oo', 'tygrefw2@gmail.com', '12345', '1234'),
('4', 'EWE', 'EGE', 'tygrefw2@gmail.com', '12345', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Habitacio`
--

CREATE TABLE `Habitacio` (
  `id_habitacio` int(5) NOT NULL,
  `tipus_habitacio` varchar(50) NOT NULL,
  `preu_nit` decimal(8,2) NOT NULL,
  `capacitat` int(5) NOT NULL,
  `descripció` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Habitacio`
--

INSERT INTO `Habitacio` (`id_habitacio`, `tipus_habitacio`, `preu_nit`, `capacitat`, `descripció`) VALUES
(1, 'Individual', '50.00', 1, 'Habitació individual amb bany privat.'),
(2, 'Doble', '80.00', 2, 'Habitacio doble amb llit de matrimoni i bany privat.'),
(3, 'Suite', '150.00', 2, 'Habitacio suite amb llit de matrimoni, sala de estar i bany privat.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva`
--

CREATE TABLE `Reserva` (
  `id_reserva` int(5) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_sortida` date NOT NULL,
  `num_persones` int(2) NOT NULL,
  `id_habitacio` int(5) DEFAULT NULL,
  `tipus_habitacio` varchar(25) NOT NULL,
  `id_Client` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Reserva`
--

INSERT INTO `Reserva` (`id_reserva`, `data_entrada`, `data_sortida`, `num_persones`, `id_habitacio`, `tipus_habitacio`, `id_client`) VALUES
(11, '2023-04-29', '2023-05-05', 1, 1, 'Individual', '1'),
(15, '2023-04-29', '2023-05-05', 1, 1, 'Individual', '1'),
(25, '2023-04-14', '2023-04-14', 1, 1, 'Individual', '1'),
(36, '2023-04-29', '2023-05-05', 1, 1, 'Individual', '1'),
(48, '2023-04-14', '2023-04-14', 1, 1, 'Individual', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indices de la tabla `Habitacio`
--
ALTER TABLE `habitacio`
  ADD PRIMARY KEY (`id_habitacio`);

--
-- Indices de la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_habitacio` (`id_habitacio`),
  ADD KEY `id_client` (`id_client`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD CONSTRAINT `Reserva_ibfk_1` FOREIGN KEY (`id_habitacio`) REFERENCES `habitacio` (`id_habitacio`),
  ADD CONSTRAINT `Reserva_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
