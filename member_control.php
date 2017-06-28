<?php

    require_once 'basic.php';
    if(!$loggedIn) die();

    $result = qM("SELECT `role` FROM `members` WHERE `id`=$id");
    $row = $result->fetch_assoc();
    if($row['role'] == 2){
       ?>
        <script>
            function role(id){
                $.ajax({
                    method: "POST",
                    url: 'get_role.php',
                    data: {'id': id.value},
                    success: function (res) {
                        $('.radio').html(res);
                    }
                });
            }
        </script>
        <br><br>

        <div align="center">
            <select id='select' onchange='role(this)' class="soflow">
                <option value="" >Choose a member</option>
                <?php
                $result = qM("SELECT * FROM `members`");
                $toRet = "";
                while ($r = $result->fetch_assoc()){
                    $gn = $r['gym_name'];
                    $n = $r['name'];
                    $ln = $r['lname'];
                    $id = $r['id'];

                    $toRet .= "<option value='$id'>". $n . " " . $ln . " @" . $gn . "</option>";
                }

                $toRet .= "</select>";

                echo $toRet;
                ?>
                <div class="radio">
                </div>
        </div>
<?php
    }
    else{
        echo"<script>location.replace('home.php')</script>";
    }
