<?php
    require_once 'functions.php';
    if(!isset($_POST['load'])) die("<script>location.replace('home.php')</script>");
    $load = htmlentities(strip_tags($_POST['load']))*2;
    $loggedIn = $_POST['loged'];
    if($loggedIn == 1){
        $following = $_POST['fol'];
        $id = $_POST['id'];
        $query = qM("SELECT m.id,m.name,m.gym_name,m.public,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` ORDER BY `date_update` DESC LIMIT ".$load.",2");
    }
    else{
        $query = qM("SELECT m.id,m.name,m.gym_name,m.public,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id`  WHERE `public`=1 ORDER BY `date_update` DESC LIMIT ".$load.",2");
    }


    while($row=$query->fetch_assoc()){
        $fid = $row['id'];
        $public = $row['public'];
        if($loggedIn == 1){
            if($public == 1 || in_array($fid, $following) || $fid == $id){  //ako je public ili ga pratis ili si ti
                echo "<div class='im' ><div class='descN'><a href='profile.php?gn=".$row['gym_name']."'  data-hover='@".$row['gym_name']."' >@".$row['gym_name']."</a></div>";
                echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a>";
                echo "<div class='desc'>".$row['pic_desc']."</div></div><br>";
            }
        }
        else{
            echo "<div class='im' ><div class='descN'><a href='profile.php?gn=".$row['gym_name']."' data-hover='@" .$row['gym_name']."' >@".$row['gym_name']."</a></div>";
            echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a><br>";
            echo "<div class='desc'>".$row['pic_desc']."</div></div><br>";
        }

    }
