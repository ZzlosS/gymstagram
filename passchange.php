<?php
require_once 'checklanguage.php';
require_once 'functions.php';
require_once 'basic.php';

if($loggedIn){
	$loc = "changeP.php";
}
else{
	$loc = "login.php";
}
		
$error = $email = $question = $question2 = $npass = $rnpass = $done = $changed = $redirect = '';
if(isset($_POST['email'])){
	$email = sS($_POST['email']);
	$question = sS($_POST['question']);
	$question2 = sS($_POST['question2']);
	if($email == '' || $question == '' || $question2 == ''){
		$alert = $lang['NotAll'];
		echo "<script type='text/javascript'>alert('$alert')</script>";
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = $lang['Wrong'];
	}
	else{
		$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
		$row = $result->fetch_assoc();
		$gname = $row['gym_name'];
		$id = $row['id'];
		if($question == $row['question1'] && $question2 == $row['question2']){
			if(isset($_POST['npass']) && isset($_POST['rnpass'])){
				$npass = $_POST['npass'];
				$rnpass = $_POST['rnpass'];
				$hpass = hash('ripemd128', "$salt1$npass$salt2");
				if($hpass == $row['pass']){
					$alert2 = $lang['OldNew'];
					echo "<script type='text/javascript'>alert('$alert2')</script>";
				}
				else{
					if($npass != $rnpass){
						$alert3 = $lang['NotAllS'];
						echo "<script type='text/javascript'>alert('$alert3')</script>";
					}
					else{
						$hpass = hash('ripemd128', "$salt1$npass$salt2");
						qM("UPDATE `members` SET `pass`='$hpass' WHERE `email`='$email'");
                        qM("INSERT INTO `log`(`date`, `msg`) VALUES('$date', '$gname($id) changed his password')");
						$changed = "<h3>".$lang['PassChanged']."</h3>";//."<a href='login.php'>".$lang['here']."</a>.";
                        $redirect = "If you are not redirected automaticly in 5 seconds click this <a href='login.php'>link</a>";
                        header( "refresh:5;url=login.php" );
					}
				}

			}
		}
		else{
			$alert4 = $lang['NotAllC'];
			echo "<script type='text/javascript'>alert('$alert4')</script>";
		}

	}
}

?>

<html>
	<body>
		<form method="post" action="">
			
			<h3><?php echo $lang['PC1']?></h3>
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="<?php echo $email?>" maxlength="40">
			<span id="ginfo"><?php echo $error ?></span>
			<br>

			<label class="fieldname" for="question"><?php echo $lang['Question']?></label>
			<input type="text" name="question" id="question" value="<?php echo $question?>" maxlength="30">
			<br>
			
			<label class="fieldname" for="question2"><?php echo $lang['Question2']?></label>
			<input type="text" name="question2" id="question2" value="<?php echo $question2?>" maxlength="30" >

			<h3><?php echo $lang['PC2']?></h3>
			<label class="fieldname" for="npass"><?php echo $lang['NPass']?>:</label>
			<input type="password" name="npass" id="npass" value="" maxlength="30" ><br>
			
			<label class="fieldname" for="rnpass"><?php echo $lang['RNPass']?>:</label>
			<input type="password" name="rnpass" id="rnpass" value="" maxlength="30"><br>
			
			<input type="submit" value="<?php echo $lang['Confirm']?>">
			<input type="button" value="<?php echo $lang['BT']?>" onclick="window.location='<?php echo $loc?>';" /><br><br>
			
			<?php echo $changed, $redirect?>
		</form>

	</body>
</html>