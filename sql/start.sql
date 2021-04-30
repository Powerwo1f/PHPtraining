CREATE SCHEMA `tl` DEFAULT CHARACTER SET utf8 ;
/*users*/
CREATE TABLE `user_list`(
	`id` INT(11) auto_increment,
	`login` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
      PRIMARY KEY (`id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;