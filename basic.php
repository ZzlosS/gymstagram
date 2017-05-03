<?php
	
	session_start();
	echo "<!DOCTYPE html><html><head>";
	require_once 'checklanguage.php';
	
	
	require_once 'functions.php';
	$userstr = ' (' .$lang['Guest'] .')';
	$not = "";
	if(isset($_SESSION['email'])){
		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$loggedIn = TRUE;
		$result = qM("SELECT * FROM `profile` WHERE `email`='$email'");
		if($result->num_rows){
			$row = $result->fetch_array(MYSQL_ASSOC);
			$gname = $row['gym_name'];
			$notifications = $row['notifications'];
			if($notifications != 0){
				$not = "[$notifications]";
			}
			$userstr = " (@$gname)";
		}
	}
	else{
		$loggedIn = FALSE;
	}
	
	echo "<title>$appname$userstr$not</title>".
			//"<link type='text/css' rel='stylesheet' href='styles.css'></link>".
        "</head><body><div style=\"text-align: center;\"><canvas id='logo' width='624' height='96'>" .
        "$appname</canvas></div>" .
			"<div class='$appname'>".$lang['Welcome'].$appname.$userstr."<span style='color:red'>".$not."</span></div>";
			//"<script src='javascript.js'></script>";
	if(!$loggedIn){
?>
	<div id="languages">
	<a href="index.php?lang=en"><img src="languages/en.png" /></a>
	<a href="index.php?lang=sr"><img src="languages/sr.png" /></a>
	</div>
	<ul class = "menu">
		<li><a href="index.php"><?php echo $lang['Home'];?></a></li>
		<li><a href="login.php"><?php echo $lang['Login'];?></a></li>
		<li><a href="signup.php"><?php echo $lang['Signup'];?></a></li>
	</ul>
	<br>
	<!-- <span class="info">&#8658; <?php echo $lang['NotLogged'];?></span>  -->
<?php } else{?>
	<div id="languages">
		<a href="profile.php?lang=en"><img src="languages/en.png" /></a>
		<a href="profile.php?lang=sr"><img src="languages/sr.png" /></a>
	</div>
	<ul class="menu">
  		<li> <a href="home.php"><?php echo $lang['Home'];?></a> </li>
  		<li> <a href="members.php"><?php echo $lang['Members'];?></a> </li>
  		<li> <a href="gallery.php"><?php echo $lang['Gallery'];?></a> </li>
  		<li> <a href="friends.php"><?php echo $lang['Friends'];?></a> </li>
  		<li> <a href="messages.php"><?php echo $lang['Messages'];?></a> </li>
  		<li> <a href="profile.php"><?php echo $lang['Profile'];?></a> </li>
  		<li> <a href="logout.php?page=index.php"><?php echo $lang['Logout'];?></a> </li>
	</ul><br>


<?php }?>