<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
?>
<div class="main">
<?php
	require_once 'infoP.php';
?>
			<form method="post" action="profile.php" enctype="multipart/form-data">
				<h3><?php echo $lang['EditP']?></h3>
				
				<label><?php echo $lang['FName']?>:</label>
		        <input type="text" id="name" name = "name" value="<?php echo $name ?>"><br>
		        
		        <label><?php echo $lang['LName']?>:</label>
		        <input type="text" id="lname" name="lname" value="<?php echo $lname ?>"><br>
		        
		        <label for="image"><?php  echo $lang['Image']?>:</label>
				<input type="file" name="image" id="image"><br>
				
				<textarea name="info" rows="3" cols="50" placeholder="Info"><?php echo $info ?></textarea><br>
		        <input type="submit" value="<?php echo $lang['SP']?>">
			</form>
		</div>
	</body>
</html>