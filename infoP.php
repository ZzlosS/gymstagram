<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
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
    require_once 'functions.php';
    require_once 'basic.php';
    if(!$loggedIn) die("<script>location.replace('home.php')</script>");

//Profile information
    $error = $checked2 = $checked = $yes = $no = "";
    $result = qM("SELECT * FROM `members` WHERE `email`='$email'");
    if($result->num_rows){
        $row = $result->fetch_array(MYSQL_ASSOC);
        $name = $row['name'];
        $lname = $row['lname'];
        $info = $row['information'];
        $gname = $row['gym_name'];
        $pic_path = $row['pic_path'];
        $public = $row['public'];
        $id = $row['id'];
        if($row['gender'] == 1){
            $gender = $lang['Male'];
            $checked = 'checked';
            $checked2 = '';
        }
        else{
            $gender = $lang['Female'];
            $checked = '';
            $checked2 = 'checked';
        }
        if($public == 0){
            $yes = '';
            $no = 'checked';
        }
        else{
            $yes = 'checked';
            $no = '';
        }

        $bday = $row['birth_date'];
        $dateObject = DateTime::createFromFormat('Y-m-d', $bday);
        $bday2 = $dateObject->format('d/m/Y');
    }

    $result5 = qM("SELECT * FROM `pictures` WHERE `user_id`=$id");
    if($result5->num_rows){
        $row4 = $result5->fetch_assoc();
        $album_id = $row4['id'];
        $user_id = $row4['user_id'];
        $pic_desc = $row4['pic_desc'];
        $pic_like = $row4['pic_like'];
    }


    if(isset($_POST['info'])){
        $info = sS($_POST['info']);
        $info = preg_replace('/\s+/', ' ', $info);
        if($result->num_rows){
            qM("UPDATE `members` SET `information`='$info' WHERE `email`='$email'");
        }
    }

    if(isset($_POST['name']) && isset($_POST['lname'])){
        $ngname = sS($_POST['gname']);
        $ngname = preg_replace('/\s+/', '_', $ngname);
        $name = sS($_POST['name']);
        $name = preg_replace("/[^a-zA-Z]+/", "", $name);
        $lname = sS($_POST['lname']);
        $lname = preg_replace("/[^a-zA-Z]+/", "", $lname);
        qM("UPDATE `members` SET `name`='$name', `lname`='$lname', `gym_name`='$ngname' WHERE `email`='$email'");
        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has updated profile information')");
        //echo "<meta http-equiv='refresh' content='0'>"; //refresuje stranicu
    }

    if(isset($_POST['selector'])){
        $gender = $_POST['selector'];
        qM("UPDATE `members` SET `gender`='$gender' WHERE `email`='$email'");
    }

    if(isset($_POST['selector2'])){
        $public = $_POST['selector2'];
        qM("UPDATE `members` SET `public`=$public WHERE `email`='$email'");
    }

    if(isset($_POST['datepicker'])){
        $bday = $_POST['datepicker'];
        $dateObject = DateTime::createFromFormat('d/m/Y', "$bday");
        $bday2 = $dateObject->format('Y-m-d');
        if($dateObject == false){
            echo "<script type='text/javascript'>alert('Wrong date format, please use day/month/Year')</script>";
        }
        else{
            qM("UPDATE `members` SET `birth_date`='$bday2' WHERE `email`='$email'");
        }
    }



    $fol = $lang['Follow'];
    if(isset($_GET['gn'])){ //ako je to setovano znaci da nisi na svom profilu
        $mgn = sS($_GET['gn']);
        $result = qM("SELECT * FROM `members` WHERE `gym_name`='$mgn'");
        if($result->num_rows){
            $row = $result->fetch_array(MYSQL_ASSOC);
            $fid = $row['id'];
            $gname = $row['gym_name'];
            $email = $row['email'];
            $name = $row['name'];
            $lname = $row['lname'];
            $info = $row['information'];
            $bday2 = $row['birth_date'];
            $public = $row['public'];
            $pic_path = $row['pic_path'];
            if(in_array($fid, $following)){
                $fol = $lang['Unfollow'];
            }
            $foll = $lang['Following2']; //da pise Prati a ne Pratis
        }
        else{
            echo "<script>location.replace('home.php')</script>";
        }
    }
    else{ //ovde ulazi ako si na svom profilu
        $public = 1; //sam sebi postavi profil na public da bi mogao da ga vidi
        $fol = '';
        $fid = '';
        $foll = $lang['Following'];
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
        qM("UPDATE `members` SET `pic_date` = '$date', `pic_path` = '$saveto' WHERE `email`='$email'");
        $typeok = TRUE;
        switch ($_FILES['image']['type']){
            case "image/gif":
                $src = imagecreatefromgif($saveto);
                break;
            case "image/jpeg":
            case "image/pjpeg":
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


            imagesavealpha($tmp, true);
            $color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $color);

            imagecopyresampled($tmp, $src, $x1, $x2, 0, 0, $tw, $th, $w, $h);

            imagepng($tmp, $saveto);
            imagedestroy($tmp);
            imagedestroy($src);
        }
    }



    if(isset($_POST['follow'])){
        $follow = $_POST['follow'];
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$follow");
        if(!$result->num_rows){

            qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($id, $follow)");

            //uzima ime onoga kog pratis da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$follow");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) is now following $aname($follow)')");
        }
        else{
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$follow");
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) is no longer following $aname($follow)')");
        }
    }

?>