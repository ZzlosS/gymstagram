<?php
require_once 'functions.php';
require_once 'checklanguage.php';

    if(isset($_POST['id_mc'])) { //vrsi ispis padajucih lista u zavisnosti koja je grupa misica izabrana
        $id_mc = $_POST['id_mc'];
        $id = $_POST['id'];
        $day = $_POST['day'];

        if($id_mc != 0){
            $result = qM("SELECT * FROM exercise WHERE mc_id=$id_mc");
            $n = $result->num_rows;
            echo "<select id='ex1' name='ex1' class='soflow'>";
            echo "</select>";

            echo "<select id='ex2' name='ex2'  class='soflow'>";
            echo "</select>";

            echo "<select id='ex3' name='ex3'  class='soflow'>";
            echo "</select>";

            echo "<select id='ex4' name='ex4'  class='soflow'>";
            echo "</select><br>";

            echo "<select id='from' onchange='to()'  class='soflow'>";
            for($i=9; $i<21; $i++){
                echo "<option value='".$i."'>".$i.":00</option>";
            }
            echo "</select  class='soflow'>";
            echo "<br><select id='to' class='soflow'>";
            for($i=10; $i<22; $i++){
                echo "<option value='".$i."'>".$i.":00</option>";
            }
            echo "</select>";

            while ($row = $result->fetch_assoc()) {
                $id_e = $row['id_e'];
                $name = $row['name_e'];
                $option = "<option value='$id_e'>$name</option>";
                ?>
                <script>
                    var option = "<?php echo $option ?>";
                    $('#ex1').append(option);
                    $('#ex2').append(option);
                    $('#ex3').append(option);
                    $('#ex4').append(option);
                </script>
                <?php
            }

            $fill = qM("SELECT * FROM `plan` WHERE `user_id`=$id AND `muscle_group_id`=$id_mc AND `day`=$day"); //ako postoji vec ta grupa u bazi da popuni sta je vec izabrano
            if($row = $fill->fetch_assoc()){
                echo "sdag";
                $from = $row['from'];
                $to = $row['to'];
                $muscle_group = $row['muscle_group_id'];
                $ex1 = $row['ex1_id'];
                $ex2 = $row['ex2_id'];
                $ex3 = $row['ex3_id'];
                $ex4 = $row['ex4_id'];

                echo "<script>
                $('#mc').val($muscle_group);
                $('#ex1').val($ex1);
                $('#ex2').val($ex2);
                $('#ex3').val($ex3);
                $('#ex4').val($ex4);
                $('#from').val($from);
                $('#to').val($to);
                </script>";
            }
        }
        else{
            echo "";
        }
    }

    if(isset($_POST['hour'])){ //odredjuje vreme za to(do)
        $hour = $_POST['hour'];
        for($i=$hour+1; $i<22; $i++){
                echo "<option value='".$i."'>".$i.":00</option>";
        }
    }

    if(isset($_POST['from'])){
        $id = $_POST['id'];
        $day = $_POST['day'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $muscle_id = $_POST['muscle_id'];
        $ex1 = $_POST['ex1'];
        $ex2 = $_POST['ex2'];
        $ex3 = $_POST['ex3'];
        $ex4 = $_POST['ex4'];
        $check = qM("SELECT * FROM `plan` WHERE `user_id`=$id AND `day`=$day");
        if($check->num_rows){ //ako postoji taj dan u bazi da proveri sta da updatuje
            $row_check = $check->fetch_assoc();
            $empty = true;
            $query = '';
            if($from != $row_check['from']){
                $query .= "`from`=$from";
                $empty = false;
            }
            if($to != $row_check['to']){
                if($empty){
                    $query .= "`to`=$to";
                    $empty = false;
                }
                else{
                    $query .= ",`to`=$to";
                }
            }
            if($muscle_id != $row_check['muscle_group_id']){
                if($empty){
                    $query .= "`muscle_group_id`=$muscle_id";
                    $empty = false;
                }
                else{
                    $query .= ",`muscle_group_id`=$muscle_id";
                }
            }
            if($ex1 != $row_check['ex1_id']){
                if($empty){
                    $query .= "`ex1_id`=$ex1";
                    $empty = false;
                }
                else{
                    $query .= ",`ex1_id`=$ex1";
                }
            }
            if($ex2 != $row_check['ex2_id']){
                if($empty){
                    $query .= "`ex2_id`=$ex2";
                    $empty = false;
                }
                else{
                    $query .= ",`ex2_id`=$ex2";
                }
            }
            if($ex3 != $row_check['ex3_id']){
                if($empty){
                    $query .= "`ex3_id`=$ex3";
                    $empty = false;
                }
                else{
                    $query .= ",`ex3_id`=$ex3";
                }
            }
            if($ex4 != $row_check['ex4_id']){
                if($empty){
                    $query .= "`ex41_id`=$ex4";
                    $empty = false;
                }
                else{
                    $query .= ",`ex4_id`=$ex4";
                }
            }
            if(!$empty){
                qM("UPDATE `plan` SET $query WHERE `user_id`=$id AND `day`=$day");
            }

        }
        else{ //ako ne postoji taj dan u bazi da upise
            qM("INSERT INTO `plan`(`user_id`,`day`,`from`,`to`,`muscle_group_id`,`ex1_id`,`ex2_id`,`ex3_id`,`ex4_id`)
                    VALUES($id,$day,$from,$to,$muscle_id,$ex1,$ex2,$ex3,$ex4)");
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
        if($result->num_rows){ //ako postoji nesto tog dana
            $from = $row['from'];
            $to = $row['to'];
            $muscle_group = $row['name_mc'];
            $ex1 = $row['ex1'];
            $ex2 = $row['ex2'];
            $ex3 = $row['ex3'];
            $ex4 = $row['ex4'];

            echo "<p style='font-size: 15px'><b>".$lang['From'].":</b> ".$from.":00 <b>".$lang['To'].":</b>".$to.":00<br><b>".$lang['Muscle Group'].":</b><br>".$muscle_group."<br><b>".$lang['Exercise'].":</b><br>".$ex1."<br><b>".$lang['Exercise'].":</b><br>".$ex2."<br><b>".$lang['Exercise'].":</b><br>".$ex3."<br><b>".$lang['Exercise'].":</b><br>".$ex4."</p></div>";
        }
    }


    if(isset($_POST['type'])){ //odredjuje gde je kliknuto enable/edit dugme
        $day = $_POST['day'];
        $id = $_POST['id'];
        $type = $_POST['type'];
        $today = $_POST['today'];

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



        if($type == 2){ //2 - klikom na enable preko dana
            $result = qM("SELECT * FROM `plan` WHERE `user_id`=$id AND `day`=$day");
            if($n = $result->num_rows){ //ako je pun dan
                $row = $result->fetch_assoc();
                $from = $row['from'];
                $to = $row['to'];
                $muscle_group = $row['muscle_group_id'];
                $ex1 = $row['ex1_id'];
                $ex2 = $row['ex2_id'];
                $ex3 = $row['ex3_id'];
                $ex4 = $row['ex4_id'];

                echo "<select id='mc' name='mc' onchange='exercise($day)' class='soflow'><option value='0'>".$lang['Muscle Group']."</option>";
                $muscle = qM("SELECT * FROM muscle_group");
                while($row_m = $muscle->fetch_assoc()){
                    $id_m = $row_m['id_m'];
                    $name = $row_m['name_mc'];
                    echo "<option value='$id_m'>$name</option>";
                }
                echo "</select><br>";
                echo "<div id='mc_div'>";
                $result = qM("SELECT * FROM exercise WHERE mc_id=$muscle_group");
                echo "<select id='ex1' name='ex1' class='soflow'>";
                echo "</select>";

                echo "<select id='ex2' name='ex2' class='soflow'>";
                echo "</select>";

                echo "<select id='ex3' name='ex3' class='soflow'>";
                echo "</select>";

                echo "<select id='ex4' name='ex4' class='soflow'>";
                echo "</select><br>";

                while ($row = $result->fetch_assoc()) {
                    $id_e = $row['id_e'];
                    $name = $row['name_e'];
                    $option = "<option value='$id_e'>$name</option>";
                    ?>
                    <script>
                        var option = "<?php echo $option ?>";
                        $('#ex1').append(option);
                        $('#ex2').append(option);
                        $('#ex3').append(option);
                        $('#ex4').append(option);
                    </script>
                    <?php
                }

                echo "<select id='from' onchange='to()' class='soflow'>";
                for($i=9; $i<21; $i++){
                    echo "<option value='".$i."'>".$i.":00</option>";
                }
                echo "</select>";
                echo "<br><select id='to' class='soflow'>";
                for($i=10; $i<22; $i++){
                    echo "<option value='".$i."'>".$i.":00</option>";
                }
                echo "</select><script>
                $('#mc').val($muscle_group);
                $('#ex1').val($ex1);
                $('#ex2').val($ex2);
                $('#ex3').val($ex3);
                $('#ex4').val($ex4);
                $('#from').val($from);
                $('#to').val($to);
                </script><div>";
            }
            else{ //ako je prazan dan
                echo "<select id='mc' name='mc' onchange='exercise($day)' class='soflow'><option value='0'>".$lang['Muscle Group']."</option>";
                $muscle = qM("SELECT * FROM muscle_group");
                while($row_m = $muscle->fetch_assoc()){
                    $id_m = $row_m['id_m'];
                    $name = $row_m['name_mc'];
                    echo "<option value='$id_m'>$name</option>";
                }
                echo "</select><div id='mc_div'></div>";
            }

        }



        elseif($type == 3){ //3 - klikom na enable preko nedelje za prazan dan
            echo "<div class='gallery' id='day'>
            <a href='#'>".$day_name."</a><a href='#' onclick='enable($day,2)' style='float:right'><i class='icon-edit'></i></a><br>
            <a href='#' id='s' onclick='save($day)' style='float:right'></a><br><br>
            <div class='desc'><select id='mc' name='mc' onchange='exercise($day)' class='soflow'><option value='0'>".$lang['Muscle Group']."</option>";
            $muscle = qM("SELECT * FROM muscle_group");
            while($row_m = $muscle->fetch_assoc()){
                $id_m = $row_m['id_m'];
                $name = $row_m['name_mc'];
                echo "<option value='$id_m'>$name</option>";
            }
            echo "</select><div id='mc_div'></div></div></div>";

            if($today != $day){
                echo "<a href='#' onclick='day_show(".$today.")'>".$lang['Today']."</a>";
            }
        }



        elseif($type == 1){ //1 - klikom na enable preko nedelje za pun dan
            $result = qM("SELECT * FROM `plan` WHERE `user_id`=$id AND `day`=$day");
            $row = $result->fetch_assoc();
            $from = $row['from'];
            $to = $row['to'];
            $muscle_group = $row['muscle_group_id'];
            $ex1 = $row['ex1_id'];
            $ex2 = $row['ex2_id'];
            $ex3 = $row['ex3_id'];
            $ex4 = $row['ex4_id'];

            echo "<div class='gallery' id='day'>
            <a href='#'>".$day_name."</a><a href='#' onclick='enable($day,2)' style='float:right'><i class='icon-edit'></i></a><br>
            <a href='#' id='s' onclick='save($day)' style='float:right'></a><br><br>
            <div class='desc'><select id='mc' name='mc' onchange='exercise($day)' class='soflow'><option value='0'>".$lang['Muscle Group']."</option>";
            $muscle = qM("SELECT * FROM muscle_group");
            while($row_m = $muscle->fetch_assoc()){
                $id_m = $row_m['id_m'];
                $name = $row_m['name_mc'];
                echo "<option value='$id_m'>$name</option>";
            }
            echo "</select><br>";
            echo "<div id='mc_div'>";
            $result = qM("SELECT * FROM exercise WHERE mc_id=$muscle_group");
            echo "<select id='ex1' name='ex1' class='soflow'>";
            echo "</select>";

            echo "<select id='ex2' name='ex2' class='soflow'>";
            echo "</select>";

            echo "<select id='ex3' name='ex3' class='soflow'>";
            echo "</select>";

            echo "<select id='ex4' name='ex4' class='soflow'>";
            echo "</select><br>";

            while ($row = $result->fetch_assoc()) {
                $id_e = $row['id_e'];
                $name = $row['name_e'];
                $option = "<option value='$id_e'>$name</option>";
                ?>
                <script>
                    var option = "<?php echo $option ?>";
                    $('#ex1').append(option);
                    $('#ex2').append(option);
                    $('#ex3').append(option);
                    $('#ex4').append(option);
                </script>
                <?php
            }

            echo "<select id='from' onchange='to()' class='soflow'>"; // onmousedown='if(this.options.length>6){this.size=6;}'  onchange='this.size=0;' onblur='this.size=0;' max opcija u prikazu padajuce liste
            for($i=9; $i<21; $i++){
                echo "<option value='".$i."'>".$i.":00</option>";
            }
            echo "</select>";
            echo "<br><select id='to' class='soflow'>";
            for($i=10; $i<22; $i++){
                echo "<option value='".$i."'>".$i.":00</option>";
            }
            echo "</select>";
            echo "<script>
            $('#mc').val($muscle_group);
            $('#ex1').val($ex1);
            $('#ex2').val($ex2);
            $('#ex3').val($ex3);
            $('#ex4').val($ex4);
            $('#from').val($from);
            $('#to').val($to);
            </script><div></div></div>"; //kraj desc i celog diva
        }
    }