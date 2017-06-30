<?php
	
	session_start();
	?>
    <!DOCTYPE html>
	<html><head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--<meta name="description" content="Saturn is free PSD &amp; HTML template by @flamekaizar">
    <meta name="author" content="Afnizar Nur Ghifari">-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--
        <script>
            function lang(lan) {
                $.ajax({
                    method: 'post',
                    url: 'checklanguage.php',
                    data: {'lang': lan}
                    success: function () {
                        location
                    }
                });
            }
        </script>
    -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="css/radio.css" />
    <link rel="stylesheet" href="css/kube.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/custom.min.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/mycss.css" />
    <link rel="stylesheet" type="text/css" href="css/profile-hover.css" />

    <script src="js/kube.min.js"></script>
    <script src="js/myjs.js"></script>


     <!--da izbacim u css-->
    <style>
        .subhead{
            float: left;
        }
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
        .name_hover:hover{
            cursor: pointer;
        }

        .image-upload > input
        {
            display: none;
        }

        #blah2{
            border-radius: 50%;
            max-width: 100px;
            max-height: 100px;
            size: inherit;
            border: 1px solid #211410;
            top: 89px;
            left: 140px;
        }

    </style>
    <!-- ... -->

	<?php
	require_once 'checklanguage.php';
	
	
	require_once 'functions.php';
	$userstr = ' (' .$lang['Guest'] .')';
	$id = "";
    $date = date("Y-m-d H:i:s"); //date_default_timezone_set jer ovako ne pokazuje tacno vreme

	if(isset($_SESSION['email'])){
		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$loggedIn = TRUE;
		$loggedIn2 = 1;
		$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
        $row = $result->fetch_array(MYSQL_ASSOC);
        $role = $row['role'];
        $public = $row['public'];

		if($result->num_rows){
			$gname = $row['gym_name'];
			$pic = $row['pic_path'];
			$userstr = " (@$gname)";
		}
	}
	else{
	    $loggedIn2 = 2;
		$loggedIn = FALSE;
	}
	?>
<?php
	echo "<title>$appname$userstr</title></head>";
	if(!$loggedIn){
?>
        <body>
        <div class="main-nav">
            <div class="container">
                <header class="group top-nav">
                    <nav class="navbar logo-w navbar-left" >
                        <a class="logo" href="index.php"><?php echo $lang['Gymstagram'];?></a>
                    </nav>

                    <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
                        <span class="logo"><?php echo $lang['Gymstagram'];?></span>
                    </div>

                    <nav id="navbar-1" class="navbar item-nav navbar-right">
                        <ul class = "menu">

                            <li><a href="home.php"><?php echo $lang['Home'];?></a></li>
                            <li><a href="login.php"><?php echo $lang['Login'];?></a></li>
                            <li><a href="signup.php"><?php echo $lang['Signup'];?></a></li>
                            <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1"><?php echo $lang['Language'];?></button>
                                        <div class="dropdown-content1">
                                            <a href="profile.php?lang=en"><img src="languages/en.png" /> <?php echo $lang['LanguageE'];?></a>
                                            <a href="profile.php?lang=sr"><img src="languages/sr.png" /> <?php echo $lang['LanguageS'];?></a>
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
                        <p class="p-intro"> <?php echo $lang['Welcome_to_Gymstagram']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        </body>
<?php } else{?>
        <body>
        <!-- Navigation -->
        <div class="main-nav">
            <div class="container">
                <header class="group top-nav">
                    <nav class="navbar logo-w navbar-left" >
                        <div id="gym_logo" style="max-height: 50px;">
                            <a class="logo" href="profile.php"> <?php echo $lang['Gymstagram']; ?> </a>


                        </div>
                    </nav>

                    <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
                        <span class="logo"><?php echo $lang['Gymstagram']; ?></span>
                    </div>

                    <nav id="navbar-1" class="navbar item-nav navbar-right">

                        <ul class = "menu">
                            <li> <a href="home.php"><?php echo $lang['Home'];?></a> </li>

                            <!-- Ispis dodatnih stranica za admina -->
                            <?php if($role == 2){?>
                                <li> <div id="language">
                                        <div class="dropdown1">
                                            <button class="dropbtn1"><?php echo $lang['Members'];?></button>
                                            <div class="dropdown-content1">
                                                <a href="search.php"><i class="icon-search"></i><?php echo $lang['search'];?></a>
                                                <a href="member_control.php"><i class="icon-edit"></i><?php echo $lang['control'];?></a>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li>
                                    <div id="language">
                                        <div class="dropdown1">
                                            <button class="dropbtn1"><?php echo $lang['Log'];?></button>
                                            <div class="dropdown-content1"  id="log">
                                                <a href="log.php"><img src="img/log.png"><?php echo $lang['Log'];?></a>
                                                <a href="log_pdf.php"><img src="img/pdf.png">PDF</a>
                                                <a href="log_html.php"><img src="img/html.png">HTML</a>
                                                <a href="log_docx.php"><img src="img/doc.png">DOCX</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                            else { ?>
                                <li> <a href="search.php"><?php echo $lang['Friends'];?></a> </li>
                            <?php } ?>

                                <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1"><?php echo $gname ?></button>
                                        <div class="dropdown-content1" id="prof">
                                            <a href="profile.php"><i class="icon-user"></i><?php echo $lang['Profile'];?></a>
                                            <a href="changeP.php"><i class="icon-cog"></i><?php echo $lang['CP']?></a>
                                            <a href="passchange.php"><i class="icon-lock"></i><?php echo $lang['Cpass']?></a>
                                            <a href="logout.php?page=index.php"><i class="icon-off"></i><?php echo $lang['Logout'];?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div id="language">
                                    <div class="dropdown1">
                                        <button class="dropbtn1"> <?php echo $lang['Language']; ?></button>
                                        <div class="dropdown-content1" id="lang">
                                            <a href="home.php?lang=en"><img src="languages/en.png" /> <?php echo $lang['LanguageE'];?></a>
                                            <a href="home.php?lang=sr"><img src="languages/sr.png" /> <?php echo $lang['LanguageS'];?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </nav>
                </header>
            </div>
        </div>
        <!--<script src="js/jquery.min.js"></script>-->

<?php }?>