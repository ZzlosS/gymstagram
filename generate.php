<?php
/**
 * Created by PhpStorm.
 * User: STRALE
 * Date: 26.6.2017.
 * Time: 13.47
 */

    require_once 'functions.php';

if(isset($_POST['select']) || isset($_POST['date']) || isset($_POST['page']) || isset($_POST['select2'])){

    $q = "SELECT * FROM `log` ";
    $zlo = 0;

    if($_POST['date'] != ""){
        $date = $_POST['date'];
        $day = substr($date, 0, 2);
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);
        $q .= " WHERE YEAR(`date`) = $year AND MONTH(`date`) = $month AND DAY(`date`) = $day ";
        $zlo = 1;
    }

    if($_POST['select'] != ""){
        if($zlo == 1){
            $q .= " AND ";
        } else {
            $q .= " WHERE ";
        }
        $id = $_POST['select'];
        $q .= " `msg` LIKE '%(". $id . ")%' ";
    }

    $page = $_POST['page'];
    $result = qM($q);
    $n = $result->num_rows;

    $limit = 0 + 5 *($page-1);
    $offset = $page * 5;

    $q2 = $q . " ORDER BY `log`.`date` ";
    if($_POST['select2'] == "n"){
        $q2 .= " DESC ";
    }
    $q2 .= " LIMIT $limit, $offset";

    $result2 = qM($q2);

    $toRet = "
            <table border='1'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
        ";

    for($i = $limit; $i < $offset; $i++){
        $row = $result2->fetch_assoc();
        $lid = $i+1;
        $toRet .= "<tr><td>$lid</td>";
        $toRet .= "<td>".$row['date']."</td>";
        $toRet .= "<td>".$row['msg']."</td></tr>";
    }
    $toRet .=  "</tbody></table>";

    $p = ceil($n/5);



    $toRet .= "</tbody></table>";
    if($page-1 < 1){
        $toRet .= "<a style='pointer-events: none;' href='#' onclick='changePage($page-1)'>Previous page</a>";
    }
    else{
        $toRet .= "<a href='#' onclick='changePage($page-1)'>Previous page</a>";
    }

    $toRet .= "<br><b>Current page: ".$page."</b><br>";

    if($page + 1 > $p){
        $toRet .= "<a style='pointer-events: none;' href='#' onclick='changePage($page + 1)'>Next page</a>";
    }
    else{
        $toRet .= "<a href='#' onclick='changePage($page + 1)'>Next page</a>";
    }

    $toRet .= "<br>";
    for($j = 1; $j <= $p; $j++){
        $toRet .= "<a href='#' onclick='changePage($j)'>" . $j . "</a> \t ";
    }

    echo $toRet;
}