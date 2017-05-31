<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    //checkUser
    function cU(gname){
        if(gname.value == ''){
            document.getElementById('info').innerHTML = '';
            return;
        }
        $.ajax({
            method : "POST",
            url : "checkuser.php",
            data : {
                'gname' : gname.value
            },
            success : function(result){
                document.getElementById('info').innerHTML = result + "";
            }
        });
    }
</script>


<?php
//Profile information
$error = "";
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

$result5 = qM("SELECT * FROM `pictures` WHERE `user_id`=$id");
if($result5->num_rows){
	$row4 = $result5->fetch_assoc();
	$album_id = $row4['id'];
	$user_id = $row4['user_id'];
	$album_name = $row4['album_name'];
	$pic_desc = $row4['pic_desc'];
	$pic_like = $row4['pic_like'];
}

if(isset($_POST['info'])){
	$info = sS($_POST['info']);
	$info = preg_replace('/\s+/', ' ', $info);
	if($result->num_rows){
		qM("UPDATE `profile` SET `information`='$info' WHERE `email`='$email'");
		qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has updated information')");
	}
}

if(isset($_POST['name']) && isset($_POST['lname'])){
	$ngname = sS($_POST['gname']);
	$ngname = preg_replace('/\s+/', '_', $ngname);
	$name = sS($_POST['name']);
	$name = preg_replace("/[^a-zA-Z]+/", "", $name);
	$lname = sS($_POST['lname']);
	$lname = preg_replace("/[^a-zA-Z]+/", "", $lname);
	qM("UPDATE `profile` SET `name`='$name', `last_name`='$lname', `gym_name`='$ngname' WHERE `email`='$email'");
    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has new credetials: gname=$ngname, name=$name, lname=$lname')");
	echo "<meta http-equiv='refresh' content='0'>"; //refresuje stranicu
}

if(!is_dir("images/$id")){
	mkdir("images/$id", 0777);
}

if(!is_dir("images/$id/profile")){
	mkdir("images/$id/profile", 0777);
}

if(isset($_FILES['image']['name'])){
	$saveto = "images/$id/profile/".$id.".png";
	$date = date("Y-m-d H:i:s");
	move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
	qM("UPDATE `profile` SET `date_update` = '$date', `pic_path` = '$saveto' WHERE `email`='$email'");
    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has updated profile picture')");
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
		$th = $h;
		$x1 = $x2 = 0;//-
		if($w > $h && $w > $max){
			$tw = $max;
			$th = $h * $max / $w;
			$x1 = $max/2 - $tw/2;//-
			$x2 = $max/2 - $th/2;//-
		}
		elseif($h > $w && $h > $max){
			$th = $max;
			$tw = $max / $h * $w;
			$x1 = $max/2 - $tw/2;//-
			$x2 = $max/2 - $th/2;//-
		}
		elseif($w > $max){
			$tw = $th = $max;
			$x1 = $max/2 - $tw/2;//-
			$x2 = $max/2 - $th/2;//-
		}
		$x1 = $max/2 - $tw/2;//-
		$x2 = $max/2 - $th/2;//-
		$tmp = imagecreatetruecolor($max, $max); //$tw, $th

        //pravi providnu pozadinu
        imagesavealpha($tmp, true);
        $color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
        imagefill($tmp, 0, 0, $color);


		//$white = imagecolorallocate($tmp, 255, 255, 255);//boji u belo
		//imagefill($tmp, 0, 0, $white);//boji u belo
		imagecopyresampled($tmp, $src, $x1, $x2, 0, 0, $tw, $th, $w, $h);
		imageconvolution($tmp, array(array(-1, -1, -1),
				array(-1, 16, 1),
				array(-1, -1, -1)), 8, 0);
	
		imagepng($tmp, $saveto);
		imagedestroy($tmp);
		imagedestroy($src);
	}
}
?>