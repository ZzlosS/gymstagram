<?php
    require_once 'basic.php';
?>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            showAnim: "slideDown",
            /*showOn: "button",
            buttonImage: "img/calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",*/
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
    .soflow {
        -webkit-appearance: button;
        -webkit-border-radius: 2px;
        -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        -webkit-padding-end: 20px;
        -webkit-padding-start: 2px;
        -webkit-user-select: none;
        background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
        background-position: 97% center;
        background-repeat: no-repeat;
        border: 1px solid #AAA;
        color: #555;
        font-size: inherit;
        margin: 20px;
        overflow: hidden;
        padding: 5px 10px;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 300px;
    }

</style>

<body onload="onload_refresh()">
<div >
    <div style="float: left">
        <select id='select' onchange='f()' class="soflow">
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
            <select id='select2' onchange='f()' class="soflow">
                <option value="o" >Oldest First</option>
                <option value="n" >Newest First</option>
            </select>
            <label>Date:
                <input class='d_in' name='datepicker' type='text' id='datepicker' maxlength='10'
                                    value='' onblur='f()'>
            </label>
    </div>
    <button onclick="location.replace('log.php')" id="but">Reset Log</button>
</div>
    <div id="rez2"></div>

