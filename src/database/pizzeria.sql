-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 07:36 PM
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
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `ID_Historial` int(11) NOT NULL,
  `ID_Tipo_Movimiento` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `ID_Ingrediente` int(11) DEFAULT NULL,
  `Nombre_Producto_Insumo` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`ID_Historial`, `ID_Tipo_Movimiento`, `ID_Producto`, `ID_Ingrediente`, `Nombre_Producto_Insumo`, `Fecha`, `Descripcion`) VALUES
(1, 1, 6, NULL, 'Frescolita de lata 350ml', '2024-06-23 13:11:52', 'Se han añadido 20 unidades de Frescolita de lata 350ml al inventario con un precio de 1.25.'),
(2, 1, 7, NULL, 'Agua Minalba 500ml', '2024-06-23 13:17:23', 'Se han añadido 100 unidades de Agua Minalba 500ml al inventario con un precio de 1.20.');

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE `ingredientes` (
  `ID_Ingrediente` int(11) NOT NULL,
  `Nombre_Ingrediente` varchar(150) NOT NULL,
  `Cantidad_Inventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredientes`
--

INSERT INTO `ingredientes` (`ID_Ingrediente`, `Nombre_Ingrediente`, `Cantidad_Inventario`) VALUES
(9, 'tomate', 25000),
(10, 'Queso mozzarella', 50000);

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
  `Cantidad` int(11) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`ID_Inventario`, `ID_Producto`, `Cantidad`, `Precio`) VALUES
(1, 1, 150, 1.5),
(2, 2, 50, 1),
(3, 3, 25, 1.25),
(4, 4, 60, 1.5),
(5, 5, 10, 2.35),
(6, 6, 20, 1.25),
(7, 7, 100, 1.2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inventario_ingredientes`
-- (See below for the actual view)
--
CREATE TABLE `inventario_ingredientes` (
`Nombre` varchar(150)
,`Cantidad` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inventario_productos`
-- (See below for the actual view)
--
CREATE TABLE `inventario_productos` (
`Nombre` varchar(250)
,`Cantidad` int(11)
,`Precio` double
);

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

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID_Producto`, `ID_Tipo_Producto`, `Nombre`, `Requiere_Inventario`) VALUES
(1, 2, 'Cerveza', 1),
(2, 2, 'Malta de lata 350ml', 1),
(3, 2, 'Cocacola Light de lata', 1),
(4, 2, '7up de lata', 1),
(5, 2, 'Cafe expresso taza 150ml', 1),
(6, 2, 'Frescolita de lata 350ml', 1),
(7, 2, 'Agua Minalba 500ml', 1);

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
-- Table structure for table `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `ID_Tipo_Movimiento` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`ID_Tipo_Movimiento`, `Descripcion`) VALUES
(1, 'Añadir');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `ID_Tipo_Produto` int(11) NOT NULL,
  `Tipo_Producto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_producto`
--

INSERT INTO `tipo_producto` (`ID_Tipo_Produto`, `Tipo_Producto`) VALUES
(1, 'Ingrediente'),
(2, 'Bebida'),
(3, 'Comida'),
(4, 'Postre');

-- --------------------------------------------------------

--
-- Structure for view `inventario_ingredientes`
--
DROP TABLE IF EXISTS `inventario_ingredientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inventario_ingredientes`  AS SELECT `i`.`Nombre_Ingrediente` AS `Nombre`, `i`.`Cantidad_Inventario` AS `Cantidad` FROM `ingredientes` AS `i` ;

-- --------------------------------------------------------

--
-- Structure for view `inventario_productos`
--
DROP TABLE IF EXISTS `inventario_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inventario_productos`  AS SELECT `p`.`Nombre` AS `Nombre`, `i`.`Cantidad` AS `Cantidad`, `i`.`Precio` AS `Precio` FROM ((`productos` `p` join `tipo_producto` `tp` on(`p`.`ID_Tipo_Producto` = `tp`.`ID_Tipo_Produto`)) join `inventario` `i` on(`p`.`ID_Producto` = `i`.`ID_Producto`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`ID_Historial`),
  ADD KEY `historial_ibfk_1` (`ID_Tipo_Movimiento`),
  ADD KEY `historial_ibfk_2` (`ID_Producto`),
  ADD KEY `historial_ibfk_3` (`ID_Ingrediente`);

--
-- Indexes for table `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`ID_Ingrediente`);

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
-- Indexes for table `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`ID_Tipo_Movimiento`);

--
-- Indexes for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`ID_Tipo_Produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `ID_Historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID_Ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredientes_producto`
--
ALTER TABLE `ingredientes_producto`
  MODIFY `ID_Ingredientes_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID_Inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registros_pedidos`
--
ALTER TABLE `registros_pedidos`
  MODIFY `ID_Registro_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `ID_Tipo_Movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `ID_Tipo_Produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`ID_Tipo_Movimiento`) REFERENCES `tipo_movimiento` (`ID_Tipo_Movimiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredientes_producto`
--
ALTER TABLE `ingredientes_producto`
  ADD CONSTRAINT `ingredientes_producto_ibfk_1` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE,
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
