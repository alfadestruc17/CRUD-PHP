CREATE DATABASE IF NOT EXISTS `usuarios_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `usuarios_app`;

CREATE TABLE IF NOT EXISTS `usuarios` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`primer_nombre` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`segundo_nombre` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`primer_apellido` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`segundo_apellido` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`telefono` VARCHAR(10) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`fecha_nacimiento` DATE NOT NULL,
	`correo` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`direccion` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;