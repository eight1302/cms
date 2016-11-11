<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
//Validate::checkPremission('4','警告：权限不够，你不能管理等级');
global $_tpl;
$_level = new LevelAction($_tpl);   //入口
$_level->_action();
$_tpl->display('level.tpl');
?>