<?php
require_once 'basic.php';
if(isset($_SESSION['email'])){
	dS();
	echo "<script> location.replace('index.php'); </script>";

/*	echo $lang['loggedOut'];
}
else{
	echo $lang['CantLogOut'];*/
}
echo "<br></div></body></html>";