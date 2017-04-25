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
	
	$email = $pass = $error = '';
	if(isset($_POST['email'])){
		$email = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		$question = sS($_POST['question']);
		if($email == '' || $pass == '' || $question == ''){
			$error = $lang['NotAll'];
		}
		else{
			$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
			if($result->num_rows){
				$error = $lang['UserTaken']."<br><br>";
			}
			else{
				$hpass = hash('ripemd128', "$salt1$pass$salt2");
				qM("INSERT INTO `members`(`email`,`pass`, `question1`) VALUES ('$email', '$hpass', '$question')");
				qM("INSERT INTO `profile`(`email`) VALUES ('$email')");
				die($lang['AccCreated']);
			}
		}
	}
?>
		<form method="post" action="signup.php">
			
			<br>
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="" maxlength="40" onBlur="cU(this)">
			<span id="info"><?php echo $error ?></span>
			<br>
			
			<label class="fieldname" for="pass"><?php echo $lang['Pass']?></label>
			<input type="password" name="pass" id="pass" value="" maxlength="16">
			<br>
			
			<label class="fieldname" for="question"><?php echo $lang['Question']?></label>
			<input type="text" name="question" id="question" value="" maxlength="30">
			<br>
			
			<label class="fieldname">&nbsp;</label>
			<input type="submit" value="<?php echo $lang['Signup']?>">
		</form>
	</body>
</html>