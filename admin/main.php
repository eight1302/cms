<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
$_main = new MainAction($_tpl);   //入口
$_main->_action();
$_tpl->display('main.tpl');
?>