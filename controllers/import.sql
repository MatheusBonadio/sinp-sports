-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Nov-2017 às 11:12
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
(1, 1, 'Bonadio', 'ww50hgbi', 'matheus_lima_bonadio_xd@hotmail.com', 'Matheus Lima', 'Gerente'),
(5, 1, 'fon', '222', 'matheus.bonadio@etec.sp.gov.br  ', 'Bacana', 'Representante'),
(4, 1, 'Bonadio ', 'trab ', 'matheus.bonadio@etec.sp.gov.br    ', 'Matheus Lima Bonadio', 'Gerente'),
(6, 1, 'trab   ', '333', 'matheus.bonadio@etec.sp.gov.br   ', 'bandeirantes   ', 'Administrador');

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
(1, 1, 1, 'Esse é o pique, hackearam meu email', '5af478e47ea90a88e60bae412c8c2ea966711ea5.jpg'),
(2, 1, 2, 'Hackearam meu site', '902a7849178f52b44ea53d9fd415b822c9dc2ac8.jpg');

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
  `representante` varchar(20) NOT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `id_torneio`, `nome`, `sigla`, `vitorias`, `empates`, `derrotas`, `pontos`, `representante`, `logo`) VALUES
(1, 1, 'Fox Hot', 'FH', 0, 0, 0, 0, 'fon', '301dbfd8999c69155eadeaca0f8480559618dde9.png'),
(2, 1, 'Gladiators', 'GT', 0, 0, 0, 0, 'fon', '57a34ab1e170b2e6acc7d792b9811b27e5b76e48.png'),
(3, 1, 'Musketeers', 'MSKT', 0, 0, 0, 0, 'fon', '0567d5c87d6769febad73d5017f4b65017dec022.png');

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
  `classificacao` varchar(20) NOT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  `qtd_times` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `esporte`
--

INSERT INTO `esporte` (`id_esporte`, `id_torneio`, `esporte`, `genero`, `tipo`, `qtd_jogadores`, `classificacao`, `imagem`, `qtd_times`) VALUES
(1, 1, 'League of Legends  ', 'Ambos', 'Eletrônico', 1, 'Chave', '077474dcd0691e40ce5d4015288de1bd0cb168a8.jpg', 2),
(2, 1, 'Xadrez ', 'Ambos', 'Tabuleiro', 1, 'Chave', '5f4fccd5f3ac34e389fc8e8a690b15f82d2753ba.jpg', 2);

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
(1, 1, 'final', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `participacao_esporte`
--

CREATE TABLE `participacao_esporte` (
  `id_participante` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `participacao_esporte`
--

INSERT INTO `participacao_esporte` (`id_participante`, `id_esporte`) VALUES
(1, 2),
(2, 1),
(1, 1),
(2, 2),
(5, 2),
(4, 1),
(5, 1),
(3, 1);

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

--
-- Extraindo dados da tabela `participante`
--

INSERT INTO `participante` (`id_participante`, `id_torneio`, `id_equipe`, `nome`) VALUES
(1, 1, 1, 'Bertao'),
(2, 1, 1, 'Lima'),
(3, 1, 1, 'Piga'),
(4, 1, 2, 'Fon'),
(5, 1, 2, 'Matheus Bonadio');

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
(1, 1, 2, 1, 2, 1, '2017-11-26', '08:39', NULL, 0, 0, NULL),
(2, 1, 1, 2, 1, 1, '2017-11-23', '09:37', '9:50', 2, 3, 1),
(4, 1, 3, 2, 2, 1, '2017-11-23', '22:03', NULL, 0, 0, NULL);

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
('trab   ', 1, 1);

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
(1, 'Torneio de verão', '2017-11-20', '2017-11-30'),
(2, 'Interclasse', '2017-11-04', '2017-11-08');

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
-- Indexes for table `participacao_esporte`
--
ALTER TABLE `participacao_esporte`
  ADD KEY `id_participante` (`id_participante`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`),
  ADD KEY `id_equipe` (`id_equipe`);

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
  MODIFY `id_destaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `esporte`
--
ALTER TABLE `esporte`
  MODIFY `id_esporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id_fase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
