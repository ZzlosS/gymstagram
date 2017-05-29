<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
	require_once 'infoP.php';
?>
    <body id="b2">
    <div class="container2">
        <section id="content">
			<form method="post" action="profile.php" enctype="multipart/form-data">
				<h3><?php echo $lang['EditP']?></h3>
				
				<label><?php echo $lang['GName']?>:
		        <input type="text" id="gname" name="gname" value="<?php echo $gname ?>" onBlur="cU(this)"></label>
                <span id="info"><?php echo $error ?></span>
                <br>

                <!--<label><?php echo $lang['E']?>:</label>
                <input type="text" id="email" name="email" value="<?php echo $email ?>"><br>-->

				<label><?php echo $lang['FName']?>:
		        <input type="text" id="name" name="name" value="<?php echo $name ?>"></label><br>
		        
		        <label><?php echo $lang['LName']?>:
		        <input type="text" id="lname" name="lname" value="<?php echo $lname ?>"></label><br>
		        
		        <label for="image"><?php  echo $lang['Image']?>:
				<input type="file" name="image" id="image"></label><br>
				
				<textarea name="info" rows="3" cols="50" placeholder="Info"><?php echo $info ?></textarea><br>
		        <input type="submit" value="<?php echo $lang['SP']?>">
		        <input type="button" value="<?php echo $lang['Cpass']?>" onclick="window.location='passchange.php';" />
		     	
			</form>

    </section><!-- content -->
</div><!-- container -->
</body>
</html>