<?php
require_once 'basic.php';
if(!$loggedIn) die();

$result5 = qM("SELECT * FROM `pictures` WHERE `user_id`=$id");
if($result5->num_rows){
    $row4 = $result5->fetch_assoc();
    $pic_id = $row4['id'];
    $user_id = $row4['user_id'];
    $album_name = $row4['album_name'];
    $pic_desc = $row4['pic_desc'];
    $pic_like = $row4['pic_like'];
}

//da prevedem
?>

<div class="main">
    <!--  <div align="center"> <h3> <?php echo $lang['Your_Gallery']; ?></h3> </div>-->
    <?php
    if(!is_dir("images/$id/album")){
        mkdir("images/$id/album", 0777);
    }

    if(isset($_POST['sub_album_name'])){
        $sub_album_name = sS($_POST['sub_album_name']);
        if($sub_album_name == '' || $sub_album_name == 'default'){
            $sub_album_name = 'Default';
        }
    }

    if(isset($_POST['desc'])){
        $desc = sS($_POST['desc']);
    }

    if(isset($_FILES['image']['name'])){
        /*$result = qM("SELECT * FROM `pictures`");
        if(($n = $result->num_rows) == 0){
            $pic_name = 1;
        }
        else{
            $b = qM("SELECT MAX(id) FROM `pictures`");
            $c = $b->fetch_all();
            $pic_name = $c + 1;
        }*/
        $name = date("YmdHis");
        $saveto = "images/$id/album/".$name.".jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
        qM("INSERT INTO `pictures`(`user_id`, `date_update`, `pic_path`, `album_name`, `pic_desc`) 
                              VALUES('$id', '$date', '$saveto', '$sub_album_name', '$desc')");
        qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname($id) added picture $desc')");
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
            $max = 500;
            $tw = $w;
            $th = $h;
            $x1 = $x2 = 0;
            if($w > $h && $w > $max){
                $tw = $max;
                $th = $h * $max / $w;
                $x1 = $max/2 - $tw/2;
                $x2 = $max/2 - $th/2;
            }
            elseif($h > $w && $h > $max){
                $th = $max;
                $tw = $max / $h * $w;
                $x1 = $max/2 - $tw/2;
                $x2 = $max/2 - $th/2;
            }
            elseif($w > $max){
                $tw = $th = $max;
                $x1 = $max/2 - $tw/2;
                $x2 = $max/2 - $th/2;
            }
            $x1 = $max/2 - $tw/2;
            $x2 = $max/2 - $th/2;
            $tmp = imagecreatetruecolor($max, $max);
            imagesavealpha($tmp, true);
            $color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $color);

            imagecopyresampled($tmp, $src, $x1, $x2, 0, 0, $tw, $th, $w, $h);

            imagepng($tmp, $saveto);
            imagedestroy($tmp);
            imagedestroy($src);
        }
    }
    if(isset($_GET['id'])){
        dI($_GET['id']);
        qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname($id) deleted picture $pic_desc')");
    }


    ?>
</div>
    <style>


        @import url(https://fonts.googleapis.com/css?family=Raleway:100,200,300);
        html {

            background-size: cover;
        }

        * {
            box-sizing: border-box;
        }

        .ppic {
            width: 100%;
        }

        .card-wrap {
            width: 400px;
            margin: 80px auto;
            background: #e3e3e3;
            position: relative;
            padding: 20px;
            border-radius: 5px;
            font-family: 'Raleway', sans-serif;
        }

        .profile_pic-wrap {
            width: 100px;
            height: 100px;
            background: #e3e3e3;
            top: 0;
            left: 50%;
            padding: 5px;
            position: absolute;
            margin-left: -50px;
            top: -50px;
            border-radius: 50%;
            overflow: hidden;
        }
        .profile_pic-wrap img {
            border-radius: 50%;
        }

        .user-name {
            text-align: center;
            margin-top: 28px;
        }


        .info-wrap {
            text-align: center;

        }

        .icon-wrap a {
            line-height: 70px;
            width: 24%;
            text-decoration: none;
            padding: 0;
            font-size: 2em;
            cursor: pointer;
            margin: 0;
            color: #b0b0b0;
            transition: color .1s linear;
        }
        .icon-wrap a:hover {
            color: #7d7d7d;
        }


         div.gallery {
             margin: 5px;
             border: 1px solid #ccc;
             float: left;
             width: 180px;
         }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

    </style>


    <div class="card-wrap">
        <div class="info-wrap">
            <form method="post" action="gallery.php" enctype="multipart/form-data" >

                <label for="image"><h3><?php echo $lang['Add_image']; ?></h3></label><br><br>
                <div align="center"> <input type="file" name="image" id="image"></div><br>

                <label><?php echo $lang['Create_album'];?>
                    <select name="owner">
                        <?php
                        $sql = qM("SELECT DISTINCT `album_name` FROM `pictures` WHERE `user_id`=$id");
                        echo "<option value='default'>". $lang['Default']." </option>";
                        while ($row = $sql->fetch_assoc()) {
                            $an = $row['album_name'];
                            if($an != 'Default'){
                                echo "<option value=$an>" . $an . "</option>";
                            }

                        }
                        ?>
                    </select>,<br><?php echo $lang['contrary']; ?></label><br><br>
                <label><?php echo $lang['Album_name']; ?> <input type="text" name="sub_album_name" id="sub_album_name"></label> <br><br>
                <label><?php echo $lang['Description']; ?> <input type="text" name="desc" id="desc"></label> <br><br>
                <input type="submit" value="Save Profile">
            </form>
        </div>
    </div><br>
<?php sI($id); ?>
</body>
</html>