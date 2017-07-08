<?php
require_once 'basic.php';
if(!$loggedIn) die("<script>location.replace('home.php')</script>");

    $show = true;
    if(isset($_GET['gn'])){
        $gn = $_GET['gn'];
        if($gn != $gname){
            $res = qM("SELECT id,gym_name FROM `members` WHERE `gym_name`='$gn'");
            $row = $res->fetch_assoc();
            $id = $row['id'];
            $gname = $row['gym_name'];
            $n = $lang['ova']." ".$lang['See_Gallery'];
            $show = false;
        }
    }
    $result5 = qM("SELECT * FROM `pictures` WHERE `user_id`=$id");
    if($result5->num_rows){
        $row4 = $result5->fetch_assoc();
        $pic_id = $row4['id'];
        $user_id = $row4['user_id'];
        $album_name = $row4['album_name'];
        $pic_desc = $row4['pic_desc'];
        $pic_like = $row4['pic_like'];
    }
?>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="fancybox-2.1.7/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.7"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
    $(".fancybox")
        .attr('rel', 'gall')
        .fancybox({
            beforeShow: function a() {
                /* Disable right click */
                $.fancybox.wrap.bind("contextmenu", function a(e) {
                    return false;
                });
            },
            beforeLoad: function() {
                this.title = $(this.element).attr('caption');
            },
            padding : 0,
            helpers : {
                overlay : {
                    css : {
                        'background' : 'rgba(58, 42, 45, 0.95)'
                    }
                }
            }
        });
</script>
<div class="main">
    <!--  <div align="center"> <h3> <?php echo $lang['Your_Gallery']; ?></h3> </div>-->
    <?php
    if(!is_dir("images/$id/album")){
        mkdir("images/$id/album", 0777);
    }

    if(isset($_POST['desc'])){
        $desc = sS($_POST['desc']);
    }

    if(isset($_FILES['image']['name'])) {
        echo $_FILES['image']['size'];
        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            echo "Greska";
            //die("<script>alert('Slika je prevelika.')</script>");
        } else {
            $name = date("YmdHis");
            $saveto = "images/$id/album/" . $name . ".jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
            qM("INSERT INTO `pictures`(`user_id`, `date_update`, `pic_path`, `pic_desc`) 
                              VALUES('$id', '$date', '$saveto', '$desc')");
            qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname($id) added picture $desc')");
            $typeok = TRUE;
            switch ($_FILES['image']['type']) {
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
            if ($typeok) {
                list($w, $h) = getimagesize($saveto);
                $max = 500;
                $tw = $w;
                $th = $h;
                $x1 = $x2 = 0;
                if ($w > $h && $w > $max) {
                    $tw = $max;
                    $th = $h * $max / $w;
                    $x1 = $max / 2 - $tw / 2;
                    $x2 = $max / 2 - $th / 2;
                } elseif ($h > $w && $h > $max) {
                    $th = $max;
                    $tw = $max / $h * $w;
                    $x1 = $max / 2 - $tw / 2;
                    $x2 = $max / 2 - $th / 2;
                } elseif ($w > $max) {
                    $tw = $th = $max;
                    $x1 = $max / 2 - $tw / 2;
                    $x2 = $max / 2 - $th / 2;
                }
                $x1 = $max / 2 - $tw / 2;
                $x2 = $max / 2 - $th / 2;
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
    }
    if(isset($_GET['id'])){
        dI($_GET['id']);
        qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname($id) deleted picture $pic_desc')");
    }


    ?>
</div>
    <style>

         div.gallery {
             margin: 5px;
             float: left;
             width: 180px;
         }

        div.gallery:hover {
            border: 1px solid #FF6C40;
            border-radius: 2%;
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

<?php if($show){?>
    <div class="card-wrap">
        <div class="info-wrap">
            <form method="post" action="gallery.php" enctype="multipart/form-data" >

                <label for="image"><h3><?php echo $lang['Add_image']; ?></h3></label><br><br>
                <div align="center"> <input type="file" name="image" id="image"></div><br>
                <p><?php echo $lang['Size']?></p><br>
                <label><?php echo $lang['Description']; ?> <input type="text" name="desc" id="desc"></label> <br><br>
                <input type="submit" value="Save Profile">
            </form>
        </div>
    </div><br>
<?php sI($id); }
else{
    echo "<br><br>";
    echo "<h3 align='center'><a href='profile.php?gn=".$gname."'>@$gname</a>$n</h3>";
    sOI($id);
}?>
</body>
</html>