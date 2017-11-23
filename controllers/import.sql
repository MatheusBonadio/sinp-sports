-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Nov-2017 às 10:56
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinpsports`

CREATE DATABASE sinpsports;
USE sinpsports;
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(70) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `id_torneio`, `login`, `senha`, `email`, `nome`, `cargo`) VALUES
(5, 1, 'fon', '123', 'matheus.bonadio@etec.sp.gov.br  ', 'Bacana', 'Representante'),
(4, 1, 'Bonadio ', 'trab ', 'matheus.bonadio@etec.sp.gov.br    ', 'Matheus Lima Bonadio', 'Gerente'),
(6, 1, 'trab', 'xie4vuhx', 'matheus.bonadio@etec.sp.gov.br', 'bandeirantes', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaque`
--

CREATE TABLE `destaque` (
  `id_destaque` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `texto` varchar(100) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `destaque`
--

INSERT INTO `destaque` (`id_destaque`, `id_torneio`, `id_partida`, `texto`, `imagem`) VALUES
(1, 1, 1, 'Crudzão gostoso', 'c20ab209df1d3c9fc5b6f9be0ed177c1810890dc.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sigla` varchar(6) NOT NULL,
  `vitorias` int(11) DEFAULT '0',
  `empates` int(11) DEFAULT '0',
  `derrotas` int(11) DEFAULT '0',
  `pontos` int(11) DEFAULT '0',
  `representante` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `id_torneio`, `nome`, `sigla`, `vitorias`, `empates`, `derrotas`, `pontos`) VALUES
(1, 1, '1º Administração', '1° ADM', 0, 0, 0, 0),
(2, 2, '1° Informática', '1° INF', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `esporte`
--

CREATE TABLE `esporte` (
  `id_esporte` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `esporte` varchar(30) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `qtd_jogadores` int(11) NOT NULL,
  `qtd_times` int(11) NOT NULL,
  `classificacao` varchar(20) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `esporte`
--

INSERT INTO `esporte` (`id_esporte`, `id_torneio`, `esporte`, `genero`, `tipo`, `qtd_jogadores`, `qtd_times`, `classificacao`, `imagem`) VALUES
(1, 1, 'League of Legends ', 'Ambos', 'Eletrônico', 1, 1, 'Chave', '79e02a9dd9acce74a8e325a9ee25e407b61c7582.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase`
--

CREATE TABLE `fase` (
  `id_fase` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `fase_descricao` varchar(40) DEFAULT NULL,
  `fase_indice` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fase`
--

INSERT INTO `fase` (`id_fase`, `id_torneio`, `fase_descricao`, `fase_indice`) VALUES
(1, 1, 'quartas', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `participacao_esporte`
--

CREATE TABLE `participacao_esporte` (
  `id_participante` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `nome` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_equipe_a` int(11) NOT NULL,
  `id_equipe_b` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `dia` date NOT NULL,
  `inicio` varchar(15) DEFAULT NULL,
  `termino` varchar(15) DEFAULT NULL,
  `placar_equipe_a` int(11) DEFAULT '0',
  `placar_equipe_b` int(11) DEFAULT '0',
  `vencedor` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `partida`
--

INSERT INTO `partida` (`id_partida`, `id_torneio`, `id_equipe_a`, `id_equipe_b`, `id_esporte`, `id_fase`, `dia`, `inicio`, `termino`, `placar_equipe_a`, `placar_equipe_b`, `vencedor`) VALUES
(1, 1, 1, 2, 1, 1, '2017-11-17', '08:00', '08:01', 2, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida_log`
--

CREATE TABLE `partida_log` (
  `id_log` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `inicio` varchar(15) DEFAULT NULL,
  `termino` varchar(15) DEFAULT NULL,
  `placar_equipe_a` int(11) DEFAULT NULL,
  `placar_equipe_b` int(11) DEFAULT NULL,
  `vencedor` int(11) DEFAULT NULL,
  `dataUpdate` datetime DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `login` varchar(20) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`login`, `id_torneio`, `id_esporte`) VALUES
('Bonadio ', 1, 1),
('trab', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `torneio`
--

CREATE TABLE `torneio` (
  `id_torneio` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `inicio` date NOT NULL,
  `termino` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `torneio`
--

INSERT INTO `torneio` (`id_torneio`, `descricao`, `inicio`, `termino`) VALUES
(1, 'Torneio de verão Etec', '2017-12-04', '2017-12-08'),
(2, 'Torneio alternativo', '2017-11-17', '2017-11-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`),
  ADD KEY `id_torneio` (`id_torneio`);

--
-- Indexes for table `destaque`
--
ALTER TABLE `destaque`
  ADD PRIMARY KEY (`id_destaque`),
  ADD KEY `id_partida` (`id_partida`);

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`);

--
-- Indexes for table `esporte`
--
ALTER TABLE `esporte`
  ADD PRIMARY KEY (`id_esporte`);

--
-- Indexes for table `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`id_fase`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`);

--
-- Indexes for table `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id_partida`),
  ADD KEY `id_esporte` (`id_esporte`),
  ADD KEY `id_equipe_a` (`id_equipe_a`),
  ADD KEY `id_equipe_b` (`id_equipe_b`),
  ADD KEY `id_fase` (`id_fase`),
  ADD KEY `id_torneio` (`id_torneio`);

--
-- Indexes for table `partida_log`
--
ALTER TABLE `partida_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_partida` (`id_partida`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD KEY `login` (`login`),
  ADD KEY `id_esporte` (`id_esporte`);

--
-- Indexes for table `torneio`
--
ALTER TABLE `torneio`
  ADD PRIMARY KEY (`id_torneio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id_destaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `esporte`
--
ALTER TABLE `esporte`
  MODIFY `id_esporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id_fase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `partida_log`
--
ALTER TABLE `partida_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `torneio`
--
ALTER TABLE `torneio`
  MODIFY `id_torneio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
