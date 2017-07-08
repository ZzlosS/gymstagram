<?php
	require_once 'basic.php';
	$email = $pass = $error1 = $error2 = $error3 = $value = '';
	if(isset($_POST['email'])){
		$email = sS($_POST['email']);
		$gname = sS($_POST['email']);
		$pass = sS($_POST['pass']);
		if($gname == '' || $email == '' || $pass == ''){
			$error1 = $lang['NotAll'];
			$value = $_POST['email'];
            qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) didnt enter all fields.')");
		}
		else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//ako je lose uneta email adresa onda je gym_name uneto
				$result2 = qM("SELECT * FROM `members` WHERE `gym_name`='$gname'");
				$row2 = $result2->fetch_assoc();
				$email = $row2['email'];
				$value = $gname;
				$role = $row2['role'];
				if($role == 3){
				    $you_banned = $lang['yb'];
				    die("<script>alert('$you_banned')</script>");
                }
				$hpass = hash('ripemd128', "$salt1$pass$salt2");
				$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
				if($result->num_rows == 0){
					$error2 = $lang['GNotInUse'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', 'Someone tried to log in with wrong gym_name.')");
				}
				else{
					$row = $result->fetch_assoc();
					if($row['pass'] != $hpass){
                        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has entered wrong password.')");
						$error3 = $lang['PassInvalid'];
						$email = $gname;//da ne ispise email adresu u polju
					}
					else{
						$id = $row['id'];
						$_SESSION['id'] = $id;
						$_SESSION['email'] = $email;
						//die($lang['LoggedIn']);
                        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has logged in.')");
                        echo "<script> location.replace('home.php'); </script>";
					}
				}
			}
			else{
				$hpass = hash('ripemd128', "$salt1$pass$salt2");
				$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
				if($result->num_rows == 0){
					$error2 = $lang['NotInUse'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', 'Someone tried to log in with wrong email.')");
				}
				else{
					$row = $result->fetch_assoc();
                    $role = $row['role'];
                    if($role == 3){
                        die("<script>alert('You are banned, contact admin for more info')</script>");
                    }
					$value = $row['email'];
					if($row['pass'] != $hpass){
						$error3 = $lang['PassInvalid'];
                        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has entered wrong password.')");
					}
					else{
						$id = $row['id'];
						$_SESSION['id'] = $id;
						$_SESSION['email'] = $email;
						//die($lang['LoggedIn']);
                        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has logged in.')");
                        echo "<script> location.replace('home.php'); </script>";
					}
				}
			}
		}
	}
?>
<body id="b2">
<div class="container2">
    <section id="content2">
        <form method="post" action="login.php">
            <h1><?php echo $lang['lf']?></h1>
            <div>
                <input type="text" name="email" id="email" value="<?php echo $value ?>" maxlength="40" placeholder="<?php echo $lang['E']."/".$lang['GName']?>" autofocus/>
                <br>
            </div>

            <div>
                <input type="password" name="pass" id="pass" value="" maxlength="30" placeholder="<?php echo $lang['Pass']?>"/>
            </div>
            <div>
                <?php echo $error1, $error2, $error3 ?>
            </div>
            <div>
                <input type="submit" value="<?php echo $lang['Login'] ?>" />
                <a href="passchange.php"><?php echo $lang['FPass']?></a>
            </div>
        </form><!-- form -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>