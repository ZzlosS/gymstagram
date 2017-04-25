<?php
	require_once 'basic.php';
	$email = $pass = $error1 = $error2 = $error3 = '';
	if(isset($_POST['email'])){
		$email = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		if($email == '' || $pass == ''){
			$error1 = $lang['NotAll'];
		}
		else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error2 = $lang['Wrong'];
			}
			else{
				$hpass = hash('ripemd128', "$salt1$pass$salt2");
				$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
				if($result->num_rows == 0){
					$error2 = $lang['NotInUse'];
				}
				else{
					$row = $result->fetch_assoc();
					if($row['pass'] != $hpass){
						$error3 = $lang['PassInvalid'];
					}
					else{
						$id = $row['id'];
						$_SESSION['id'] = $id;
						$_SESSION['email'] = $email;
						die($lang['LoggedIn']);
					}
				}
			}
		}
	}
?>
	
		<form method="post" action="login.php">
			<?php echo $error1 ?>
			<br>
			
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="<?php echo $email ?>" maxlength="40">
			<?php echo $error2 ?>
			<br>
			
			<label class="fieldname" for="pass"><?php echo $lang['Pass']?></label>
			<input type="password" name="pass" id="pass" value="<?php echo $pass ?>" maxlength="16">
			<?php echo $error3 ?>
			<br>
			
			<label class="fieldname">&nbsp;</label>
			<input type="submit" value="<?php echo $lang['Login']?>">
		</form>
	</body>
</html>