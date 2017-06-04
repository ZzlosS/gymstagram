<?php

# require_once('TCPDF-master/examples/tcpdf_include.php');
require_once ('TCPDF-master/tcpdf.php');
require_once 'functions.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetTitle('Gymstagram Log');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


$result = qM("SELECT * FROM `log`");
$n = $result->num_rows;
$log = "";

for($j = 0; $j < $n; $j++){
    $row = $result->fetch_assoc();
    $i = $j + 1;
    $log .= "<tr><td style=\"text-align:center\" >". $i ."</td>";
    $log .= "<td>" . $row['date'] . "</td>";
    $log .= "<td>".$row['msg']."</td></tr>";
}


$tbl = <<<EOD
    <html>
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
    <table cellspacing="0" cellpadding="1">
                    <thead >
                    <tr class="prvired">
                        <th>Id</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
        $log
        
                    </tbody>
    </table>
    </body>
</html>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$name = 'log_' . date("Y-m-d-H-i-s").'.pdf';
$pdf->Output($name, 'I');

?>