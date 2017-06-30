<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die("<script>location.replace('home.php')</script>");
	require_once 'infoP.php';

?>
<script>
    function follow() {
        $.ajax({
            method: 'POST',
            url: 'infoP.php',
            data: {
                'follow': $('#fol').val()
            }
        });
    }
</script>

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
        <?php if($public == 1){ //dal da ima ova provera, jer se u svakom slucaju slike vide na pocetnoj iako nije public?>
        <p><a href="gallery.php?gn=<?php echo $gname ?>"><?php echo $lang['See_Gallery'];?></a></p>
        <?php } ?>
        <p><a href="javascript:window.location.reload();" onclick="follow()"><?php echo $fol ?></a></p>
    </div>

</div>

	</body>
</html>