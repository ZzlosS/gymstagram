<?php
require_once 'basic.php';
if(!$loggedIn) die();

if(isset($_GET['id'])){
	$mid = sS($_GET['id']);
}
else{
	$mid = $id;
}

$result = qM("SELECT * FROM `members` WHERE `id`=$mid");
if($result->num_rows){
	$row = $result->fetch_array(MYSQL_ASSOC);
	$view = $row['gym_name'];
}
else{
	$view = "";
}

if($view == $email){
	$name3 =$name1 = $name2 = "Your";
}
else{
	$name1 = "<a href='members.php?id=$mid'>$view</a>'s";
	$name2 = "$view's";
	$name3 = "$view ".$lang['has'];
}
?>
		<div class="main">
			<?php 
				$followers = array();
				$following = array();
				
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$mid");
				$num = $result->num_rows;
				for($j = 0; $j < $num; $j++){
					$row = $result->fetch_array(MYSQL_ASSOC);
					$followers[$j] = $row['friend_id'];
				}
				$result = qM("SELECT * FROM `gym_buddies` WHERE `friend_id`=$mid");
				$num = $result->num_rows;
				for($j = 0; $j < $num; $j++){
					$row = $result->fetch_assoc();
					$following[] = $row['user_id'];
				}
				
				$mutual = array_intersect($followers, $following);
				$followers = array_diff($followers, $mutual);
				$following = array_diff($following, $mutual);
				$friends = FALSE;
				
				if(sizeof($mutual)){
					echo "<span class='subhead'>$name2 ". $lang['friends'].":</span>";
					echo "<ul>";
					foreach ($mutual as $friendId){
						$result = qM("SELECT * FROM `members` WHERE `id`=$friendId");
						$row = $result->fetch_assoc();
						$friendName = $row['gym_name'];
						echo "<li><a href='members.php?id=$friendId'>$friendName</a></li>";
					}
					echo "</ul>";
					$friends = TRUE;
				}
				
				if(sizeof($followers)){
					echo "<span class='subhead'>$name2 ". $lang['fr'].":</span>";
					echo "<ul>";
					foreach ($followers as $friendId){
						$result = qM("SELECT * FROM `members` WHERE `id`=$friendId");
						$row = $result->fetch_assoc();
						$friendName = $row['gym_name'];
						echo "<li><a href='members.php?id=$friendId'>$friendName</a></li>";
					}
					echo "</ul>";
					$friends = TRUE;
				}
				
				if(sizeof($following)){
					echo "<span class='subhead'>$name3 ". $lang['sent'] . $lang['fr']. $lang['to'].":</span>";
					echo "<ul>";
					foreach ($following as $friendId){
						$result = qM("SELECT * FROM `members` WHERE `id`=$friendId");
						$row = $result->fetch_assoc();
						$friendName = $row['gym_name'];
						echo "<li><a href='members.php?id=$friendId'>$friendName</a></li>";
					}
					echo "</ul>";
					$friends = TRUE;
				}
				
				if(!$friends){
					echo $lang['ForeverAlone'];
				}
			?>
		</div>
	</body>
</html>
