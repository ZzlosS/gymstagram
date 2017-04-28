<?php
require_once 'basic.php';

if(!$loggedIn) die();

?>

		<div class="main">
		<?php 
			
			if(isset($_GET['id'])){
				$mid = sS($_GET['id']); //member id
				$result = qM("SELECT * FROM `members` WHERE `id`=$mid");
				if($result->num_rows){
					$row = $result->fetch_array(MYSQL_ASSOC);
					$view = $row['gym_name'];
					$view2 = $row['email'];
				}
				else{
					$view = "";
				}
				if($view == $gname){
					$name = $lang['Your'];
				}
				else{
					$name = "$view's";
				}
				echo "<h3>$name ".$lang['Profile']."</h3>";
				sP($view2); //prikazuje profil tog clana kog izaberes iz liste
				die("</div></body></html>");
			}
			if(isset($_GET['add'])){
				$add = sS($_GET['add']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$add AND `friend_id`=$id");
				if(!$result->num_rows){
					qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($add, $id)");
				}
			}
			if(isset($_GET['remove'])){
				$remove = sS($_GET['remove']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$remove AND `friend_id`=$id");
				if($result->num_rows){
					qM("DELETE FROM `gym_buddies` WHERE `user_id`=$remove AND `friend_id`=$id");
				}
			}
		
			$result = qM("SELECT * FROM `members`");
			$num = $result->num_rows;
			
		?>
			<h3>Other Members</h3>
			<ul>
				<?php 
					for($j = 0; $j < $num; $j++){
						$row = $result->fetch_assoc();
						if($row['id'] == $id){
							continue;
						}
						echo "<li><a href='members.php?id=" . $row['id'] . "'>" . $row['gym_name'] . "</a> ";
						$follow = "Send friend request";
						$result1 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=" . $row['id'] . " AND `friend_id`=$id");
						$t1 = $result1->num_rows;
						$resutl2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=" . $row['id']);
						$t2 = $resutl2->num_rows;
						if($t1 + $t2 >1){
							echo $lang['yf'];
						}
						elseif($t1){
							echo $lang['yousent'];
						}
						elseif($t2){
							echo $lang['sentyou'];
							$follow = $lang['add'];
						}
						if(!$t1){
							echo "[<a href='members.php?add=" . $row['id'] . "'>$follow</a>]";
						}
						else{
							echo "[<a href='members.php?remove=" . $row['id'] . "'>".$lang['Revoke']."</a>]";
						}
						echo "</li>";
					}
				?>
			</ul>
		</div>
		
	</body>
</html>
