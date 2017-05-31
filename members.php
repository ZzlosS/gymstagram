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
		
			$result = qM("SELECT * FROM `profile`");
			$num = $result->num_rows;
			
		?>
            <br><br>
			<h3>Other Members</h3>
			<ul>
				<?php 
					for($j = 0; $j < $num; $j++){
						$row = $result->fetch_assoc();
						//current
						$cid = $row['id'];
						$cgname = $row['gym_name'];
						$cimage = $row['pic_path'];
						$cname = $row['name'];
                        $clname = $row['last_name'];
                        $cinfo = $row['information'];
						if($cid == $id){
							continue;
						}
                        $result1 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=" . $row['id'] . " AND `friend_id`=$id");
                        $t1 = $result1->num_rows;
                        $resutl2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=" . $row['id']);
                        $t2 = $resutl2->num_rows;
                        $sent = $remove = false;
                        if($t1){$sent = true;}
                        if($t1 + $t2 >1){$remove = true;}
						?>
                        <li>
                        <span class="box">
                            <?php
                            echo "<a href='members.php?id=" . $cid . "'>" . $cgname . "</a>";
                            ?>

                            <span class="overlay">
                                <figure class="snip1336">
                                <img src="img/cover.jpg" alt="sample87" />
                                  <figcaption>
                                    <img src="<?php echo $cimage?>" alt="profile-sample4" class="profile" />
                                    <h2><?php echo $cname?>
                                        <span>
                                            <?php
                                            if($t1 + $t2 >1){
                                                echo $lang['yf'];
                                            }
                                            elseif($t1){
                                                echo "is yet to decide if he wants to accept your friend request";
                                            }
                                            elseif($t2){
                                                echo "wants yo be your friend";
                                            }
                                            else{
                                                echo "is not your friend";
                                            }
                                            ?>
                                        </span>
                                    </h2>
                                    <p><?php echo $cinfo?></p>
                                      <?php
                                      if($t1 + $t2 >1){
                                          echo '<a href="members.php?delete='.$cid.'" class="delete">Delete friend</a>';
                                      }
                                      elseif($t1){
                                          echo '<a href="members.php?revoke='.$cid.'" class="delete">Revoke request</a>';
                                      }
                                      elseif($t2){
                                          echo "<a href='members.php?decline=".$cid."' class='delete'>".$lang['nadd']."</a>"; //decline
                                          echo "<a href='members.php?accept=".$cid."' class='follow'>".$lang['add']."</a><br>"; //accept
                                      }
                                      else{
                                          echo '<a href="members.php?add='.$cid.'" class="follow">Add friend</a>';
                                      }
                                      ?>
                                    <a href="#" class="info">More Info</a>
                                  </figcaption>
                                </figure>
                            </span>
                        </span>
                        </li>
                        <?php

					}
				?>
			</ul>
		</div>
		
	</body>
</html>
