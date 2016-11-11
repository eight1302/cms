<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_feedback = new FeedBackAction($_tpl); 
$_feedback->_action();
$_tpl->display('feedback.tpl');
?>