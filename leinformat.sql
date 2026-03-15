-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2026 at 01:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leinformat`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_cat`) VALUES
(7, 'Comidas'),
(8, 'Bebidas'),
(9, 'Postres');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_gastos`
--

CREATE TABLE `categoria_gastos` (
  `id_cat_gasto` int(11) NOT NULL,
  `nombre_cat_gasto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria_gastos`
--

INSERT INTO `categoria_gastos` (`id_cat_gasto`, `nombre_cat_gasto`) VALUES
(1, 'Arrendamiento y Alquileres'),
(2, 'Reparación y mantenimientos'),
(3, 'Transportes'),
(4, 'Publicad y propaganda'),
(5, 'Sueldos y salarios'),
(6, 'Otros gastos Financieros');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(250) NOT NULL,
  `nit_cliente` varchar(250) NOT NULL,
  `tel_cliente` varchar(250) NOT NULL,
  `email_cliente` varchar(250) NOT NULL,
  `dir_cliente` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `nit_cliente`, `tel_cliente`, `email_cliente`, `dir_cliente`) VALUES
(0, 'Consumidor Final', '222222222222', '0000', 'correo@com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `datos_empresa`
--

CREATE TABLE `datos_empresa` (
  `nit_empresa` varchar(100) NOT NULL,
  `nombre_empresa` varchar(300) NOT NULL,
  `direccion_empresa` varchar(300) NOT NULL,
  `telefono_empresa` varchar(300) NOT NULL,
  `email_empresa` varchar(300) NOT NULL,
  `descripcion_empresa` varchar(300) NOT NULL,
  `logo_empresa` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datos_empresa`
--

INSERT INTO `datos_empresa` (`nit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `email_empresa`, `descripcion_empresa`, `logo_empresa`) VALUES
('000000', 'Sabrositos Burguer', 'Manzana 2 casa 6 Barrio Bateas', '313 2156887', 'sabrositosburguer@gmail.com', 'Descripcion', 'logo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE `gastos` (
  `id_gasto` int(11) NOT NULL,
  `id_tipo_gasto` int(11) NOT NULL,
  `fecha_gasto` date NOT NULL,
  `monto_gasto` decimal(10,0) NOT NULL,
  `descripcion_gasto` text NOT NULL,
  `estado_gasto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ing_productos`
--

CREATE TABLE `ing_productos` (
  `id_ingfac` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `plazo` date NOT NULL,
  `forma_pago` varchar(300) NOT NULL,
  `estado` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `ing_productos`
--
DELIMITER $$
CREATE TRIGGER `INGRESOPRODUCTO_AU` AFTER INSERT ON `ing_productos` FOR EACH ROW UPDATE productos SET cantidad = cantidad + NEW.cantidad , precio_compra = NEW.precio WHERE id_producto = NEW.id_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ing_productos_temp`
--

CREATE TABLE `ing_productos_temp` (
  `id_ingfac` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_proveedor` int(250) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `plazo` date NOT NULL,
  `forma_pago` varchar(300) NOT NULL,
  `estado` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `status` enum('open','paid','cancelled') DEFAULT 'open',
  `subtotal` decimal(10,2) DEFAULT 0.00,
  `tax` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) DEFAULT 0.00,
  `payment_method` enum('cash','card','nequi','other') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `closed_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `cod_producto` varchar(100) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unid` decimal(10,0) NOT NULL,
  `precio_compra` decimal(10,0) NOT NULL,
  `iva_producto` decimal(10,0) NOT NULL,
  `estado_producto` tinyint(1) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `cod_producto`, `nombre_producto`, `id_categoria`, `cantidad`, `precio_unid`, `precio_compra`, `iva_producto`, `estado_producto`, `img`) VALUES
(1384, '123465', 'Hamburguesa Especial de Pollo', 7, 12186, '26000', '20000', '0', 1, 'uploads/products/1768106410_hamburguer.png'),
(1385, '5634', 'Hamburguesa de Carne', 7, 12210, '28000', '20000', '0', 1, 'uploads/products/1768106401_hamburguer.png'),
(1386, '4353', 'Papas Fritas Pequeña', 7, 12166, '8000', '20000', '0', 1, 'uploads/products/1768106389_papas.png'),
(1387, '0908', 'Perro Caliente Especial', 7, 12228, '18000', '20000', '0', 1, 'uploads/products/1768106379_perros.png'),
(1388, '3466', 'Perro Caliente Carne', 7, 12204, '20000', '20000', '0', 1, 'uploads/products/1768106363_perros.png'),
(1389, '076876', 'Jugo de Naranja', 8, 12162, '12000', '20000', '0', 1, 'uploads/products/1768106421_Bebidas.png'),
(1390, '5665', 'Cocacola 250ml', 8, 12158, '4500', '20000', '0', 1, 'uploads/products/1768242810_width1960.png'),
(1391, '324', 'Agua 500ml', 8, 12185, '6000', '20000', '0', 1, 'uploads/products/1768244273_01HSKMDDE4DKB9ECK3F7MRNB0G.png'),
(1392, '45654', 'Torta de Chocolate', 9, 12221, '13500', '20000', '0', 1, 'uploads/products/1768244215_r0o8msm3ecpvqsvhve3l.png'),
(1393, '7890', 'Arroz con leche', 9, 12138, '7000', '20000', '0', 1, 'uploads/products/1768244084_download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(250) NOT NULL,
  `nit_proveedor` varchar(250) NOT NULL,
  `tel_proveedor` varchar(250) NOT NULL,
  `email_proveedor` varchar(250) NOT NULL,
  `dir_proveedor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `nit_proveedor`, `tel_proveedor`, `email_proveedor`, `dir_proveedor`) VALUES
(3, 'Provvee', '2343', '432432', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(0, 'administrador'),
(1, 'Cajero');

-- --------------------------------------------------------

--
-- Table structure for table `salida_productos`
--

CREATE TABLE `salida_productos` (
  `id_salida` int(11) NOT NULL,
  `numero_fact` int(11) NOT NULL,
  `nombre_fact` text NOT NULL,
  `fecha_salida` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `desc_product` int(11) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `salida_productos`
--
DELIMITER $$
CREATE TRIGGER `SALIDAPRODUCTO_AU` AFTER INSERT ON `salida_productos` FOR EACH ROW UPDATE productos SET cantidad = cantidad - NEW.cantidad WHERE id_producto = NEW.id_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salida_productos_temp`
--

CREATE TABLE `salida_productos_temp` (
  `id_salida` int(11) NOT NULL,
  `numero_fact` int(11) NOT NULL,
  `nombre_fact` text NOT NULL,
  `fecha_salida` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `desc_product` int(11) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `is_free` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `is_free`, `state`, `description`) VALUES
(0, 'Barra', 0, 1, ''),
(1, 'Mesa 1', 1, 1, 'Mesa'),
(2, 'Mesa 2', 1, 1, 'Test'),
(3, 'Mesa 3', 1, 1, 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nick` varchar(200) NOT NULL,
  `nombre_usu` varchar(250) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `password` varchar(250) NOT NULL,
  `foto_usu` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sid` int(11) NOT NULL,
  `telefono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nick`, `nombre_usu`, `id_rol`, `password`, `foto_usu`, `email`, `sid`, `telefono`) VALUES
(1, 'admin', 'Admin', 0, '123', 'user.png', 'admin@gmail.com', 3782, '000'),
(2, 'caja1', 'caja1', 1, '123', 'user.png', 'caja1@gmail.com', 7636, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `categoria_gastos`
--
ALTER TABLE `categoria_gastos`
  ADD PRIMARY KEY (`id_cat_gasto`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `datos_empresa`
--
ALTER TABLE `datos_empresa`
  ADD PRIMARY KEY (`nit_empresa`);

--
-- Indexes for table `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `id_tipo_gasto` (`id_tipo_gasto`);

--
-- Indexes for table `ing_productos`
--
ALTER TABLE `ing_productos`
  ADD PRIMARY KEY (`id_ingfac`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indexes for table `ing_productos_temp`
--
ALTER TABLE `ing_productos_temp`
  ADD PRIMARY KEY (`id_ingfac`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `salida_productos`
--
ALTER TABLE `salida_productos`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `salida_productos_temp`
--
ALTER TABLE `salida_productos_temp`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categoria_gastos`
--
ALTER TABLE `categoria_gastos`
  MODIFY `id_cat_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ing_productos`
--
ALTER TABLE `ing_productos`
  MODIFY `id_ingfac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ing_productos_temp`
--
ALTER TABLE `ing_productos_temp`
  MODIFY `id_ingfac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1411;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salida_productos`
--
ALTER TABLE `salida_productos`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salida_productos_temp`
--
ALTER TABLE `salida_productos_temp`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
