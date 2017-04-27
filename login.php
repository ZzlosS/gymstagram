<?php
	require_once 'basic.php';
	$email = $pass = $error1 = $error2 = $error3 = '';
	if(isset($_POST['email'])){
		$email = sS($_POST['email']);
		$gname = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		if($gname == '' || $email == '' || $pass == ''){
			$error1 = $lang['NotAll'];
		}
		else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//ako je lose uneta sifra onda je gym_name uneto
				$result2 = qM("SELECT * FROM `members` WHERE `gym_name`='$gname'");
				$row2 = $result2->fetch_assoc();
				$email = $row2['email'];
				$hpass = hash('ripemd128', "$salt1$pass$salt2");
				$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
				if($result->num_rows == 0){
					$error2 = $lang['GNotInUse'];
				}
				else{
					$row = $result->fetch_assoc();
					if($row['pass'] != $hpass){
						$error3 = $lang['PassInvalid'];
						$email = $gname;//da ne ispise email adresu u polju
					}
					else{
						$id = $row['id'];
						$_SESSION['id'] = $id;
						$_SESSION['email'] = $email;
						//die($lang['LoggedIn']);
						header('Location: profile.php');
					}
				}
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
						//die($lang['LoggedIn']);
						header('Location: profile.php');
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
			<input type="password" name="pass" id="pass" value="<?php echo $pass ?>" maxlength="30">
			<?php echo $error3 ?>
			<br>
			
			<a href="passchange.php"><?php echo $lang['FPass']?></a><br>
			
			<input type="submit" value="<?php echo $lang['Login']?>">
		</form>
	</body>
</html>