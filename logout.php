<?php
    require_once 'basic.php';
    if(isset($_SESSION['email'])){
        qM("INSERT INTO `log`(`date`, `msg`) VALUES ('$date', '$gname($id) has logged out.')");
        dS();
        echo "<script> location.replace('index.php'); </script>";
    }
    echo "<br></div></body></html>";