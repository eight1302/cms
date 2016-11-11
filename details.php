<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_details = new DetailsAction($_tpl); 
$_details->_action();
$_tpl->display('details.tpl');
?>