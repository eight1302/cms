<?php
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
global $_cache;
if(IS_CAHCE){
	$_cache->_action();
}?>