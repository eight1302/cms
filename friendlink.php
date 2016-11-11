<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
$_friend = new FriendLinkAction($_tpl);
$_friend->_action();
$_tpl->display('friendlink.tpl');
?>