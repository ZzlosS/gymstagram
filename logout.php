<?php
require_once 'basic.php';
$page = $_GET['page'];
if(isset($_SESSION['email'])){
	dS();
	
	header('Location:' . $page);
/*	echo $lang['loggedOut'];
}
else{
	echo $lang['CantLogOut'];*/
}
echo "<br></div></body></html>";