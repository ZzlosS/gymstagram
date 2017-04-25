<?php
require_once 'basic.php';

if(isset($_SESSION['email'])){
	dS();
	echo $lang['loggedOut'];
}
else{
	echo $lang['CantLogOut'];
}
echo "<br></div></body></html>";