<?php
	
	session_start();
	?>
    <!DOCTYPE html>
	<html><head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--<meta name="description" content="Saturn is free PSD &amp; HTML template by @flamekaizar">
    <meta name="author" content="Afnizar Nur Ghifari">-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/kube.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/custom.min.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/mycss.css" />
    <link rel="stylesheet" type="text/css" href="css/profile-hover.css" />



    <!--da izbacim u css-->
    <style>
        .loader{
            position: fixed;
            bottom: 0;
            left: 48%;
        }
        .up{
            position: fixed;
            float: left;
            bottom: 10px;
            left: 96%;
        }
        .up:hover{
            opacity: 0.7;
            cursor: pointer;
        }
    </style>
    <!-- ... -->

	<?php
	require_once 'checklanguage.php';
	
	
	require_once 'functions.php';
	$userstr = ' (' .$lang['Guest'] .')';
	$not = "";
	$id = "";
    $date = date("Y-m-d H:i:s"); //date_default_timezone_set jer ovako ne pokazuje tacno vreme

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
	
	echo "<title>$appname$userstr$not</title></head>";
			//"<link type='text/css' rel='stylesheet' href='styles.css'></link>".
        /*"</head><body><div style=\"text-align: center;\"><canvas id='logo' width='624' height='96'>" .
        "$appname</canvas></div>" .
			"<div class='$appname'>".$lang['Welcome'].$appname.$userstr."<a style='color:red; text-decoration: none' href='notifications.php?id=$id'>".$not."</a></div>";*/
			//"<script src='javascript.js'></script>";
	if(!$loggedIn){
?>
        <body>
        <div class="main-nav">
            <div class="container">
                <header class="group top-nav">
                    <nav class="navbar logo-w navbar-left" >
                        <a class="logo" href="index.php">Gymstagram</a>
                    </nav>

                    <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
                        <span class="logo">Gymstagram</span>
                    </div>

                    <nav id="navbar-1" class="navbar item-nav navbar-right">
                        <ul class = "menu">

                            <li><a href="index.php"><?php echo $lang['Home'];?></a></li>
                            <li><a href="login.php"><?php echo $lang['Login'];?></a></li>
                            <li><a href="signup.php"><?php echo $lang['Signup'];?></a></li>
                            <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1">Language</button>
                                        <div class="dropdown-content1">
                                            <a href="profile.php?lang=en"><img src="languages/en.png" /> Eng</a>
                                            <a href="profile.php?lang=sr"><img src="languages/sr.png" /> Srb</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </nav>

                </header>
            </div>
        </div>

        <!-- Introduction -->
        <div class="intro">
            <div class="container">
                <div class="units-row">
                    <div class="unit-10">
                        <img class="img-intro" src="img/avatar.png" alt="">
                    </div>
                    <div class="unit-90">
                        <p class="p-intro">Wellcome to Gymstagram!</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/kube.min.js"></script>
        <script src="js/myjs.js"></script>
        </body>
	<!-- <span class="info">&#8658; <?php echo $lang['NotLogged'];?></span>  -->
<?php } else{?>
        <body>
        <!-- Navigation -->
        <div class="main-nav">
            <div class="container">
                <header class="group top-nav">
                    <nav class="navbar logo-w navbar-left" >
                        <a class="logo" href="profile.php">Gymstagram</a>
                        <a style='color:red; text-decoration: none;' href='notifications.php?id='.<?php echo $id?>.><?php echo $not?></a>
                    </nav>

                    <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
                        <span class="logo">Gymstagram</span>
                    </div>

                    <nav id="navbar-1" class="navbar item-nav navbar-right">

                        <ul class = "menu">
                            <li> <a href="home.php"><?php echo $lang['Home'];?></a> </li>
                            <li> <a href="members.php"><?php echo $lang['Members'];?></a> </li>
                            <li> <a href="gallery.php"><?php echo $lang['Gallery'];?></a> </li>
                            <li> <a href="friends.php"><?php echo $lang['Friends'];?></a> </li>
                            <li> <a href="messages.php"><?php echo $lang['Messages'];?></a> </li>
                            <li> <a href="log.php?page=1"><?php echo $lang['Log'];?></a> </li>
                            <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1"><?php echo $gname ?></button>
                                        <div class="dropdown-content1">
                                            <a href="profile.php"><i class="icon-user"></i><?php echo $lang['Profile'];?></a>
                                            <a href="#"><i class="icon-cog"></i>Settings</a>
                                            <a href="logout.php?page=index.php"><i class="icon-remove"></i><?php echo $lang['Logout'];?></a>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1">Language</button>
                                        <div class="dropdown-content1">
                                            <a href="profile.php?lang=en"><img src="languages/en.png" /> Eng</a>
                                            <a href="profile.php?lang=sr"><img src="languages/sr.png" /> Srb</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </nav>
                </header>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/kube.min.js"></script>
        <script src="js/myjs.js"></script>
    </body>
</html>
<?php }?>