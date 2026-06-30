-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Jun-2026 às 19:50
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lista_compras`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ano` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`id`, `mes`, `item`, `data_cadastro`, `ano`, `status`) VALUES
(4, 'Julho', '10 dentes de alho', '2026-06-30 13:08:34', 2026, 'pendente'),
(5, 'Julho', '10 dentes de alho', '2026-06-30 13:08:36', 2026, 'pendente'),
(6, 'Julho', '10 dentes de alho', '2026-06-30 13:08:38', 2026, 'pendente'),
(7, 'Janeiro', '10 dentes de alho', '2026-06-30 13:12:53', 2024, 'pendente'),
(8, 'Janeiro', '10 dentes de alho', '2026-06-30 13:12:55', 2024, 'pendente'),
(9, 'Janeiro', '10 dentes de alho', '2026-06-30 13:12:58', 2024, 'pendente'),
(10, 'Janeiro', '10 dentes de alho', '2026-06-30 13:13:00', 2024, 'pendente'),
(12, 'Janeiro', '10 dentes de alho', '2026-06-30 13:47:56', 2026, 'pendente'),
(13, 'Janeiro', '10 dentes de alho', '2026-06-30 13:48:04', 2026, 'carrinho'),
(14, 'Janeiro', '10 dentes de alho', '2026-06-30 13:49:01', 2026, 'carrinho');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
