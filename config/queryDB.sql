-- 1. Asegurar que la base de datos exista y usarla
CREATE DATABASE IF NOT EXISTS `sistema_clubes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_clubes`;

-- ========================================================
-- 2. CREACIÓN DE LA TABLA 'clubes'
-- ========================================================
CREATE TABLE IF NOT EXISTS `clubes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre_club` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de los talleres disponibles en el Tec San Pedro
INSERT INTO `clubes` (`id`, `nombre_club`) VALUES
(1, 'TIRO CON ARCO'),
(2, 'AJEDREZ'),
(3, 'NORTEÑO'),
(4, 'FÚTBOL'),
(5, 'RONDALLA'),
(6, 'DANZA'),
(7, 'BASKETBALL'),
(8, 'VOLEIBOL')
ON DUPLICATE KEY UPDATE `nombre_club` = VALUES(`nombre_club`);

-- ========================================================
-- 3. CREACIÓN DE LA TABLA 'alumnos'
-- ========================================================
-- Nota: 'matricula' se define como UNIQUE para evitar duplicados.
-- 'id_club' se enlaza directamente con el 'id' de la tabla 'clubes'.
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `matricula` VARCHAR(20) NOT NULL UNIQUE,
  `carrera` VARCHAR(100) NOT NULL,
  `id_club` INT NOT NULL,
  'matricula_visible' INT NOT NULL UNIQUE,
  CONSTRAINT `fk_alumnos_clubes` 
    FOREIGN KEY (`id_club`) REFERENCES `clubes`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE alumnos MODIFY COLUMN matricula VARCHAR(255) NOT NULL;

-- Crear la tabla de maestros
CREATE TABLE IF NOT EXISTS maestros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL
);

ALTER TABLE clubes ADD COLUMN maestro_id INT NULL;
ALTER TABLE maestros ADD COLUMN club_id INT NULL;

ALTER TABLE clubes ADD CONSTRAINT fk_clubes_maestros 
FOREIGN KEY (maestro_id) REFERENCES maestros(id) ON DELETE SET NULL;

-- Columna foto
ALTER TABLE alumnos ADD COLUMN foto VARCHAR(255) NULL;