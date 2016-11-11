<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
global $_tpl;
$_rotatain = new RotatainAction($_tpl);   //入口
$_rotatain->_action();
$_tpl->display('rotatain.tpl');
?>