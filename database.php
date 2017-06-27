<!DOCTYPE html>
<html>

<head>
<title>Setting up database</title>
</head>

<body>
<h3>Setting up...</h3>
	<?php
		require_once 'functions.php'; 
		
		cT('`members`', 
				'`id` INT UNSIGNED AUTO_INCREMENT,
				`gym_name` VARCHAR(20) DEFAULT "",
				`email` VARCHAR(50) NOT NULL,
				`pass` VARCHAR(50) NOT NULL,
				`q1_id` VARCHAR(10) DEFAULT "",
				`question1` VARCHAR(30) NOT NULL,
				`q2_id` VARCHAR(10) DEFAULT "",
				`question2` VARCHAR(30) NOT NULL,
				PRIMARY KEY(`id`)');
/*		
		cT('`profile`', 
				'`id` INT UNSIGNED AUTO_INCREMENT,
				`gym_name` VARCHAR(20) DEFAULT "",
				`email` VARCHAR(50) NOT NULL,
				`name` VARCHAR(50) DEFAULT "",
				`last_name` VARCHAR(50) DEFAULT "",
				`information` VARCHAR(4096) DEFAULT "",
				`date_update` DATETIME,
				`pic_path` VARCHAR(50) DEFAULT "",
				`notifications` INT UNSIGNED DEFAULT 0,
				PRIMARY KEY(`id`)');
	*/
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
				`pic_like` INT DEFAULT 0,
				`pic_desc` VARCHAR(255) DEFAULT "",
				`album_name` VARCHAR(20) NOT NULL,
				PRIMARY KEY(`id`),
				FOREIGN KEY(`user_id`) REFERENCES `members`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION');

		cT('`log`','
		        `id` INT UNSIGNED AUTO_INCREMENT,
		        `date` DATETIME,
		        `msg` VARCHAR(255),
		        PRIMARY KEY(`id`)');

		aT('`members`', '`name`', 'VARCHAR(46) DEFAULT ""') ;
        aT('`members`', '`lname`', 'VARCHAR(46) DEFAULT ""') ;
        aT('`members`', '`gender`', 'INT DEFAULT 1') ;
        aT('`members`', '`birth_date`', 'DATE');

        aT('`members`', '`information`', 'VARCHAR(4096) DEFAULT ""');
        aT('`members`', '`pic_date`', 'DATETIME');
        aT('`members`', '`pic_path`', 'VARCHAR(50) DEFAULT ""');
        aT('`members`', '`notifications`', 'INT UNSIGNED DEFAULT 0');

        if(!is_dir("images")){
			mkdir("images", 0777);
		}


	?>
		<br>...done.
	</body>
	
</html>