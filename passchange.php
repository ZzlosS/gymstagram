<?php
require_once 'checklanguage.php';
require_once 'functions.php';
require_once 'basic.php';
$ok = false;
if($loggedIn){
	$loc = "changeP.php";
}
else{
	$loc = "login.php";
}
		
$error = $email = $npass = $rnpass = $done = $changed = $redirect = '';
if(isset($_POST['email'])){
	$email = sS($_POST['email']);
    $s1 = sS($_POST['s1']);
    $rq1 = sS($_POST['q1']); //reset question 1
    $s2 = sS($_POST['s2']);
    $rq2 = sS($_POST['q2']); //reset question 2
    $rst = sS($_POST['st']); //reset security text
	if($email == '' || $rq1 == '' || $rq2 == '' || $rst == ''){
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
        $q1_id = $row['q1_id'];
        $q1 = $row['question1'];
        $q2_id = $row['q2_id'];
        $q2 = $row['question2'];
        $st = $row['security_text'];
        $pass = $row['pass'];
		if($s1 == $q1_id && $rq1 == $q1 && $s2 == $q2_id && $rq2 == $q2 && $rst == $st){
			if(isset($_POST['npass']) && isset($_POST['rnpass'])){
				$npass = $_POST['npass'];
				$rnpass = $_POST['rnpass'];
				$hpass = hash('ripemd128', "$salt1$npass$salt2");
				if($hpass == $pass){
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
                        $ok = true;
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
    <?php
    if(!$ok){
    ?>
		<form method="post" action="">
			
			<h3><?php echo $lang['PC1']?></h3>
			<label class="fieldname" for="email"><?php echo $lang['Email']?></label>
			<input type="text" name="email" id="email" value="<?php echo $email?>" maxlength="40">
			<span id="ginfo"><?php echo $error ?></span>
			<br>
<!--
			<label class="fieldname" for="question"><?php echo $lang['Question']?></label>
			<input type="text" name="question" id="question" value="<?php echo $question?>" maxlength="30">
			<br>
			
			<label class="fieldname" for="question2"><?php echo $lang['Question2']?></label>
			<input type="text" name="question2" id="question2" value="<?php echo $question2?>" maxlength="30" >
-->
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
            <input type="text" name="q2" id="q2" value="" maxlength="30"><br>
            <h3>Type in your security text</h3>
            <textarea name="st" id="st" rows="6" cols="50" placeholder="Type in your security text" maxlength="255"></textarea>
            <br>

			<h3><?php echo $lang['PC2']?></h3>
			<label class="fieldname" for="npass"><?php echo $lang['NPass']?>:</label>
			<input type="password" name="npass" id="npass" value="" maxlength="30" ><br>
			
			<label class="fieldname" for="rnpass"><?php echo $lang['RNPass']?>:</label>
			<input type="password" name="rnpass" id="rnpass" value="" maxlength="30"><br>
			
			<input type="submit" value="<?php echo $lang['Confirm']?>">
			<input type="button" value="<?php echo $lang['BT']?>" onclick="window.location='<?php echo $loc?>';" /><br><br>
			

		</form>
    <?php
    }
    else{
        echo $changed, $redirect;
    }
    ?>
	</body>
</html>