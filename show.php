<?php
    require_once 'functions.php';
    if(isset($_POST['show'])){
        //samo prosledim niz pa ispitujem, ne mora show
        $show = $_POST['show'];
        $res = '';
        if($show == 1){
            foreach ($following as $f){
                $result = qM("SELECT * FROM `members` WHERE `id`=$f");
                $res .= "<ul>";
                $cid = $row['id'];
                $cgname = $row['gym_name'];
                $cname = $row['name'];
                $clname = $row['lname'];
                if($cid == $id){
                    continue;
                }
                $res.='<li style="list-style-type:none"><div align="center">';
                $res.= "<a href='profile.php?gn=" . $cgname . "'>" . $cname ." ".$clname." @". $cgname . "</a>";
                $res.="</div></li>";
                $res.="</ul>";
            }
            echo $res;
        }
        elseif($show == 2){
            foreach ($followers as $f){
                $result = qM("SELECT * FROM `members` WHERE `id`=$f");
                $res .= "<ul>";
                $cid = $row['id'];
                $cgname = $row['gym_name'];
                $cname = $row['name'];
                $clname = $row['lname'];
                if($cid == $id){
                    continue;
                }
                $res.='<li style="list-style-type:none"><div align="center">';
                $res.= "<a href='profile.php?gn=" . $cgname . "'>" . $cname ." ".$clname." @". $cgname . "</a>";
                $res.="</div></li>";
                $res.="</ul>";
            }
            echo $res;
        }
        else{
            echo "dgaga";
        }
    }