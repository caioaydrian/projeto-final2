  CREATE DATABASE IF NOT EXISTS projeto2;
  USE projeto2;

  CREATE TABLE `agendamento` (
    `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id_clientes` int NOT NULL,
    `data` date NOT NULL,
    `horario` time NOT NULL,
    `status` varchar(50) DEFAULT NULL
  );


  CREATE TABLE `clientes` (
    `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nome` varchar(100) NOT NULL,
    `telefone` varchar(15) NOT NULL,
    `dt_nasc` date DEFAULT NULL
  );


  CREATE TABLE `servico` (
    `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nome` varchar(50) NOT NULL,
    `valor` decimal(10,2) DEFAULT NULL,
    `duracao_estimada` time DEFAULT NULL
  );


  CREATE TABLE `servico_agendamento` (
    `id_servico` int NOT NULL,
    `id_agendamento` int NOT NULL
  );

  ALTER TABLE `agendamento`
    ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`);

  ALTER TABLE `servico_agendamento`
    ADD CONSTRAINT `servico_agendamento_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`),
    ADD CONSTRAINT `servico_agendamento_ibfk_2` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento` (`id`);