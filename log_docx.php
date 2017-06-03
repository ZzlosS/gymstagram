<?php

require_once 'functions.php';

header("Content-type: application/vnd.ms-word");
$name = "log_" .date("Y-m-d-H-s-i");
header("Content-Disposition: attachment;Filename=$name.doc");

$result = qM("SELECT * FROM `log`");
$n = $result->num_rows;
$log = "
    <style>
    table, th, td {
       border: 1px solid grey;  
    }
    .prvired{
        color: royalblue;
        text-align: center;
        background-color: #c1c1c7;
    }
    h3{
        color: royalblue;
    }
    </style>
    <body>
    <h3> Gymstagram Log</h3>
    <table cellspacing=\"0\" cellpadding=\"1\">
                    <thead >
                    <tr class=\"prvired\">
                        <th>Id</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>";

for($j = 0; $j < $n; $j++){
    $row = $result->fetch_assoc();
    $i = $j + 1;
    $log .= "<tr><td style=\"text-align:center\" >". $i ."</td>";
    $log .= "<td>" . $row['date'] . "</td>";
    $log .= "<td>".$row['msg']."</td></tr>";
}

$log .= "</tbody>
    </table>
    </body>
</html>";

echo "<html>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=Windows-1252'>";
echo $log;
?>