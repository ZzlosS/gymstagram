<?php

    require_once 'basic.php';
    if(!$loggedIn) die();

   if(isset($_GET['accept'])){
        $accept = sS($_GET['accept']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$accept AND `friend_id`=$id");
        if(!$result->num_rows){
            qM("INSERT INTO `gym_buddies`(`user_id`, `friend_id`) VALUES ($accept, $id)");
            $result = qM("SELECT `notifications` FROM `profile` WHERE `id`=$id");
            if($result->num_rows){
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] - 1;
                qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$id");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
   }

    if(isset($_GET['decline'])){
        $decline = sS($_GET['decline']);
        $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");
        if($result->num_rows) {
            qM("DELETE FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=$decline");
            $result = qM("SELECT `notifications` FROM `profile` WHERE `id`=$id");
            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                $notification = $row['notifications'] - 1;
                qM("UPDATE `profile` SET `notifications`=$notification WHERE `id`=$id");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

    echo "<h3>Your friend requests</h3><ul>";
    $result = qM("SELECT * FROM `members`");
    $num = $result->num_rows;

    for($j = 0; $j < $num; $j++){
        $row = $result->fetch_assoc();
        if($row['id'] == $id){
            continue;
        }

        $result1 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=" . $row['id'] . " AND `friend_id`=$id");
        $t1 = $result1->num_rows;
        $resutl2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id AND `friend_id`=" . $row['id']);
        $t2 = $resutl2->num_rows;
        if(!$t1 && $t2){
            echo "<li><a href='notifications.php?id=" . $row['id'] . "'>" . $row['gym_name'] . "</a> ";
            echo $lang['sentyou'];
            echo "[<a href='notifications.php?decline=" . $row['id'] . "'>".$lang['nadd']."</a>]"; //decline
            echo "[<a href='notifications.php?accept=" . $row['id'] . "'>".$lang['add']."</a>]"; //accept
        }

        echo "</li>";
    }
    echo "</ul>";
    echo "<h3>Your likes</h3>";
    echo "<h3>Your comments</h3>";
?>
            </ul>
        </div>
    </body>
</html>

