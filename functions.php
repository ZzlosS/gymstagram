<?php

	$dbhost = 'localhost';
	$dbname = 'gym';
	$dbpass = 'gym';
	$dbuser = 'gym';
	$appname = "Gymstagram";

	$salt1 = "qm&h*";
	$salt2 = "pg!@";

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($connection->connect_error){
        die($connection->connect_error);
	}

	function qM($query){  //queryMysql
		global $connection;
		$result = $connection->query($query);
		if(!$result) die($connection->error);
		return $result;
	}
	
	function cT($name, $query){ //createTable
		qM("CREATE TABLE IF NOT EXISTS $name($query)");
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
		$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
		if($result->num_rows){
			$row = $result->fetch_assoc();
			$id = $row['id'];
			$pic = $row['pic_path'];
			//if(file_exists("images/$id/profile/$id.png")){mozda bas i ne radi kako treba
            if(file_exists("$pic")){
				//echo "<div style='max-height: 100px; max-width: 100px;float:left;'><img style='max-height: 100px; max-width: 100px; height: auto; width: auto;' id='blah' src='$pic' /></div>";
                echo "<div id='blah' style='float: left; height: 100px; width: 100px; background: url(" .$pic. ") no-repeat center; background-size:contain;'></div>";
			}
		}
	}
	
	function dI($pic_id){ //deleteImage
		//$id_$album_name
		$result = qM("SELECT * FROM `pictures` WHERE `id`=$pic_id");
		if($result->num_rows){
			$row = $result->fetch_assoc();
			unlink($row['pic_path']);
			qM("DELETE FROM `pictures` WHERE `id`=$pic_id");
		}
	}
	
	function sI($user_id){  //showImages za trenutnog korisnika
		$result = qM("SELECT * FROM `pictures` WHERE `user_id` = $user_id ORDER BY  `date_update` DESC");
		if($n = $result->num_rows){
			for($j = 0; $j < $n; $j++){
				$row = $result->fetch_array();
				echo "<div class='gallery'>
                        <a rel='gall' class='fancybox' caption='". $row['pic_desc'] ."' href='".$row['pic_path']."'>
                         <img src='".$row['pic_path']."' alt = '' >
                         </a><br><br>";
				echo "<div align='center'><button value='delete' onclick='window.location.href=\" /gallery.php?id=" . $row['id']. "\"'>
                        <i class='icon-trash'></i>
                    </button></div><br></div>";
			}
		}
	}

    function sOI($user_id){  //showOtherImages za ostale korisnike, razlika u delete dugme
        $result = qM("SELECT * FROM `pictures` WHERE `user_id` = $user_id ORDER BY  `date_update` DESC");
        if($n = $result->num_rows){
            for($j = 0; $j < $n; $j++){
                $row = $result->fetch_array();
                echo "<div class='gallery'>
                        <a rel='gall' class='fancybox' caption='". $row['pic_desc'] ."' href='".$row['pic_path']."'>
                         <img src='".$row['pic_path']."' alt = '' >
                         </a>";
                echo "<br></div>";


            }
        }
    }
?>