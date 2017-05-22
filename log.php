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
        $show = $page * 20 + 1;
        $result2 = qM("SELECT * FROM `log` ORDER BY `id` LIMIT $start,$show");
        for($i = $start; $i < $show; $i++){
            $row = $result2->fetch_assoc();
            echo "<tr><td>$i</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['msg']."</td></tr>";
        }
        echo "</tbody></table>";
        $p = ceil($n/20);
        for($j = 1; $j <= $p; $j++){
            echo "<a href='log.php?page=".$j."'>".$j."</a>\t";
        }
    }
?>

