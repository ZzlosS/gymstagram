<script>

	//checkUser
	function cU(email){
		if(email.value == ''){
			document.getElementById('info').innerHTML = '';
			return;
		}
		$.ajax({
			method : "POST",
			url : "checkuser.php",
			data : {
					'email' : email.value
				},
			success : function(result){
				document.getElementById('info').innerHTML = result;	
			}
		});
	}
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

<?php
	require_once 'basic.php';
	require_once 'checklanguage.php';
	$ok = false;
	$gname = $date = $checked2 = $name = $q1 = $q2 = $gender = $lname = $email = $pass = $error = $error2 = $alert = $redirect = '';
	$checked = "checked";
	$s1 = "cq1";
	$s2 = "cq2";
	if(isset($_POST['email'])){
		$gname = sS($_POST['gname']);
		$name = sS($_POST['name']);
		$lname = sS($_POST['lname']);
		$email = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		$gender = $_POST['selector'];
		$bday = $_POST['datepicker'];
		$dateObject = DateTime::createFromFormat('d/m/Y', "$bday");
		$s1 = sS($_POST['s1']);
		$q1 = sS($_POST['q1']);
        $s2 = sS($_POST['s2']);
		$q2 = sS($_POST['q2']);
		if($gname == '' || $name == '' || $lname == '' || $email == '' || $pass == '' || $q1 == '' || $q2 == '' || $bday == ''){
			$alert = $lang['NotAll'];
			echo "<script type='text/javascript'>alert('$alert')</script>";
		}
		elseif($dateObject == false){
            echo "<script type='text/javascript'>alert('Wrong date format, please use day/month/Year')</script>";
        }
		elseif($s1 == 'cq1' || $s2 == 'cq2'){
			echo "<script type='text/javascript'>alert('Please choose a question')</script>";
		}
		else{
            $date2 = $dateObject->format("Y-m-d");
            if($gender == '2'){
                $checked = '';
                $checked2 = 'checked';
            }
            $result = qM("SELECT * FROM `members` WHERE `email`='$email'");
            $result2 = qM("SELECT * FROM `members` WHERE `gym_name`='$gname'");
            if($result2->num_rows){
                $error2 = $lang['GUserTaken'];
            }
            elseif($result->num_rows){
                $error = $lang['UserTaken'];
            }
            else{
                $hpass = hash('ripemd128', "$salt1$pass$salt2");
                qM("INSERT INTO `members`(`gym_name`, `name`, `lname`, `gender`, `birth_date`, `email`, `pass`,
                                `q1_id`, `question1`, `q2_id`, `question2`, `pic_path`)
                    VALUES ('$gname', '$name', '$lname', $gender, '$date2', '$email', '$hpass', '$s1', '$q1', '$s2', '$q2', 'img/default_avatar.png')");
                qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname created account')");
                $redirect = $lang['AccCreated']."<br>Click <a href='login.php'>here</a> to Log in";
                $ok = true;
                echo "<script> location.replace('login.php'); </script>";
            }
        }
	}
?>
<?php if(!$ok) { ?>
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
<body id="b2">
    <div class="container2">
        <section id="content2">
            <form method="post" action="signup.php">
                <h1>Sign up Form</h1>
                <?php echo $redirect ?>
                <h3><?php echo $lang['Registration'] ?>:</h3>
                <input type="text" name="gname" id="gname" value="<?php echo $gname ?>" maxlength="20" onBlur="cU2(this)" placeholder="<?php echo $lang['GName'] ?>" autofocus />
                <span id="ginfo"><?php echo $error2 ?></span>
                <span id="info2"><?php echo $error ?></span>
                <br>

                <input type="text" name="name" id="name" value="<?php echo $name ?>" maxlength="20"  placeholder="Name" />
                <br>
                <input type="text" name="lname" id="lname" value="<?php echo $lname ?>" maxlength="20"  placeholder="Last name" />
                <br>

                <input type="text" name="email" id="email" value="<?php echo $email ?>" maxlength="40" onBlur="cU(this)" placeholder="<?php echo $lang['Email'] ?>" />
                <span id="info"><?php echo $error ?></span>
                <br>

                <input type="password" name="pass" id="pass" value="" maxlength="30" placeholder="<?php echo $lang['Pass'] ?>" />
                <br>

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
                <label>Birthday: <br><input class='d_in' name="datepicker" type="text" id="datepicker" maxlength="10" value="<?php echo $date ?>" /></label>
                <br>
                <h3><?php echo $lang['SQ'] ?>:</h3>

                <label class="fieldname" for="q1">
                    <select name="s1" id="s1" class="form-control">
                        <option value="<?php echo $s1?>">Choose question:</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
                <input type="text" name="q1" id="q1" value="<?php echo $q1?>" maxlength="30" />
                <br>

                <label class="fieldname" for="q2">
                    <select name="s2" id="s2" class="form-control">
                        <option value="<?php echo $s2?>">Choose question:</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
                <input class="q2" type="text" name="q2" id="q2" value="<?php echo $q2?>" maxlength="30" />
                <br>

                <input type="submit" value="<?php echo $lang['Signup'] ?>">

            </form>
        </section><!-- content -->
    </div><!-- container -->
    </body>
    <?php
}else{
    echo $redirect;
}
?>

</html>