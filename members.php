<?php
require_once 'basic.php';

if(!$loggedIn) die();

?>

		<div class="main">
		<?php 
			
			if(isset($_GET['id'])){
				$mid = sS($_GET['id']);
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
				sP($view2);
				die("</div></body></html>");
			}

			if(isset($_GET['accept'])){
				$accept = sS($_GET['accept']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$accept AND `friend_id`=$id");
				if(!$result->num_rows){
                    qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($accept, $id)");

                    //uzima ime prijatelja da bi upisalo u log
				    $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$accept");
				    $row3 = $result3->fetch_assoc();
				    $aname = $row3['gym_name'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) is now friend with $aname($accept)')");

					$result = qM("SELECT `notifications` FROM `profile` WHERE `id`='$id'");
					if($result->num_rows){
						$row = $result->fetch_assoc();
						$notification = $row['notifications'] - 1;
						qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$id");
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}
			}

			if(isset($_GET['add'])){
				$add = sS($_GET['add']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$add AND `friend_id`=$id");
				if(!$result->num_rows){
					qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($add, $id)");

                    //uzima ime prijatelja da bi upisalo u log
                    $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$add");
                    $row3 = $result3->fetch_assoc();
                    $aname = $row3['gym_name'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) wants to be friend with $aname($add)')");

					$result = qM("SELECT `notifications` FROM `profile` WHERE `id`='$add'");
					if($result->num_rows){
						$row = $result->fetch_assoc();
						$notification = $row['notifications'] + 1;
						qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$add");
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}
			}

			if(isset($_GET['revoke'])){
				$revoke = sS($_GET['revoke']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$revoke AND `friend_id`=$id");
				if($result->num_rows){
					qM("DELETE FROM `gym_buddies` WHERE `user_id`=$revoke AND `friend_id`=$id");

                    //uzima ime prijatelja da bi upisalo u log
                    $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$revoke");
                    $row3 = $result3->fetch_assoc();
                    $aname = $row3['gym_name'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) revoked friend request for $aname($revoke)')");

					$result = qM("SELECT `notifications` FROM `profile` WHERE `id`='$revoke'");
					if($result->num_rows){
						$row = $result->fetch_assoc();
						$notification = $row['notifications'] - 1;
						qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$revoke");
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}
			}

			if(isset($_GET['decline'])){
				$decline = sS($_GET['decline']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");
				if($result->num_rows) {
                    qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");

                    //uzima ime prijatelja da bi upisalo u log
                    $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$decline");
                    $row3 = $result3->fetch_assoc();
                    $aname = $row3['gym_name'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) declined friend request from $aname($decline)')");

                    $result = qM("SELECT `notifications` FROM `profile` WHERE `id`='$id'");
                    if ($result->num_rows) {
                        $row = $result->fetch_assoc();
                        $notification = $row['notifications'] - 1;
                        qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$id");
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }
			}

			if(isset($_GET['delete'])){
				$delete = sS($_GET['delete']);
				$result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$delete");
				$result2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$delete AND `friend_id`=$id");
				if($result->num_rows && $result2->num_rows){
					qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$delete");
					qM("DELETE FROM `gym_buddies` WHERE `user_id`=$delete AND `friend_id`=$id");

                    //uzima ime prijatelja da bi upisalo u log
                    $result3 = qM("SELECT `gym_name` FROM `members` WHERE `id`=$delete");
                    $row3 = $result3->fetch_assoc();
                    $aname = $row3['gym_name'];
                    qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) and $aname($delete) are no longer friends')");
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
						$result1 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=" . $row['id'] . " AND `friend_id`=$id");
						$t1 = $result1->num_rows;
						$resutl2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=" . $row['id']);
						$t2 = $resutl2->num_rows;
						if($t1 + $t2 >1){
							echo $lang['yf'];
							echo "[<a href='members.php?delete=" . $row['id'] . "'>".$lang['delete']."</a>]";
						}
						elseif($t1){
							echo $lang['yousent'];
							echo "[<a href='members.php?revoke=" . $row['id'] . "'>".$lang['Revoke']."</a>]";
						}
						elseif($t2){
							echo $lang['sentyou'];
							echo "[<a href='members.php?decline=" . $row['id'] . "'>".$lang['nadd']."</a>]"; //decline
							echo "[<a href='members.php?accept=" . $row['id'] . "'>".$lang['add']."</a>]"; //accept
						}
						else{
							echo "[<a href='members.php?add=" . $row['id'] . "'>".$lang['send']."</a>]"; //add
						}
						echo "</li>";
					}
				?>
			</ul>
		</div>
		
	</body>
</html>
