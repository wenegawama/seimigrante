-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Maio-2025 às 22:13
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sei`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `idAtividade` int(5) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `duracao` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `continente`
--

CREATE TABLE `continente` (
  `idContinente` int(1) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='					';

-- --------------------------------------------------------

--
-- Estrutura da tabela `encontro`
--

CREATE TABLE `encontro` (
  `idEncontro` int(11) NOT NULL,
  `evento` int(5) NOT NULL,
  `usuario` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(5) NOT NULL,
  `local` int(5) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `atividade` int(5) NOT NULL,
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `idLocal` int(5) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `cep` int(8) NOT NULL,
  `numero` int(5) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `contato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='					';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `idPais` int(3) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `continente` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `idPerfil` int(2) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(9) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `celular` int(11) NOT NULL,
  `genero` enum('Masculino','Feminino','Outro') NOT NULL,
  `pais` int(3) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `perfil` int(2) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`idAtividade`);

--
-- Índices para tabela `continente`
--
ALTER TABLE `continente`
  ADD PRIMARY KEY (`idContinente`);

--
-- Índices para tabela `encontro`
--
ALTER TABLE `encontro`
  ADD PRIMARY KEY (`idEncontro`),
  ADD KEY `fk_encontro_evento1_idx` (`evento`),
  ADD KEY `fk_encontro_usuario1_idx` (`usuario`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_evento_local1_idx` (`local`),
  ADD KEY `fk_evento_atividade1_idx` (`atividade`);

--
-- Índices para tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`idLocal`);

--
-- Índices para tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`),
  ADD KEY `fk_pais_continente1_idx` (`continente`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idPerfil`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `ativo_UNIQUE` (`ativo`),
  ADD KEY `fk_usuario_pais1_idx` (`pais`),
  ADD KEY `fk_usuario_perfil1_idx` (`perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `idAtividade` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `continente`
--
ALTER TABLE `continente`
  MODIFY `idContinente` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `encontro`
--
ALTER TABLE `encontro`
  MODIFY `idEncontro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `idLocal` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `idPais` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE usuario DROP INDEX ativo_UNIQUE;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `encontro`
--
ALTER TABLE `encontro`
  ADD CONSTRAINT `fk_encontro_evento1` FOREIGN KEY (`evento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_encontro_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_atividade1` FOREIGN KEY (`atividade`) REFERENCES `atividade` (`idAtividade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_local1` FOREIGN KEY (`local`) REFERENCES `local` (`idLocal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_pais_continente1` FOREIGN KEY (`continente`) REFERENCES `continente` (`idContinente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_pais1` FOREIGN KEY (`pais`) REFERENCES `pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
