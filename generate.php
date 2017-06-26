<?php
/**
 * Created by PhpStorm.
 * User: STRALE
 * Date: 26.6.2017.
 * Time: 13.47
 */

    require_once 'functions.php';
    $_POST['select'] = 2;
    $_POST['date'] = "2017-05-30";
    var_dump($_POST);
if(isset($_POST['select']) || isset($_POST['date'])){

    $q = "SELECT * FROM `log` ";
    $zlo = 0;

    if($_POST['date'] != ""){
        $date = $_POST['date'];
       /* $b = qM($q);
        while($rb = $b->fetch_assoc()){
            echo $rb['MRK'];}*/
       $y = $date ;
        $q .= " WHERE YEAR(1date1) = $date ";
        $zlo = 1;
    }
    if($_POST['select'] != ""){
        if($zlo == 1){
            $q .= " AND ";
        } else {
            $q .= " WHERE ";
        }
        $id = $_POST['select'];
        $q .= " `msg` LIKE '%(". $id . ")%'";
    }

    $result = qM($q);
    echo $q;
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

    while ($r = $result->fetch_assoc()){
      $id = $r['id'];
      $date = $r['date'];
      $msg = $r['msg'];
      $toRet .= "<tr> <td> $id </td> <td> $date </td> <td> $msg </td></tr>";
    }

    $toRet .= "</tbody></table>";

    echo $toRet;


}