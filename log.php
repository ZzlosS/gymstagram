<?php
    require_once 'basic.php';
    ?>
    <table border='1'>
        <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
    <?php
    if(!$loggedIn) die();

    $result = qM("SELECT * FROM `log`");
    $n = $result->num_rows;


    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start = 1 + 20*($page-1);
        $end = $page * 20 + 1;
        $result2 = qM("SELECT * FROM `log` ORDER BY `id` LIMIT $start,$end");
        for($i = $start; $i < $end; $i++){
            $row = $result2->fetch_assoc();
            echo "<tr><td>$i</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['msg']."</td></tr>";
        }
        echo "</tbody></table>";
        $p = ceil($n/20);

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


    }
?>

