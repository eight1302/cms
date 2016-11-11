<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_index = new IndexAction($_tpl); 
$_index->_action();
$_tpl->display('index.tpl');
?>