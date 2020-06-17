-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jun-2020 às 01:14
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dela-rifa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `raffles`
--

CREATE TABLE `raffles` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `participantsQuantity` int(11) NOT NULL,
  `unitaryValue` float NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `raffles`
--

INSERT INTO `raffles` (`id`, `productName`, `description`, `participantsQuantity`, `unitaryValue`, `picture`, `created_by`, `updated`, `created`) VALUES
(8, 'Caceta e planeta', 'cacetada', 12, 7, './assets/productsImg/95432294672be6484fde79852aa5cab5.png', 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Carro', 'carro da gol', 40, 8, './assets/productsImg/3be167b0d5db62cb44c87e83b6b8f1d5.png', 21, '2020-06-14 16:06:39', '2020-06-14 16:06:39'),
(12, 'Teste', 'goleta brabo', 26, 9, './assets/productsImg/8c9b7e249f4efd321921078a391ce5c9.png', 21, '2020-06-17 00:37:10', '2020-06-17 00:37:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `raffles_buy`
--

CREATE TABLE `raffles_buy` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantityRaffles` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `raffles_draw`
--

CREATE TABLE `raffles_draw` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `raffle_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `raffles_draw`
--

INSERT INTO `raffles_draw` (`id`, `product_id`, `raffle_number`, `user_id`, `created`) VALUES
(1, 8, 5, 21, '2020-06-17 01:43:42'),
(2, 8, 10, 21, '2020-06-17 01:43:42'),
(3, 8, 11, 21, '2020-06-17 01:43:42'),
(4, 8, 12, 21, '2020-06-17 01:43:42'),
(5, 8, 5, 21, '2020-06-17 01:45:34'),
(6, 8, 10, 21, '2020-06-17 01:45:34'),
(7, 8, 11, 21, '2020-06-17 01:45:34'),
(8, 8, 12, 21, '2020-06-17 01:45:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `postalCode` varchar(8) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `maritalStatus` int(11) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birthDate` varchar(10) DEFAULT NULL,
  `homePhone` varchar(20) DEFAULT NULL,
  `cellPhone` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `neighborhood` varchar(100) DEFAULT NULL,
  `state` varchar(80) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `category_id` int(1) NOT NULL DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `postalCode`, `number`, `email`, `maritalStatus`, `gender`, `birthDate`, `homePhone`, `cellPhone`, `street`, `neighborhood`, `state`, `city`, `country`, `password`, `category_id`) VALUES
(20, 'Manoel Merlin', '02832250', 143, 'manoel.neto@samplemed.com.br', 1, 1, '1999-11-24', '11958401353', '11958401353', 'Rua Francesco Granacci', 'Parque SÃ£o LuÃ­s', 'Sp', 'Sp', 'Brasil', '$2a$08$MTE1ODEyMTUzMTVlZGUzM.Nt/oal0Z01gK1a8XfrY.JGd2VGal3bm', 4),
(21, 'Manoel Merlin', '02832250', 143, 'manoelmerlin@hotmail.com', 1, 1, '1999-11-24', '11958401353', '11958401353', 'Rua Francesco Granacci', 'Parque SÃ£o LuÃ­s', 'Sp', 'Sp', 'Brasil', '$2a$08$MTQ5OTA5MzY2NzVlZGUzMuBxhI9xM6aHx45X8QTDi5yDvmErz1GrC', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `raffles`
--
ALTER TABLE `raffles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `raffles_buy`
--
ALTER TABLE `raffles_buy`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `raffles_draw`
--
ALTER TABLE `raffles_draw`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `raffles`
--
ALTER TABLE `raffles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `raffles_buy`
--
ALTER TABLE `raffles_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `raffles_draw`
--
ALTER TABLE `raffles_draw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
