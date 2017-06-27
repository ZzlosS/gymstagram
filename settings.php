<?php
require_once 'basic.php';

if(!$loggedIn) die();
?>
<br><br>
<button id="but" onclick="location.replace('changeP.php')"><?php echo $lang['CP']?></button>
<button id="but" onclick="location.replace('passchange.php')"><?php echo $lang['Cpass']?></button>
