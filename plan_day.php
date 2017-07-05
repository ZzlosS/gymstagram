<?php
require_once 'functions.php';

$daily = $_POST['daily']; //onload je 1 - weekly, a daily salje 2
$id = $_POST['id'];

if($daily == 2) {
    $day = $_POST['day'];
    if(isset($_POST['today'])){ //ako se otvori pregled preko linka nekog dana, onda se ne setuje today pa mora ovako
        $today = $_POST['today'];
    }
    else{
        $today = $day;
    }
    $result = qM("SELECT * FROM `plan` WHERE `user_id`=$id AND `day`='$day'");
    $row = $result->fetch_assoc();

    /*
    while($row = $result->fetch_assoc()){
        var_dump($row);
    } ako ima vise treninga za isti dan*/

    switch ($day) {
        //tu da budu $lang['dan']
        case('1'):
            $day_name = "pon";
            break;
        case('2'):
            $day_name = "uto";
            break;
        case('3'):
            $day_name = "sre";
            break;
        case('4'):
            $day_name = "cet";
            break;
        case('5'):
            $day_name = "pet";
            break;
        case('6'):
            $day_name = "sub";
            break;
        case('7'):
            $day_name = "ned";
            break;
    }
    if($result->num_rows){
        $from = $row['from'];
        $to = $row['to'];
        $muscle_group = $row['muscle_group'];
        $ex1 = $row['ex1'];
        $ex2 = $row['ex2'];
        $ex3 = $row['ex3'];
        $ex4 = $row['ex4'];

        echo "<div class='gallery' id='day'>
            <a href='#'>".$day_name."</a><a href='#' style='float: right'><i class='icon-edit'></i></a> <br>
            <div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1."<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div></div>";
        if($today != $day){
            echo "<a href='#' onclick='day_show(".$today.")'>Today</a>";
        }
    }
    else{
        echo "<div class='gallery' id='day'>
            <a href='#'>".$day_name."</a><a href='#' style='float: right'><i class='icon-edit'></i> <br>
            <div class='desc'><a href='#'><i class='icon-edit'></i>Create</a></div></div>";
        if($today != $day){
            echo "<a href='#' onclick='day_show(".$today.")'>Today</a>";
        }
    }
}
else{
    echo "
        <div class='gallery' id='mon'>
            <a href='#' onclick='day_show(1)'>Monday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='tue'>
            <a href='#' onclick='day_show(2)'>Tuesday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='wed'>
            <a href='#' onclick='day_show(3)'>Wednesday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='thu'>
            <a href='#' onclick='day_show(4)'>Thursday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='fri'>
            <a href='#' onclick='day_show(5)'>Friday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='sat'>
            <a href='#' onclick='day_show(6)'>Saturday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>
        <div class='gallery' id='sun'>
            <a href='#' onclick='day_show(7)'>Sunday</a> <br>
            <div class='desc'>Plan</div>
            <br><br>
        </div>";
    $result = qM("SELECT * FROM `plan` WHERE `user_id`=$id");
    while($row = $result->fetch_assoc()){
        $day = $row['day'];
        $from = $row['from'];
        $to = $row['to'];
        $muscle_group = $row['muscle_group'];
        $ex1 = $row['ex1'];
        $ex2 = $row['ex2'];
        $ex3 = $row['ex3'];
        $ex4 = $row['ex4'];
        switch ($day) {
            case('1'):
                $view = "<a href='#' onclick='day_show(1)'>Monday</a><br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1."<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("mon").innerHTML = "'.$view.'"</script>';
                break;
            case('2'):
                $view = "<a href='#' onclick='day_show(2)'>Tuesday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("tue").innerHTML = "'.$view.'"</script>';
                break;
            case('3'):
                $view = "<a href='#' onclick='day_show(3)'>Wednesday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("wed").innerHTML = "'.$view.'"</script>';
                break;
            case('4'):
                $view = "<a href='#' onclick='day_show(4)'>Thursday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("thu").innerHTML = "'.$view.'"</script>';
                break;
            case('5'):
                $view = "<a href='#' onclick='day_show(5)'>Friday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("fri").innerHTML = "'.$view.'"</script>';
                break;
            case('6'):
                $view = "<a href='#' onclick='day_show(6)'>Saturday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("sat").innerHTML = "'.$view.'"</script>';
                break;
            case('7'):
                $view = "<a href='#' onclick='day_show(7)'>Sunday</a> <br><div class='desc'>From: ".$from." To: ".$to."<br>Muslce Group: ".$muscle_group."<br>Exercise: ".$ex1. "<br>Exercise: ".$ex2."<br>Exercise: ".$ex3."<br>Exercise: ".$ex4."</div>";
                echo '<script>document.getElementById("sun").innerHTML = "'.$view.'"</script>';
                break;
        }
    }

}
