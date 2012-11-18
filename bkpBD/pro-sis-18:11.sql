-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Nov 18, 2012 as 07:23 PM
-- Versão do Servidor: 5.1.44
-- Versão do PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `pro-sis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ultimo_login` date NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` VALUES(1, 'guilherme', '123456', 'Guilherme Pontes', '2012-11-18', 'guilhermepontes@msn.com');
INSERT INTO `administrador` VALUES(2, 'thiago', '321', 'Thiago', '2011-11-15', 'thiago.maciel@msn.com');
INSERT INTO `administrador` VALUES(3, 'daniela', 'poline1993', 'Daniela', '0000-00-00', 'dani_kitty2006@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `cod_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `cod_funcionario` int(11) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `adiantamento` int(11) NOT NULL,
  `data_admissao` date NOT NULL,
  `data_afastamento` date NOT NULL,
  `salario` int(11) NOT NULL,
  `cargo` varchar(155) NOT NULL,
  PRIMARY KEY (`cod_contrato`),
  UNIQUE KEY `cod_funcionario` (`cod_funcionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` VALUES(1, 1, 44, 3440, '0000-00-00', '0000-00-00', 8600, 'Desenvolvedor de Interface');
INSERT INTO `contrato` VALUES(11, 24, 21321, 4925, '0000-00-00', '0000-00-00', 12312, 'sddsa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `descontos`
--

CREATE TABLE `descontos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `descontos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `cod_funcionario` int(11) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `cnh` varchar(50) NOT NULL,
  `escolaridade` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `titulo_eleitoral` varchar(50) NOT NULL,
  `pis` varchar(50) NOT NULL,
  `nacionalidade` varchar(50) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `cnh` (`cnh`,`rg`,`titulo_eleitoral`,`pis`),
  UNIQUE KEY `cod_funcionario` (`cod_funcionario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` VALUES(1, '398.854.248-22', '0032.3221.4321', 'Superior', '34.553.479-7', '3221.6542.3', '253479342859875328', '');
INSERT INTO `documentos` VALUES(33, '', '', '', '', '', '', '');
INSERT INTO `documentos` VALUES(24, '232.132.112-31', '213213123', 'Primeiro Grau Completo', '21.321.312-3', '21312', '21321313', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod_funcionario` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(150) NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  UNIQUE KEY `cod_funcionario` (`cod_funcionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` VALUES(1, 1, 'Jales', 18, '12233680', 'Bosque dos Eucaliptos', 'Sao Jose dos Campos', 'Sao Paulo');
INSERT INTO `endereco` VALUES(24, 13, '232.132.112-31', 213213123, '12233-680', 'Bosque dos Eucaliptos', 'SÃ£o JosÃ© dos Campos', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechamentoFolhaDePonto`
--

CREATE TABLE `fechamentoFolhaDePonto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `fechado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `fechamentoFolhaDePonto`
--

INSERT INTO `fechamentoFolhaDePonto` VALUES(1, 2012, 11, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `folhadeponto`
--

CREATE TABLE `folhadeponto` (
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `faltas` int(11) NOT NULL,
  `dsr` int(11) NOT NULL,
  `he60` int(11) NOT NULL,
  `he100` int(11) NOT NULL,
  `feriado` int(11) NOT NULL,
  `cod_funcionario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `folhadeponto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `etnia` varchar(50) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `banco_pagamento` varchar(50) NOT NULL,
  `agencia_pagamento` int(11) NOT NULL,
  `conta_pagamento` int(11) NOT NULL,
  PRIMARY KEY (`cod_funcionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` VALUES(1, 'Guilherme Pontes', '1992-06-11', 'Branco', 'Solteiro', 'Banco do Brasil', 12130, 391670);
INSERT INTO `funcionario` VALUES(24, 'Thiago', '0000-00-00', 'Bixa', 'Casado', 'Banco Real', 213, 231);
INSERT INTO `funcionario` VALUES(33, '', '0000-00-00', '', 'Selecione seu Estado', '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `cod_funcionario` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  PRIMARY KEY (`cod_funcionario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` VALUES(1, '9166-0648');
INSERT INTO `telefone` VALUES(24, '(12) 3121-2321');
INSERT INTO `telefone` VALUES(33, '');
