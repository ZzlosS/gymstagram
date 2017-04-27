<?php
//Profile information
echo $lang['YP'];


$result = qM("SELECT * FROM `profile` WHERE `email`='$email'");
if($result->num_rows){
	$row = $result->fetch_array(MYSQL_ASSOC);
	$name = $row['name'];
	$lname = $row['last_name'];
	$info = $row['information'];
	$gname = $row['gym_name'];
}
$result2 = qM("SELECT * FROM `members` WHERE `email`='$email'");
if($result2->num_rows){
	$row2 = $result2->fetch_assoc();
	$id = $row2['id'];
}

if(isset($_POST['info'])){
	$info = sS($_POST['info']);
	$info = preg_replace('/\s+/', ' ', $info);
	if($result->num_rows){
		qM("UPDATE `profile` SET `information`='$info' WHERE `email`='$email'");
	}
}

if(isset($_POST['name']) && isset($_POST['lname'])){
	$gname = sS($_POST['gname']);
	$gname = preg_replace('/\s+/', '_', $gname);
	$name = sS($_POST['name']);
	$name = preg_replace("/[^a-zA-Z]+/", "", $name);
	$lname = sS($_POST['lname']);
	$lname = preg_replace("/[^a-zA-Z]+/", "", $lname);
	qM("UPDATE `profile` SET `name`='$name', `last_name`='$lname', `gym_name`='$gname' WHERE `email`='$email'");
	echo "<meta http-equiv='refresh' content='0'>"; //refresuje stranicu
}

if(!is_dir("images/$id")){
	mkdir("images/$id", 0777);
}

if(!is_dir("images/$id/profile")){
	mkdir("images/$id/profile", 0777);
}

if(isset($_FILES['image']['name'])){
	$saveto = "images/$id/profile/".$id.".jpg";
	$date = date("Y-m-d H:i:s");
	move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
	qM("UPDATE `profile` SET `date_update` = '$date', `pic_path` = '$saveto' WHERE `email`='$email'");
	$typeok = TRUE;
	switch ($_FILES['image']['type']){
		case "image/gif":
			$src = imagecreatefromgif($saveto);
			break;
		case "image/jpeg": case "image/pjpeg":
			$src = imagecreatefromjpeg($saveto);
			break;
		case "image/png":
			$src = imagecreatefrompng($saveto);
			break;
		default:
			$typeok = FALSE;
			break;
	}
	if($typeok){
		list($w, $h) = getimagesize($saveto);
		$max = 100;
		$tw = $w;
		$th = $h;//da probam da dodam da se slika centrira u 100x100
		if($w > $h && $w > $max){
			$tw = $max;
			$th = $h * $max / $w;
		}
		elseif($h > $w && $h > $max){
			$th = $max;
			$tw = $max / $h * $w;
		}
		elseif($w > $max){
			$tw = $th = $max;
		}
		$tmp = imagecreatetruecolor($tw, $th);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h); //ovde
		imageconvolution($tmp, array(array(-1, -1, -1),
				array(-1, 16, 1),
				array(-1, -1, -1)), 8, 0);
		imagejpeg($tmp, $saveto);
		imagedestroy($tmp);
		imagedestroy($src);
	}
}
echo $lang['YPP'];
sP($email);
echo "<br>";

?>