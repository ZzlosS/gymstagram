<?php
require_once 'functions.php';
require_once 'checklanguage.php';
?>
<style>
    a:hover{
        color: #ff6c40;
    }
</style>
<div class="main">
    <?php
    if(!isset($_POST['id'])){
        if((!isset($_POST['tags']))){
            echo "<script>location.replace('home.php')</script>";
        }
    }
    $id = $_POST['id'];
    $res = '';
    if(($_POST['tags']) != ''){
        $name = $_POST['tags'];
        $result = qM("SELECT * FROM `members` WHERE (`gym_name`='$name' OR `name`='$name' OR `lname`='$name' OR CONCAT(`name`,' ',`lname`)='$name')");
        $row = $result->fetch_assoc();
        $num = $result->num_rows;
        $res .= "<ul>";
        for($j = 0; $j < $num; $j++){
            //current
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
        }
        $res.="</ul>";
        echo $res;
    }
    else{
    $id = $_POST['id'];
    $result = qM("SELECT * FROM `members`");
    $num = $result->num_rows;
    ?>
    <ul>
        <?php
        for($j = 0; $j < $num; $j++){
            $row = $result->fetch_assoc();
            //current
            $cid = $row['id'];
            $cgname = $row['gym_name'];
            $cname = $row['name'];
            $clname = $row['lname'];
            if($cid == $id){
                continue;
            }
            ?>
            <li style="list-style-type:none">
                <div align="center">
                    <?php
                    echo "<a href='profile.php?gn=" . $cgname . "'>" . $cname ." ".$clname." @". $cgname . "</a>";
                    ?>
                </div>
            </li>
            <?php
        }
        }
        ?>
    </ul>
</div>
<br><br>
</body>
</html>