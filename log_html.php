<?php
    require_once 'functions.php';

    $name = 'log_' . date("Y-m-d-H-i-s").'.html';

    $file = fopen($name, "w") or die("Unable to open file!");


    $result = qM("SELECT * FROM `log`");
    $n = $result->num_rows;
    $log = "<html>
        <head>
            <title>Gymstagram Log</title>
        </head>

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
    fwrite($file, $log);
    fclose($file);

    echo "<script> location.replace('$name') </script>";
?>