<?php
require_once 'functions.php';
require_once 'checklanguage.php';

$daily = $_POST['daily']; //onload je 1 - weekly, a daily salje 2
$id = $_POST['id'];

if($daily == 2) {
    $day = $_POST['day'];
    $previous = $day - 1;
    $next = $day + 1;
    if(isset($_POST['today'])){ //ako se otvori pregled preko linka nekog dana, onda se ne setuje today pa mora ovako
        $today = $_POST['today'];
    }
    else{
        $today = $day;
    }
    $result = qM("SELECT p.user_id,p.from,p.to,p.day,mg.name_mc,(SELECT name_e FROM exercise WHERE id_e=p.ex1_id) AS ex1,(SELECT name_e FROM exercise WHERE id_e=p.ex2_id) AS ex2,(SELECT name_e FROM exercise WHERE id_e=p.ex3_id) AS ex3,(SELECT name_e FROM exercise WHERE id_e=p.ex4_id) AS ex4 FROM `plan` AS p LEFT JOIN `muscle_group` AS mg ON p.muscle_group_id=mg.id_m WHERE p.`user_id`=$id AND p.`day`=$day");
    $row = $result->fetch_assoc();

    switch ($day) {
        case('1'):
            $day_name = $lang['Monday'];
            break;
        case('2'):
            $day_name = $lang['Tuesday'];
            break;
        case('3'):
            $day_name = $lang['Wednesday'];
            break;
        case('4'):
            $day_name = $lang['Thursday'];
            break;
        case('5'):
            $day_name = $lang['Friday'];
            break;
        case('6'):
            $day_name = $lang['Saturday'];
            break;
        case('7'):
            $day_name = $lang['Sunday'];
            break;
    }
    if($previous == 0){
        $link = "<div id='next'><a href='#' onclick='day_show($next)'>".$lang['Next']."</a></div>";
    }
    elseif($next == 8){
        $link = "<div id='previous'><a href='#' onclick='day_show($previous)'>".$lang['Previous']."</a></div>";
    }
    else{
        $link = "<div id='previous'><a href='#' onclick='day_show($previous)'>".$lang['Previous']."</a></div><div id='next'><a href='#' onclick='day_show($next)'>".$lang['Next']."</a></div>";
    }
    if($result->num_rows){ //ako postoji nesto tog dana
        $from = $row['from'];
        $to = $row['to'];
        $muscle_group = $row['name_mc'];
        $ex1 = $row['ex1'];
        $ex2 = $row['ex2'];
        $ex3 = $row['ex3'];
        $ex4 = $row['ex4'];

        echo "<div class='gallery' id='day'><a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,2)'><i class='icon-trash'></i></a>
            <a href='#'>".$day_name."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable($day,2)'><i class='icon-edit'></i></a><br><a href='#' id='s' title='".$lang['Save']."' onclick='save($day)' style='float:right'></a><br><br>
            <div class='desc'><p style='font-size: 15px'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b>".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1."<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</p></div>
            $link</div>";
        if($today != $day){
            echo "<a href='#' onclick='day_show(".$today.")'>".$lang['Today']."</a>";
        }
    }
    else{ //kad se dodje na prazan dan
        echo "<div class='gallery' id='day'>
            <a href='#'>".$day_name."</a><a href='#' title='".$lang['Edit']."' onclick='enable($day,2)' style='float:right'><i class='icon-edit'></i></a><br>
            <a href='#' id='s' title='".$lang['Save']."' onclick='save($day)' style='float:right'></a><br><br>
            <div class='desc'></div>$link</div>";
        if($today != $day){
            echo "<a href='#' onclick='day_show(".$today.")'>".$lang['Today']."</a>";
        }
    }
}
else{ //default ispis nedelje
    echo "
        <div class='gallery' id='mon'>
            <a href='#' onclick='day_show(1)'>".$lang['Monday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(1,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='tue'>
            <a href='#' onclick='day_show(2)'>".$lang['Tuesday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(2,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='wed'>
            <a href='#' onclick='day_show(3)'>".$lang['Wednesday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(3,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='thu'>
            <a href='#' onclick='day_show(4)'>".$lang['Thursday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(4,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='fri'>
            <a href='#' onclick='day_show(5)'>".$lang['Friday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(5,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='sat'>
            <a href='#' onclick='day_show(6)'>".$lang['Saturday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(6,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>
        <div class='gallery' id='sun'>
            <a href='#' onclick='day_show(7)'>".$lang['Sunday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(7,3)'><i class='icon-edit'></i></a><br><br>
            <div class='desc'></div>
            <br><br>
        </div>";
    $result = qM("SELECT p.user_id,p.from,p.to,p.day,mg.name_mc,(SELECT name_e FROM exercise WHERE id_e=p.ex1_id) AS ex1,(SELECT name_e FROM exercise WHERE id_e=p.ex2_id) AS ex2,(SELECT name_e FROM exercise WHERE id_e=p.ex3_id) AS ex3,(SELECT name_e FROM exercise WHERE id_e=p.ex4_id) AS ex4 FROM `plan` AS p LEFT JOIN `muscle_group` AS mg ON p.muscle_group_id=mg.id_m WHERE p.`user_id`=$id");
    while($row = $result->fetch_assoc()){ //ispis ako postoji nesto za neki dan
        $day = $row['day'];
        $from = $row['from'];
        $to = $row['to'];
        $muscle_group = $row['name_mc'];
        $ex1 = $row['ex1'];
        $ex2 = $row['ex2'];
        $ex3 = $row['ex3'];
        $ex4 = $row['ex4'];
        switch ($day) {
            case('1'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(1)'>".$lang['Monday']."</a><a href='#' title='".$lang['Edit']."' style='float: right' onclick='enable(1,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1."<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("mon").innerHTML = "'.$view.'"</script>';
                break;
            case('2'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(2)'>".$lang['Tuesday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(2,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("tue").innerHTML = "'.$view.'"</script>';
                break;
            case('3'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(3)'>".$lang['Wednesday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(3,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("wed").innerHTML = "'.$view.'"</script>';
                break;
            case('4'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(4)'>".$lang['Thursday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(4,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("thu").innerHTML = "'.$view.'"</script>';
                break;
            case('5'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(5)'>".$lang['Friday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(5,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("fri").innerHTML = "'.$view.'"</script>';
                break;
            case('6'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(6)'>".$lang['Saturday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(6,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("sat").innerHTML = "'.$view.'"</script>';
                break;
            case('7'):
                $view = "<a href='#' title='".$lang['Clear']."' style='float: left' id='t' onclick='clear_day($day,1)'><i class='icon-trash'></i></a><a href='#' onclick='day_show(7)'>".$lang['Sunday']."</a><a href='#' style='float: right' title='".$lang['Edit']."' onclick='enable(7,1)'><i class='icon-edit'></i></a><br><br><div class='desc'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b> ".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1. "<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</div>";
                echo '<script>document.getElementById("sun").innerHTML = "'.$view.'"</script>';
                break;
        }
    }

}