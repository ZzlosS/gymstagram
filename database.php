<!DOCTYPE html>
<html>

<head>
<title>Setting up database</title>
</head>

<body>
<h3>Setting up...</h3>
	<?php
    /* da se doda ako si admin da mozes da pokrenes*/
		require_once 'functions.php'; 
		
		cT('`members`', 
				'`id` INT UNSIGNED AUTO_INCREMENT,
				`gym_name` VARCHAR(20) DEFAULT "",
				`name` VARCHAR(46) DEFAULT "",
				`lname` VARCHAR(46) DEFAULT "",
				`email` VARCHAR(50) NOT NULL,
				`pass` VARCHAR(50) NOT NULL,
				`gender` INT DEFAULT 1,
				`birth_date` DATE,
				`q1_id` VARCHAR(10) DEFAULT "",
				`question1` VARCHAR(30) NOT NULL,
				`q2_id` VARCHAR(10) DEFAULT "",
				`question2` VARCHAR(30) NOT NULL,
				`information` VARCHAR(4096) DEFAULT "",
				`pic_date` DATETIME,
				`pic_path` VARCHAR(50) DEFAULT "",
				`role` INT DEFAULT 1,
				`public` INT DEFAULT 0,
				PRIMARY KEY(`id`)');

		cT('`gym_buddies`',
				'`id` INT UNSIGNED AUTO_INCREMENT,
				`user_id` INT UNSIGNED NOT NULL,
				`friend_id` INT UNSIGNED NOT NULL,
				PRIMARY KEY(`id`),
				FOREIGN KEY(`user_id`) REFERENCES `members`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION,
				FOREIGN KEY(`friend_id`) REFERENCES `members`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION');


		cT('`pictures`','
				`id` INT UNSIGNED AUTO_INCREMENT,
				`user_id` INT UNSIGNED NOT NULL,
				`date_update` DATETIME,
				`pic_path` VARCHAR(50) DEFAULT "",
				`pic_desc` VARCHAR(255) DEFAULT "",
				`album_name` VARCHAR(20) NOT NULL,
				PRIMARY KEY(`id`),
				FOREIGN KEY(`user_id`) REFERENCES `members`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION');

		cT('`log`','
		        `id` INT UNSIGNED AUTO_INCREMENT,
		        `date` DATETIME,
		        `msg` VARCHAR(255),
		        PRIMARY KEY(`id`)');

        cT('`muscle_group`','
		        `id_m` INT UNSIGNED AUTO_INCREMENT,
		        `name_mc` VARCHAR(56),
		        PRIMARY KEY(`id_m`)');

        cT('`exercise`','
		        `id_e` INT UNSIGNED AUTO_INCREMENT,
		        `mc_id` INT UNSIGNED,
		        `name_e` VARCHAR(56),
		        PRIMARY KEY(`id_e`),
		        FOREIGN KEY(`mc_id`) REFERENCES `muscle_group`(`id_m`) ON UPDATE CASCADE ON DELETE NO ACTION');

		cT('`plan`','
		        `id_p` INT UNSIGNED AUTO_INCREMENT,
		        `user_id` INT UNSIGNED,
		        `day` INT NOT NULL,
		        `from` INT NOT NULL,
		        `to` INT NOT NULL,
		        `muscle_group_id` INT UNSIGNED,
		        `ex1_id` INT UNSIGNED,
		        `ex2_id` INT UNSIGNED,
		        `ex3_id` INT UNSIGNED,
		        `ex4_id` INT UNSIGNED,
		        PRIMARY KEY(`id_p`),
		        FOREIGN KEY(`user_id`) REFERENCES `members`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION,
                FOREIGN KEY(`muscle_group_id`) REFERENCES `muscle_group`(`id_m`) ON UPDATE CASCADE ON DELETE NO ACTION,
                FOREIGN KEY(`ex1_id`) REFERENCES `exercise`(`id_e`) ON UPDATE CASCADE ON DELETE NO ACTION,
                FOREIGN KEY(`ex2_id`) REFERENCES `exercise`(`id_e`) ON UPDATE CASCADE ON DELETE NO ACTION,
                FOREIGN KEY(`ex3_id`) REFERENCES `exercise`(`id_e`) ON UPDATE CASCADE ON DELETE NO ACTION,
                FOREIGN KEY(`ex4_id`) REFERENCES `exercise`(`id_e`) ON UPDATE CASCADE ON DELETE NO ACTION');
/*
		aT('`members`', '`name`', 'VARCHAR(46) DEFAULT ""') ;
        aT('`members`', '`lname`', 'VARCHAR(46) DEFAULT ""') ;
        aT('`members`', '`gender`', 'INT DEFAULT 1') ;
        aT('`members`', '`birth_date`', 'DATE');

        aT('`members`', '`information`', 'VARCHAR(4096) DEFAULT ""');
        aT('`members`', '`pic_date`', 'DATETIME');
        aT('`members`', '`pic_path`', 'VARCHAR(50) DEFAULT ""');
        aT('`members`', '`notifications`', 'INT UNSIGNED DEFAULT 0');

        aT('`members`', '`role`', 'INT DEFAULT 1') ;

        aT('`members`', '`public`', 'INT DEFAULT 0');
*/
        if(!is_dir("images")){
			mkdir("images", 0777);
		}


	?>
		<br>...done.
	</body>
	
</html>