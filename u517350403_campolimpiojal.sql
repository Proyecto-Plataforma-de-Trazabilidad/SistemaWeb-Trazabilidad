-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-07-2023 a las 03:12:21
-- Versión del servidor: 10.5.19-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u517350403_campolimpiojal`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`u517350403_admindb`@`127.0.0.1` PROCEDURE `OrdenConsulta` (IN `nomDistribuidor` VARCHAR(40), IN `FI` VARCHAR(15), IN `FF` VARCHAR(15), IN `IdProductor` INT)  BEGIN
IF nomDistribuidor = 'admin' THEN
	IF FI = '' and FF = '' and IdProductor = '' THEN
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor;
	ELSEIF FI != ''  and FF != '' and IdProductor = '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.Fecha BETWEEN FI AND FF;
	ELSEIF FI = '' and FF = '' and IdProductor != '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.IdProductor = IdProductor;
	ELSEIF FI != ''  and FF != '' and IdProductor != '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.Fecha BETWEEN FI AND FF AND O.IdProductor = IdProductor;
	END IF;
ELSE 
	IF FI = '' and FF = '' and IdProductor = '' THEN
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor 
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
        WHERE O.IdDistribuidor = nomDistribuidor;
	ELSEIF FI != ''  and FF != '' and IdProductor = '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.IdDistribuidor = nomDistribuidor AND O.Fecha BETWEEN FI AND FF;
	ELSEIF FI = '' and FF = '' and IdProductor != '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.IdDistribuidor = nomDistribuidor AND O.IdProductor = IdProductor;
	ELSEIF FI != ''  and FF != '' and IdProductor != '' THEN	
		SELECT O.IdOrden, D.Nombre AS 'Distribuidor', P.Nombre AS 'Productor', O.NumFactura, O.Factura, O.NumReceta, O.Receta,  O.Fecha
		FROM ordenproductos AS O
		INNER JOIN distribuidores AS D 
		ON D.IdDistribuidor = O.IdDistribuidor
		INNER JOIN productores AS P ON P.IdProductor = O.IdProductor
		WHERE O.IdDistribuidor = nomDistribuidor AND O.Fecha BETWEEN FI AND FF AND O.IdProductor = IdProductor;
	END IF;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AgricultorCpuSsa`
--

CREATE TABLE `AgricultorCpuSsa` (
  `idAgriCpuSsa` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `ApellidoP` varchar(20) DEFAULT NULL,
  `ApellidoM` varchar(20) DEFAULT NULL,
  `RazonSocial` varchar(50) DEFAULT NULL,
  `Telefon` varchar(16) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Municipio` varchar(30) DEFAULT NULL,
  `CurpRfc` varchar(20) DEFAULT NULL,
  `Contrasena` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centroacopiotemporal`
--

CREATE TABLE `centroacopiotemporal` (
  `IdCAT` int(11) NOT NULL,
  `IdResponsableCat` int(11) NOT NULL,
  `NombreCentro` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NumRegAmbiental` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `InformacionAdicional` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Estado` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `HorarioDiasLaborales` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `PlanManejo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `centroacopiotemporal`
--

INSERT INTO `centroacopiotemporal` (`IdCAT`, `IdResponsableCat`, `NombreCentro`, `NumRegAmbiental`, `InformacionAdicional`, `Domicilio`, `CP`, `Municipio`, `Estado`, `Telefono`, `Correo`, `HorarioDiasLaborales`, `Latitud`, `Longitud`, `PlanManejo`) VALUES
(1, 1, 'Reciclando Ando', '8798797', 'STAL rifa', 'Morelos# 40', '49782', 'Carmen', 'Campeche', '3411349110', 'ReciclandoAndo@gmail.com', 'Lun-Vie 7am-4pm', 19.714792, -103.480522, 'IZI BOTS'),
(2, 2, 'Rici3000', '90324', 'Manejarse con cuidado', 'Jose rolon #186', '49542', 'Aquiles Serdán', 'Chihuahua', '3411349160', 'Reci3000@gmail.com', 'Lun-Vie 7am-4pm', 19.687965, -103.486015, 'No se '),
(3, 1, 'CAT Chihuahua', '123456', 'otro', 'Manuel Ávila Camacho #100', '49300', 'Ahumada', 'Chihuahua', '3421096968', 'CatC@gmail.com', 'Lun-vin-8-4', 19.719641, -103.573906, 'uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centroacopiotemporalnew`
--

CREATE TABLE `centroacopiotemporalnew` (
  `IdCAT` int(11) NOT NULL,
  `NombreCentro` varchar(30) DEFAULT NULL,
  `IdResponsableCat` int(11) DEFAULT NULL,
  `Responsablecat` varchar(30) DEFAULT NULL,
  `NumRegAmbiental` varchar(10) DEFAULT NULL,
  `PlanManejo` varchar(200) DEFAULT NULL,
  `TelefonoRespCat` varchar(20) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Calle` varchar(50) DEFAULT NULL,
  `Colonia` varchar(30) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Municipio` varchar(40) DEFAULT NULL,
  `OpeNombre` varchar(30) DEFAULT NULL,
  `ApellidoP` varchar(20) DEFAULT NULL,
  `ApellidoM` varchar(20) DEFAULT NULL,
  `TelefonoOpe` varchar(20) DEFAULT NULL,
  `CorreoOpe` varchar(50) DEFAULT NULL,
  `CurpRfc` varchar(20) DEFAULT NULL,
  `Contrasena` varchar(20) DEFAULT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedores`
--

CREATE TABLE `contenedores` (
  `IdContenedor` int(11) NOT NULL,
  `IdTipoCont` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Origen` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Capacidad` float NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `UltimaFechaRecoleccion` date NOT NULL,
  `ReferenciaPermiso` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `InstruccionesManejo` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CapacidadStatus` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `contenedores`
--

INSERT INTO `contenedores` (`IdContenedor`, `IdTipoCont`, `IdUsuario`, `Origen`, `Capacidad`, `Descripcion`, `Latitud`, `Longitud`, `UltimaFechaRecoleccion`, `ReferenciaPermiso`, `InstruccionesManejo`, `CapacidadStatus`) VALUES
(1, 1, 6, 'Amocali', 200, 'nose se creo', 19.947533, -103.677979, '2023-05-16', '', '', 30),
(2, 1, 6, 'CAT', 300, 'alguna', 19.947533, -103.677979, '2023-05-16', '', '', 50),
(3, 1, 4, 'Distribuidores', 200, 'Un triste bote', 19.702187, -103.467819, '2023-05-21', 'PermisosContenedor/3.pdf', 'Con cuidadito ', 25),
(4, 2, 6, 'Distribuidores', 100, 'Un constal grande ', 19.633066, -103.439819, '2023-05-01', 'PermisosContenedor/4.png', 'Na mas vacíale  ', 20),
(5, 1, 8, 'Municipios', 300, 'Contenedor grande', 20.069592, -103.512451, '2023-05-21', 'PermisosContenedor/5.pdf', 'Tiene candado pedir al responsable la llave', 23),
(6, 3, 6, 'Distribuidores', 500, 'contenedor de flexibles', 19.735476, -103.613045, '2023-05-22', 'PermisosContenedor/6.jpg', 'no es necesario', 130);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentrega`
--

CREATE TABLE `detalleentrega` (
  `IdEntrega` int(11) NOT NULL,
  `Consecutivo` int(11) NOT NULL,
  `TipoEnvaseVacio` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CantidadPiezas` int(11) NOT NULL,
  `Peso` float DEFAULT NULL,
  `Observaciones` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `detalleentrega`
--

INSERT INTO `detalleentrega` (`IdEntrega`, `Consecutivo`, `TipoEnvaseVacio`, `CantidadPiezas`, `Peso`, `Observaciones`) VALUES
(1, 1, 'Rígidos lavable', 12, 3, ''),
(1, 2, 'Rígidos no lavable', 22, 2, 'Ninguna'),
(2, 1, 'Flexible', 12, 3, 'No'),
(2, 2, 'Rígidos no lavable', 11, 0, ''),
(3, 1, 'Rígidos Lavables', 5, 2, ''),
(4, 1, 'Rígidos lavables', 10, 2, 'sdfgh'),
(4, 2, 'Rígidos no lavables', 82, 2, 'asdfghj'),
(5, 1, 'Rígidos no lavables', 12, 0, 'adadasd'),
(6, 1, 'Rígidos lavables', 10, 5, 'ninguna'),
(6, 2, 'Flexibles', 5, 30, 'ninguna'),
(7, 1, 'Rígidos lavables', 30, 4, 'Alguna descripcion de los envases entregados '),
(7, 2, 'Rígidos no lavables', 5, 2, 'alguna otra descripcion'),
(8, 1, 'Rígidos no lavables', 12, 1, ''),
(9, 1, 'Flexibles', 10, 2, ''),
(9, 2, 'Flexibles', 7, 0, ''),
(10, 1, 'Rígidos lavables', 3, 0.5, 'todo bien'),
(11, 1, 'Rígidos lavables', 5, 2, 'se entregaron lavados'),
(12, 1, 'Rígidos no lavables', 5, 0.5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleorden`
--

CREATE TABLE `detalleorden` (
  `IdOrden` int(11) NOT NULL,
  `Consecutivo` int(11) NOT NULL,
  `IdTipoQuimico` int(11) NOT NULL,
  `TipoEnvase` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Color` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CantidadPiezas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `detalleorden`
--

INSERT INTO `detalleorden` (`IdOrden`, `Consecutivo`, `IdTipoQuimico`, `TipoEnvase`, `Color`, `CantidadPiezas`) VALUES
(1, 1, 3, 'Rígidos no lavable', 'No Aplica', 12),
(2, 1, 1, 'Rígidos lavable', 'Azul', 5),
(2, 2, 2, 'Rígidos no lavable', 'No Aplica', 4),
(2, 3, 4, 'Rígidos no lavable', 'No Aplica', 3),
(2, 4, 1, 'Flexible', 'Azul', 10),
(3, 1, 1, 'Rígidos lavable', 'Verde', 10),
(3, 2, 2, 'Rígidos no lavable', 'No Aplica', 20),
(4, 1, 1, 'Rígidos lavable', 'Amarillo', 10),
(4, 2, 2, 'Rígidos no lavable', 'No Aplica', 22),
(5, 1, 1, 'Rígidos lavable', 'Verde', 10),
(6, 1, 2, 'Rígidos lavable', 'No Aplica', 20),
(6, 2, 1, 'Rígidos no lavable', 'Amarillo', 20),
(6, 3, 3, 'Flexible', 'No Aplica', 25),
(6, 4, 4, 'Rígidos no lavable', 'No Aplica', 5),
(7, 1, 1, 'Rígidos lavable', 'Verde', 500),
(7, 2, 2, 'Rígidos lavable', 'No Aplica', 300),
(8, 1, 2, 'Rígidos lavable', 'No Aplica', 5),
(9, 1, 1, 'Rígidos lavables', 'Azul', 30),
(9, 2, 2, 'Rígidos lavables', 'No Aplica', 10),
(10, 1, 2, 'Rígidos lavables', 'No Aplica', 4),
(11, 1, 1, 'Rígidos lavables', 'Amarillo', 3),
(12, 1, 1, 'Rígidos lavables', 'Verde', 10),
(12, 2, 3, 'Rígidos no lavables', 'No Aplica', 20),
(13, 1, 1, 'Rígidos lavables', 'Azul', 4),
(14, 1, 1, 'Rígidos lavables', 'Amarillo', 15),
(14, 2, 2, 'Rígidos no lavables', 'No Aplica', 19),
(15, 1, 1, 'Rígidos no lavables', 'Azul', 20),
(15, 2, 3, 'Flexibles', 'No Aplica', 13),
(16, 1, 2, 'Rígidos no lavables', 'No Aplica', 20),
(16, 2, 1, 'Rígidos no lavables', 'Azul', 10),
(17, 1, 1, 'Rígidos lavables', 'Verde', 15),
(17, 2, 2, 'Rígidos no lavables', 'No Aplica', 4),
(18, 1, 2, 'Rígidos no lavables', 'No Aplica', 5),
(19, 1, 1, 'Rígidos lavables', 'Verde', 5),
(20, 1, 2, 'Rígidos no lavables', 'No Aplica', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidores`
--

CREATE TABLE `distribuidores` (
  `IdDistribuidor` int(11) NOT NULL,
  `Nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Representante` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Ciudad` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `ActividadGiro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CapacitacionBUMA` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SEMARNAT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LicenciaMunicipio` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `distribuidores`
--

INSERT INTO `distribuidores` (`IdDistribuidor`, `Nombre`, `Representante`, `Domicilio`, `CP`, `Ciudad`, `Municipio`, `Edo`, `Telefono`, `Correo`, `Latitud`, `Longitud`, `ActividadGiro`, `CapacitacionBUMA`, `SEMARNAT`, `LicenciaMunicipio`) VALUES
(1, 'Sergio', 'Shiro', 'Ocampo #30', '49650', 'Tamazula de Gordiano', 'Tamazula de Gordiano', 'Jalisco', '3589029865', 'usersergiojos3@gmail.com', 19.704451, -103.495972, 'zzzzz', 'BUMADistribuidores/1.jpg', 'SEMARNATDistribuidores/1.jpg', 'LicenciaDistribuidores/1.jpg'),
(2, 'Ever', 'Ever', 'Hidalgo #30', '49000', 'Sayula', 'Allende', 'Coahuila', '3212312343', 'Everrodriguez7@gmail.com', 19.703480, -103.462669, 'zzz', 'BUMADistribuidores/2.png', 'SEMARNATDistribuidores/2.jpg', 'LicenciaDistribuidores/2.jpg'),
(3, 'NAG', 'Naylea', 'maclovio', '49300', 'Sayula', 'Sayula', 'Jalisco', '3421096968', 'L19290620@cdguzman.tecnm.mx', 19.870941, -103.588455, 'distribuidor de fertilizantes', 'BUMADistribuidores/3.png', 'SEMARNATDistribuidores/3.png', 'LicenciaDistribuidores/3.jpg'),
(4, 'Teratsu', 'Kuyomi', 'Ocampo#30', '49000', 'Centro', 'Calkiní', 'Campeche', '3411349110', 'Teratsu@gmail.com', 19.713499, -103.484642, 'mmm', 'BUMADistribuidores/4.jpg', 'SEMARNATDistribuidores/4.jpg', 'LicenciaDistribuidores/4.jpg'),
(5, 'Grupo Bimbo', 'Alejandro Justo García', 'Juarez #14', '49000', 'Manzanillo', 'Manzanillo', 'Colima', '3411500725', 'jesus.a.j.g@hotmail.com', 19.114145, -104.332649, 'Mucho Trabajo', 'BUMADistribuidores/5.jpg', 'SEMARNATDistribuidores/5.jpg', 'LicenciaDistribuidores/5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidoresnew`
--

CREATE TABLE `distribuidoresnew` (
  `IdDistribuidor` int(11) NOT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Calle` varchar(50) DEFAULT NULL,
  `Colonia` varchar(40) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Municipio` varchar(40) DEFAULT NULL,
  `LicenciaSanitaria` varchar(40) DEFAULT NULL,
  `ComercializacionSader` varchar(40) DEFAULT NULL,
  `NResponsable` varchar(30) DEFAULT NULL,
  `ApellidoP` varchar(20) DEFAULT NULL,
  `ApellidoM` varchar(20) DEFAULT NULL,
  `Telefono` varchar(14) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `CurpRfc` varchar(20) DEFAULT NULL,
  `Contrasena` varchar(20) DEFAULT NULL,
  `Latitud` float(10,6) DEFAULT NULL,
  `Longitud` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidorvehiculos`
--

CREATE TABLE `distribuidorvehiculos` (
  `Consecutivo` int(11) NOT NULL,
  `IdDistribuidor` int(11) NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TipoVehiculo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Capacidad` float NOT NULL,
  `Marca` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Placa` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SCT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `distribuidorvehiculos`
--

INSERT INTO `distribuidorvehiculos` (`Consecutivo`, `IdDistribuidor`, `Descripcion`, `TipoVehiculo`, `Capacidad`, `Marca`, `Placa`, `SCT`) VALUES
(1, 3, 'Trocona del año', 'Raptor ', 200, 'Ford', '123-nay', 'SCTDistribuidor/13.pdf'),
(2, 1, 'Camion Torton', 'Torton', 500, 'Toyota', '123-piña', 'SCTDistribuidor/21.pdf'),
(3, 3, 'Trailer  rojo de mcqueen', 'Trailer', 1000, 'Ramenautos', '123-trail', 'SCTDistribuidor/33.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresadestino`
--

CREATE TABLE `empresadestino` (
  `IdDestino` int(11) NOT NULL,
  `RazonSocial` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SEMARNAT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `empresadestino`
--

INSERT INTO `empresadestino` (`IdDestino`, `RazonSocial`, `SEMARNAT`, `Domicilio`, `CP`, `Municipio`, `Edo`, `Telefono`, `Correo`, `Latitud`, `Longitud`) VALUES
(1, 'Gorditos y bonitos', 'SEMARNATEmpresaDest/1.jpg', 'Jose rolon #186', '49000', 'Mexicali', 'Baja California', '3411349110', 'GorditosBon@gmail.com', 19.703480, -103.479836);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresarecolectoraprivada`
--

CREATE TABLE `empresarecolectoraprivada` (
  `IdERP` int(11) NOT NULL,
  `Permiso` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `ActividadGiro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SEMARNAT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Responsable` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `empresarecolectoraprivada`
--

INSERT INTO `empresarecolectoraprivada` (`IdERP`, `Permiso`, `Nombre`, `Domicilio`, `Telefono`, `CP`, `Municipio`, `Edo`, `Correo`, `Latitud`, `Longitud`, `ActividadGiro`, `SEMARNAT`, `Responsable`) VALUES
(1, 'PermisosERP/1.png', 'ERP1', 'Colon #281', '3421096968', '49300', 'Zapotlán el Grande', 'Jalisco', 'ERP@gmail.com', 19.708006, -103.537170, 'tranporte peligroso', 'SEMARNATERP/1.png', 'Joaquin Guzman Loera'),
(2, 'PermisosERP/2.jpg', 'ERP2', 'Ocampo #30', '3411349165', '49650', 'Acatlán de Juárez', 'Jalisco', 'ERP2@gmail.com', 19.714470, -103.463356, 'mnmn', 'SEMARNATERP/2.jpg', 'Julio'),
(3, 'PermisosERP/3.png', 'ERP3', 'Manuel Ávila Camacho #100', '3421096968', '49300', 'Calvillo', 'Aguascalientes', 'ERP3@gmail.com', 19.876633, -103.599312, 'una', 'SEMARNATERP/3.png', 'Joaquin Guzman Loera'),
(4, 'PermisosERP/4.pdf', 'Recolector S.A', 'domicilio cualquiera ', '3411234567', '49000', 'Zapotlán el Grande', 'Jalisco', 'sergiojosepina@outlook.com', 19.701864, -103.470566, 'Ninguna', 'SEMARNATERP/4.pdf', 'Jose');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `IdEntrega` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdContenedor` int(11) NOT NULL,
  `ResponsableEntrega` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ResponsableRecepcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Recibo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`IdEntrega`, `IdProductor`, `IdUsuario`, `IdContenedor`, `ResponsableEntrega`, `ResponsableRecepcion`, `Recibo`, `fecha`) VALUES
(1, 1, 4, 3, 'Yo', 'Justo', 'Recibos/re1.pdf', '2023-05-22'),
(2, 2, 8, 5, 'Juli', 'Oscar ', 'Recibos/re2.pdf', '2023-05-22'),
(3, 3, 11, 1, 'Misael', 'Agustin', NULL, '2023-05-22'),
(4, 1, 4, 3, 'Pepe', 'Maria', 'Recibos/re4.pdf', '2023-05-23'),
(5, 1, 4, 3, 'Yo', 'Maria', 'Recibos/re5.pdf', '2023-05-25'),
(6, 2, 4, 3, 'cesar', 'jose', 'Recibos/re6.pdf', '2023-05-26'),
(7, 3, 4, 3, 'Cesar', 'Martin', 'Recibos/re7.pdf', '2023-05-28'),
(8, 1, 4, 3, 'Yo', 'Pancho', 'Recibos/re8.pdf', '2023-06-26'),
(9, 1, 4, 3, 'Jose', 'Julia', 'Recibos/re9.pdf', '2023-06-26'),
(10, 3, 4, 3, 'Julio ', 'Sergio', 'Recibos/re10.pdf', '2023-06-26'),
(11, 1, 4, 3, 'julio', 'sergio', 'Recibos/re11.pdf', '2023-06-26'),
(12, 1, 4, 3, 'ddasd', 'dadsad', 'Recibos/re12.pdf', '2023-06-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erpvehiculos`
--

CREATE TABLE `erpvehiculos` (
  `Consecutivo` int(11) NOT NULL,
  `IdERP` int(11) NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TipoVehiculo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Capacidad` float NOT NULL,
  `Marca` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Placa` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SCT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `erpvehiculos`
--

INSERT INTO `erpvehiculos` (`Consecutivo`, `IdERP`, `Descripcion`, `TipoVehiculo`, `Capacidad`, `Marca`, `Placa`, `SCT`) VALUES
(1, 1, 'Trocona del año', 'Raptor ', 200, 'Ford', '123-nay', 'SCTERP/11.pdf'),
(2, 2, 'Camion Torton', 'Torton', 500, 'Toyota', '123-nay', 'SCTERP/22.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extraviados`
--

CREATE TABLE `extraviados` (
  `IdExtraviados` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL,
  `TipoEnvaseVacio` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CantidadPiezas` int(11) NOT NULL,
  `Aclaracion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `extraviados`
--

INSERT INTO `extraviados` (`IdExtraviados`, `IdProductor`, `TipoEnvaseVacio`, `CantidadPiezas`, `Aclaracion`, `fecha`) VALUES
(1, 1, 'Rígidos lavable', 2, 'se los robaron', '2023-04-29'),
(2, 1, 'Flexible', 8, 'se volaron con el aire', '2023-04-29'),
(3, 1, 'Tapas', 3, 'las aplasto un tractor', '2023-04-29'),
(4, 1, 'Tapas', 20, 'me las robaron', '2023-05-04'),
(5, 2, 'Flexible', 8, 'volaron con el aire', '2023-05-17'),
(6, 2, 'Tapas', 10, 'Rodaron', '2023-05-19'),
(7, 1, 'Rígidos lavable', 150, 'me asaltaron', '2023-05-19'),
(8, 1, 'Rígidos no lavable', 10, 'Me asaltaron ', '2023-05-26'),
(9, 2, 'Rígidos lavable', 23, 'Aclaracion de por que se extraviaron los envases', '2023-05-28'),
(10, 2, 'Rígidos lavable', 4, 'me las robaron otra vez', '2023-06-26'),
(11, 1, 'Rígidos no lavable', 5, 'No se donde quedaron ', '2023-06-26'),
(12, 2, 'Rígidos lavable', 25, 'se cayeron en el camino', '2023-06-26'),
(13, 1, 'Rígidos lavable', 5, 'No se donde quedaron ', '2023-06-26'),
(14, 1, 'Cubetas', 3, 'por olvido en el campo', '2023-07-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huertos`
--

CREATE TABLE `huertos` (
  `IdHuerto` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `HUE` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `huertos`
--

INSERT INTO `huertos` (`IdHuerto`, `IdProductor`, `Latitud`, `Longitud`, `HUE`) VALUES
(1, 1, 19.703804, -103.552963, '1'),
(2, 1, 19.677298, -103.552963, '2'),
(3, 2, 19.666630, -103.438980, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `IdMunicipio` int(11) NOT NULL,
  `NombreLugar` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL,
  `Responsable` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SEMARNAT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`IdMunicipio`, `NombreLugar`, `Domicilio`, `Telefono`, `CP`, `Edo`, `Correo`, `Latitud`, `Longitud`, `Responsable`, `SEMARNAT`) VALUES
(1, 'Sayula', 'Manuel Ávila Camacho #100', '3421096968', '49300', 'Jalisco', 'sayula@gmail.com', 19.878733, -103.599312, 'Naylea', 'SEMARNATMunicipio/1.pdf'),
(2, 'Guzman', 'Colon #281', '3421096968', '49300', 'Jalisco', 'Guzman@gmail.com', 19.702833, -103.461639, 'Naylea', 'SEMARNATMunicipio/2.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipiovehiculos`
--

CREATE TABLE `municipiovehiculos` (
  `Consecutivo` int(11) NOT NULL,
  `IdMunicipio` int(11) NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TipoVehiculo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Capacidad` float NOT NULL,
  `Marca` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Placa` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SCT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `municipiovehiculos`
--

INSERT INTO `municipiovehiculos` (`Consecutivo`, `IdMunicipio`, `Descripcion`, `TipoVehiculo`, `Capacidad`, `Marca`, `Placa`, `SCT`) VALUES
(1, 1, 'troca', 'troca', 200, 'ford', '123-nay', 'SCTMunicipio/1.pdf'),
(2, 2, 'torton', 'camion', 500, 'toyota', '123-piña', 'SEMARNATMunicipio/2.pdf'),
(3, 1, 'troca', 'troca ', 200, 'nissan', '123-jul', 'SEMARNATMunicipio/3.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenproductos`
--

CREATE TABLE `ordenproductos` (
  `IdOrden` int(11) NOT NULL,
  `IdDistribuidor` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL,
  `NumFactura` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Factura` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NumReceta` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Receta` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ordenproductos`
--

INSERT INTO `ordenproductos` (`IdOrden`, `IdDistribuidor`, `IdProductor`, `NumFactura`, `Factura`, `NumReceta`, `Receta`, `Fecha`) VALUES
(1, 1, 1, '1288dhf', 'Facturas/f1.pdf', '12ee', 'Recetas/r1.pdf', '2023-05-18'),
(2, 1, 2, 'FAC002', 'Facturas/f2.png', 'CED002', 'Recetas/r2.png', '2023-05-19'),
(3, 2, 2, 'fac003', 'Facturas/f3.pdf', 'ced003', 'Recetas/r3.pdf', '2023-05-19'),
(4, 1, 2, '3388FHHHE3H', 'Facturas/f4.pdf', '35544TGGW', 'Recetas/r4.pdf', '2023-05-19'),
(5, 2, 1, 'XCA001', 'Facturas/f5.pdf', '0015', 'Recetas/r5.pdf', '2023-05-19'),
(6, 2, 1, '19290620', 'Facturas/f6.png', '19290620', 'Recetas/r6.png', '2023-05-21'),
(7, 2, 1, '19290620', 'Facturas/f7.pdf', '19290620', 'Recetas/r7.pdf', '2023-05-21'),
(8, 2, 3, '19290620', 'Facturas/f8.jpg', '19290620', 'Recetas/r8.jpg', '2023-05-22'),
(9, 1, 1, '1228', 'Facturas/f9.pdf', '', 'Faltante', '2023-05-23'),
(10, 1, 1, '31313', 'Facturas/f10.png', '312314', 'Recetas/r10.png', '2023-05-25'),
(11, 1, 1, '1231', 'Facturas/f11.png', '', 'Faltante', '2023-05-26'),
(12, 1, 2, '221ff4gh', 'Facturas/f12.pdf', '9djjej32', 'Recetas/r12.png', '2023-05-26'),
(13, 2, 1, 'Xs', 'Facturas/f13.png', 'XJKSI', 'Recetas/r13.png', '2023-05-27'),
(14, 1, 3, 'fac0014', 'Facturas/f14.pdf', 'rec0014', 'Recetas/r14.pdf', '2023-05-28'),
(15, 1, 3, 'FAC15', 'Facturas/f15.pdf', 'REC15', 'Recetas/r15.pdf', '2023-06-26'),
(16, 1, 2, '2344KK23223', 'Facturas/f16.pdf', '21eeeqa', 'Faltante', '2023-06-26'),
(17, 1, 3, 'Fac17', 'Facturas/f17.pdf', 'Rec17', 'Recetas/r17.pdf', '2023-06-26'),
(19, 1, 1, '1288dhf', 'Facturas/f18.pdf', '9283UUR3', 'Recetas/r18.pdf', '2023-06-26'),
(20, 1, 2, '3123', 'Facturas/f19.pdf', '1233', 'Recetas/r19.pdf', '2023-06-26'),
(21, 1, 1, 'qdqwd', 'Faltante', 'qwdqwd', 'Faltante', '2023-07-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productores`
--

CREATE TABLE `productores` (
  `IdProductor` int(11) NOT NULL,
  `Nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `RegistroProductor` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Ciudad` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PuntosAcumulados` float NOT NULL,
  `TotalPiezasOrden` int(11) NOT NULL,
  `TotalPiezasEntregadas` int(11) NOT NULL,
  `ActividadGiro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `productores`
--

INSERT INTO `productores` (`IdProductor`, `Nombre`, `RegistroProductor`, `Domicilio`, `CP`, `Ciudad`, `Municipio`, `Edo`, `Telefono`, `Correo`, `PuntosAcumulados`, `TotalPiezasOrden`, `TotalPiezasEntregadas`, `ActividadGiro`) VALUES
(1, 'SAEN', '2023-04-12', 'Zaragoza #30', '49650', 'Tamazula de Gordiano', 'Mexicali', 'Baja California', '5235890298', 'SAEN@gmail.com', 50, 1155, 1138, 'nmnmn'),
(2, 'STAL', '2023-04-19', 'Ocampo #30', '49000', 'Sayula', 'Amacueca', 'Jalisco', '3212312343', 'STAL@gmail.com', 3, 201, 163, 'lmlml'),
(3, 'Alejandro Justo', '2023-05-06', 'Juarez #3', '49000', 'Ciudad Guzmán', 'Zapotlán el Grande', 'Jalisco', '3411500725', 'alejojusgar@gmail.com', 0, 91, 38, 'Opcional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsablecat`
--

CREATE TABLE `responsablecat` (
  `IdCAT` int(11) NOT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Domicilio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CP` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Municipio` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Edo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `responsablecat`
--

INSERT INTO `responsablecat` (`IdCAT`, `Nombre`, `Domicilio`, `CP`, `Municipio`, `Edo`, `Telefono`, `Correo`, `Estado`) VALUES
(1, 'Alejandro', 'Moctezuma #3', '49650', 'Asientos', 'Aguascalientes', '5235890298', 'Justo@gmail.com', 'Activo'),
(2, 'Naylea', 'Hidalgo #30', '49000', 'Calkiní', 'Campeche', '3212312343', 'Naygdz306@gmail.com', 'Activo'),
(3, 'Ever Essau', 'Vesnustiano #113', '49301', 'Sayula', 'Jalisco', '3421103021', 'everrodriguez7@gmail.com', 'Activo'),
(4, 'aaaa', 'aaaaa', '49000', 'Selecciona tu municipio', 'Selecciona tu estado', '1234567891', 'ejemplox@gmail.com', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `IdSalida` int(11) NOT NULL,
  `IdContenedor` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Responsable` varchar(30) DEFAULT NULL,
  `Cantidad` float DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`IdSalida`, `IdContenedor`, `IdUsuario`, `Responsable`, `Cantidad`, `fecha`) VALUES
(1, 5, 8, 'Juli', 20, '2023-05-22'),
(2, 4, 6, 'Nay', 2, '2023-05-22'),
(3, 1, 11, 'nay', 100, '2023-05-10'),
(4, 3, 4, 'Jose', 100, '2023-05-26'),
(6, 3, 4, 'Sergio', 180, '2023-05-29'),
(7, 3, 4, 'Ricardo', 50, '2023-05-29'),
(8, 2, 6, 'Yo', 20, '2023-06-25'),
(9, 1, 6, 'Ever', 50, '2023-06-26'),
(10, 3, 4, 'Julio', 4, '2023-06-26'),
(11, 3, 4, 'Jose', 10, '2023-06-26'),
(12, 3, 4, 'Juan', 6, '2023-06-26'),
(13, 3, 4, 'julio', 15, '2023-06-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontenedor`
--

CREATE TABLE `tipocontenedor` (
  `idTipoCont` int(11) NOT NULL,
  `Concepto` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipocontenedor`
--

INSERT INTO `tipocontenedor` (`idTipoCont`, `Concepto`) VALUES
(1, 'Botes'),
(2, 'Bolsas'),
(3, 'Plásticos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoquimico`
--

CREATE TABLE `tipoquimico` (
  `IdTipoQuimico` int(11) NOT NULL,
  `Concepto` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipoquimico`
--

INSERT INTO `tipoquimico` (`IdTipoQuimico`, `Concepto`) VALUES
(1, 'Plaguicidas'),
(2, 'Fertilizante'),
(3, 'Peligroso'),
(4, 'Muy peligroso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `Idtipousuario` int(11) NOT NULL,
  `Descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`Idtipousuario`, `Descripcion`) VALUES
(1, 'admin'),
(2, 'Productores'),
(3, 'Distribuidores'),
(4, 'Municipios'),
(5, 'Empresa Recolectora'),
(6, 'Empresa Recicladora'),
(7, 'AMOCALI'),
(8, 'ASICA'),
(9, 'CESAVEJAL '),
(10, 'APEAJAL'),
(11, 'CAT'),
(12, 'Agricultor'),
(13, 'CPU'),
(14, 'SSA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Idtipousuario` int(11) DEFAULT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Contrasena` varchar(40) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Idtipousuario`, `Nombre`, `Contrasena`, `Correo`) VALUES
(1, 1, 'Shinon', '3eb2eb646d3a32e64feb2e23c0c7f4af', 'shinon@gmail.com'),
(2, 11, 'Alejandro', 'e5ab00055e1f4cf8b91ab56fcbc43400', 'Justo@gmail.com'),
(3, 11, 'Naylea', '66bb80fbc8e787ff17c628fb1d8d544c', 'Naygdz306@gmail.com'),
(4, 3, 'Sergio', 'e5ab00055e1f4cf8b91ab56fcbc43400', 'usersergiojos3@gmail.com'),
(5, 1, 'Alejo', '0f94ed47ee9b1ee64e399f2d840abb79', 'alejustogar3@gmail.com'),
(6, 3, 'Ever', 'de6ab55cf175c53a3a901ab9f4c52c6d', 'Everrodriguez7@gmail.com'),
(7, 2, 'SAEN', '275c4267c5e6ca76d637aaa19305a1c9', 'SAEN@gmail.com'),
(8, 4, 'Sayula', 'e18e599321ccf1bd457f5b2603c955fb', 'Sayula@gmail.com'),
(11, 5, 'ERP1', '5202bfaff162a71345cc0f3dde1940a4', 'ERP@gmail.com'),
(12, 2, 'STAL', '26058d9e5863a8a9cf206e1204cdf38f', 'STAL@gmail.com'),
(13, 5, 'ERP2', 'e7c4beda56858765ca00f3830dfe31ab', 'ERP2@gmail.com'),
(14, 5, 'ERP3', '953bd7958c0c17edb313a90f0fbef989', 'ERP3@gmail.com'),
(15, 3, 'Teratsu', '896e4eafb440401c9ce2fe86876949f1', 'Teratsu@gmail.com'),
(16, 6, 'Gorditos y bonitos', 'bec4069d850ccf74a1c0340223fde671', 'GorditosBon@gmail.com'),
(17, 11, 'Reciclando Ando', 'b7cf537087093632992be26c2708dfff', 'ReciclandoAndo@gmail.com'),
(18, 11, 'Rici3000', '16ff721ed1453ccf28f131c3213e946d', 'Reci3000@gmail.com'),
(19, 4, 'Muni', '29cf705cdb6d057e1e51697d3d6dc957', 'muni@gmail.com'),
(20, 11, 'CAT Chihuahua', '09a2c68b2510b77b51ca1a11019c74fb', 'CatC@gmail.com'),
(21, 5, 'Recolector S.A', '34d320b6b5094548234d3996ac0bc17b', 'sergiojosepina@outlook.com'),
(22, 5, 'ssadasd', 'b39460fc1b73b776636bfbaa0c504eca', 'ejemplox@gmail.com'),
(23, 5, 'ddqe', 'be4ec911e2591bcbad0f5fd1bbe217be', 'ejemplox@gmail.com'),
(24, 5, 'dad', '81a7aa70b6d988b96802a011b5f80a81', 'ejemplox@gmail.com'),
(26, 5, 'sdad', 'c24bb8af57acd118b78ad51ed1aa7094', 'ejemplox@gmail.com'),
(27, 1, 'Julio Cesar Arriaga Mendoza', 'f688ae26e9cfa3ba6235477831d5122e', 'julio.arriaga2001@gmail.com'),
(28, 11, 'Ever Essau', '7bd342353351f4fa5f47475faeb73300', 'everrodriguez7@gmail.com'),
(29, 2, 'Alejandro Justo', '9ff4d9c66a37b12bda985e5ca785bc40', 'alejojusgar@gmail.com'),
(30, 3, 'Grupo Bimbo', '74135e304c97b770a26fb52901145681', 'jesus.a.j.g@hotmail.com'),
(31, 11, 'aaaa', '03d8a9dc54b4ac7342647d589c7caa88', 'ejemplox@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AgricultorCpuSsa`
--
ALTER TABLE `AgricultorCpuSsa`
  ADD PRIMARY KEY (`idAgriCpuSsa`);

--
-- Indices de la tabla `centroacopiotemporal`
--
ALTER TABLE `centroacopiotemporal`
  ADD PRIMARY KEY (`IdCAT`);

--
-- Indices de la tabla `centroacopiotemporalnew`
--
ALTER TABLE `centroacopiotemporalnew`
  ADD PRIMARY KEY (`IdCAT`);

--
-- Indices de la tabla `contenedores`
--
ALTER TABLE `contenedores`
  ADD PRIMARY KEY (`IdContenedor`);

--
-- Indices de la tabla `detalleentrega`
--
ALTER TABLE `detalleentrega`
  ADD PRIMARY KEY (`IdEntrega`,`Consecutivo`);

--
-- Indices de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD PRIMARY KEY (`IdOrden`,`Consecutivo`);

--
-- Indices de la tabla `distribuidores`
--
ALTER TABLE `distribuidores`
  ADD PRIMARY KEY (`IdDistribuidor`);

--
-- Indices de la tabla `distribuidoresnew`
--
ALTER TABLE `distribuidoresnew`
  ADD PRIMARY KEY (`IdDistribuidor`);

--
-- Indices de la tabla `distribuidorvehiculos`
--
ALTER TABLE `distribuidorvehiculos`
  ADD PRIMARY KEY (`Consecutivo`);

--
-- Indices de la tabla `empresadestino`
--
ALTER TABLE `empresadestino`
  ADD PRIMARY KEY (`IdDestino`);

--
-- Indices de la tabla `empresarecolectoraprivada`
--
ALTER TABLE `empresarecolectoraprivada`
  ADD PRIMARY KEY (`IdERP`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`IdEntrega`);

--
-- Indices de la tabla `erpvehiculos`
--
ALTER TABLE `erpvehiculos`
  ADD PRIMARY KEY (`Consecutivo`);

--
-- Indices de la tabla `extraviados`
--
ALTER TABLE `extraviados`
  ADD PRIMARY KEY (`IdExtraviados`);

--
-- Indices de la tabla `huertos`
--
ALTER TABLE `huertos`
  ADD PRIMARY KEY (`IdHuerto`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`IdMunicipio`);

--
-- Indices de la tabla `municipiovehiculos`
--
ALTER TABLE `municipiovehiculos`
  ADD PRIMARY KEY (`Consecutivo`);

--
-- Indices de la tabla `ordenproductos`
--
ALTER TABLE `ordenproductos`
  ADD PRIMARY KEY (`IdOrden`);

--
-- Indices de la tabla `productores`
--
ALTER TABLE `productores`
  ADD PRIMARY KEY (`IdProductor`);

--
-- Indices de la tabla `responsablecat`
--
ALTER TABLE `responsablecat`
  ADD PRIMARY KEY (`IdCAT`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`IdSalida`);

--
-- Indices de la tabla `tipocontenedor`
--
ALTER TABLE `tipocontenedor`
  ADD PRIMARY KEY (`idTipoCont`);

--
-- Indices de la tabla `tipoquimico`
--
ALTER TABLE `tipoquimico`
  ADD PRIMARY KEY (`IdTipoQuimico`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`Idtipousuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Nombre` (`Nombre`,`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `AgricultorCpuSsa`
--
ALTER TABLE `AgricultorCpuSsa`
  MODIFY `idAgriCpuSsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centroacopiotemporal`
--
ALTER TABLE `centroacopiotemporal`
  MODIFY `IdCAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centroacopiotemporalnew`
--
ALTER TABLE `centroacopiotemporalnew`
  MODIFY `IdCAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contenedores`
--
ALTER TABLE `contenedores`
  MODIFY `IdContenedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `distribuidores`
--
ALTER TABLE `distribuidores`
  MODIFY `IdDistribuidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `distribuidoresnew`
--
ALTER TABLE `distribuidoresnew`
  MODIFY `IdDistribuidor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `distribuidorvehiculos`
--
ALTER TABLE `distribuidorvehiculos`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresadestino`
--
ALTER TABLE `empresadestino`
  MODIFY `IdDestino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresarecolectoraprivada`
--
ALTER TABLE `empresarecolectoraprivada`
  MODIFY `IdERP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `IdEntrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `erpvehiculos`
--
ALTER TABLE `erpvehiculos`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `extraviados`
--
ALTER TABLE `extraviados`
  MODIFY `IdExtraviados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `huertos`
--
ALTER TABLE `huertos`
  MODIFY `IdHuerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `IdMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `municipiovehiculos`
--
ALTER TABLE `municipiovehiculos`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordenproductos`
--
ALTER TABLE `ordenproductos`
  MODIFY `IdOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productores`
--
ALTER TABLE `productores`
  MODIFY `IdProductor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `responsablecat`
--
ALTER TABLE `responsablecat`
  MODIFY `IdCAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `IdSalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipocontenedor`
--
ALTER TABLE `tipocontenedor`
  MODIFY `idTipoCont` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoquimico`
--
ALTER TABLE `tipoquimico`
  MODIFY `IdTipoQuimico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
