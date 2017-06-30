<?php
    require_once 'basic.php';
    if(!$loggedIn || $role!='2') die("<script>location.replace('home.php')</script>");
?>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            showAnim: "slideDown",
            changeMonth: true,
            changeYear: true
        });
    } );
</script>
<script  type="text/javascript">

    function onload_refresh() {
        $.ajax({
            method : "POST",
            url : "generate.php",
            data : {
                'select' : "",
                'select2' : "",
                'date' : "",
                'page' : 1
            },
            success : function(r){
                $("#rez2").html(r)
            }
        });

    }

    function changePage(page){
        $.ajax({
            method : "POST",
            url : "generate.php",
            data : {
                'select' : $("#select").val(),
                'select2' : $("#select2").val(),
                'date' : $("#datepicker").val(),
                'page' : page
            },
            success : function(r){
                $("#rez2").html(r)
            }
        });
    }

    function f(){
        $.ajax({
            method : "POST",
            url : "generate.php",
            data : {
                'select' : $("#select").val(),
                'select2' : $("#select2").val(),
                'date' : $("#datepicker").val(),
                'page' : 1
            },
            success : function(r){
                $("#rez2").html(r)
            }
        });
    }

</script>
<style>
    #but{
        margin: 15px 0 35px 15px;
    }
</style>

<body onload="onload_refresh()">
<div >
    <br><br>
    <div style="float: left">
        <select id='select' onchange='f()' class="soflow">
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
            <select id='select2' onchange='f()' class="soflow">
                <option value="o" ><?php echo $lang['OF'] ?></option>
                <option value="n" ><?php echo $lang['NF'] ?></option>
            </select>
            <label><?php echo $lang['Date'] ?>:
                <input class='d_in' name='datepicker' type='text' id='datepicker' maxlength='10'
                                    value='' onchange='f()'>
            </label>
    </div>
    <button onclick="location.replace('log.php')" id="but"><?php echo $lang['RL'] ?></button>
</div>
    <div id="rez2"></div>

