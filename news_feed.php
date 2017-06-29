<?php
    require_once 'functions.php';
    $load = htmlentities(strip_tags($_POST['load']))*2;

    $query = qM("SELECT m.id,m.name,m.gym_name,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` ORDER BY `date_update` DESC LIMIT ".$load.",2");

    while($row=$query->fetch_assoc()){
        echo "<div class='im'><div class='descN'><a href='profile.php?gn=".$row['gym_name']."'>".$row['name']."</a></div>";
        echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a>";
        echo "<div class='desc'>".$row['pic_desc']."</div></div>";

    }

