<?php
	$dbhost = 'localhost';
	$dbname = 'gym';
	$dbpass = 'gym';
	$dbuser = 'gym';
	$appname = "Gymstagram";

	$dbuserR = 'robinsnest';
	$dbpassR = 'rnpassword';
	
	$salt1 = "qm&h*";
	$salt2 = "pg!@";
	
	$connection = new mysqli($dbhost, $dbuserR, $dbpassR, $dbname);
	if($connection->connect_error){
		die($connection->connect_error);
	}
	
	function qM($querry){  //queryMysql
		global $connection;
		$result = $connection->query($querry);
		if(!$result) die($connection->error);
		return $result;
	}
	
	function cT($name, $querry){ //createTable
		qm("CREATE TABLE IF NOT EXISTS $name($querry)");
		echo "Table `$name` created or already exists.<br>";
	}
	
	function aT($name, $column, $type){ //alterTable
		qM("ALTER TABLE $name ADD $column $type");
		echo "Column `$column` added in table $name.<br>";
	}
	
	function sS($var){  //sanitizeString
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		global $connection;
		return $connection->real_escape_string($var);
	}
	
	function dS(){ //destroySession
		$_SESSION = array();
		session_destroy();
	}
	
	function sP($email){ //showProfile
		$result = qM("SELECT * FROM `profile` WHERE `email`='$email'");
		if($result->num_rows){
			$row = $result->fetch_assoc();
			$id = $row['id'];
			if(file_exists("images/$id/profile/$id.jpg")){
				echo "<div style='border: thin solid black; height: 100px; width: 100px;'><img src='images/$id/profile/$id.jpg'></div>";
			}
			echo "<br>";
		}
	}
?>