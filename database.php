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
				`question1` VARCHAR(30) NOT NULL,
				`question2` VARCHAR(30) NOT NULL,
				PRIMARY KEY(`id`)');
		
		cT('`profile`', 
				'`id` INT UNSIGNED AUTO_INCREMENT,
				`gym_name` VARCHAR(20) DEFAULT "",
				`email` VARCHAR(50) NOT NULL,
				`name` VARCHAR(50) DEFAULT "",
				`last_name` VARCHAR(50) DEFAULT "",
				`information` VARCHAR(4096) DEFAULT "",
				`date_update` DATETIME,
				`pic_path` VARCHAR(50) DEFAULT "",
				PRIMARY KEY(`id`)');
		
		//aT('`profile`', 'gym_name', 'VARCHAR(20) DEFAULT ""');
		
		if(!is_dir("images")){
			mkdir("images", 0777);
		}


	?>
		<br>...done.
	</body>
	
</html>