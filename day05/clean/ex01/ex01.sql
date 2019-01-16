CREATE TABLE ft_table (
`id` INT NOT NULL AUTO_INCREMENT,
`login` VARCHAR(8) DEFAULT 'toto' NOT NULL,
`group` ENUM('staff', 'student', 'other') NOT NULL,
creation_date DATE NOT NULL,
PRIMARY KEY (id));