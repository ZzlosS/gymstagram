<?php
	require_once 'basic.php';
	
	if(!$loggedIn) echo "<script>location.reload();</script>";
	require_once 'infoP.php';

    if(isset($_GET['gn'])){
        $mgn = sS($_GET['gn']);
        $result = qM("SELECT * FROM `members` WHERE `gym_name`='$mgn'");
        if($result->num_rows){
            $row = $result->fetch_array(MYSQL_ASSOC);
            $gname = $row['gym_name'];
            $email = $row['email'];
            $name = $row['name'];
            $lname = $row['lname'];
            $info = $row['information'];
            $bday2 = $row['birth_date'];
        }
        else{
            echo "<script>location.replace('home.php')</script>";
        }
    }
?>

<div class="card-wrap">
    <div class="profile_pic-wrap">
        <img id="ppic" src="<?php echo $pic_path;?>" alt="" />
    </div>
    <div class="info-wrap">
        <br>

        <h1 class="user-name"><?php echo "@".$gname?></h1>
        <br>
        <p><?php echo "<b>".$lname." " . $name. "</b>"; ?></p>
        <p><?php echo "<b>".$lang['E'].": </b>".$email; ?></p>
        <p><?php echo "<b>".$lang['Birthday']."</b> ".$bday2;?></p>
        <p><?php echo "<b>".$lang['Gender'].": </b>" .$gender; ?></p>
        <p><?php echo "<b>".$lang['PInformation'].":</b> <br>".$info."";?></p><br>
        <p><a href="gallery.php?gn=".$gname."><?php echo $lang['See_Gallery'];?></a></p>
    </div>

</div>

	</body>
</html>