<?php
require_once 'checklanguage.php';
require_once 'functions.php';
require_once 'basic.php';
$error = $action = $dis = $npass = $rnpass = $done = $changed = '';
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
						$changed = "<h3>".$lang['PassChanged']."</h3>";//."<a href='login.php'>".$lang['here']."</a>.";
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
		<form method="post" action="<?php echo $action?>">
			
			<h3><?php echo $lang['PC1']?></h3>
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="" maxlength="40">
			<span id="ginfo"><?php echo $error ?></span>
			<br>

			<label class="fieldname" for="question"><?php echo $lang['Question']?></label>
			<input type="text" name="question" id="question" value="" maxlength="30">
			<br>
			
			<label class="fieldname" for="question2"><?php echo $lang['Question2']?></label>
			<input type="text" name="question2" id="question2" value="" maxlength="30" >

			<h3><?php echo $lang['PC2']?></h3>
			<label class="fieldname" for="npass"><?php echo $lang['NPass']?>:</label>
			<input type="password" name="npass" id="npass" value="" maxlength="30" ><br>
			
			<label class="fieldname" for="rnpass"><?php echo $lang['RNPass']?>:</label>
			<input type="password" name="rnpass" id="rnpass" value="" maxlength="30"><br>
			
			<input type="submit" value="<?php echo $lang['Confirm']?>">
	<!--	<input type="button" value="<?php echo $lanh['BT']?>" onclick="window.location='login.php';" /><br><br>		-->
			
			<?php echo $changed ?>
		</form>

	</body>
</html>