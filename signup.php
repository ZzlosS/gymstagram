<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
	$gname = $email = $pass = $error = $error2 = $alert = $redirect = '';
	if(isset($_POST['email'])){
		$gname = sS($_POST['gname']);
		$email = sS($_POST['email']);
		$pass = sS($_POST['pass']);
        $s1 = sS($_POST['s1']);
		$q1 = sS($_POST['q1']);
        $s2 = sS($_POST['s2']);
		$q2 = sS($_POST['q2']);
        $st = sS($_POST['st']);
		if($gname == '' || $email == '' || $pass == '' || $q1 == '' || $q2 == '' || $st == ''){
			$alert = $lang['NotAll'];
			echo "<script type='text/javascript'>alert('$alert')</script>";
		}
		elseif($s1 == 'cq1' || $s2 == 'cq2'){
			echo "<script type='text/javascript'>alert('Please choose a question')</script>";
		}
		else{
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
                qM("INSERT INTO `members`(`gym_name`, `email`, `pass`, `q1_id`, `question1`, `q2_id`, `question2`, `security_text`)
                    VALUES ('$gname', '$email', '$hpass', '$s1', '$q1', '$s2', '$q2', '$st')");
                qM("INSERT INTO `profile`(`gym_name`, `email`) VALUES ('$gname', '$email')");
                qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname created account')");
                $redirect = $lang['AccCreated']."<br>Click <a href='login.php'>here</a> to Log in";
                $ok = true;
                //header( "refresh:5;url=login.php" ); ne radi...
            }
        }
	}
?>
<?php if(!$ok) { ?>
<body id="b2">
    <div class="container2">
        <section id="content">
            <form method="post" action="signup.php">
                <?php echo $redirect ?>
                <h3><?php echo $lang['Registration'] ?>:</h3>
                <input type="text" name="gname" id="gname" value="<?php echo $gname ?>" maxlength="20" onBlur="cU2(this)" placeholder="<?php echo $lang['GName'] ?>"/>
                <span id="ginfo"><?php echo $error2 ?></span>
                <span id="info2"><?php echo $error ?></span>
                <br>

                <input type="text" name="email" id="email" value="<?php echo $email ?>" maxlength="40" onBlur="cU(this)" placeholder="<?php echo $lang['Email'] ?>">
                <span id="info"><?php echo $error ?></span>
                <br>

                <input type="password" name="pass" id="pass" value="" maxlength="30" placeholder="<?php echo $lang['Pass'] ?>">

                <h3><?php echo $lang['SQ'] ?>:</h3>

                <label class="fieldname" for="q1">
                    <select name="s1" id="s1" class="form-control">
                        <option value="cq1">Choose question:</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
                <input type="text" name="q1" id="q1" value="" maxlength="30">
                <br>

                <label class="fieldname" for="q2">
                    <select name="s2" id="s2" class="form-control">
                        <option value="cq2">Choose question:</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
                <input type="text" name="q2" id="q2" value="" maxlength="30">
                <br>
                <h3>Type in something only you know for maximum security</h3>
                <textarea style="resize: none;" name="st" id="st" rows="6" cols="50" placeholder="Type in something only you know for maximum security" maxlength="255"></textarea>
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