<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
global $_tpl;
$_nav = new NavAction($_tpl);   //入口
$_nav->_action();
$_tpl->display('nav.tpl');
?>