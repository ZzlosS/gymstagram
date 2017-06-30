<?php

    require_once 'basic.php';
    if(!$loggedIn || $role!='2') die("<script>location.replace('home.php')</script>");

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
        <body id="b2">
        <div class="container2">
            <section id="content2">
                <form>
                    <h1><?php echo $lang['Select_role'] ?>:</h1>
                    <select id='select' onchange='role(this)' class="soflow">
                        <option value="" ><?php echo $lang['Cm'] ?></option>

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

                        <br><br>
                        <div class="radio">
                        </div>
                </form>
            </section>
        </div>
<?php
    }
    else{
        echo"<script>location.replace('home.php')</script>";
    }
