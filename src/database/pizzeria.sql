-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 02:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE `ingredientes` (
  `ID_Ingredientes` int(11) NOT NULL,
  `Nombre_Ingrediente` varchar(150) NOT NULL,
  `Cantidad_Inventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes_producto`
--

CREATE TABLE `ingredientes_producto` (
  `ID_Ingredientes_producto` int(11) NOT NULL,
  `ID_Ingrediente` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad_Ingredientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `ID_Inventario` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedidos` int(11) NOT NULL,
  `Nro_Mesa` int(11) NOT NULL,
  `Fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `ID_Tipo_Producto` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `Requiere_Inventario` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registros_pedidos`
--

CREATE TABLE `registros_pedidos` (
  `ID_Registro_Pedido` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad_Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `ID_Tipo_Produto` int(11) NOT NULL,
  `Tipo_Producto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredientes`
--pizzeria
  ADD PRIMARY KEY (`ID_Ingredientes`);

--
-- Indexes for table `ingredientes_producto`
--
ALTER TABLE `ingredientes_producto`
  ADD PRIMARY KEY (`ID_Ingredientes_producto`),
  ADD KEY `ID_Ingrediente` (`ID_Ingrediente`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID_Inventario`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedidos`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Tipo_Producto` (`ID_Tipo_Producto`);

--
-- Indexes for table `registros_pedidos`
--
ALTER TABLE `registros_pedidos`
  ADD PRIMARY KEY (`ID_Registro_Pedido`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Pedido` (`ID_Pedido`);

--
-- Indexes for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`ID_Tipo_Produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID_Ingredientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredientes_producto`
--
ALTER TABLE `ingredientes_producto`
  MODIFY `ID_Ingredientes_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID_Inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registros_pedidos`
--
ALTER TABLE `registros_pedidos`
  MODIFY `ID_Registro_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `ID_Tipo_Produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredientes_producto`
--
ALTER TABLE `ingredientes_producto`
  ADD CONSTRAINT `ingredientes_producto_ibfk_1` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingredientes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredientes_producto_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_Tipo_Producto`) REFERENCES `tipo_producto` (`ID_Tipo_Produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registros_pedidos`
--
ALTER TABLE `registros_pedidos`
  ADD CONSTRAINT `registros_pedidos_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registros_pedidos_ibfk_2` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedidos`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
