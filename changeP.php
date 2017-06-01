<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
	require_once 'infoP.php';
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
                $('#blah2')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

    <body id="b2">
    <div class="container2">
        <section id="content2">
			<form method="post" action="profile.php" enctype="multipart/form-data">

                <?php
                echo "<br><br>";
                echo $lang['YP'];
                sP($email);
                //ajax funkciji da se proslede visina i sirina slike pa da se tek onda promeni inace samo da je smanji na 100x100
                //ili samo da bude dugme za resize i onda da se skalira  a po defaultu na 100x100
                ?>

                <label for="image" style="float:left; padding-left:20%;">
                    <i style='cursor: pointer;' class='icon-picture icon-large'></i>
                    <div class="image-upload">
                        <input type='file' onchange="readURL(this);" name="image" id="image"/>
                    </div>
                </label>
                <div style="float:right">
                    <img id="blah2" src="<?php echo $pic ?>" /><br>
                    Chat preview
                </div>
                <br><br><br><br><br><br><br><br>
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


				
				<textarea name="info" rows="3" cols="50" placeholder="Info"><?php echo $info ?></textarea><br>
		        <input type="submit" value="<?php echo $lang['SP']?>">
		        <input type="button" value="<?php echo $lang['Cpass']?>" onclick="window.location='passchange.php';" />
		     	
			</form>

    </section><!-- content -->
</div><!-- container -->
</body>
</html>