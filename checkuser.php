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
				echo "<span class='taken'>&nbsp;&#x2718;".$lang['UserTaken']."</span>";
			}
			else{
				echo "<span class='available'>&nbsp;&#x2714;</span>";
			}
		}


	}

    if(isset($_POST['gname'])){
        $gname = $_POST['gname'];
        $result = qM("SELECT * FROM `members` WHERE `gym_name`='$gname'");
        if($result->num_rows){
            echo "<span class='taken'>&nbsp;&#x2718;".$lang['GUserTaken']."</span>";
        }
        else{
            echo "<span class='available'>&nbsp;&#x2714;</span>";
        }




    }
?>