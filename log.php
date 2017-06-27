<?php
    require_once 'basic.php';
?>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            showAnim: "slideDown",
            showOn: "button",
            buttonImage: "img/calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",
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
              'date' : $("#datepicker").val(),
                'page' : 1
            },
            success : function(r){
                $("#rez2").html(r)
            }
        });
    }

</script>

<body onload="onload_refresh()">
<select id='select' onchange='f()'>
    <option value="">Choose a member</option>
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
    <br><label>Date: <input class='d_in' name='datepicker' type='text' id='datepicker' maxlength='10'
                            value='' onblur='f()'></label>
    <br><br>
    <button onclick="location.replace('log.php')" id="but">Reset Log</button>
<br>
<br>
    <div id="rez2"></div>
<div id="rez">

    <?php
    /*
    if(!$loggedIn) die();

    $result = qM("SELECT * FROM `log`");
    $n = $result->num_rows;

*/

    /*if(isset($_GET['page'])){

        echo "<table border='1'>
        <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>";

        $page = 1;
        $start = 0 + 20 *($page-1);
        $end = $page * 20;
        $result2 = qM("SELECT * FROM `log` ORDER BY `id` LIMIT $start, $end");
        // $result1 = qM("SELECT * FROM `log`");

        for($i = $start; $i < $end; $i++){
            $row = $result2->fetch_assoc();
            $lid = $i+1;
            echo "<tr><td>$lid</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['msg']."</td></tr>";
        }
        echo "</tbody></table>";
        $p = ceil($n/20);


            if($page-1 < 1){
               echo "<a style='pointer-events: none;' href='#' onclick='changePage($page-1)'>Previous page</a>";
            }
            else{
                echo  "<a href='#' onclick='changePage($page-1)'>Previous page</a>";
            }

            echo  "<br><b>Current page: ".$page."</b><br>";

            if($page + 1 > $p){
                echo "<a style='pointer-events: none;' href='#' onclick='changePage($page + 1)'>Next page</a>";
            }
            else{
                echo  "<a href='#' onclick='changePage($page + 1)'>Next page</a>";
            }

            echo  "<br>";
            for($j = 1; $j <= $p; $j++){
                echo  "<a href='#' onclick='changePage($j)'>" . $j . "</a> \t ";
            }

        if($page-1 < 1){
            echo "<a style='pointer-events: none;' href='log.php?page=".($page-1)."'>Previous page</a>";
        }
        else{
            echo "<a href='log.php?page=".($page-1)."'>Previous page</a>";
        }

        echo "<br><b>Current page: ".$page."</b><br>";

        if($page+1 > $p){
            echo "<a style='pointer-events: none;' href='log.php?page=".($page+1)."'>Next page</a>";
        }
        else{
            echo "<a href='log.php?page=".($page+1)."'>Next page</a>";
        }

        echo "<br>";
        for($j = 1; $j <= $p; $j++){
            echo "<a href='log.php?page=".$j."'>".$j."</a>\t";
        }


    */
?>
</div>
