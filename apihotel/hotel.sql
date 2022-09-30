-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Set-2022 às 01:06
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `logradouro` varchar(200) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `email`, `cep`, `estado`, `cidade`, `bairro`, `logradouro`, `numero`) VALUES
(1, 'José', 'jose@email.com', '18270000', 'SP', 'Tatuí', 'Centro', 'Rua 11 de agosto', '100'),
(2, 'Maria', 'maria@email.com', '18270010', 'SP', 'Tatuí', 'Centro', 'Rua 11 de Agosto', '200'),
(3, 'Paulo', 'paulo@email.com', '18270020', 'SP', 'Tatuí', 'Centro', 'Praça Adelaide Guedes', '01'),
(4, 'Julia', 'julia@email.com', '18270000', 'SP', 'Tatuí', 'Centro', 'Rua 11 de Agosto', '300');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quarto`
--

DROP TABLE IF EXISTS `quarto`;
CREATE TABLE IF NOT EXISTS `quarto` (
  `idquarto` int NOT NULL AUTO_INCREMENT,
  `andar` varchar(50) NOT NULL,
  `numeroquarto` int NOT NULL,
  `diaria` float NOT NULL,
  `alugado` bit(1) NOT NULL,
  PRIMARY KEY (`idquarto`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `quarto`
--

INSERT INTO `quarto` (`idquarto`, `andar`, `numeroquarto`, `diaria`, `alugado`) VALUES
(1, '1º andar', 101, 200, b'0'),
(2, '1º andar', 102, 200, b'0'),
(3, '1º andar', 103, 200, b'0'),
(4, '1º andar', 104, 200, b'0'),
(5, '2º andar', 201, 300, b'0'),
(6, '2º andar', 202, 300, b'0'),
(7, '2º andar', 203, 300, b'0'),
(8, '2º andar', 204, 300, b'0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `idreserva` int NOT NULL AUTO_INCREMENT,
  `idquarto` int NOT NULL,
  `idcliente` int NOT NULL,
  `dataentrada` date NOT NULL,
  `datasaida` date NOT NULL,
  `valor` float NOT NULL,
  `pago` bit(1) NOT NULL,
  PRIMARY KEY (`idreserva`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
