<?php
	require_once 'functions.php';
	require_once 'checklanguage.php';
	if(isset($_POST['email'])){
		$email = sS($_POST['email']);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo $lang['Wrong'];
		}
		else{
			$result = qM("SELECT * FROM `members` WHERE `email`='$email'");
			if($result->num_rows){
				echo "<br><span>&#x2718;".$lang['UserTaken']." (at least by you)</span>";
			}
			else{
				echo "<span>&#x2714;</span>";
			}
		}
	}
	elseif(isset($_POST['gname'])){
        $gname = $_POST['gname'];
        $result = qM("SELECT * FROM `members` WHERE `gym_name`='$gname'");
        if($result->num_rows){
            echo "<br><span class='taken'>&#x2718;".$lang['GUserTaken']." (at least by you)</span>";
        }
        else{
            echo "<span class='available'>&#x2714;</span>";
        }
    }
    else{
        die("<script>location.replace('home.php')</script>");
    }
