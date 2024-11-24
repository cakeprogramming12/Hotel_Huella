-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2024 a las 18:18:28
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
(1, 'configuroweb', 'msevillab@gmail.com', '123', '2016-04-04 20:31:45', '2016-04-17');

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
(1, 'jdoe', 'jdoe12@example.com', '1234', '2024-11-23 22:41:43', '2024-11-24'),
(2, 'asmith', 'asmith@example.com', 'hashedpassword456', '2024-11-23 22:41:43', NULL);

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
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `posting_date`) VALUES
(8, 'AA5224', 'ADMON', 'AdministraciÃ³n de Empresas', '2019-12-13 19:53:56'),
(10, 'SS24IU', 'SIP', 'PsicologÃ­a', '2019-12-13 19:57:04'),
(11, 'II12EW', 'IS', 'IngenierÃ­a de Sistemas InformÃ¡ticos', '2019-12-13 20:02:43'),
(13, 'IICI42', 'INCIV', 'IngenierÃ­a Civil', '2019-12-13 20:05:21'),
(14, 'IIQQ23', 'INGQUIM', 'IngenierÃ­a QuÃ­mica', '2019-12-13 20:49:17'),
(15, 'PP3210', 'PERD', 'ComunicaciÃ³n Social', '2019-12-13 20:51:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hostel_finances`
--

CREATE TABLE `hostel_finances` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(255) DEFAULT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL,
  `codigo_alfanumerico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `clean` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `posting_date`, `clean`) VALUES
(22, 1, 101, 500, '2024-11-20 04:30:22', 0),
(23, 3, 201, 700, '2024-11-20 04:31:00', 0),
(24, 3, 301, 900, '2024-11-20 04:32:44', 0),
(25, 5, 501, 1000, '2024-11-24 16:56:15', 0),
(26, 4, 401, 600, '2024-11-24 16:59:15', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(10, 'Brazil'),
(9, 'Japan'),
(8, 'China'),
(7, 'India'),
(6, 'Germany'),
(5, 'France'),
(4, 'United Kingdom'),
(3, 'Mexico'),
(2, 'Canada'),
(1, 'United States');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(7, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 17:42:38'),
(8, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 18:17:09'),
(9, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 18:17:39'),
(10, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 18:54:35'),
(11, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 19:48:14'),
(12, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 20:54:24'),
(13, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 21:18:43'),
(14, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 21:50:23'),
(15, 23, 'hello@cw.com', 0x3a3a31, '', '', '2019-12-13 21:55:13'),
(16, 23, 'hello@cw.com', 0x3a3a31, '', '', '2019-12-13 22:50:51'),
(17, 22, 'hola@cw.com', 0x3a3a31, '', '', '2019-12-13 22:52:22'),
(18, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-19 01:24:39'),
(19, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-20 04:05:18'),
(20, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-21 02:32:47'),
(21, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-21 03:12:19'),
(22, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-21 03:39:22'),
(23, 21, 'm@g.com', 0x3a3a31, '', '', '2024-11-21 17:23:48'),
(24, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 17:59:58'),
(25, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 18:00:33'),
(26, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 18:01:44'),
(27, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 18:03:06'),
(28, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 18:06:18'),
(29, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-21 19:32:27'),
(30, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-22 03:09:17'),
(31, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-23 02:29:11'),
(32, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-24 03:18:46'),
(33, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-24 03:32:09'),
(34, 24, 'vegaddd@gmail.com', 0x3a3a31, '', '', '2024-11-24 03:39:13'),
(35, 25, 'carol@gmail.com', 0x3a3a31, '', '', '2024-11-24 04:42:35'),
(36, 24, 'vegaddd@gmail.com', 0x3a3a31, '', '', '2024-11-24 05:25:39'),
(37, 24, 'vegaddd@gmail.com', 0x3a3a31, '', '', '2024-11-24 15:35:37');

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
(21, 'Juan', 'Able', 'Process', 'male', 1231231230, 'm@g.com', '123123123', '2019-12-13 14:00:24', '', ''),
(22, 'Mauricio', 'Sevilla', 'Perez', 'male', 123457890, 'hola@cw.com', '1234567890', '2019-12-13 17:42:01', '14-12-2019 01:20:53', ''),
(24, 'rodirgo', 'vega', 'vega', 'male', 733333, 'vegaddd@gmail.com', '123', '2024-11-21 17:42:13', '', ''),
(25, 'fernando', 'meza', 'vega', 'male', 777777777, 'carol@gmail.com', '123', '2024-11-21 17:58:09', '21-11-2024 11:42:59', '');

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
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hostel_finances`
--
ALTER TABLE `hostel_finances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_id` (`registration_id`);

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
-- Indices de la tabla `states`
--
ALTER TABLE `states`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cleaner`
--
ALTER TABLE `cleaner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cleanerlog`
--
ALTER TABLE `cleanerlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `hostel_finances`
--
ALTER TABLE `hostel_finances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cleanerlog`
--
ALTER TABLE `cleanerlog`
  ADD CONSTRAINT `cleanerlog_ibfk_1` FOREIGN KEY (`cleanerid`) REFERENCES `cleaner` (`id`);

--
-- Filtros para la tabla `hostel_finances`
--
ALTER TABLE `hostel_finances`
  ADD CONSTRAINT `hostel_finances_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
