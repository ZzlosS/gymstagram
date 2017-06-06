<?php
    require_once 'functions.php';
    $load = htmlentities(strip_tags($_POST['load']))*2;

    $query = qM("SELECT * FROM `members` ORDER BY `pic_date` DESC LIMIT ".$load.",2");

    while($row=$query->fetch_assoc()){
        echo "<p align='center'><img src='".$row['pic_path']."' height='500' width='500'></p>".$row['id'];
    }

