-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Dez-2022 às 02:39
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `testbluepex`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(150) NOT NULL,
  `model_computer` varchar(150) DEFAULT NULL,
  `processor` varchar(150) NOT NULL,
  `ram_memory` varchar(150) NOT NULL,
  `storage_computer` varchar(150) NOT NULL,
  `storage_type` varchar(150) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `date_inventory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `inventory`
--

INSERT INTO `inventory` (`id`, `brand_name`, `model_computer`, `processor`, `ram_memory`, `storage_computer`, `storage_type`, `amount`, `date_inventory`) VALUES
(2, 'Acer', 'Nitro 5', 'Intel i5', '16GB', '250GB', 'SSD', 4, '11/12/2022'),
(3, 'Dell', 'Inspiron', 'Intel i5', '8GB', '250GB', 'SSD', 2, '12/12/2022'),
(4, 'Dell', 'G5', 'Intel i5', '8GB', '250GB', 'SSD', 1, '12/12/2022');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
