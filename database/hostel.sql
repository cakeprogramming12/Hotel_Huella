-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 05:51:23
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
(6, 'admindaniel', 'admindaniel@gmail.com', '1234', '2024-11-25 11:38:11', '0000-00-00');

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
-- Estructura de tabla para la tabla `hostel_finances`
--

CREATE TABLE `hostel_finances` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `hostel_finances`
--

INSERT INTO `hostel_finances` (`id`, `registration_id`, `amount_due`, `payment_date`) VALUES
(3, 25, 3100.00, '2024-11-25');

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
  `contactno` int(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` varchar(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` varchar(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(255) DEFAULT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` varchar(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL,
  `codigo_alfanumerico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `seater`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `corresCIty`, `corresState`, `corresPincode`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `postingDate`, `updationDate`, `codigo_alfanumerico`) VALUES
(25, 101, 1, 500, 0, '2024-11-25', 5, 'Ramiro', '0', 'Meza', 'male', 2147483647, 'vegara@gmail.com', '0', 'luis', '0', '7228997888', 'Parque bosencheve 1305', '0', 'Mexico', 50100, 'Parque bosencheve 1305', '0', 'Mexico', '50100', '2024-11-25 03:11:06', '', 'IA7L6XOC8W');

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
  `clean` tinyint(1) DEFAULT 0,
  `ocupada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `posting_date`, `clean`, `ocupada`) VALUES
(22, 1, 101, 500, '2024-11-20 04:30:22', 1, 1),
(23, 3, 201, 600, '2024-11-20 04:31:00', 0, 0),
(24, 3, 301, 900, '2024-11-20 04:32:44', 0, 0),
(26, 4, 401, 600, '2024-11-24 16:59:15', 0, 0),
(27, 4, 701, 800, '2024-11-25 03:23:46', 0, 0);

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
(45, 27, 'vegara@gmail.com', 0x3a3a31, '2024-11-25 02:48:03');

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
(27, 'Ramiro', 'perezx', 'Meza', 'Masculino', 7228698438, 'vegara@gmail.com', '12345678', '2024-11-25 02:46:00', '2024-11-25 05:37:39', '25-11-2024 08:19:46');

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
-- AUTO_INCREMENT de la tabla `hostel_finances`
--
ALTER TABLE `hostel_finances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `super`
--
ALTER TABLE `super`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
