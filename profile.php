<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die("<script>location.replace('home.php')</script>");
	require_once 'infoP.php';

?>
<script>
    var following = [
        <?php
        $result2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id");
        while($row = $result2->fetch_assoc()){
            echo  '"'.$row['friend_id'].'",';
        }
        ?>
    ];
    var followers = [
        <?php
        $result2 = qM("SELECT * FROM `gym_buddies` WHERE `friend_id`=$id");
        while($row = $result2->fetch_assoc()){
            echo  '"'.$row['user_id'].'",';
        }
        ?>
    ];
    function follow() {
        $.ajax({
            method: 'POST',
            url: 'infoP.php',
            data: {
                'follow': $('#fol').val()
            }
        });
    }
    function show(sh) {
        if(sh === 1){
            var fol = following;
        }
        else{
            var fol = followers;
        }
        $.ajax({
            method: 'POST',
            url: 'show.php',
            data: {
                'fol': fol
            },
            success: function (res) {
                $('#show').html(res)
            }
        });
    }
</script>
<style>
	a:hover{
		color: #ff6c40;
	}
</style>
<div class="card-wrap">
    <div class="profile_pic-wrap">
        <img id="ppic" src="<?php echo $pic_path;?>" alt="" />
    </div>
    <div class="info-wrap">
        <br>

        <h1 class="user-name"><?php echo "@".$gname?></h1>
        <br>
        <input id="fol" hidden value="<?php echo $fid ?>" />
        <p><?php echo "<b>".$lname." " . $name. "</b>"; ?></p>
        <p><?php echo "<b>".$lang['E'].": </b>".$email; ?></p>
        <p><?php echo "<b>".$lang['Birthday']."</b> ".$bday2;?></p>
        <p><?php echo "<b>".$lang['Gender'].": </b>" .$gender; ?></p>
        <p><?php echo "<b>".$lang['PInformation'].":</b> <br>".$info."";?></p><br>
        <?php if($public == 1 || in_array($fid, $following)){ ?>

        <!-- <nav class="cl-effect-16"> -->
            <p><a href="gallery.php?gn=<?php echo $gname ?>" data-hover="<?php echo $lang['See_Gallery'];?>"><?php echo $lang['See_Gallery'];?></a></p>
            <a href="#" data-hover="<?php echo $foll."(". $num_following?>)" onclick="show(1)"><?php echo $foll ?></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" data-hover="<?php echo $lang['Followers']."(". $num_followers?>)" onclick="show(2)"><?php echo $lang['Followers']; ?> </a>
      <!--  </nav> -->
        <?php } ?>
        <p><a href="javascript:window.location.replace('profile.php?gn=<?php echo $gname ?>');" onclick="follow()" data-hover="<?php echo $fol ?>"><?php echo $fol ?></a></p>
        <div id="show"></div>
    </div>
</div>

	</body>
</html>