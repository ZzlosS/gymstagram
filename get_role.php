<?php
    require_once 'functions.php';
    require_once 'checklanguage.php';
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if($id != ''){
            $checked = $checked2 = $checked3 = '';
            $result = qM("SELECT `role`,`gym_name` FROM `members` WHERE `id`=$id");
            $row = $result->fetch_assoc();
            if($row['gym_name'] != 'admin'){

                if($row['role'] == 1){
                    $checked = 'checked';
                }
                elseif($row['role'] == 2){
                    $checked2 = 'checked';
                }
                else{
                    $checked3 = 'checked';
                }
                ?>
                <link rel="stylesheet" type="text/css" href="css/mycss.css" />
                <form method='post' action="change_role.php">

                    <ul id="s_ul">
                        <li id="s_li">
                            <input type="radio" id="f-option" name="selector" <?php echo $checked ?> value="1"/>
                            <label for="f-option"><?php echo $lang['user'] ?></label>
                            <div class="check"></div>
                        </li>
                        <br><br><br>
                        <li id="s_li">
                            <input type="radio" id="s-option" name="selector" <?php echo $checked2 ?> value="2"/>
                            <label for="s-option"><?php echo $lang['admin'] ?></label>
                            <div class="check"></div>
                        </li>
                        <br><br><br>
                        <li id="s_li">
                            <input type="radio" id="b-option" name="selector" <?php echo $checked3 ?> value="3"/>
                            <label for="b-option"><?php echo $lang['banned'] ?></label>
                            <div class="check"></div>
                        </li>
                    </ul>
                    <input name="id" hidden value="<?php echo $id ?>" />
                    <br>
                    <input id='but' type="submit" value="<?php echo $lang['SC'] ?>" style="margin-left: 28%"/>
                </form>


<?php       }
        }
    }
    else{
        die("<script>location.replace('home.php')</script>");
    }