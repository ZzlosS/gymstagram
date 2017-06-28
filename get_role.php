<?php
    require_once 'functions.php';
    if($_POST['id'] != ''){
        $id = $_POST['id'];
        $checked = $checked2 = $checked3 = '';
        $result = qM("SELECT `role`,`gym_name` FROM `members` WHERE `id`=$id");
        $row = $result->fetch_assoc();
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
        <b>Select role for <?php echo $row['gym_name'] ?>:</b>

        <ul id="s_ul" style="padding-left: 37%">
            <li id="s_li">
                <input type="radio" id="f-option" name="selector" <?php echo $checked ?> value="1"/>
                <label for="f-option">User</label>
                <div class="check"></div>
            </li>

            <li id="s_li">
                <input type="radio" id="s-option" name="selector" <?php echo $checked2 ?> value="2"/>
                <label for="s-option">Admin</label>
                <div class="check"></div>
            </li>

            <li id="s_li">
                <input type="radio" id="s-option" name="selector" <?php echo $checked3 ?> value="3"/>
                <label for="s-option">Banned</label>
                <div class="check"></div>
            </li>
        </ul>
<?php
    }