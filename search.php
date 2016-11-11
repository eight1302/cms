<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_search = new SearchAction($_tpl);
$_search->_action();
$_tpl->display('search.tpl');
?>