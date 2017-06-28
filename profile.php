<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
	require_once 'infoP.php';

// echo $lang['YP'];
// echo $lang['YPP'];
// sP($email);
?>
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
        border-top: 33.33333px solid #ff6c40;
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
</style>

        <!--
		<span><?php echo $lang['GName'].": @".$gname?></span><br>
        <span><?php echo $lang['E'].": ".$email?></span><br>
		<span><?php echo $lang['FName'].": ".$name?></span><br>
		<span><?php echo $lang['LName'].": ".$lname?></span><br>
        <span><?php echo $lang['Gender'].":" .$gender?></span><br>
        <span> <?php echo $lang['Birthday']." ".$bday2;?></span><br>
		<span><?php echo $lang['PInformation'].": ".$info;?></span><br>
        -->
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
        <p><a href="gallery.php"><?php echo $lang['See_Gallery'];?></a></p>
    </div>

</div>

	</body>
</html>