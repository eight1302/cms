<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
global $_tpl;
$_adver = new AdverAction($_tpl);   //入口
$_adver->_action();
$_tpl->display('adver.tpl');
?>