<?php
	require_once 'basic.php';
	
	if(!$loggedIn) die();
	require_once 'infoP.php';
?>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            showAnim: "slideDown",
            showOn: "button",
            buttonImage: "img/calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",
            changeMonth: true,
            changeYear: true
        });
    } );
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').css('background-image', 'url('+ e.target.result + ')');
                $('#blah2').css('background-image', 'url(' + e.target.result + ')');
            };

            reader.readAsDataURL(input.files[0]);
        }
    };
    function cU2(gname){
        if(gname.value == ''){
            document.getElementById('info2').innerHTML = '';
            return;
        }
        $.ajax({
            method : "POST",
            url : "checkuser.php",
            data : {
                'gname' : gname.value
            },
            success : function(result){
                document.getElementById('info2').innerHTML = result;
            }
        });
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

                <label for="image" style="float:left; padding-left:18%;">
                    <i style='cursor: pointer;' class='icon-picture icon-2x'></i>
                    <div class="image-upload">
                        <input type='file' onchange="readURL(this);" name="image" id="image"/>
                    </div>
                </label>
                <div id="blah2" style='float:right; height: 100px; width: 100px; background: url("<?php echo $pic ?>") no-repeat center;
                        background-size:contain;'></div>
                <br><br><br><br><br><br><br>
                <div style="float: right; padding-right: 5%;">Chat preview</div><br>
				<h3><?php echo $lang['EditP']?></h3>

                <label>Birthday: <br><input class='d_in' name="datepicker" type="text" id="datepicker" maxlength="10" value="<?php echo $bday2 ?>" /></label>
                <br>
				<label><?php echo $lang['GName']?>:
		        <input type="text" id="gname" name="gname" value="<?php echo $gname ?>" onBlur="cU2(this)"></label>
                <span id="info2"><?php echo $error ?></span>
                <br>

				<label><?php echo $lang['FName']?>:
		        <input type="text" id="name" name="name" value="<?php echo $name ?>"></label><br>
		        
		        <label><?php echo $lang['LName']?>:
		        <input type="text" id="lname" name="lname" value="<?php echo $lname ?>"></label><br>

                <div class="radio">
                    <b>Choose gender:</b>

                    <ul id="s_ul">
                        <li id="s_li">
                            <input type="radio" id="f-option" name="selector" <?php echo $checked ?> value="1"/>
                            <label for="f-option">Male</label>
                            <div class="check"></div>
                        </li>

                        <li id="s_li">
                            <input type="radio" id="s-option" name="selector" <?php echo $checked2 ?> value="2"/>
                            <label for="s-option">Female</label>
                            <div class="check"></div>
                        </li>
                    </ul>
                </div>

                <b>Profile information:</b><br>
                <textarea name="info" rows="3" cols="50" placeholder="Info"><?php echo $info ?></textarea><br>

		        <input type="submit" value="<?php echo $lang['SP']?>">
                <input type="button" value="<?php echo $lang['BT']?>" onclick="window.location='settings.php';" /><br><br>
			</form>

    </section><!-- content -->
</div><!-- container -->
</body>
</html>