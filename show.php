<?php
    require_once 'functions.php';
    if(isset($_POST['fol'])){
        $res = '';
        $follow = $_POST['fol'];
        foreach ($follow as $f){
            $result = qM("SELECT * FROM `members` WHERE `id`=$f");
            $row = $result->fetch_assoc();
            $res .= "<ul>";
            $cid = $row['id'];
            $cgname = $row['gym_name'];
            $cname = $row['name'];
            $clname = $row['lname'];
            $res.='<li style="list-style-type:none"><div align="center">';
            $res.= "<a href='profile.php?gn=" . $cgname . "'>" . $cname ." ".$clname." @". $cgname . "</a>";
            $res.="</div></li>";
            $res.="</ul>";
        }
        echo $res;
        }