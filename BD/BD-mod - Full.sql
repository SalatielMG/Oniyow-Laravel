
DROP DATABASE IF EXISTS `oniyow2`;
CREATE SCHEMA IF NOT EXISTS `oniyow2` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `oniyow2` ;

-- -----------------------------------------------------
-- Table `oniyow2`.`unidadmedida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`unidadmedida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `medida` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`materiaprima`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`materiaprima` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `stock` INT NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `unidadmedida` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`unidadmedida`)
    REFERENCES `oniyow2`.`unidadmedida` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`producto` (
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
-- Table `oniyow2`.`dato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`dato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `domicilioparticular` VARCHAR(255) NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `sitioweb` VARCHAR(200) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`cliente` (
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
    REFERENCES `oniyow2`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`comunicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`comunicacion` (
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
    REFERENCES `oniyow2`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`venta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `fechaestimada` DATE NULL,
  `fechaentrega` DATE NULL,
  `cliente` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`cliente`)
    REFERENCES `oniyow2`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`telefono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`telefono` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(15) NOT NULL UNIQUE,
  `dato` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow2`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`email`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`email` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `dato` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow2`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`proveedor` (
  `dato` INT NOT NULL,
  `nombrerazonsocial` VARCHAR(100) NOT NULL,
  `representantelegal` VARCHAR(200) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`dato`),
    FOREIGN KEY (`dato`)
    REFERENCES `oniyow2`.`dato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`producto_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`producto_venta` (
  `venta` INT NOT NULL,
  `producto` INT NOT NULL,
  `promocion` INT NULL DEFAULT NULL,
  `precio` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `porcentaje` INT NULL,
  PRIMARY KEY (`venta`, `producto`),
    FOREIGN KEY (`venta`)
    REFERENCES `oniyow2`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow2`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `oniyow2`.`provisiona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`provisiona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `proveedor` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`proveedor`)
    REFERENCES `oniyow2`.`proveedor` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`provisiona_materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`provisiona_materia` (
  `provisiona` INT NOT NULL,
  `materiaprima` INT NOT NULL,
  `precio` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`provisiona`, `materiaprima`),
    FOREIGN KEY (`provisiona`)
    REFERENCES `oniyow2`.`provisiona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`materiaprima`)
    REFERENCES `oniyow2`.`materiaprima` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`metodofabrica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`metodofabrica` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NULL,
  `preciofabrica` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow2`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`ocupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`ocupa` (
  `metodofabrica` INT NOT NULL,
  `materiaprima` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`metodofabrica`, `materiaprima`),
    FOREIGN KEY (`metodofabrica`)
    REFERENCES `oniyow2`.`metodofabrica` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`materiaprima`)
    REFERENCES `oniyow2`.`materiaprima` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`devolucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`devolucion` (
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
    REFERENCES `oniyow2`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`devolucion_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`devolucion_producto` (
  `devolucion` INT NOT NULL,
  `producto` INT NOT NULL,
  `cantidaddevuelto` INT NOT NULL,
  PRIMARY KEY (`devolucion`, `producto`),
    FOREIGN KEY (`devolucion`)
    REFERENCES `oniyow2`.`devolucion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow2`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`configuracion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`configuracion` (
  `sumaVentas` INT NOT NULL,
  `frecuencia` INT NOT NULL,
  `fechainicial` DATE NULL,
  `fechafinal` DATE NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`produccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`produccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL,
  `cantidadfabricado` INT NOT NULL,
  `metodo` INT NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`metodo`)
    REFERENCES `oniyow2`.`metodofabrica` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`dato_fiscal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`dato_fiscal` (
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
    REFERENCES `oniyow2`.`cliente` (`dato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`perdida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`perdida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `cantidad` INT NOT NULL,
  `producto` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow2`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`factura` (
  `folio` INT(7) ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY key,
  `venta` INT(11) NOT NULL UNIQUE,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
    FOREIGN KEY (`venta`)
    REFERENCES `oniyow2`.`venta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oniyow2`.`promocion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`promocion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fehcainicio` DATE NOT NULL,
  `fechafinal` DATE NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `oniyow2`.`promocion_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oniyow2`.`promocion_producto` (
  `promocion` INT NOT NULL,
  `producto` INT NOT NULL,
  `porcentaje` INT NOT NULL,
  PRIMARY KEY (`promocion`, `producto`),
    FOREIGN KEY (`promocion`)
    REFERENCES `oniyow2`.`promocion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`producto`)
    REFERENCES `oniyow2`.`producto` (`id`)
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

-- *********PROVISIONA**********
DELIMITER //
CREATE TRIGGER incrementarMateria_afterProvisiona
    AFTER INSERT ON provisiona_materia
    FOR EACH ROW
BEGIN

    UPDATE materiaprima set stock = (stock + NEW.cantidad) where id = NEW.materiaprima;

END; //
DELIMITER ;


DELIMITER //
CREATE TRIGGER borrarRelacion_deleteProvisiona
    BEFORE DELETE ON provisiona
    FOR EACH ROW
BEGIN

    DELETE FROM provisiona_materia WHERE provisiona = OLD.id;

END; //
DELIMITER ;


DELIMITER //
CREATE TRIGGER decrementarMateria_afterDeleteProvisiona
    AFTER DELETE ON provisiona_materia
    FOR EACH ROW
BEGIN

    UPDATE materiaprima set stock = (stock - OLD.cantidad) where id = OLD.materiaprima;

END; //
DELIMITER ;


--**********************************

--************PRODUCCION*****************
DELIMITER //
CREATE TRIGGER incrementarProducto_afterProduccion
    AFTER INSERT ON produccion
    FOR EACH ROW
BEGIN

    UPDATE producto set stock = (stock + NEW.cantidadfabricado) where id = (SELECT producto FROM metodofabrica WHERE id = NEW.metodo);

END; //
DELIMITER ;



DELIMITER //
CREATE TRIGGER decrementarMateria_afterProduccion
    AFTER INSERT ON produccion
    FOR EACH ROW
BEGIN

	DECLARE done INT DEFAULT FALSE;
  DECLARE mat, cant INT;
  DECLARE cMat CURSOR FOR SELECT materiaprima FROM ocupa WHERE metodofabrica = NEW.metodo;
  DECLARE cCant CURSOR FOR SELECT cantidad FROM ocupa WHERE metodofabrica = NEW.metodo;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cMat;
  OPEN cCant;

  read_loop: LOOP
    FETCH cMat INTO mat;
    FETCH cCant INTO cant;
    IF done THEN
      LEAVE read_loop;
    END IF;

	UPDATE materiaprima set stock = (stock - (cant * NEW.cantidadfabricado) ) where id = mat;

  END LOOP;

  CLOSE cMat;
  CLOSE cCant;

END; //
DELIMITER ;




DELIMITER //
CREATE TRIGGER incrementarMateria_afterDeleteProduccion
    BEFORE DELETE ON produccion
    FOR EACH ROW
BEGIN

  DECLARE done INT DEFAULT FALSE;
  DECLARE mat, cant INT;
  DECLARE cMat CURSOR FOR SELECT materiaprima FROM ocupa WHERE metodofabrica = OLD.metodo;
  DECLARE cCant CURSOR FOR SELECT cantidad FROM ocupa WHERE metodofabrica = OLD.metodo;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cMat;
  OPEN cCant;

  read_loop: LOOP
    FETCH cMat INTO mat;
    FETCH cCant INTO cant;
    IF done THEN
      LEAVE read_loop;
    END IF;

	UPDATE materiaprima set stock = (stock + (cant * OLD.cantidadfabricado) ) where id = mat;

  END LOOP;

  CLOSE cMat;
  CLOSE cCant;

END; //
DELIMITER ;

--**************************************



--***********Metodo de Fabrica***********
DELIMITER //
CREATE TRIGGER borrarRelacion_deleteMetodoFabrica
    BEFORE DELETE ON metodofabrica
    FOR EACH ROW
BEGIN

    DELETE FROM ocupa WHERE metodofabrica = OLD.id;

END; //
DELIMITER ;


DELIMITER //
CREATE TRIGGER borrarRelacionProduccion_deleteMetodoFabrica
    BEFORE DELETE ON metodofabrica
    FOR EACH ROW
BEGIN

    DELETE FROM produccion WHERE metodo = OLD.id;

END; //
DELIMITER ;






/*
DELIMITER //
CREATE TRIGGER incrementarStockProducto
    AFTER DELETE ON producto_venta
    FOR EACH ROW
BEGIN

    UPDATE producto set stock = (stock + OLD.cantidad) where id = OLD.producto;

END; //
DELIMITER ;*/