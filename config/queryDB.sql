
CREATE DATABASE IF NOT EXISTS `sistema_clubes`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `sistema_clubes`;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `clubes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_club` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_clubes_nombre_club` (`nombre_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Catalogo base de clubes. No es informacion privada.
INSERT INTO `clubes` (`id`, `nombre_club`) VALUES
  (1, 'TIRO CON ARCO'),
  (2, 'AJEDREZ'),
  (3, 'NORTENO'),
  (4, 'FUTBOL'),
  (5, 'RONDALLA'),
  (6, 'DANZA'),
  (7, 'BASKETBALL'),
  (8, 'VOLEIBOL')
ON DUPLICATE KEY UPDATE
  `nombre_club` = VALUES(`nombre_club`);


CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `matricula` VARCHAR(255) NOT NULL,
  `matricula_visible` VARCHAR(12) NOT NULL,
  `carrera` VARCHAR(100) NOT NULL,
  `club_id` INT NOT NULL,
  `foto` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_alumnos_matricula_visible` (`matricula_visible`),
  KEY `idx_alumnos_club_id` (`club_id`),
  CONSTRAINT `fk_alumnos_clubes`
    FOREIGN KEY (`club_id`) REFERENCES `clubes` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `maestros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `club_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_maestros_club_id` (`club_id`),
  CONSTRAINT `fk_maestros_clubes`
    FOREIGN KEY (`club_id`) REFERENCES `clubes` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
