
DROP DATABASE IF EXISTS `oniyow`;
CREATE SCHEMA IF NOT EXISTS `oniyow` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `oniyow` ;

-- -----------------------------------------------------
-- Table `oniyow`.`unidadmedida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`unidadmedida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `medida` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`materiaprima`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`materiaprima` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `stock` INT NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `unidadmedida` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`unidadmedida`)
    REFERENCES `oniyow`.`unidadmedida` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `stock` INT NOT NULL,
  `precio` INT NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`dato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`dato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `domicilioparticular` VARCHAR(255) NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `sitioweb` VARCHAR(200) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`cliente` (
  `dato` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(200) NOT NULL,
  `tipo` ENUM('empresa', 'persona', 'admin') NOT NULL,
  `usuario` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`dato`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`comunicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`comunicacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `asunto` VARCHAR(50) NOT NULL,
  `mensaje` VARCHAR(255) NOT NULL,
  `archivoruta` VARCHAR(100) NULL,
  `entregado` TINYINT NOT NULL,
  `fecha` DATE NOT NULL,
  `tipo` ENUM('correo', 'llamada') NOT NULL,
  `yoemisor` TINYINT NOT NULL,
  `cliente` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`cliente`)
    REFERENCES `oniyow`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`venta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `fechaestimada` DATE NULL,
  `fechaentrega` DATE NULL,
  `cliente` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`cliente`)
    REFERENCES `oniyow`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`telefono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`telefono` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(15) NOT NULL UNIQUE,
  `dato` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`email`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`email` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `dato` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`proveedor` (
  `dato` INT NOT NULL,
  `nombrerazonsocial` VARCHAR(100) NOT NULL,
  `representantelegal` VARCHAR(200) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`dato`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`producto_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`producto_venta` (
  `venta` INT NOT NULL,
  `producto` INT NOT NULL,
  `promocion` INT NULL DEFAULT NULL,
  `precio` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `porcentaje` INT NULL,
  PRIMARY KEY (`venta`, `producto`),
    FOREIGN KEY (`venta`)
    REFERENCES `oniyow`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `oniyow`.`provisiona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`provisiona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `proveedor` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`proveedor`)
    REFERENCES `oniyow`.`proveedor` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`provisiona_materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`provisiona_materia` (
  `provisiona` INT NOT NULL,
  `materiaprima` INT NOT NULL,
  `precio` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`provisiona`, `materiaprima`),
    FOREIGN KEY (`provisiona`)
    REFERENCES `oniyow`.`provisiona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`materiaprima`)
    REFERENCES `oniyow`.`materiaprima` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`metodofabrica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`metodofabrica` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NULL,
  `preciofabrica` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`ocupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`ocupa` (
  `metodofabrica` INT NOT NULL,
  `materiaprima` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`metodofabrica`, `materiaprima`),
    FOREIGN KEY (`metodofabrica`)
    REFERENCES `oniyow`.`metodofabrica` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`materiaprima`)
    REFERENCES `oniyow`.`materiaprima` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`devolucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`devolucion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `fechaestimada` DATE NULL,
  `fechaentrega` DATE NULL,
  `razon` VARCHAR(100) NOT NULL,
  `ventatotal` TINYINT NOT NULL,
  `venta` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`venta`)
    REFERENCES `oniyow`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`devolucion_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`devolucion_producto` (
  `devolucion` INT NOT NULL,
  `producto` INT NOT NULL,
  `cantidaddevuelto` INT NOT NULL,
  PRIMARY KEY (`devolucion`, `producto`),
    FOREIGN KEY (`devolucion`)
    REFERENCES `oniyow`.`devolucion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`configuracion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`configuracion` (
  `sumaVentas` INT NOT NULL,
  `frecuencia` INT NOT NULL,
  `fechainicial` DATE NULL,
  `fechafinal` DATE NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`produccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`produccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `cantidadfabricado` INT NOT NULL,
  `metodo` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`metodo`)
    REFERENCES `oniyow`.`metodofabrica` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`dato_fiscal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`dato_fiscal` (
  `cliente` INT NOT NULL,
  `RFC` VARCHAR(13) NOT NULL UNIQUE,
  `calle` VARCHAR(100) NOT NULL,
  `numinterior` VARCHAR(4) NOT NULL,
  `numexterior` VARCHAR(4) NULL,
  `colonia` VARCHAR(50) NOT NULL,
  `cp` VARCHAR(5) NOT NULL,
  `municipio` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`cliente`),
    FOREIGN KEY (`cliente`)
    REFERENCES `oniyow`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`perdida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`perdida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `cantidad` INT NOT NULL,
  `producto` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`factura` (
  `folio` INT(7) ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY key,
  `venta` INT(11) NOT NULL UNIQUE,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
    FOREIGN KEY (`venta`)
    REFERENCES `oniyow`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow`.`promocion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`promocion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fechainicio` DATE NOT NULL,
  `fechafinal` DATE NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `oniyow`.`promocion_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow`.`promocion_producto` (
  `promocion` INT NOT NULL,
  `producto` INT NOT NULL,
  `porcentaje` INT NOT NULL,
  PRIMARY KEY (`promocion`, `producto`),
    FOREIGN KEY (`promocion`)
    REFERENCES `oniyow`.`promocion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DELIMITER //
CREATE TRIGGER decrementarStockProducto
    AFTER INSERT ON producto_venta
    FOR EACH ROW
BEGIN

    UPDATE producto set stock = (stock - NEW.cantidad) where id = NEW.producto;

END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER incrementarStockProducto
    AFTER DELETE ON producto_venta
    FOR EACH ROW
BEGIN

    UPDATE producto set stock = (stock + OLD.cantidad) where id = OLD.producto;

END; //
DELIMITER ;