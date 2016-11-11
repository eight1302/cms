<?php
require dirname(__FILE__) . '/init.inc.php';
global $_tpl;
$_cast = new CastAction($_tpl);
$_cast->_action();
$_tpl->display('cast.tpl');
?>