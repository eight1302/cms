<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
isset($_SESSION['admin']) ? Tool::alertLocation(null, 'admin.php') : Tool::alertLocation(null, 'admin_login.php');
?>