<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
	require_once 'infoP.php';
echo "<br><br>";
echo $lang['YP'];
echo $lang['YPP'];
sP($email);
?>
        <br>
		<span><?php echo $lang['GName'].": @".$gname?></span><br>
        <span><?php echo $lang['E'].": ".$email?></span><br>
		<span><?php echo $lang['FName'].": ".$name?></span><br>
		<span><?php echo $lang['LName'].": ".$lname?></span><br>
        <span>Gender: <?php echo $gender?></span><br>
        <span>Birth Date: <?php echo $bday2?></span><br>
		<span><?php echo $lang['PInformation'].": ".$info?></span><br>
		<a href="changeP.php"><?php echo $lang['CP']?></a>
	</body>
</html>