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
</script>
<?php 
	require_once 'basic.php';
	
	$gname = $email = $pass = $error = $error2 = $alert = '';
	if(isset($_POST['email'])){
		$gname = sS($_POST['gname']);
		$email = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		$question = sS($_POST['question']);
		$question2 = sS($_POST['question2']);
		if($gname == '' || $email == '' || $pass == '' || $question == '' || $question2 == ''){
			$alert = $lang['NotAll'];
			echo "<script type='text/javascript'>alert('$alert')</script>";
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
					qM("INSERT INTO `members`(`gym_name`, `email`, `pass`, `question1`, `question2`) VALUES ('$gname', '$email', '$hpass', '$question', '$question2')");
					qM("INSERT INTO `profile`(`gym_name`, `email`) VALUES ('$gname', '$email')");
					die($lang['AccCreated']);
				}
		}
	}
?>
		<form method="post" action="signup.php">
			
			<h3><?php echo $lang['Registration']?>:</h3>
			<label class="fieldname" for="gname"><?php echo $lang['GName']?></label>
			<input type="text" name="gname" id="gname" value="" maxlength="20">
			<span id="ginfo"><?php echo $error2 ?></span>
			<br>
			
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="" maxlength="40" onBlur="cU(this)">
			<span id="info"><?php echo $error ?></span>
			<br>
			
			<label class="fieldname" for="pass"><?php echo $lang['Pass']?></label>
			<input type="password" name="pass" id="pass" value="" maxlength="16">
		
			
			<h3><?php echo $lang['SQ']?>:</h3>
			<label class="fieldname" for="question"><?php echo $lang['Question']?></label>
			<input type="text" name="question" id="question" value="" maxlength="30">
			<br>
			
			<label class="fieldname" for="question2"><?php echo $lang['Question2']?></label>
			<input type="text" name="question2" id="question2" value="" maxlength="30">
			<br>
			
			<label class="fieldname">&nbsp;</label>
			<input type="submit" value="<?php echo $lang['Signup']?>">
		</form>
	</body>
</html>