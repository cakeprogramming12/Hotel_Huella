-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 00:46:18
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
-- Base de datos: `hostel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'configuroweb1', 'msevillab@gmail.com', '123456789', '2016-04-04 20:31:45', '2024-11-24'),
(6, 'admindaniel', 'aadmindaniel@gmail.com', '123', '2024-11-25 11:38:11', '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cleaner`
--

CREATE TABLE `cleaner` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cleaner`
--

INSERT INTO `cleaner` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'jdoe', 'jdoe12@example.com', '12345678', '2024-11-23 22:41:43', '2024-11-25'),
(2, 'lucasamith', 'asmith@example.com', 'hashedpassword456', '2024-11-23 22:41:43', '2024-11-24'),
(3, 'Adrian', 'adrian@gmail.com', '123', '2024-11-25 11:15:22', '2024-11-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cleanerlog`
--

CREATE TABLE `cleanerlog` (
  `id` int(11) NOT NULL,
  `cleanerid` int(11) NOT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `contactno` int(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL,
  `codigo_alfanumerico` varchar(255) DEFAULT NULL,
  `confirmada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `firstName`, `middleName`, `lastName`, `contactno`, `emailid`, `postingDate`, `updationDate`, `codigo_alfanumerico`, `confirmada`) VALUES
(36, 101, 500, 1, '2024-12-02', 1, 'Ramiro', 'Edson', 'Vega', 1234567890, '123@gmail.com', '2024-12-01 19:33:17', '', '8ATN14FW3M', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `clean` tinyint(1) DEFAULT 0,
  `ocupada` tinyint(1) DEFAULT 0,
  `room_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `fees`, `posting_date`, `clean`, `ocupada`, `room_type`) VALUES
(28, 101, 550, '2024-12-01 04:33:50', 0, 1, 'Habitacion Sencilla'),
(29, 102, 900, '2024-12-01 04:33:50', 1, 1, 'Habitacion Jacuzzi'),
(30, 103, 1000, '2024-12-01 04:33:50', 1, 1, 'Jacuzzi con Jardín'),
(31, 201, 1800, '2024-12-01 04:33:50', 1, 0, 'Habitacion Alberca'),
(32, 202, 1850, '2024-12-01 04:33:50', 1, 0, 'Habitacion Suite'),
(33, 203, 2000, '2024-12-01 04:33:50', 1, 0, 'Habitación Jacuzzi con Sauna'),
(34, 204, 2500, '2024-12-01 04:33:50', 1, 0, 'Suite Alberca con Habitacion Doble'),
(37, 1010, 550, '2024-12-01 20:41:07', 0, 0, 'Habitacion Sencilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `super`
--

CREATE TABLE `super` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `super`
--

INSERT INTO `super` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin1', 'adminprincipal@example.com', '123456789', '2024-11-24 22:57:13', '2024-11-25'),
(2, 'admin2', 'admin2@example.com', 'securepass456', '2024-11-24 22:57:13', '2024-11-10'),
(3, 'admin3', 'admin3@example.com', 'mypassword789', '2024-11-24 22:57:13', '2024-11-15'),
(4, 'admin4', 'admin4@example.com', 'adminpass001', '2024-11-24 22:57:13', NULL),
(5, 'admin5', 'admin5@example.com', 'testpass002', '2024-11-24 22:57:13', '2024-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `loginTime`) VALUES
(32, 25, 'carol@gmail.com', 0x3a3a31, '2024-11-24 03:18:46'),
(33, 25, 'carol@gmail.com', 0x3a3a31, '2024-11-24 03:32:09'),
(34, 24, 'vegaddd@gmail.com', 0x3a3a31, '2024-11-24 03:39:13'),
(35, 25, 'carol@gmail.com', 0x3a3a31, '2024-11-24 04:42:35'),
(36, 24, 'vegaddd@gmail.com', 0x3a3a31, '2024-11-24 05:25:39'),
(37, 24, 'vegaddd@gmail.com', 0x3a3a31, '2024-11-24 15:35:37'),
(38, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-24 17:23:15'),
(39, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-24 17:35:42'),
(40, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-24 21:25:33'),
(41, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-24 22:31:12'),
(42, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-24 23:54:51'),
(43, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-25 01:37:22'),
(44, 26, 'vegaramiro02@gmail.com', 0x3a3a31, '2024-11-25 02:05:19'),
(45, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-25 02:48:03'),
(46, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-28 23:31:31'),
(47, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-28 23:32:58'),
(48, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-29 00:29:30'),
(49, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-29 03:20:22'),
(50, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-29 18:35:02'),
(51, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-29 18:52:36'),
(52, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-29 19:09:31'),
(53, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:24:48'),
(54, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:29:50'),
(55, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:33:43'),
(56, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:40:18'),
(57, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:43:08'),
(58, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:46:46'),
(59, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:54:58'),
(60, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:55:31'),
(61, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 04:56:45'),
(62, 33, 'asdasdasd@gmail.com', 0x3a3a31, '2024-11-30 05:01:03'),
(63, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 20:46:42'),
(64, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 20:50:08'),
(65, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 20:53:08'),
(66, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 21:30:29'),
(67, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 22:46:11'),
(68, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-30 23:02:09'),
(69, 27, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 00:15:42'),
(70, 27, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 01:46:41'),
(71, 27, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 04:17:26'),
(72, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 04:30:41'),
(73, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 05:30:40'),
(74, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 05:39:10'),
(75, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 05:39:45'),
(76, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 05:42:55'),
(77, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 18:21:28'),
(78, 39, 'Lucasegara@gmail.com', 0x3a3a31, '2024-12-01 18:33:10'),
(79, 40, 'adrian@gmail.com', 0x3a3a31, '2024-12-01 19:28:43'),
(80, 40, 'adrian@gmail.com', 0x3a3a31, '2024-12-01 19:30:03'),
(81, 41, '123@gmail.com', 0x3a3a31, '2024-12-01 19:30:31'),
(82, 41, '123@gmail.com', 0x3a3a31, '2024-12-01 19:46:09'),
(83, 40, 'adrian@gmail.com', 0x3a3a31, '2024-12-01 19:46:46'),
(84, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 19:47:45'),
(85, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 20:51:04'),
(86, 36, 'vegara@gmail.com', 0x3a3a31, '2024-12-01 23:01:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `userregistration`
--

INSERT INTO `userregistration` (`id`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(36, 'Ramiro', 'Edson', 'Vega', 'male', 1234567890, 'vegara@gmail.com', '123', '2024-12-01 04:22:27', '', ''),
(37, 'daniel', 'cejudo', 'vega', 'others', 1234567890, 'danielcejudo@gmail.com', '123', '2024-12-01 04:30:04', '', ''),
(38, 'daniel', 'cejudo', 'vega', 'male', 1234567890, 'admin1@example.com', '123', '2024-12-01 18:21:22', '', ''),
(39, 'lucas', 'cejudo', 'vega', 'male', 1234567890, 'Lucasegara@gmail.com', '123', '2024-12-01 18:31:09', '', ''),
(40, 'adrian', 'marcelo', 'lopezs', 'male', 1234567890, 'adrian@gmail.com', '123', '2024-12-01 19:28:27', '', ''),
(41, 'Ramiro', 'Edson', 'Vega', 'male', 1234567890, '123@gmail.com', '123', '2024-12-01 19:30:24', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cleaner`
--
ALTER TABLE `cleaner`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cleanerlog`
--
ALTER TABLE `cleanerlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleanerid` (`cleanerid`);

--
-- Indices de la tabla `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_alfanumerico` (`codigo_alfanumerico`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `super`
--
ALTER TABLE `super`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cleaner`
--
ALTER TABLE `cleaner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cleanerlog`
--
ALTER TABLE `cleanerlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `super`
--
ALTER TABLE `super`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cleanerlog`
--
ALTER TABLE `cleanerlog`
  ADD CONSTRAINT `cleanerlog_ibfk_1` FOREIGN KEY (`cleanerid`) REFERENCES `cleaner` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
