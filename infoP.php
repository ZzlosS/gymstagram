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
//Profile information
    $error = $checked2 = $checked = "";
    $result = qM("SELECT * FROM `members` WHERE `email`='$email'");

    if($result->num_rows){
        $row = $result->fetch_array(MYSQL_ASSOC);
        $name = $row['name'];
        $lname = $row['lname'];
        $info = $row['information'];
        $gname = $row['gym_name'];
        $pic_path = $row['pic_path'];
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
        $bday = $row['birth_date'];
        $dateObject = DateTime::createFromFormat('Y-m-d', $bday);
        $bday2 = $dateObject->format('d/m/Y');
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
        echo "<meta http-equiv='refresh' content='0'>"; //refresuje stranicu
    }

    if(isset($_POST['selector'])){
        $gender = $_POST['selector'];
        qM("UPDATE `members` SET `gender`='$gender' WHERE `email`='$email'");
    }

    if(isset($_POST['datepicker'])){
        $bday = $_POST['datepicker'];
        $dateObject = DateTime::createFromFormat('d/m/Y', "$bday");
        if($dateObject == false){
            echo "<script type='text/javascript'>alert('Wrong date format, please use day/month/Year')</script>";
        }
        else{
            qM("UPDATE `members` SET `gender`='$gender' WHERE `email`='$email'");
        }
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
            /*imageconvolution($tmp, array(array(-1, -1, -1),
                    array(-1, 16, 1),
                    array(-1, -1, -1)), 8, 0);
        */
            imagepng($tmp, $saveto);
            imagedestroy($tmp);
            imagedestroy($src);
        }
    }


    //add,delete,revoke,decline,accept


    if(isset($_GET['accept'])){
        $accept = sS($_GET['accept']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$accept AND `friend_id`=$id");
        if(!$result->num_rows){
            qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($accept, $id)");

            //uzima ime prijatelja da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$accept");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) is now friend with $aname($accept)')");

            $result = qM("SELECT `notifications` FROM `members` WHERE `id`='$id'");
            if($result->num_rows){
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] - 1;
                qM("UPDATE `members` SET `notifications`=$notification WHERE `id`=$id");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    if(isset($_GET['add'])){
        $add = sS($_GET['add']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$add AND `friend_id`=$id");
        if(!$result->num_rows){
            qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($add, $id)");

            //uzima ime prijatelja da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$add");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) wants to be friend with $aname($add)')");

            $result = qM("SELECT `notifications` FROM `members` WHERE `id`='$add'");
            if($result->num_rows){
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] + 1;
                qM("UPDATE `members` SET `notifications`=$notification WHERE `id`=$add");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    if(isset($_GET['revoke'])){
        $revoke = sS($_GET['revoke']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$revoke AND `friend_id`=$id");
        if($result->num_rows){
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$revoke AND `friend_id`=$id");

            //uzima ime prijatelja da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$revoke");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) revoked friend request for $aname($revoke)')");

            $result = qM("SELECT `notifications` FROM `members` WHERE `id`='$revoke'");
            if($result->num_rows){
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] - 1;
                qM("UPDATE `members` SET `notifications`=$notification WHERE `id`=$revoke");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    if(isset($_GET['decline'])){
        $decline = sS($_GET['decline']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");
        if($result->num_rows) {
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");

            //uzima ime prijatelja da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$decline");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) declined friend request from $aname($decline)')");

            $result = qM("SELECT `notifications` FROM `members` WHERE `id`='$id'");
            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] - 1;
                qM("UPDATE `members` SET `notifications`=$notification WHERE `id`=$id");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    if(isset($_GET['delete'])){
        $delete = sS($_GET['delete']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$delete");
        $result2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$delete AND `friend_id`=$id");
        if($result->num_rows && $result2->num_rows){
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$delete");
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$delete AND `friend_id`=$id");

            //uzima ime prijatelja da bi upisalo u log
            $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$delete");
            $row3 = $result3->fetch_assoc();
            $aname = $row3['gym_name'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) and $aname($delete) are no longer friends')");
        }
    }

?>