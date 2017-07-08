<?php
require_once 'checklanguage.php';
$id = $_POST['id'];
if($id == 1){
    echo "<p class='p-info right'>".$lang['FName'].": Jovan<br>".$lang['LName'].": RadenkoviĆ<br>".$lang['Email'].": jovan.radenkovic@pmf.edu.rs<br></p>";
}
else{
    echo "<p class='p-info left'>".$lang['FName'].": Strahinja<br>".$lang['LName'].": StojadinoviĆ<br>".$lang['Email'].": strahinja.stojadinovic@pmf.edu.rs<br></p>";
}