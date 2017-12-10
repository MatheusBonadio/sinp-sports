-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2017 at 07:09 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3206094_sinpsports1`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
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
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`id_adm`, `id_torneio`, `login`, `senha`, `email`, `nome`, `cargo`) VALUES
(4, 1, 'Bonadio      ', '5cbc93d5a9bb424ce5ec387b67b8a27a', 'matheus.bonadio@etec.sp.gov.br', 'Matheus Lima Bonadio', 'Gerente'),
(9, 2, 'Haru ', '123', 'urhweuhr ', 'Marcello', 'Gerente'),
(10, 2, 'Fase ', '123', 'weqwe ', '123 ', 'Administrador'),
(11, 2, 'Chave ', '123', 'qweqwr ', '123 ', 'Administrador'),
(17, 1, 'trab', '7363a0d0604902af7b70b271a0b96480', 'matheus_lima@hotmail.comm', 'Beliver', 'Representante'),
(18, 1, 'Bertao', '202cb962ac59075b964b07152d234b70', 'marcellolucasbertao@gmail.com', 'Bertão', 'Administrador'),
(19, 1, 'Marcello', '202cb962ac59075b964b07152d234b70', 'marcellolucasbertao@gmail.com', 'Marcello', 'Administrador'),
(20, 1, 'Lucas', '202cb962ac59075b964b07152d234b70', 'marcello.bertao@hotmail.com', 'Lucas', 'Representante'),
(29, 4, 'lima', '3c3ae972dadeb76923fb71ce9f39fd5c', 'matheus_lima_bonadio_xd@hotmail.com', 'Lima', 'Representante'),
(22, 1, 'Cowboys', '5e8a802a2e80d890172799d0dd340e9e', 'cowboys', 'Cowboys', 'Representante'),
(23, 1, 'Foxes', '202cb962ac59075b964b07152d234b70', 'foxes', 'Foxes', 'Representante'),
(24, 1, 'Gladiators', '202cb962ac59075b964b07152d234b70', 'gladiators', 'Gladiators', 'Representante'),
(25, 1, 'Musketeers', '202cb962ac59075b964b07152d234b70', 'musketeers', 'Musketeers', 'Representante'),
(26, 1, 'Santos', '202cb962ac59075b964b07152d234b70', 'santos', 'Santos', 'Representante'),
(27, 2, 'Royale', '202cb962ac59075b964b07152d234b70', 'Royale', 'Royale', 'Representante'),
(28, 2, 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'admin', 'Administrador'),
(30, 4, 'Resende', '2a65a8b5f3bb1ac4697777713070eeec', 'barbhara.oliveira@etec.sp.gov.br', 'Barbhara Resende', 'Representante'),
(31, 4, 'larii_nakaa', '7825b386e918fbdcf51d91433f8293ec', 'lala2008br@hotmail.com', 'Larissa Nakamura', 'Representante');

-- --------------------------------------------------------

--
-- Table structure for table `classificacao`
--

CREATE TABLE `classificacao` (
  `id_classificacao` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL,
  `pontuacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classificacao`
--

INSERT INTO `classificacao` (`id_classificacao`, `id_torneio`, `id_equipe`, `id_esporte`, `pontuacao`) VALUES
(1, 1, 1, 3, 0),
(2, 1, 2, 3, 0),
(3, 1, 3, 3, 0),
(4, 1, 4, 3, 0),
(5, 1, 5, 3, 0),
(6, 1, 6, 3, 0),
(35, 4, 17, 15, 0),
(34, 4, 16, 16, 0),
(36, 4, 17, 16, 0),
(37, 4, 18, 15, 0),
(38, 4, 18, 16, 0),
(33, 4, 16, 15, 0),
(39, 4, 19, 15, 0),
(40, 4, 19, 16, 0),
(41, 4, 20, 15, 0),
(42, 4, 20, 16, 0),
(43, 4, 21, 15, 0),
(44, 4, 21, 16, 0),
(45, 4, 22, 15, 0),
(46, 4, 22, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `destaque`
--

CREATE TABLE `destaque` (
  `id_destaque` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `texto` varchar(100) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destaque`
--

INSERT INTO `destaque` (`id_destaque`, `id_torneio`, `id_partida`, `texto`, `imagem`) VALUES
(1, 1, 1, 'Esse é o pique, hackearam meu email', '5af478e47ea90a88e60bae412c8c2ea966711ea5.jpg'),
(2, 1, 2, 'Um projeto Beta finalizado', 'aaf0e5d0859266fe63b34a81dd6846633013e642.jpg'),
(3, 1, 17, 'Jogador faz ace sozinho de AWP', '2be4000a2b548f47d941f6f99514b4fa16357123.jpg'),
(4, 2, 22, 'Começa a V Amostra de TCCs!', '9c4524edcdc4077b97e59c0429e633b2bb46d9f1.jpg'),
(5, 4, 26, 'De virada! 1º INF conquista seu primeiro ouro na competição', '2e0355ff3b1ae4057a72e9fc217059689da65675.jpg'),
(6, 4, 33, 'A primeira penalidade é aplicada sobre jogador do 2° INF', '540ef1753ebd8c5ddad48124f849261ca6cc3641.jfif'),
(8, 4, 36, '3º ADM se recupera do apagão e vence a partida nos últimos minutos de jogo', 'd7b4725c484f35a981d4d6883fabc7d46743525a.png');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sigla` varchar(6) NOT NULL,
  `ouro` int(11) DEFAULT '0',
  `prata` int(11) DEFAULT '0',
  `bronze` int(11) DEFAULT '0',
  `pontos` int(11) DEFAULT '0',
  `representante` varchar(20) NOT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `id_torneio`, `nome`, `sigla`, `ouro`, `prata`, `bronze`, `pontos`, `representante`, `logo`) VALUES
(1, 1, 'Foxes', 'FX', 1, 0, 0, 0, 'fon', 'ce0614b981456b67ee945a9d68d35e6856e43991.png'),
(2, 1, 'Gladiators', 'GT', 1, 1, 0, 0, 'fon', '57a34ab1e170b2e6acc7d792b9811b27e5b76e48.png'),
(3, 1, 'Musketeers', 'MKT', 0, 1, 0, 0, 'fon', '0567d5c87d6769febad73d5017f4b65017dec022.png'),
(4, 1, 'Santos', 'SAN', 1, 1, 0, 0, 'fon', 'a912ca53ca20f6f6a1f2516df1bd990ca6e7dbd1.png'),
(5, 1, 'Cowboys', 'CB', 1, 0, 0, 0, 'fon', '09b24dc289fb29856d09859007e08966d02681e2.png'),
(6, 1, 'Burst', 'BST', 1, 2, 0, 0, 'fon', '1872966d5da28df01e5799b5286ed2d77b8a01c7.png'),
(10, 1, 'Believers', 'BL', 0, 0, 0, 0, 'asfa', 'b9e958612173a81fe78b7ec8792010dc10f6cd06.png'),
(12, 2, 'Prince', 'PRINCE', 0, 0, 0, 0, 'Royale', 'd95a8ee529a637198c2a4d160e3017e8053fc03d.png'),
(13, 2, 'P.E.K.K.A.', 'PEKKA', 0, 0, 0, 0, 'Royale', 'ef36cb89651cbeb627fcbff353a9c973eb86798e.png'),
(14, 2, 'Goblins', 'GOBLIN', 0, 0, 0, 0, 'Royale', '294eca42840048dd500641f501c0583f678ad6bd.png'),
(15, 2, 'Giant', 'GIANT', 0, 0, 0, 0, 'Royale', 'f952121ad520201805b29777208b3033e907ae1c.png'),
(16, 4, '1º Administração', '1º ADM', 0, 1, 0, 0, 'lima', 'd7b9b33e912c8ade5b73bf6e25e589738cebe6fd.png'),
(17, 4, '1º Informática', '1º INF', 1, 0, 0, 0, 'Resende', '8a63ec6242b7f868ae614fc19970e4505e4f2838.png'),
(18, 4, '3º A', '3º A', 0, 0, 1, 0, 'lima', '88f797ec641004f84b322d6e3c92a7540a3fc8ed.png'),
(19, 4, '2º Informática', '2º INF', 0, 0, 0, 0, 'lima', '86ba8def91fa662bcd38471b72517774b8c512b8.png'),
(20, 4, '2º Administração', '2º ADM', 0, 0, 0, 0, 'larii_nakaa', '3b0c544bc458cfeaed4e7f9560ec303ab21d6e90.png'),
(21, 4, '3° Informática', '3º INF', 0, 0, 0, 0, 'lima', '47c8f781528b99968e1546b13f151accc1ff1e9b.png'),
(22, 4, '3º Administração', '3º ADM', 0, 0, 0, 0, 'lima', '474d5795121e8457b62321ee232ba37611d6e560.png');

-- --------------------------------------------------------

--
-- Table structure for table `esporte`
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
-- Dumping data for table `esporte`
--

INSERT INTO `esporte` (`id_esporte`, `id_torneio`, `esporte`, `genero`, `tipo`, `qtd_jogadores`, `classificacao`, `imagem`, `qtd_times`) VALUES
(1, 1, 'League of Legends         ', 'Ambos', 'Eletrônico', 1, 'Chave', '7dae675974558d003af1d7040dad2588ab135ccc.jpg', 2),
(2, 1, 'Xadrez   ', 'Ambos', 'Tabuleiro', 1, 'Chave', '5f4fccd5f3ac34e389fc8e8a690b15f82d2753ba.jpg', 2),
(3, 1, 'Futsal masculino ', 'Masculino', 'Físico', 5, 'Fase de Grupo', '4895b91f2074fd464afbf065e492b873093bd70e.jpg', 2),
(4, 1, 'Queima ', 'Ambos', 'Físico', 10, 'Chave', 'bf0b574c4994de85677e6221e7d33188bbf1c89d.jpg', 1),
(5, 1, 'Counter Strike  ', 'Ambos', 'Eletrônico', 5, 'Chave', '7b1d0ef88dea5a76e296cb8f36b065d3c2c4f56d.jpg', 2),
(6, 1, 'Damas  ', 'Ambos', 'Tabuleiro', 1, 'Chave', '7a0973e637f6934b4ab62c86a4e31d4119e06c4b.jpg', 2),
(8, 1, 'Vôlei masculino ', 'Masculino', 'Físico', 5, 'Chave', '3323673196d927fa0d04fe005ed3d17b627c05e0.jpg', 1),
(7, 1, 'Mortal Kombat', 'Ambos', 'Eletrônico', 1, 'Chave', '254444eba2bf534fa94e7b09a58064145ab3687c.jpg', 2),
(9, 1, 'Vôlei feminino', 'Feminino', 'Físico', 5, 'Chave', 'cc5b24839caed9970895f6f289e2a4329ab67a38.jpg', 1),
(10, 1, 'Futsal feminino', 'Feminino', 'Físico', 5, 'Chave', '918497b94dfa25ce58346c4e37b75fd3f15b813f.jpg', 1),
(12, 2, 'Clash Royale', 'Ambos', 'Eletrônico', 1, 'Chave', '2298ab67437f69082414f64ae7425e20421384d2.png', 1),
(13, 1, 'Baseball', 'Ambos', 'Físico', 5, 'Chave', '8202d019c20046fb85968b8741e4ba9e3ba9bd3e.jpg', 1),
(14, 4, 'Counter Strike', 'Ambos', 'Eletrônico', 5, 'Chave', 'c6f1be597b7d4a246e83409a2e6f6915c5bd5ac7.jpg', 1),
(15, 4, 'Futsal masculino', 'Masculino', 'Físico', 5, 'Fase de Grupo', '221f7c81bd2db1a8e16d131e9a9f19155796a879.jpg', 1),
(16, 4, 'Futsal feminino', 'Feminino', 'Físico', 5, 'Fase de Grupo', 'e47b20452b4bf4312e5c9a2a3abc9a3cb8b389d6.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fase`
--

CREATE TABLE `fase` (
  `id_fase` int(11) NOT NULL,
  `fase_descricao` varchar(40) DEFAULT NULL,
  `fase_indice` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fase`
--

INSERT INTO `fase` (`id_fase`, `fase_descricao`, `fase_indice`) VALUES
(1, 'Final', 1),
(2, 'Semifinal', 2),
(3, 'Quartas', 3),
(4, 'Oitavas', 4),
(6, 'Eliminatórias', 0);

-- --------------------------------------------------------

--
-- Table structure for table `participacao_esporte`
--

CREATE TABLE `participacao_esporte` (
  `id_participante` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participacao_esporte`
--

INSERT INTO `participacao_esporte` (`id_participante`, `id_esporte`) VALUES
(1, 2),
(2, 2),
(1, 1),
(2, 1),
(5, 2),
(4, 2),
(5, 1),
(3, 2),
(4, 1),
(3, 1),
(6, 2),
(6, 1),
(1, 5),
(2, 5),
(3, 5),
(12, 5),
(13, 5),
(4, 5),
(5, 5),
(6, 5),
(9, 5),
(11, 5),
(19, 5),
(20, 5),
(21, 5),
(22, 5),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(29, 5),
(30, 5),
(31, 5),
(32, 4),
(33, 5),
(1, 3),
(2, 3),
(3, 3),
(12, 3),
(13, 3),
(4, 3),
(5, 3),
(6, 3),
(9, 3),
(11, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(1, 4),
(2, 4),
(3, 4),
(12, 4),
(13, 4),
(4, 4),
(5, 4),
(6, 4),
(9, 4),
(11, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 5),
(33, 4),
(28, 6),
(33, 6);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `nome` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id_participante`, `id_torneio`, `id_equipe`, `nome`) VALUES
(1, 1, 1, 'Marcello Bertão'),
(2, 1, 1, 'Gabriel do Carmo'),
(3, 1, 1, 'João Piga'),
(4, 1, 2, 'Faustino Lopes'),
(5, 1, 2, 'Matheus Bonadio'),
(6, 1, 2, 'Guilherme Bergamo'),
(9, 1, 2, 'Femuel Silva'),
(11, 1, 2, 'Josnei Matos'),
(12, 1, 1, 'Micheli Novais'),
(13, 1, 1, 'Mirela Lima'),
(14, 1, 5, 'Lucas Lima'),
(15, 1, 5, 'Neymar Ceni'),
(16, 1, 5, 'Lucas Pato'),
(17, 1, 5, 'Michel Zika'),
(18, 1, 5, 'Ludimari Neri'),
(19, 1, 3, 'Clécio Paizão'),
(20, 1, 3, 'Raissa Linda'),
(21, 1, 3, 'Irina Tempero'),
(22, 1, 3, 'Lubianka Tiko-Teko'),
(23, 1, 3, 'Pablo Escobar'),
(24, 1, 4, 'Garet Bale'),
(25, 1, 4, 'James Rodriguez'),
(26, 1, 4, 'Bruno Henrique'),
(27, 1, 4, 'Vitor Casillas'),
(28, 1, 4, 'Zeca Pagodinho'),
(29, 1, 6, 'Marcelo Lee'),
(30, 1, 6, 'Ronaldo Fenomeno'),
(31, 1, 6, 'William Lemos'),
(32, 1, 6, 'Faustão'),
(33, 1, 6, 'Ratinho');

-- --------------------------------------------------------

--
-- Table structure for table `partida`
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
-- Dumping data for table `partida`
--

INSERT INTO `partida` (`id_partida`, `id_torneio`, `id_equipe_a`, `id_equipe_b`, `id_esporte`, `id_fase`, `dia`, `inicio`, `termino`, `placar_equipe_a`, `placar_equipe_b`, `vencedor`) VALUES
(2, 1, 2, 1, 1, 1, '2017-11-23', '09:37', '01:26', 2, 3, 1),
(5, 1, 1, 3, 5, 2, '2017-11-25', '15:30', '16:00', 0, 1, 3),
(6, 1, 5, 4, 3, 0, '2017-11-30', '12:09', '13:10', 1, 3, 4),
(7, 1, 6, 4, 3, 3, '2017-11-28', '11:10', '13:00', 4, 5, 4),
(8, 1, 5, 2, 3, 4, '2017-11-27', '21:00', '22:00', 0, 4, 2),
(9, 1, 3, 6, 5, 0, '2017-11-25', '09:00', '11:25', 1, 2, 6),
(10, 1, 1, 5, 5, 4, '2017-11-29', '13:21', '14:00', 1, 5, 5),
(11, 1, 6, 4, 4, 1, '2017-11-28', '13:24', '01:40', 2, 4, 4),
(12, 1, 5, 2, 4, 3, '2017-11-29', '10:10', NULL, 0, 0, NULL),
(13, 1, 5, 3, 5, 1, '2017-12-01', '13:46', '01:23', 3, 1, 5),
(14, 1, 2, 4, 5, 2, '2017-11-29', '11:10', '12:00', 1, 2, 4),
(15, 1, 1, 2, 4, 0, '2017-11-28', '13:21', NULL, 0, 0, NULL),
(16, 1, 2, 6, 3, 1, '2017-12-08', '12:11', '01:20', 3, 1, 2),
(17, 1, 4, 6, 5, 0, '2017-11-24', '08:09', '10:00', 3, 0, 4),
(18, 1, 1, 3, 5, 0, '2017-11-21', '09:42', '01:20', 2, 1, 1),
(19, 1, 5, 6, 3, 0, '2017-11-18', '11:56', '12:10', 2, 1, 5),
(20, 1, 4, 6, 6, 1, '2017-12-01', '09:00', '01:27', 1, 5, 6),
(21, 1, 4, 5, 2, 0, '2017-12-02', '10:00', NULL, 0, 0, NULL),
(22, 2, 12, 13, 12, 3, '2017-12-01', '20:30', '20:30', 2, 0, 12),
(23, 2, 14, 15, 12, 3, '2017-12-01', '20:00', NULL, 0, 0, NULL),
(24, 4, 16, 19, 14, 2, '2017-12-04', '9:30', '9:30', 16, 14, 16),
(25, 4, 17, 18, 14, 2, '2017-12-04', '10:30', '10:30', 11, 1, 17),
(26, 4, 16, 17, 14, 1, '2017-12-04', '11:20', '11:20', 8, 11, 17),
(27, 4, 16, 21, 15, 0, '2017-12-05', '7:40', '8:07', 1, 1, 0),
(28, 4, 20, 19, 15, 0, '2017-12-05', '8:25', '8:50', 2, 2, 0),
(29, 4, 21, 18, 15, 0, '2017-12-05', '9:10', '9:35', 3, 2, 21),
(30, 4, 16, 20, 15, 0, '2017-12-05', '10:40', '11:00', 1, 2, 20),
(31, 4, 19, 21, 15, 0, '2017-12-06', '9:40', '10:05', 0, 7, 21),
(32, 4, 17, 18, 15, 0, '2017-12-05', '11:20', '11:40', 0, 3, 18),
(33, 4, 17, 19, 15, 0, '2017-12-05', '10:00', '10:20', 1, 1, 0),
(34, 4, 16, 19, 15, 0, '2017-12-06', '8:50', '9:15', 8, 0, 16),
(35, 4, 20, 21, 15, 0, '2017-12-07', '10:20', '10:45', 2, 0, 20),
(36, 4, 20, 22, 15, 0, '2017-12-06', '9:15', '9:40', 1, 2, 22),
(37, 4, 17, 21, 15, 0, '2017-12-06', '7:55', '8:20', 1, 8, 21),
(38, 4, 22, 18, 15, 0, '2017-12-06', '8:20', '8:45', 1, 2, 18),
(39, 4, 17, 16, 15, 0, '2017-12-07', '7:40', '8:05', 0, 4, 16),
(40, 4, 16, 22, 15, 0, '2017-12-06', '10:05', '10:30', 0, 1, 22),
(41, 4, 16, 18, 15, 0, '2017-12-07', '9:05', '9:25', 3, 1, 16),
(42, 4, 22, 19, 15, 0, '2017-12-07', '9:25', '9:45', 3, 0, 22),
(43, 4, 19, 18, 15, 0, '2017-12-06', '10:55', '11:10', 1, 3, 18),
(44, 4, 20, 17, 15, 0, '2017-12-06', '10:30', '10:55', 3, 0, 20),
(45, 4, 22, 21, 15, 0, '2017-12-07', '8:30', '8:50', 0, 1, 21),
(46, 4, 22, 17, 15, 0, '2017-12-07', '10:00', '10:20', 4, 1, 22),
(47, 4, 20, 18, 15, 0, '2017-12-07', '8:05', '8:25', 6, 0, 20),
(48, 4, 16, 20, 16, 0, '2017-12-05', '8:10', '8:23', 0, 1, 20),
(49, 4, 17, 19, 16, 0, '2017-12-05', '8:55', '9:05', 2, 0, 17),
(50, 4, 20, 19, 16, 0, '2017-12-05', '9:40', '9:50', 0, 0, 0),
(51, 4, 19, 16, 16, 0, '2017-12-05', '10:20', '10:35', 0, 0, 0),
(52, 4, 17, 20, 16, 0, '2017-12-05', '11:00', '11:15', 1, 0, 17),
(53, 4, 19, 22, 16, 0, '2017-12-06', '11:15', '11:30', 0, 1, 22),
(54, 4, 16, 17, 16, 0, '2017-12-06', '11:30', '11:45', 0, 1, 17),
(55, 4, 20, 22, 16, 0, '2017-12-06', '11:50', '12:00', 0, 0, 0),
(56, 4, 22, 17, 16, 0, '2017-12-06', '12:00', '12:10', 1, 0, 22),
(57, 4, 16, 22, 16, 0, '2017-12-07', '8:50', '9:00', 1, 0, 16),
(58, 4, 20, 17, 16, 0, '2017-12-07', '9:50', '10:00', 2, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `partida_log`
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
-- Table structure for table `permissao`
--

CREATE TABLE `permissao` (
  `login` varchar(20) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_esporte` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissao`
--

INSERT INTO `permissao` (`login`, `id_torneio`, `id_esporte`) VALUES
('Bertao', 1, 5),
('Marcello', 1, 8),
('Marcello', 1, 9),
('Marcello', 1, 4),
('Marcello', 1, 3),
('Marcello', 1, 10),
('Lucas', 1, 2),
('Lucas', 1, 6),
('admin', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `torneio`
--

CREATE TABLE `torneio` (
  `id_torneio` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `inicio` date NOT NULL,
  `termino` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `torneio`
--

INSERT INTO `torneio` (`id_torneio`, `descricao`, `inicio`, `termino`) VALUES
(1, 'Torneio fictício', '2017-11-27', '2017-12-01'),
(2, 'Amostra de TCCs', '2017-12-01', '2017-12-01'),
(4, 'Interclasse Etec 2017', '2017-12-04', '2017-12-11');

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
-- Indexes for table `classificacao`
--
ALTER TABLE `classificacao`
  ADD PRIMARY KEY (`id_classificacao`);

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
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `classificacao`
--
ALTER TABLE `classificacao`
  MODIFY `id_classificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id_destaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `esporte`
--
ALTER TABLE `esporte`
  MODIFY `id_esporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id_fase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `partida_log`
--
ALTER TABLE `partida_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `torneio`
--
ALTER TABLE `torneio`
  MODIFY `id_torneio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
